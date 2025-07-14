<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function profile()
    {
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        return view('profile', [
            'title'   => 'SIMS PPOB - Syahrul Ramadhan | Profile',
            'profile' => $this->profile
        ]);
    }

    public function uploadImage()
    {
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        $file = $this->request->getFile('file');
        if (!$file->isValid() || $file->getSize() > 102400) {
            return $this->response->setJSON(['status' => 1, 'message' => 'Ukuran maksimal 100KB atau file tidak valid']);
        }

        $filePath = $file->getTempName();
        $fileName = $file->getName();
        $mimeType = $file->getMimeType();

        //multipart PUT
        $curl = curl_init();
        $cFile = new \CURLFile($filePath, $mimeType, $fileName);

        $postData = ['file' => $cFile];

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://take-home-test-api.nutech-integrasi.com/profile/image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->token,
                "Accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $error    = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return $this->response->setJSON(['status' => 1, 'message' => 'Curl Error: ' . $error]);
        }

        $decoded = json_decode($response, true);
        return $this->response->setJSON($decoded);
    }

    public function updateProfile()
    {
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name')
        ];

        $client = \Config\Services::curlrequest();
        try {
            $response = $client->request('PUT', 'https://take-home-test-api.nutech-integrasi.com/profile/update', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ],
                'body' => json_encode($data)
            ]);

            $body = json_decode($response->getBody(), true);
            if ($body['status'] === 0) {
                session()->setFlashdata('success', 'Profil berhasil diperbarui');
            }

            return redirect()->to('/profile');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memperbarui profil');
            return redirect()->back()->withInput();
        }
    }
}

<?php

namespace App\Controllers;

class Topup extends BaseController
{
    public function topup()
    {
        // BaseController
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        return view('topup', [
            'title'   => 'SIMS PPOB - Syahrul Ramadhan | Topup',
            'balance' => $this->balance,
            'profile' => $this->profile
        ]);
    }

    // Tutup BaseController

    public function process()
    {
        if (!session()->has('token')) {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu.');
        }

        $token = session('token');
        $amount = $this->request->getPost('amount');

        session()->setFlashdata('last_amount', number_format((float)$amount, 0, ',', '.'));

        if (!is_numeric($amount) || $amount < 10000 || $amount > 1000000) {
            return redirect()->back()->with('error', 'Nominal harus antara 10.000 hingga 1.000.000');
        }

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post('https://take-home-test-api.nutech-integrasi.com/topup', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ],
                'body' => json_encode([
                    'top_up_amount' => (int)$amount
                ]),
                'http_errors' => false
            ]);

            $body = json_decode($response->getBody(), true);
            if ($response->getStatusCode() === 200 && $body['status'] === 0) {
                return redirect()->to('/topup')->with('success', $body['message']);
            } else {
                return redirect()->back()->with('error', $body['message'] ?? 'Top up gagal.');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

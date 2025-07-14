<?php

namespace App\Controllers;

class Transaction extends BaseController
{
    public function history()
    {
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        $client = \Config\Services::curlrequest();
        $offset = (int) $this->request->getGet('offset') ?? 0;
        $limit = 5;

        try {
            $response = $client->get('https://take-home-test-api.nutech-integrasi.com/transaction/history', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json'
                ],
                'query' => [
                    'offset' => $offset,
                    'limit'  => $limit
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['status']) && $result['status'] === 108) {
                return redirect()->to('/login')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            $records = $result['data']['records'] ?? [];

            return view('transaction/history', [
                'title'       => 'SIMS PPOB - Syahrul Ramadhan | Transaction History',
                'balance'     => $this->balance,
                'profile'     => $this->profile,
                'records'     => $records,
                'limit'       => $limit,
                'offset'      => $offset,
                'nextOffset'  => $offset + $limit
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data transaksi.');
        }
    }
}

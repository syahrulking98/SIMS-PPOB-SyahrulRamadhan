<?php

namespace App\Controllers;

class Service extends BaseController
{
    public function detail($code)
    {
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get('https://take-home-test-api.nutech-integrasi.com/services', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            $services = $result['data'] ?? [];

            $targetService = null;
            foreach ($services as $service) {
                if (strtolower($service['service_code']) === strtolower($code)) {
                    $targetService = $service;
                    break;
                }
            }

            if (!$targetService) {
                return redirect()->to('/dashboard')->with('error', 'Layanan tidak ditemukan');
            }

            return view('service/detail', [
                'title'   => 'SIMS PPOB - Syahrul Ramadhan ' . $targetService['service_name'],
                'balance' => $this->balance,
                'profile' => $this->profile,
                'service' => $targetService
            ]);
        } catch (\Exception $e) {
            return redirect()->to('/dashboard')->with('error', 'Gagal mengambil data layanan');
        }
    }

    public function process($code)
    {
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;

        $client = \Config\Services::curlrequest();

        try {
            // Kirim request transaksi
            $response = $client->post('https://take-home-test-api.nutech-integrasi.com/transaction', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'service_code' => strtoupper($code)
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            if ($body['status'] === 0) {
                $amount = $body['data']['total_amount'] ?? 0;
                $serviceName = $body['data']['service_name'] ?? 'Layanan';

                return redirect()->to('/service/' . strtolower($code))
                    ->with('success', $body['message'])
                    ->with('last_amount', $amount)
                    ->with('last_service', $serviceName);
            } else {
                // Ambil info layanan dari /services
                $targetService = $this->getServiceByCode($code);
                $amount = $targetService['service_tariff'] ?? 0;
                $serviceName = $targetService['service_name'] ?? 'Layanan';

                return redirect()->back()
                    ->with('error', $body['message'] ?? 'Transaksi gagal')
                    ->with('last_amount', $amount)
                    ->with('last_service', $serviceName);
            }
        } catch (\Exception $e) {
            // Exception saat transaksi, fallback ke service info
            $targetService = $this->getServiceByCode($code);
            $amount = $targetService['service_tariff'] ?? 0;
            $serviceName = $targetService['service_name'] ?? 'Layanan';

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghubungi server')
                ->with('last_amount', $amount)
                ->with('last_service', $serviceName);
        }
    }

    //Tambahkan helper internal
    private function getServiceByCode($code)
    {
        $client = \Config\Services::curlrequest();
        try {
            $response = $client->get('https://take-home-test-api.nutech-integrasi.com/services', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $services = $data['data'] ?? [];

            foreach ($services as $service) {
                if (strtolower($service['service_code']) === strtolower($code)) {
                    return $service;
                }
            }
        } catch (\Exception $e) {
            return [];
        }

        return [];
    }
}

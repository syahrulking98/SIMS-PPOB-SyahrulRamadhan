<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function dashboard()
    {
        // BaseController
        $redirect = $this->initializeUserData();
        if ($redirect) return $redirect;
        // Ambil API servis ambek banner
        $client = \Config\Services::curlrequest();

        try {
            // Ambil layanan
            $responseServices = $client->get('https://take-home-test-api.nutech-integrasi.com/services', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                ],
                'http_errors' => false
            ]);

            $bodyServices = json_decode($responseServices->getBody(), true);
            if ($responseServices->getStatusCode() !== 200 || $bodyServices['status'] !== 0) {
                return redirect()->to('/')->with('error', $bodyServices['message'] ?? 'Gagal mengambil layanan.');
            }
            $services = $bodyServices['data'];

            // Ambil banner
            $responseBanner = $client->get('https://take-home-test-api.nutech-integrasi.com/banner', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'http_errors' => false
            ]);

            $bodyBanner = json_decode($responseBanner->getBody(), true);
            $banners = [];

            if ($responseBanner->getStatusCode() === 200 && $bodyBanner['status'] === 0) {
                $banners = $bodyBanner['data'];
            }
            // view
            return view('dashboard', [
                'title'    => 'SIMS PPOB - Syahrul Ramadhan | Dashboard',
                'profile'  => $this->profile,
                'balance'  => $this->balance,
                'services' => $services,
                'banners'  => $banners
            ]);
        } catch (\Throwable $e) {
            return redirect()->to('/')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

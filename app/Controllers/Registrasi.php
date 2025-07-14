<?php

namespace App\Controllers;

class Registrasi extends BaseController
{
    public function registrasi(): string
    {
        return view('registrasi', ['title' => 'SIMS PPOB - Syahrul Ramadhan | Registrasi']);
    }

    public function submit()
    {
        $request = service('request');

        $email    = trim($request->getPost('email'));
        $first    = trim($request->getPost('first_name'));
        $last     = trim($request->getPost('last_name'));
        $password = $request->getPost('password');
        $confirm  = $request->getPost('password_confirm');

        if (!$email || !$first || !$last || !$password || !$confirm) {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with('error', 'Format email tidak valid.');
        }
        $domain = substr(strrchr($email, "@"), 1);
        if (!$domain || !checkdnsrr($domain, 'MX')) {
            return redirect()->back()->withInput()->with('error', 'Email tidak valid.');
        }
        if (strlen($password) < 8) {
            return redirect()->back()->withInput()->with('error', 'Password minimal 8 karakter.');
        }

        if ($password !== $confirm) {
            return redirect()->back()->withInput()->with('error', 'Password tidak cocok.');
        }
        $client = \Config\Services::curlrequest();
        $url = 'https://take-home-test-api.nutech-integrasi.com/registration';

        try {
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'verify' => false,
                'body' => json_encode([
                    'email' => $email,
                    'first_name' => $first,
                    'last_name' => $last,
                    'password' => $password
                ]),
                'http_errors' => false,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            if ($statusCode === 200 && isset($body['status']) && $body['status'] == 0) {
                return redirect()->to('/registrasi')->with('success', $body['message']);
            } else {
                return redirect()->back()->withInput()->with('error', $body['message'] ?? 'Registrasi gagal.');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal terhubung. Silakan coba lagi.');
        }
    }
}

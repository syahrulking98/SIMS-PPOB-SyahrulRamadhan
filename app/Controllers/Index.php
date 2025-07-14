<?php

namespace App\Controllers;

class Index extends BaseController
{
    public function index()
    {
        if (session()->has('token')) {
            return redirect()->to('/dashboard');
        }
        return view('index', ['title' => 'SIMS PPOB - Syahrul Ramadhan | Login']);
    }

    public function submit()
    {
        $request = service('request');
        $email = trim($request->getPost('email'));
        $password = $request->getPost('password');

        // Validasi input
        if (!$email || !$password) {
            return redirect()->back()->withInput()->with('error', 'Email dan Password wajib diisi.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with('error', 'Format email tidak valid.');
        }

        if (strlen($password) < 8) {
            return redirect()->back()->withInput()->with('error', 'Password minimal 8 karakter.');
        }

        $client = \Config\Services::curlrequest();
        $url = 'https://take-home-test-api.nutech-integrasi.com/login';

        try {
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'verify' => false,
                'body' => json_encode([
                    'email' => $email,
                    'password' => $password
                ]),
                'http_errors' => false
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            if ($statusCode === 200 && isset($body['status']) && $body['status'] == 0) {
                session()->set('token', $body['data']['token']);
                session()->set('email', $email);

                return redirect()->to('/dashboard')->with('success', 'Berhasil login.');
            } else {
                return redirect()->back()->withInput()->with('error', $body['message'] ?? 'Login gagal.');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal terhubung ke server.');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah logout.');
    }
}

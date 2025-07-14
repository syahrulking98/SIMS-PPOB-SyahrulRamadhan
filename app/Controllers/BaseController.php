<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    // properti untuk token, profile, dan balance
    protected $token;
    protected $profile = [];
    protected $balance = 0;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = service('session');
    }

    /**
     * mengatasi (token, profile, balance)
     * Panggil di controller sebelum menampilkan view
     */
    protected function initializeUserData()
    {
        if (!session()->has('token')) {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu.');
        }

        $this->token = session('token');
        $client = \Config\Services::curlrequest();

        // Ambil profile
        try {
            $resProfile = $client->get('https://take-home-test-api.nutech-integrasi.com/profile', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                ],
                'http_errors' => false
            ]);

            $bodyProfile = json_decode($resProfile->getBody(), true);
            if ($resProfile->getStatusCode() === 200 && $bodyProfile['status'] === 0) {
                $this->profile = $bodyProfile['data'];
            } else {
                return redirect()->to('/')->with('error', 'Gagal mengambil data profil.');
            }
        } catch (\Throwable $e) {
            return redirect()->to('/')->with('error', 'Gagal terhubung ke server profil.');
        }

        // Ambil saldo
        try {
            $resBalance = $client->get('https://take-home-test-api.nutech-integrasi.com/balance', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                ],
                'http_errors' => false
            ]);

            $bodyBalance = json_decode($resBalance->getBody(), true);
            if ($resBalance->getStatusCode() === 200 && $bodyBalance['status'] === 0) {
                $this->balance = $bodyBalance['data']['balance'] ?? 0;
            } else {
                $this->balance = 0;
            }
        } catch (\Throwable $e) {
            $this->balance = 0;
        }

        return null;
    }
}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'DASHBOARD' ?></title>
    <link rel="icon" href="<?= base_url('assets/image/Logo.png') ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .navbar {
            padding: 1rem 2rem;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: bold;
            gap: 8px;
        }

        .navbar-nav a {
            margin-left: 1.5rem;
            color: #000;
            text-decoration: none;
            font-weight: 500;
        }

        .saldo-card {
            background-image: url('<?= base_url('assets/image/Background Saldo.png') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            color: white;
            border-radius: 1rem;
            padding: 1.5rem 2rem;
            width: 100%;

            display: flex;
            flex-direction: column;
            align-items: flex-start;

            position: relative;
            overflow: hidden;
        }

        .saldo-card>* {
            position: relative;
            z-index: 1;
        }

        .saldo-info h5 {
            font-size: 1rem;
            font-weight: 400;
            margin: 0;
            line-height: 1.2;
        }

        .saldo-info h2 {
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0.25rem 0 0.5rem 0;
        }

        .lihat-saldo {
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
        }

        .lihat-saldo:hover {
            text-decoration: underline;
        }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .layanan-item img {
            width: 40px;
            height: 40px;
            margin-bottom: 0.5rem;
        }

        .promo-section h5 {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .promo-scroll {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .promo-card {
            border-radius: 1rem;
            overflow: hidden;
            background-color: #f8f9fa;
            padding: 0;
            color: #212529;
        }

        .promo-card img {
            width: 100%;
            border-radius: 0.75rem;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 768px) {
            .saldo-info h2 {
                font-size: 1.5rem;
            }
        }


        .topup-section {
            margin-top: 2rem;
        }

        .topup-input {
            margin-bottom: 1rem;
        }

        .topup-buttons .btn {
            margin: 0.3rem;
            min-width: 100px;
        }

        @media (max-width: 767.98px) {
            .row.g-3.align-items-stretch {
                flex-direction: column;
            }
        }

        .topup-section .btn {
            border-radius: 12px;
            font-weight: 500;
        }

        .topup-section input {
            border-radius: 12px;
        }

        /* Semua Transaksi */
        .transaksi-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .nominal {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .nominal.positif {
            color: green;
        }

        .nominal.negatif {
            color: red;
        }

        .tanggal {
            font-size: 0.85rem;
            color: #666;
        }

        .keterangan {
            font-size: 0.95rem;
            color: #333;
        }

        .show-more {
            cursor: pointer;
            color: red;
            font-weight: 600;
            text-align: center;
            margin-top: 1rem;
        }

        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
            cursor: pointer;
        }

        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .edit-icon:hover {
            background-color: #f0f0f0;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .input-group-text {
            background-color: #fff;
            border-right: none;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .btn-primary {
            background-color: #F72514;
            border: none;
            border-radius: 0.5rem;
        }

        .btn-outline-primary {
            border-color: #F72514;
            color: #F72514;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="navbar-brand">
                <a href="<?= base_url('/dashboard') ?>" class="navbar-brand text-decoration-none text-dark">
                    <img src="<?= base_url('assets/image/Logo.png') ?>" alt="Logo" width="24" height="24" />
                    SIMS PPOB
                </a>
            </div>
            <div class="navbar-nav d-flex flex-row">
                <a href="<?= base_url('/topup') ?>" class="me-4 <?= uri_string() === 'topup' ? 'text-danger fw-bold' : '' ?>">Top Up</a>
                <a href="<?= base_url('/transaction/history') ?>" class="me-4">Transaction</a>
                <a href="<?= base_url('/profile') ?>">Akun</a>
            </div>
        </div>
    </nav>
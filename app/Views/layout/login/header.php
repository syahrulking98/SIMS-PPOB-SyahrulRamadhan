<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'SIMS PPOB' ?></title>
    <link rel="icon" href="<?= base_url('assets/image/Logo.png') ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }
        }

        .form-section {
            flex: 1;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo-title {
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            font-size: 1.2rem;
            color: #000;
            margin-bottom: 0.5rem;
        }

        .logo-title img {
            margin-right: 8px;
        }

        .heading {
            font-size: 1.3rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 2rem;
            color: #212529;
        }

        .form-control-icon {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-control-icon input {
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .form-control-icon i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .icon-left {
            left: 10px;
        }

        .icon-right {
            right: 10px;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #e50914;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c40811;
        }

        .register-text {
            margin-top: 1.2rem;
            font-size: 0.9rem;
        }

        .register-text a {
            color: #e50914;
            text-decoration: none;
        }

        .image-section {
            flex: 1;
            background-color: #fff3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .image-section {
                display: none;
            }
        }
    </style>
</head>

<body>
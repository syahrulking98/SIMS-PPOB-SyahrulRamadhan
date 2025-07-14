<?= view('layout/login/header') ?>
<div class="login-wrapper">
    <div class="form-section">
        <div class="form-box">
            <div class="logo-title">
                <img src="<?= base_url('assets/image/Logo.png') ?>" alt="Logo" width="24" height="24">
                <span>SIMS PPOB</span>
            </div>
            <div class="heading">
                Masuk atau buat akun<br>untuk memulai
            </div>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('login') ?>">
                <div class="form-control-icon">
                    <i class="bi bi-at icon-left"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= old('email') ?>" required>
                </div>

                <div class="form-control-icon">
                    <i class="bi bi-lock-fill icon-left"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
                    <i class="bi bi-eye-slash-fill icon-right" id="togglePassword"></i>
                </div>

                <button type="submit" class="btn btn-danger w-100">Masuk</button>
            </form>

            <div class="register-text">
                Belum punya akun? registrasi <a href="<?= base_url('registrasi') ?>">di sini</a>
            </div>
        </div>
    </div>
    <div class="image-section">
        <img src="<?= base_url('assets/image/Illustrasi Login.png') ?>" alt="Ilustrasi Login">
    </div>
</div>
<?= view('layout/login/footer') ?>
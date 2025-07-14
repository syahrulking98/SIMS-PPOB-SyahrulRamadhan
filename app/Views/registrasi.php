<?= view('layout/login/header') ?>

<div class="login-wrapper">
    <div class="form-section">
        <div class="form-box">
            <div class="logo-title mb-3">
                <img src="<?= base_url('assets/image/Logo.png') ?>" alt="Logo SIMS PPOB" width="24" height="24">
                <span class="ms-2 fw-bold">SIMS PPOB</span>
            </div>
            <div class="heading mb-4">
                Lengkapi data untuk<br>membuat akun
            </div>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>
            <form action="<?= base_url('/registrasi') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-control-icon mb-3">
                    <i class="bi bi-at icon-left"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email anda" required>
                </div>

                <div class="form-control-icon mb-3">
                    <i class="bi bi-person icon-left"></i>
                    <input type="text" name="first_name" class="form-control" placeholder="Nama depan" required>
                </div>

                <div class="form-control-icon mb-3">
                    <i class="bi bi-person icon-left"></i>
                    <input type="text" name="last_name" class="form-control" placeholder="Nama belakang" required>
                </div>

                <div class="form-control-icon mb-3">
                    <i class="bi bi-lock icon-left"></i>
                    <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                </div>

                <div class="form-control-icon mb-4">
                    <i class="bi bi-lock-fill icon-left"></i>
                    <input type="password" name="password_confirm" class="form-control" placeholder="Konfirmasi password" required>
                </div>

                <button type="submit" class="btn btn-danger w-100">Registrasi</button>
            </form>
            <div class="register-text mt-3">
                Sudah punya akun? login <a href="<?= base_url('/') ?>">di sini</a>
            </div>

        </div>
    </div>
    <div class="image-section">
        <img src="<?= base_url('assets/image/Illustrasi Login.png') ?>" alt="Ilustrasi Registrasi">
    </div>
</div>

<?= view('layout/login/footer') ?>
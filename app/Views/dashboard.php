<?= view('layout/dashboard/header') ?>
<!-- Main Content -->
<div class="container py-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div>
                <img src="<?= ($profile['profile_image'] && $profile['profile_image'] !== 'https://minio.nutech-integrasi.com/take-home-test/null')
                                ? $profile['profile_image']
                                : base_url('assets/image/Profile Photo.png') ?>" alt="Foto Profil" width="48" height="48" class="mb-2 rounded-circle" />
            </div>
            <p class="mb-1">Selamat datang,</p>
            <h4 class="m-0 fw-bold"><?= esc($profile['first_name'] . ' ' . $profile['last_name']) ?></h4>
        </div>
        <div class="col-md-6">
            <div class="saldo-card">
                <div class="saldo-info">
                    <h5>Saldo anda</h5>
                    <h2 id="saldo-text" style="letter-spacing: 2px">Rp ●●●●●●●</h2>
                </div>
                <div class="lihat-saldo" onclick="toggleSaldo()">Lihat Saldo 👁</div>
            </div>
        </div>
    </div>
    <!-- Grid Layanan -->
    <div class="layanan-grid mb-4">
        <?php foreach ($services as $service) : ?>
            <a href="<?= base_url('/service/' . strtolower($service['service_code'])) ?>" class="text-decoration-none text-dark">
                <div class="layanan-item text-center">
                    <img src="<?= esc($service['service_icon']) ?>" alt="<?= esc($service['service_name']) ?>" />
                    <div><?= esc($service['service_name']) ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>



    <!-- Promo Section -->
    <div class="promo-section">
        <h5>Temukan promo menarik</h5>
        <div class="promo-scroll">
            <?php foreach ($banners as $banner) : ?>
                <div class="promo-card">
                    <img src="<?= esc($banner['banner_image']) ?>" alt="<?= esc($banner['banner_name']) ?>" />
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--Saldo -->
<script>
    let saldoVisible = false;
    const realSaldo = "Rp <?= number_format($balance, 0, ',', '.') ?>";
    const saldoText = document.getElementById("saldo-text");
    const lihatBtn = document.querySelector(".lihat-saldo");

    function toggleSaldo() {
        saldoVisible = !saldoVisible;
        saldoText.textContent = saldoVisible ? realSaldo : "Rp ●●●●●●●●";
        lihatBtn.textContent = saldoVisible ? "Tutup Saldo 👁" : "Lihat Saldo 👁";
    }
</script>

<?= view('layout/dashboard/footer') ?>
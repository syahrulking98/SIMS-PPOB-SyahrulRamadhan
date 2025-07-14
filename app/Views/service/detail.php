<?= view('layout/dashboard/header') ?>

<div class="container py-5">
    <!-- Modal Konfirmasi Pembayaran -->
    <div class="modal fade" id="confirmTopupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="mx-auto mb-3" style="width:60px;height:60px;">
                    <img src="<?= base_url('assets/image/Logo.png') ?>" alt="Warning" style="width:100%;height:auto;" />
                </div>
                <p class="mb-1">Beli <?= esc($service['service_name']) ?> senilai</p>
                <h4 class="fw-bold mb-3" id="confirmAmount">Rp<?= number_format($service['service_tariff'], 0, ',', '.') ?></h4>
                <form action="<?= base_url('/service/' . strtolower($service['service_code']) . '/process') ?>" method="post" id="confirmForm">
                    <input type="hidden" name="service_code" value="<?= $service['service_code'] ?>">
                    <button type="submit" class="btn btn-danger w-100 py-2">Ya, lanjutkan Bayar</button>
                </form>
                <span class="text-muted d-block mt-2" data-bs-dismiss="modal" style="cursor:pointer">Batalkan</span>
            </div>
        </div>
    </div>

    <!-- Modal Hasil Pembayaran -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div id="resultIcon" class="rounded-circle mx-auto mb-3" style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;"></div>
                <p class="mb-1" id="resultText"></p>
                <h4 class="fw-bold mb-2" id="resultAmount">Rp0</h4>
                <p class="mb-0" id="resultStatus"></p>
                <a href="<?= base_url('/dashboard') ?>" class="text-danger fw-semibold d-block mt-3">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div>
                <img src="<?= ($profile['profile_image'] && $profile['profile_image'] !== 'https://minio.nutech-integrasi.com/take-home-test/null') ? $profile['profile_image'] : base_url('assets/image/Profile Photo.png') ?>" alt="Foto Profil" width="48" height="48" class="mb-2 rounded-circle" />
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

    <!-- Konten -->
    <div class="mb-3">
        <p class="mb-1 fw-medium">Pembayaran</p>
        <h5 class="mb-3 d-flex align-items-center gap-2">
            <img src="<?= $service['service_icon'] ? esc($service['service_icon']) : base_url('assets/image/Logo.png') ?>" alt="Icon" style="width: 24px; height: 24px;">
            <strong><?= esc($service['service_name']) ?></strong>
        </h5>
        <h2 class="text-danger fw-bold mb-3">Rp<?= number_format($service['service_tariff'], 0, ',', '.') ?></h2>
        <button type="button" class="btn btn-danger w-100 py-2" id="topup-btn">Beli</button>
    </div>
</div>
<div id="service-data" data-saldo="<?= number_format(is_numeric($balance) ? $balance : 0, 0, ',', '.') ?>" data-success="<?= session()->getFlashdata('success') ?>" data-error="<?= session()->getFlashdata('error') ?>" data-amount="<?= session()->getFlashdata('last_amount') ?>" data-service="<?= session()->getFlashdata('last_service') ?>">
</div>


<?= view('layout/dashboard/footer') ?>
<script src="<?= base_url('assets/js/pages/detail.js') ?>"></script>
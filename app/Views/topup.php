<?= view('layout/dashboard/header') ?>

<div class="container py-5">

    <!-- Modal Notifikasi -->
    <div class="modal fade" id="topupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div id="modalIcon" class="rounded-circle mx-auto mb-3" style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;"></div>
                <p class="mb-1" id="modalTitle">Top Up sebesar</p>
                <h4 class="fw-bold mb-2" id="modalAmount">Rp -</h4>
                <p class="mb-0" id="modalStatus">gagal</p>
                <a href="<?= base_url('/dashboard') ?>" class="text-danger fw-semibold d-block mt-3">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Top Up -->
    <div class="modal fade" id="confirmTopupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="mx-auto mb-3" style="width:60px;height:60px;">
                    <img src="<?= base_url('assets/image/Logo.png') ?>" alt="Warning" style="width:100%;height:auto;" />
                </div>
                <p class="mb-1">Anda yakin untuk Top Up sebesar</p>
                <h4 class="fw-bold mb-3" id="confirmAmount">Rp0</h4>
                <form action="<?= base_url('/topup/process') ?>" method="post" id="confirmForm">
                    <input type="hidden" name="amount" id="confirmInputAmount">
                    <button type="submit" class="btn btn-danger w-100 py-2">Ya, lanjut Top Up</button>
                </form>
                <span class="text-muted d-block mt-2" data-bs-dismiss="modal" style="cursor:pointer">Batalkan</span>
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

    <!-- Form Topup -->
    <div class="topup-section">
        <h5 class="mb-3">Silahkan masukan</h5>
        <h3 class="fw-bold mb-4">Nominal Top Up</h3>

        <form id="topup-form">
            <div class="row g-4">
                <div class="col-md-6 d-flex flex-column gap-3">
                    <input type="number" name="amount" id="amount" class="form-control form-control-lg" placeholder="Masukkan nominal Top Up" min="10000" max="1000000" required />
                    <button type="button" class="btn btn-danger" id="topup-btn" disabled>Top Up</button>
                </div>

                <div class="col-md-6">
                    <div class="row g-2">
                        <?php foreach ([10000, 20000, 50000, 100000, 250000, 500000] as $nominal) : ?>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-secondary w-100 preset-btn" data-value="<?= $nominal ?>">Rp<?= number_format($nominal, 0, ',', '.') ?></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="topup-data" data-saldo="<?= number_format(is_numeric($balance) ? $balance : 0, 0, ',', '.') ?>" data-success="<?= session()->getFlashdata('success') ?>" data-error="<?= session()->getFlashdata('error') ?>" data-amount="<?= session()->getFlashdata('last_amount') ?>">
</div>
<?= view('layout/dashboard/footer') ?>
<script src="<?= base_url('assets/js/pages/topup.js') ?>"></script>
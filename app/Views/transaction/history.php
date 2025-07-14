<?= view('layout/dashboard/header') ?>

<div class="container py-5">
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

    <!-- Semua Transaksi -->
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Semua Transaksi</h5>

        <?php if (!empty($records)) : ?>
            <?php foreach ($records as $item) : ?>
                <div class="transaksi-item">
                    <div>
                        <div class="nominal <?= $item['transaction_type'] === 'TOPUP' ? 'positif' : 'negatif' ?>">
                            <?= $item['transaction_type'] === 'TOPUP' ? '+ ' : '- ' ?>Rp<?= number_format($item['total_amount'], 0, ',', '.') ?>
                        </div>
                        <div class="tanggal">
                            <?= date('d M Y H:i', strtotime($item['created_on'])) ?> WIB
                        </div>
                    </div>
                    <div class="keterangan"><?= esc($item['description']) ?></div>
                </div>
            <?php endforeach; ?>

            <?php if (count($records) >= $limit) : ?>
                <div class="text-center mt-4">
                    <a href="<?= base_url('/transaction/history?offset=' . $nextOffset) ?>" class="show-more">Show more</a>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="text-center text-muted mt-5">
                Maaf tidak ada histori transaksi saat ini
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const saldoText = document.getElementById("saldo-text");
    const lihatBtn = document.querySelector(".lihat-saldo");
    let saldoVisible = false;
    const realSaldo = "Rp <?= number_format(is_numeric($balance) ? $balance : 0, 0, ',', '.') ?>";

    function toggleSaldo() {
        saldoVisible = !saldoVisible;
        saldoText.textContent = saldoVisible ? realSaldo : "Rp ●●●●●●●";
        lihatBtn.textContent = saldoVisible ? "Tutup Saldo 👁" : "Lihat Saldo 👁";
    }
</script>

<?= view('layout/dashboard/footer') ?>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById('amount');
    const topupBtn = document.getElementById('topup-btn');
    const presetBtns = document.querySelectorAll('.preset-btn');
    const saldoText = document.getElementById("saldo-text");
    const lihatBtn = document.querySelector(".lihat-saldo");
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmTopupModal'));
    const confirmAmount = document.getElementById('confirmAmount');
    const confirmInputAmount = document.getElementById('confirmInputAmount');

    // Ambil data dari DOM
    const flashDiv = document.getElementById('topup-data');
    const flashSuccess = flashDiv.dataset.success;
    const flashError = flashDiv.dataset.error;
    const flashAmount = flashDiv.dataset.amount;
    const realSaldo = "Rp " + flashDiv.dataset.saldo;

    // Toggle saldo
    let saldoVisible = false;
    function toggleSaldo() {
        saldoVisible = !saldoVisible;
        saldoText.textContent = saldoVisible ? realSaldo : "Rp ●●●●●●●";
        lihatBtn.textContent = saldoVisible ? "Tutup Saldo 👁" : "Lihat Saldo 👁";
    }
    lihatBtn.addEventListener("click", toggleSaldo);

    // Aktifkan tombol saat input valid
    input.addEventListener('input', function() {
        const val = parseInt(this.value);
        topupBtn.disabled = isNaN(val) || val < 10000 || val > 1000000;
    });

    // Preset nominal
    presetBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            input.value = this.dataset.value;
            topupBtn.disabled = false;
        });
    });

    // Modal konfirmasi
    topupBtn.addEventListener('click', function() {
        const amount = parseInt(input.value);
        if (!amount || isNaN(amount)) return;
        confirmAmount.textContent = `Rp${amount.toLocaleString('id-ID')}`;
        confirmInputAmount.value = amount;
        confirmModal.show();
    });

    // Modal hasil sukses/gagal
    const modal = new bootstrap.Modal(document.getElementById('topupModal'));
    const modalIcon = document.getElementById('modalIcon');
    const modalTitle = document.getElementById('modalTitle');
    const modalAmount = document.getElementById('modalAmount');
    const modalStatus = document.getElementById('modalStatus');

    const amountNumber = parseInt(flashAmount.replace(/\./g, ''));

    if (flashSuccess) {
        modalIcon.className = 'bg-success text-white rounded-circle mx-auto mb-3 d-flex justify-content-center align-items-center';
        modalIcon.innerHTML = '<i class="bi bi-check-lg fs-4"></i>';
        modalTitle.textContent = 'Top Up sebesar';
        modalAmount.textContent = isNaN(amountNumber) ? 'Rp -' : `Rp${amountNumber.toLocaleString('id-ID')}`;
        modalStatus.textContent = 'berhasil!!';
        modal.show();
    }

    if (flashError) {
        modalIcon.className = 'bg-danger text-white rounded-circle mx-auto mb-3 d-flex justify-content-center align-items-center';
        modalIcon.innerHTML = '<i class="bi bi-x-lg fs-4"></i>';
        modalTitle.textContent = 'Top Up sebesar';
        modalAmount.textContent = isNaN(amountNumber) ? 'Rp -' : `Rp${amountNumber.toLocaleString('id-ID')}`;
        modalStatus.textContent = 'gagal';
        modal.show();
    }
});

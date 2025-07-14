document.addEventListener("DOMContentLoaded", function () {
    const saldoText = document.getElementById("saldo-text");
    const lihatBtn = document.querySelector(".lihat-saldo");
    const realData = document.getElementById("service-data");

    const realSaldo = "Rp " + realData.dataset.saldo;
    const flashSuccess = realData.dataset.success;
    const flashError = realData.dataset.error;
    const flashAmount = realData.dataset.amount || "0";
    const flashService = realData.dataset.service;

    // Toggle saldo
    let saldoVisible = false;
    function toggleSaldo() {
        saldoVisible = !saldoVisible;
        saldoText.textContent = saldoVisible ? realSaldo : "Rp ●●●●●●●";
        lihatBtn.textContent = saldoVisible ? "Tutup Saldo 👁" : "Lihat Saldo 👁";
    }
    lihatBtn.addEventListener("click", toggleSaldo);

    // Tampilkan modal konfirmasi saat tombol beli diklik
    const beliBtn = document.getElementById('topup-btn');
    beliBtn.addEventListener('click', function () {
        const modal = new bootstrap.Modal(document.getElementById('confirmTopupModal'));
        modal.show();
    });

    // Tampilkan modal hasil
    const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
    const resultIcon = document.getElementById('resultIcon');
    const resultAmount = document.getElementById('resultAmount');
    const resultStatus = document.getElementById('resultStatus');
    const resultText = document.getElementById('resultText');

    const amountNumber = parseInt(flashAmount.replace(/\./g, ''));

    if (flashSuccess) {
        resultIcon.className = 'bg-success text-white rounded-circle mx-auto mb-3 d-flex justify-content-center align-items-center';
        resultIcon.innerHTML = '<i class="bi bi-check-lg fs-4"></i>';
        resultAmount.textContent = isNaN(amountNumber) ? 'Rp -' : `Rp${amountNumber.toLocaleString('id-ID')}`;
        resultStatus.textContent = 'berhasil!!';
        resultText.textContent = `Pembayaran ${flashService} sebesar`;
        resultModal.show();
    }

    if (flashError) {
        resultIcon.className = 'bg-danger text-white rounded-circle mx-auto mb-3 d-flex justify-content-center align-items-center';
        resultIcon.innerHTML = '<i class="bi bi-x-lg fs-4"></i>';
        resultAmount.textContent = isNaN(amountNumber) ? 'Rp -' : `Rp${amountNumber.toLocaleString('id-ID')}`;
        resultStatus.textContent = 'gagal';
        resultText.textContent = `Pembayaran ${flashService} sebesar`;
        resultModal.show();
    }
});

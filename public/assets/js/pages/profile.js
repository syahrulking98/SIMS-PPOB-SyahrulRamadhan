document.addEventListener("DOMContentLoaded", function () {
    function showModal(isSuccess, message) {
        const modal = new bootstrap.Modal(document.getElementById('profileModal'));
        const modalIcon = document.getElementById('modalIcon');
        const modalTitle = document.getElementById('modalTitle');
        const modalStatus = document.getElementById('modalStatus');

        if (isSuccess) {
            modalIcon.className = 'bg-success text-white rounded-circle mx-auto mb-3 d-flex justify-content-center align-items-center';
            modalIcon.innerHTML = '<i class="bi bi-check-lg fs-4"></i>';
            modalTitle.textContent = 'Berhasil';
        } else {
            modalIcon.className = 'bg-danger text-white rounded-circle mx-auto mb-3 d-flex justify-content-center align-items-center';
            modalIcon.innerHTML = '<i class="bi bi-x-lg fs-4"></i>';
            modalTitle.textContent = 'Gagal';
        }

        modalStatus.textContent = message;
        modal.show();
    }

    window.handleProfileChange = function (event) {
        const file = event.target.files[0];
        if (!file) return;

        if (file.size > 102400) {
            showModal(false, "Ukuran gambar maksimal 100KB.");
            return;
        }

        const formData = new FormData();
        formData.append("file", file);

        fetch(profileUploadUrl, {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 0) {
                showModal(true, "Foto profil berhasil diperbarui.");
                setTimeout(() => location.reload(), 1500);
            } else {
                showModal(false, data.message || "Gagal upload foto");
            }
        })
        .catch(() => showModal(false, "Terjadi kesalahan saat upload"));
    };

    const editBtn = document.getElementById('editBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const saveCancelGroup = document.getElementById('saveCancelGroup');
    const buttonGroup = document.getElementById('buttonGroup');
    const firstNameInput = document.getElementById('firstName');
    const lastNameInput = document.getElementById('lastName');

    editBtn.addEventListener('click', function() {
        firstNameInput.disabled = false;
        lastNameInput.disabled = false;
        buttonGroup.classList.add('d-none');
        saveCancelGroup.classList.remove('d-none');
    });

    cancelBtn.addEventListener('click', function() {
        firstNameInput.disabled = true;
        lastNameInput.disabled = true;
        saveCancelGroup.classList.add('d-none');
        buttonGroup.classList.remove('d-none');
    });
});

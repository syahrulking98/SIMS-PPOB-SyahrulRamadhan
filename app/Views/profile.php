<?= view('layout/dashboard/header') ?>

<div class="container py-5">
    <div class="container text-center py-5">
        <div class="profile-container mb-3 position-relative">
            <img src="<?= ($profile['profile_image'] && $profile['profile_image'] !== 'https://minio.nutech-integrasi.com/take-home-test/null') ? $profile['profile_image'] : base_url('assets/image/Profile Photo.png') ?>" alt="Profile" class="profile-img" id="profilePicture">
            <div class="edit-icon" title="Edit Foto Profil" onclick="document.getElementById('uploadProfile').click()">✎</div>
            <input type="file" id="uploadProfile" accept="image/jpeg,image/png" style="display:none;" onchange="handleProfileChange(event)">
        </div>

        <h4 id="profileName"><?= esc($profile['first_name'] . ' ' . $profile['last_name']) ?></h4>

        <form class="text-start mx-auto" style="max-width: 600px;" method="post" action="<?= base_url('/profile/update') ?>" id="editForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="<?= esc($profile['email']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">Nama Depan</label>
                <input type="text" class="form-control" id="firstName" name="first_name" value="<?= esc($profile['first_name']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Nama Belakang</label>
                <input type="text" class="form-control" id="lastName" name="last_name" value="<?= esc($profile['last_name']) ?>" disabled>
            </div>

            <div class="d-grid gap-2 mt-4" id="buttonGroup">
                <button type="button" class="btn btn-primary btn-lg" id="editBtn">Edit Profile</button>
                <a href="<?= base_url('/logout') ?>" class="btn btn-outline-primary btn-lg">Logout</a>
            </div>

            <div class="d-grid gap-2 mt-4 d-none" id="saveCancelGroup">
                <button type="submit" class="btn btn-success btn-lg">Simpan</button>
                <button type="button" class="btn btn-secondary btn-lg" id="cancelBtn">Batalkan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Notifikasi -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div id="modalIcon" class="rounded-circle mx-auto mb-3" style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;"></div>
            <p class="mb-1" id="modalTitle">Status</p>
            <p class="mb-0" id="modalStatus">Pesan</p>
        </div>
    </div>
</div>

<script>
    const profileUploadUrl = "<?= base_url('/profile/upload') ?>";
</script>

<?= view('layout/dashboard/footer') ?>
<script src="<?= base_url('assets/js/pages/profile.js') ?>"></script>
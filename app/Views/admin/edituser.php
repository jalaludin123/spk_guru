<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="row g-2 mb-3">
  <div class="col-12">
    <div class="d-block bg-white rounded shadow p-3">
      <div class="card">
        <h5 class="card-header"><?= $title; ?></h5>
        <div class="card-body">
          <form action="<?= base_url('admin/user/update/' . $user['id_user']); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="user" value="<?= $user['id_user']; ?>">
            <div class="mb-3">
              <label for="Nama" class="form-label label ">Nama</label>
              <input type="text" name="nama"
                class="form-control form <?= ($validation->hasError('nama')) ? 'is-invalid' : null ?>" id="Nama"
                value="<?= old('nama', $user['nama']); ?>" placeholder="Masukan Nama User">
              <div class="invalid-feedback">
                <?= $validation->getError('nama') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Username" class="form-label label ">Username</label>
              <input type="text" name="username"
                class="form-control form <?= ($validation->hasError('username')) ? 'is-invalid' : null ?>" id="Username"
                value="<?= old('username', $user['username']); ?>" placeholder="Masukan Username">
              <div class="invalid-feedback">
                <?= $validation->getError('username') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Password" class="form-label label ">Password</label>
              <input type="password" name="password"
                class="form-control form <?= ($validation->hasError('password')) ? 'is-invalid' : null ?>" id="Password"
                value="<?= old('password'); ?>" placeholder="Masukan password">
              <div class="invalid-feedback">
                <?= $validation->getError('password') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Level" class="form-label label ">Level</label>
              <select name="level" id="Level"
                class="form-control form <?= ($validation->hasError('level')) ? 'is-invalid' : null; ?>">
                <option value="">--Pilih Jenis Kelamin--</option>
                <option value="admin" <?= old('level', $user['level']) == 'admin' ? 'selected' : null ?>>Admin</option>
                <option value="user" <?= old('level', $user['level']) == 'user' ? 'selected' : null ?>>User</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('level') ?>
              </div>
            </div>
            <div class="mt-5 save">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
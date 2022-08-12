<?= $this->extend("template/layout-login") ?>
<?= $this->section("body") ?>

<div class="container reg">
  <div class="register">
    <div class="title-login">
      <p><?= $title; ?></p>
    </div>
    <div class="form-login">
      <form action="<?= base_url('login/insert'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="mb-3">
          <label for="Nama" class="form-label label ">Nama</label>
          <input type="text" class="form-control form <?= ($validation->hasError('nama')) ? 'is-invalid' : null ?>"
            id="Nama" name="nama" value="<?= old('nama') ?>" placeholder="Nama User">
          <div class="invalid-feedback">
            <?= $validation->getError('nama') ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="Nama" class="form-label label ">Username</label>
          <input type="text" class="form-control form <?= ($validation->hasError('username')) ? 'is-invalid' : null ?>"
            id="floatingInput" name="username" value="<?= old('username') ?>" placeholder="username">
          <div class="invalid-feedback">
            <?= $validation->getError('username') ?>
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col-6">
            <label for="Password" class="form-label label ">Password</label>
            <input type="password"
              class="form-control form <?= ($validation->hasError('password')) ? 'is-invalid' : null ?>" id="Password"
              name="password" placeholder="Password">
            <div class="invalid-feedback">
              <?= $validation->getError('password') ?>
            </div>
          </div>
          <div class="col-6">
            <label for="confirm" class="form-label label ">Repeat Password</label>
            <input type="password"
              class="form-control form <?= ($validation->hasError('confirm')) ? 'is-invalid' : null ?>" id="confirm"
              name="confirm" placeholder="Repeat Password">
            <div class="invalid-feedback">
              <?= $validation->getError('confirm') ?>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="Level" class="form-label label ">Level</label>
          <select name="level" id="Level"
            class="form-control form <?= ($validation->hasError('level')) ? 'is-invalid' : null; ?>">
            <option value="">--Pilih Level--</option>
            <option value="user" <?= old('level') == 'user' ? 'selected' : null ?>>User</option>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('level') ?>
          </div>
        </div>
        <div class="button-login">
          <button type="submit" class="btn btn-primary">Register</button>
          <p>Already have an account ? <a href="<?= base_url('login'); ?>">Login</a></p>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
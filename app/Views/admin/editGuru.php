<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="row g-2 mb-3">
  <div class="col-12">
    <div class="d-block bg-white rounded shadow p-3">
      <div class="card">
        <h5 class="card-header"><?= $title; ?></h5>
        <div class="card-body">
          <form action="<?= base_url('admin/guru/update/' . $guru['id_guru']); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id" value="<?= $guru['id_guru']; ?>">
            <div class="mb-3">
              <label for="Nama" class="form-label label ">Nama</label>
              <input type="text" name="nama"
                class="form-control form <?= ($validation->hasError('nama')) ? 'is-invalid' : null ?>" id="Nama"
                value="<?= old('nama', ($guru['nama_guru']) ? $guru['nama_guru'] : ''); ?>"
                placeholder="Masukan Nama Guru">
              <div class="invalid-feedback">
                <?= $validation->getError('nama') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Jabatan" class="form-label label ">Jabatan</label>
              <select name="jabatan" id="Jabatan"
                class="form-control form <?= ($validation->hasError('jabatan')) ? 'is-invalid' : null; ?>">
                <option value="">--Pilih Jabatan--</option>
                <option value="Guru"
                  <?= old('jabatan', ($guru['jabatan']) ? $guru['jabatan'] : '') == 'Guru' ? 'selected' : null ?>>
                  Guru</option>
                <option value="Staf"
                  <?= old('jabatan', ($guru['jabatan']) ? $guru['jabatan'] : '') == 'Staf' ? 'selected' : null ?>>
                  Staf</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('jabatan') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Jk" class="form-label label ">Jenis Kelamin</label>
              <select name="jk" id="Jk"
                class="form-control form <?= ($validation->hasError('jk')) ? 'is-invalid' : null; ?>">
                <option value="">--Pilih Jenis Kelamin--</option>
                <option value="Pria" <?= old('jk', ($guru['jk']) ? $guru['jk'] : '') == 'Pria' ? 'selected' : null ?>>
                  Pria</option>
                <option value="Wanita"
                  <?= old('jk', ($guru['jk']) ? $guru['jk'] : '') == 'Wanita' ? 'selected' : null ?>>Wanita
                </option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('jk') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Pend" class="form-label label ">Pendidikan</label>
              <select name="pendidikan" id="Pend"
                class="form-control form <?= ($validation->hasError('pendidikan')) ? 'is-invalid' : null; ?>">
                <option value="">--Pilih Pendidikan--</option>
                <option value="SMA"
                  <?= old('pendidikan', ($guru['pendidikan']) ? $guru['pendidikan'] : '') == 'SMA' ? 'selected' : null ?>>
                  SMA</option>
                <option value="S1"
                  <?= old('pendidikan', ($guru['pendidikan']) ? $guru['pendidikan'] : '') == 'S1' ? 'selected' : null ?>>
                  S1</option>
                <option value="S2"
                  <?= old('pendidikan', ($guru['pendidikan']) ? $guru['pendidikan'] : '') == 'S2' ? 'selected' : null ?>>
                  S2</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('pendidikan') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Kerja" class="form-label label ">Masa Kerja</label>
              <select name="kerja" id="Kerja"
                class="form-control form <?= ($validation->hasError('kerja')) ? 'is-invalid' : null; ?>">
                <option value="">Pilih</option>
                <option value="1 Tahun"
                  <?= old('kerja', ($guru['kerja']) ? $guru['kerja'] : '') == '1 Tahun' ? 'selected' : null ?>>
                  1 Tahun</option>
                <option value="2 Tahun"
                  <?= old('kerja', ($guru['kerja']) ? $guru['kerja'] : '') == '2 Tahun' ? 'selected' : null ?>>
                  2 Tahun</option>
                <option value="3 Tahun"
                  <?= old('kerja', ($guru['kerja']) ? $guru['kerja'] : '') == '3 Tahun' ? 'selected' : null ?>>
                  3 Tahun</option>
                <option value="4 Tahun"
                  <?= old('kerja', ($guru['kerja']) ? $guru['kerja'] : '') == '4 Tahun' ? 'selected' : null ?>>
                  4 Tahun</option>
                <option value="5 Tahun Lebih"
                  <?= old('kerja', ($guru['kerja']) ? $guru['kerja'] : '') == '5 Tahun/Lebih' ? 'selected' : null ?>>
                  5 Tahun/Lebih
                </option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('kerja') ?>
              </div>
            </div>
            <div class="mb-3">
              <label for="Tgl" class="form-label label ">Tanggal Lahir</label>
              <input type="date" name="tgl"
                class="form-control form <?= ($validation->hasError('tgl')) ? 'is-invalid' : null ?>" id="Tgl"
                value="<?= old('tgl', ($guru['tgl_lahir']) ? $guru['tgl_lahir'] : ''); ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('tgl') ?>
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
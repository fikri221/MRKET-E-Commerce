<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
  <div class="row">

    <!-- Float Kiri -->
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-header">
              Menu
            </div>
            <div class="list-group list-group-flush">
              <li class="list-group-item">
                  <a href="<?= base_url('profile') ?>">Profile</a>
              </li>
              <li class="list-group-item">
                  <a href="/orders.html">Orders</a>
              </li>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Float Kanan -->
    <div class="col-md-9">
      <div class="card">
          <div class="card-header">
              Formulir Profil
          </div>
          <div class="card-body">
            <?= form_open_multipart($form_action, ['method' => 'POST']) ?>
                <?= isset($input->id) ? form_hidden('id', $input->id) : '' ; ?>
                <div class="form-group">
                    <label for="">Nama</label>
                    <?= form_input(['name' => 'name', 'value' => $input->name, 'class' => 'form-control', 'required' => true, 'autofocus' => true]) ?>
                    <?= form_error('name'); ?>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control', 'required' => true]) ?>
                    <?= form_error('email'); ?>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Masukkan password minimal 8 karakter']) ?>
                    <?= form_error('password'); ?>
                </div> 
                <div class="form-group">
                    <label for="">Foto</label><br>
                    <?= form_upload('image') ?>
                    <?php if($this->session->flashdata('image_error')) :  ?>
                      <small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
                    <?php endif ?>
                    <?php if(isset($input->image)) : ?>
                      <img src="<?= base_url("/images/user/$input->image") ?>" alt="" height="150">
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            <?= form_close() ?>
          </div>
      </div>
    </div>
  </div>
</main>
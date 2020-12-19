<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <?= form_open('login', ['method' => 'POST']); ?>
            <div class="form-group">
              <label for="">Email</label>
              <?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 
              'class' => 'form-control', 'required' => true]); ?>
              <?= form_error('email'); ?>
            </div>
            <div class="form-group">
              <label for="">Password</label>
              <?= form_password('password', '', ['class' => 'form-control', 'required' => true]) ?>
              <?= form_error('password'); ?>
            </div>
            <button type="submit" class="btn btn-success">Login</button>
          <?= form_close(); ?>
        </div>
        <div class="text-center mb-3">
        
          Belum punya akun? Silahkan <a href="<?= base_url("register") ?>">register</a>
        </div>
      </div>
    </div>
  </div>
</main>
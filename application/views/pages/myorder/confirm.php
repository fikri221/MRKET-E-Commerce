<main role="main" class="container">
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
                    <a href="<?= base_url('myorder') ?>">Orders</a>
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
            Konfirmasi Order #<?= $order->invoice; ?>
            <div class="float-right">
                <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
            </div>
          </div>
          <?= form_open_multipart($form_action, ['method' => 'POST']) ?>
            <?=
                form_hidden('id_orders', $order->id);
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Transaksi</label>
                    <input type="text" class="form-control" value="#<?= $order->invoice ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nama Pemilik Rekening</label>
                    <?= form_input(['type' => 'text', 'name' => 'account_name', 'value' => $input->account_name, 
                    'class' => 'form-control', 'required' => true]) ?>
                    <?= form_error('account_name') ?>
                </div>
                <div class="form-group">
                    <label for="">Nomor Rekening</label>
                    <?= form_input(['type' => 'number', 'name' => 'account_number', 'value' => $input->account_number, 
                    'class' => 'form-control', 'required' => true]) ?>
                    <?= form_error('account_number') ?>
                </div>
                <div class="form-group">
                    <label for="">Nominal Pembayaran</label>
                    <?= form_input(['type' => 'number', 'name' => 'nominal', 'value' => $input->nominal, 
                    'class' => 'form-control', 'required' => true]) ?>
                    <?= form_error('nominal') ?>
                </div>
                <div class="form-group">
                    <label for="">Catatan</label>
                    <?= 
                      form_textarea(['name' => 'note', 'value' => $input->note, 
                      'row' => 4, 'class' => 'form-control']);
                     ?>
                     <?= form_error('note') ?>
                </div>
                <div class="form-group">
                    <label for="">Bukti Transfer</label>
                    <?= form_upload('image') ?>
                    <?php if($this->session->flashdata('image_error')) :  ?>
                      <small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
                    <?php endif ?>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
            </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</main>
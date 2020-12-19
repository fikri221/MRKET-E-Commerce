<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
  <div class="row">
    <!-- Float Kiri -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            Formulir Alamat Pengiriman
            </div>
            <div class="card-body">
            <?= form_open(base_url('checkout/create'), ['method' => 'POST']) ?>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <?= 
                            form_input(['name' => 'name', 'value' => $input_name->name, 'class' => 'form-control', 
                            'placeholder' => "Masukkan nama penerima", 'required' => true, 'autofocus' => true]) ?>
                        <?= form_error('name'); ?>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <?= 
                            form_textarea(['name' => 'address', 'value' => $input->address, 
                            'row' => 4, 'class' => 'form-control', 'placeholder' => "Masukkan alamat penerima"]);
                        ?>
                        <?= form_error('address') ?>
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <?= 
                            form_input(['name' => 'phone', 'value' => $input->phone, 'class' => 'form-control', 
                            'placeholder' => "Masukkan nomor telepon penerima", 'required' => true, 'autofocus' => true]) ?>
                        <?= form_error('phone'); ?>
                    </div>
                    <button type="submit" class="btn btn-success">Pembayaran <i class="fas fa-angle-right"></i></button>
                <?php form_close() ?>
            </div>
      </div>
    </div>

    <!-- Float Kanan -->
    <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-3">
              <div class="card-header">
                Cart
              </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart as $row) : ?>
                            <tr>
                                <td><?= $row->product_title ?></td>
                                <td class="text-center"><?= $row->qty ?></td>
                                <td class="text-center">Rp <?= number_format($row->subtotal, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                            <?php endforeach ?>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                <th class="text-center" style="color: #FE4E00;">Rp <?= number_format(array_sum(array_column(
                                  $cart, 'subtotal')), 0, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</main>
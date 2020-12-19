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
            Detail Order #<?= $order->invoice; ?>
            <div class="float-right">
                <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
            </div>
          </div>
          <div class="card-body">
            <p class="tab1"><span>Tanggal</span> : <?= str_replace('-', '/', date("d-m-Y", strtotime($order->date))); ?></p>
            <p class="tab1"><span>Nama</span> : <?= $order->name ?></p>
            <p class="tab1"><span>Telepon</span> : <?= $order->phone ?></p>
            <p class="tab1"><span>Alamat</span> : <?= $order->address ?></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($order_detail as $row) : ?>
                        <tr>
                            <td>
                                <p><img src="<?= $row->image ? base_url("images/product/$row->image") : 
                              base_url("images/product/no_image_available.jpg") ?>" alt="" height="50"><strong> <?= $row->title ?></strong></p>
                            </td>
                            <td class="text-center"><strong>Rp <?= number_format($row->price, 0, ',', '.') ?></strong></td>
                            <td class="text-center"><?= $row->qty ?></td>
                            <td class="text-center"><strong>Rp <?= number_format($row->subtotal, 0, ',', '.') ?></strong></td>
                            <td>
                                <form action="<?= base_url("myorder/delete/$row->id") ?>" method="POST">
                                  <input type="hidden" name="id" value="<?= $row->id ?>">
                                  <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt" 
                                  onclick="return confirm('Apakah yakin ingin menghapus?')"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="3"><strong>Total:</strong></td>
                            <td style="color: #FE4E00;" class="text-center"><strong>Rp <?= number_format(array_sum(array_column(
                                  $order_detail, 'subtotal')), 0, ',', '.') ?></strong></td>
                        </tr>
                    </tbody>
                </table>
          </div>
          <?php if($order->status == 'waiting') : ?>
          <div class="card-footer">
              <a href="<?= base_url("myorder/confirm/$order->invoice") ?>" class="btn btn-success">Pembayaran</a>
          </div>
          <?php endif ?>
      </div>
        <br>
      <?php if(isset($order_confirm)) : ?>
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Bukti Transfer
                    </div>
                    <div class="card-body">
                        <p class="tab1"><span>Dari Rekening</span> : <strong><?= $order_confirm->account_number; ?></strong></p>
                        <p class="tab1"><span>Atas Nama</span> : <?= $order_confirm->account_name; ?></p>
                        <p class="tab1"><span>Nominal</span> : Rp. <?= number_format($order_confirm->nominal, 0, ',', '.'); ?></p>
                        <p class="tab1"><span>Catatan</span> : <?= $order_confirm->note; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="" height="250">
            </div>
        </div>
        <?php endif ?>
    </div>
  </div>
</main>
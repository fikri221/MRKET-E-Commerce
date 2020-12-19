<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
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
                              <th>Harga</th>
                              <th class="text-center">Jumlah</th>
                              <th>Subtotal</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($content as $row) : ?>
                          <tr>
                              <td>
                                  <p><img src="<?= $row->image ? base_url("images/product/$row->image") : 
                                  base_url("images/product/no_image_available.jpg") ?>" alt="" height="50">
                                  <strong> <?= $row->product_title ?></strong></p>
                              </td>
                              <td><strong>Rp <?= number_format($row->price, 0, ',', '.') ?></strong></td>
                              <td>
                                  <form action="<?= base_url("cart/update/$row->id") ?>" method="POST">
                                  <?= form_hidden('id', $row->id) ?>
                                      <div class="input-group">
                                          <input type="number" name="qty" class="form-control text-center" value="<?= $row->qty ?>">
                                          <div class="input-group-append">
                                              <button class="btn btn-info"><i class="fas fa-check"></i></button>
                                          </div>
                                      </div>
                                  <?= form_close() ?>
                              </td>
                              <td><strong>Rp <?= number_format($row->subtotal, 0, ',', '.') ?></strong></td>
                            <td>
                                <?= form_open("cart/delete/$row->id", ['method' => 'POST']) ?>
                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt" 
                                    onclick="return confirm('Apakah yakin ingin menghapus?')"></i></button>
                                <?= form_close() ?>
                            </td>
                          </tr>
                        <?php endforeach ?>
                          <tr>
                              <td colspan="3"><strong>Total:</strong></td>
                              <td style="color: #FE4E00;"><strong>Rp <?= number_format(array_sum(array_column(
                                  $content, 'subtotal')), 0, ',', '.') ?></strong></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="card-footer">
                  <a href="<?= base_url('checkout') ?>" class="btn btn-success float-right">Checkout <i class="fas fa-angle-right"></i></a>
                  <a href="<?= base_url() ?>" class="btn btn-warning float-left"><i class="fas fa-angle-left"></i> Kembali</a>
              </div>
          </div>
      </div>
  </div>
</main>
<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
  <div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          Checkout Berhasil
        </div>
        <div class="card-body">
          <form action="" method="post">
            <h5>Nomor Order: <?= $content->invoice; ?></h5>
            <p>Terimakasih sudah berbelanja.</p>
            <p>Silahkan lakukan pembayaran untuk bisa kami prosesd dengan cara:</p>
            <ol>
                <li>Lakukan pembayaran pada rekening <strong>BRI 628238979613</strong> a/n MRket E-Commerce</li>
                <li>Sertakan keterangan dengan nomor order: <strong><?= $content->invoice; ?></strong></li>
                <li>Total pembayaran: <strong style="color: #FE4E00;">Rp <?= number_format($content->total, 0, ',', '.'); ?></strong></li>
            </ol>
            <p>Jika sudah, Silahkan kirimkan bukti pembayaran transfer dihalaman konfirmasi atau bisa <a href="<?= base_url("myorder/detail/$content->invoice") ?>">
                klik disini</a>!</p>
            <a href="<?= base_url() ?>" class="btn btn-primary"><i class="fas fa-angle-left"></i> Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
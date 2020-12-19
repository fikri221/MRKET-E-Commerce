<main role="main" class="container">
  <?php $this->load->view('layouts/_alert'); ?>
  <div class="row">

    <!-- Float Kiri -->
    <div class="col-lg-3">
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-3">
            <div class="card-header">
              Semua Kategori
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="<?= base_url('home') ?>">Semua Kategori</a></li>
              <?php foreach(getCategories() as $rowcat) : ?>
              <li class="list-group-item"><a href="<?= base_url("shop/category/$rowcat->slug") ?>"><?= $rowcat->title; ?></a></li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Float Kanan -->
    <div class="col-lg-9">

      <!-- Card -->
      <div class="row">
        <div class="card mt-4">
            <img class="card-img-top" src="<?= $order->image ? base_url("images/product/$order->image") : 
            base_url('images/product/no_image_available.jpg') ?>" alt="" height="350">
            <div class="card-body">
                <h3 class="card-title"><?= $order->title ?></h3>
                <h4 style="color: #FE4E00;">Rp <?= number_format($order->price, 0, ',', '.') ?></h4>
                <?php if(array_sum(array_column($rate, 'ratings')) > 0 && $total_rows > 0) : ?>
                  <?php $total_rating = round(array_sum(array_column($rate, 'ratings')) / $total_rows, 1) ?>
                  <?php if($total_rating <= 5 && $total_rating > 3) : ?>
                    <p class="card-text"><strong>Rating:</strong> <strong style="color: green"><?= $total_rating ?></strong></p>
                  <?php endif ?>
                  <?php if($total_rating <= 3 && $total_rating > 1) : ?>
                    <p class="card-text"><strong>Rating:</strong> <strong style="color: red"><?= $total_rating ?></strong></p>
                  <?php endif ?>
                <?php endif ?>
                <?php if(array_sum(array_column($rate, 'ratings')) == NULL && $total_rows == NULL) : ?>
                  <p class="card-text"><strong>Rating:</strong> <strong style="color: blue">Produk belum diberi rating</strong></p>
                <?php endif ?>
                <p class="card-text"><?= $order->description ?></p>
              <form action="<?= base_url('cart/add') ?>" method="POST">
                <input type="hidden" name="id_product" value="<?= $order->id ?>">
                <div class="input-group">
                  <input type="number" class="form-control" name="qty" value="1">
                  <div class="input-group-append">
                    <button class="btn btn-success">Add to Cart</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>

    </div>
  </div>
</main>
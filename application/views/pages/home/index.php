
<main role="main" class="container">
  <?php $this->load->view('layouts/_alert'); ?>
  <div class="row">

    <!-- Float Kiri -->
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-header">
              Pencarian
            </div>
            <div class="card-body">
              <?= form_open(base_url('shop/search'), ['method' => 'POST']) ?>
                <div class="input-group">
                  <input type="text" class="form-control" name="keyword" placeholder="Cari" 
                  value="<?= $this->session->userdata('keyword') ?>">
                  <div class="input-group-append">
                    <button class="btn btn-success btn-sm" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              <?= form_close() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
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
    <div class="col-md-9">

      <!-- Kategori -->
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-body">
              Kategori: <strong><?= isset($category) ? $category : 'Semua Kategori' ?></strong>
              <span class="float-right">
                Urutkan Harga: <a href="<?= base_url('shop/sortBy/asc') ?>" class="badge badge-primary">Termurah</a> | 
                <a href="<?= base_url('shop/sortBy/desc') ?>" class="badge badge-primary">Termahal</a>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Carousel -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/assets/images/promo_belanja.jpg" class="d-block img-fluid" alt="promo belanja">
              </div>
              <div class="carousel-item">
                <img src="/assets/images/sunlight.jpg" class="d-block img-fluid" alt="promo sunlight">
              </div>
              <div class="carousel-item">
                <img src="/assets/images/tokped.jpg" class="d-block img-fluid" alt="promo tokped">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Card -->
      <div class="row">
        <?php foreach($content as $row) : ?>
        <div class="col-md-4">
          <div class="card mb-3">
            <img src="<?= $row->image ? base_url("images/product/$row->image") : 
            base_url('images/product/no_image_available.jpg') ?>" 
            alt="" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><a href="<?= base_url("home/detail/$row->id/$row->product_title") ?>" style="color: black;"><?= $row->product_title; ?></a></h5>
              <p class="card-text" style="color: #FE4E00;"><strong>Rp <?= number_format($row->price, 0, ',', '.'); ?></strong></p>
              <a href="<?= base_url("shop/category/$row->slug") ?>" class="badge badge-primary"><i class="fas fa-tags"></i> <?= $row->category_title; ?></a>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
      
      <nav aria-label="Page navigation example">
        <?= $pagination; ?>
      </nav>
      
    </div>
  </div>
</main>
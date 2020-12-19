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
      <div class="row">
          <div class="col-md-4">
              <div class="card">
                  <div class="card-body text-center">
                      <img src="<?= $content->image ? base_url("/images/user/$content->image") : 
                      base_url('/images/user/no_image_available.jpg') ?>" height="198px" alt="">
                  </div>
              </div>
          </div>
          <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                    <p class="tab1"><span>Nama</span> : <?= $content->name ?></p>
                    <p class="tab1"><span>Telepon</span> : <?= $order->phone ?></p>
                    <p class="tab1"><span>Alamat</span> : <?= $order->address ?></p>
                    <p class="tab1"><span>Email</span> : <?= $content->email ?></p>
                    <a href="<?= base_url("profile/edit/$content->id") ?>" class="btn btn-primary">Edit</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</main>
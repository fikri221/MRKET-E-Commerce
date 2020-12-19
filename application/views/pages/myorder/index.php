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
              Daftar Orders
          </div>
          <div class="card-body">
              <table class="table">
                  <thead>
                      <tr>
                          <th>Nomor</th>
                          <th>Tanggal</th>
                          <th>Total</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach($content as $row) : ?>
                      <tr>
                          <td>
                              <a href="<?= base_url("myorder/detail/$row->invoice") ?>"><strong>#<?= $row->invoice; ?></strong></a>
                          </td>
                          <td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))); ?></td>
                          <td><strong style="color: #FE4E00;">Rp <?= number_format($row->total, 0, ',', '.'); ?></strong></td>
                          <td>
                            <?php $this->load->view('layouts/_status', ['status' => $row->status]); ?>
                          </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
              </table>
            <nav aria-label="Page navigation example">
                <?= $pagination; ?>
            </nav>
          </div>
      </div>
    </div>
  </div>
</main>
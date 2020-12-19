<main role="main" class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
          <span>Order</span>
          
          <div class="float-right">
              <form action="<?= base_url("order/search") ?>" method="POST">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari" 
                    value="<?= $this->session->userdata('keyword') ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="fas fa-eraser"></i>
                        </a>
                    </div>
                </div>
              </form>
          </div>
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
                            <a href="<?= base_url("order/detail/$row->invoice") ?>"><strong>#<?= $row->invoice ?></strong></a>
                        </td>
                        <td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></td>
                        <td><strong style="color: #FE4E00;">Rp <?= number_format($row->total, 0, ',', '.') ?></strong></td>
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
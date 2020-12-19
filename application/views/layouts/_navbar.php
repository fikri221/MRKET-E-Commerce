<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url('home') ?>">MRKet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Manage
          </a>
        
          <div class="dropdown-menu" aria-labelledby="dropdown-1">
            <a class="dropdown-item" href="<?= base_url('category') ?>">Category</a>
            <a class="dropdown-item" href="<?= base_url('product') ?>">Product</a>
            <?php if($this->session->userdata('role') == 'admin') : ?>
              <a class="dropdown-item" href="<?= base_url('order') ?>">Order</a>
            <?php endif ?>
            <a class="dropdown-item" href="<?= base_url('user') ?>">User</a>
          </div>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php if(!getCart()) : ?>
            <a href="<?= base_url('cart') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart (0)</a>
          <?php else : ?>
            <a href="<?= base_url('cart') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart (<?= getCart() ?>)</a>
          <?php endif ?>
        </li>
        <?php if(!$this->session->userdata('is_login')) : ?>
        <li class="nav-item">
          <a href="<?= base_url('login') ?>" class="nav-link">Login</a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('register') ?>" class="nav-link">Register</a>
        </li>
        <?php else : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $this->session->userdata('name') ?>
          </a>
        
          <div class="dropdown-menu" aria-labelledby="dropdown-2">
            <a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a>
            <a class="dropdown-item" href="<?= base_url('myorder') ?>">Orders</a>
            <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
          </div>
        </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>
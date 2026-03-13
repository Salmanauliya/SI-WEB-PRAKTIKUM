<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot Wheels Toys | Katalog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Hot Wheels Toys</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-person"></i></a>
        </li>
  
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="modal" data-bs-target="#wishlistModal">
            <i class="bi bi-cart"></i> Wishlist <span id="wishlist-count" class="badge bg-danger">0</span>
          </button>
        </li>

        <li class="nav-item">
          <span class="nav-link text-light">Halo, <?= htmlspecialchars($username) ?></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="controller/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </li>

        <li class="nav-item">
          <button class="nav-link" id="btn-theme"><i class="bi bi-moon-fill"></i> Mode Gelap</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section class="hero-section py-5">
  <div class="container position-relative z-2">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center text-white">
        <h2 class="display-6 fw-semibold mb-4">What are you looking for?</h2>
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-lg" placeholder="Search Hot Wheels...">
          <button class="btn btn-primary" type="button"><i class="bi bi-search"></i> Search</button>
        </div>
      </div>
    </div>
 
    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
      <span class="badge-category badge-hero">Premium</span>
      <span class="badge-category badge-hero">Cars</span>
      <span class="badge-category badge-hero">New Arrivals</span>
      <span class="badge-category badge-hero">City</span>
      <span class="badge-category badge-hero">Collector</span>
      <span class="badge-category badge-hero">Trade</span>
    </div>
  </div>
</section>

<section class="py-3">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <button class="btn btn-outline-secondary"><i class="bi bi-funnel"></i> Filter</button>
      </div>
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Recommended
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Terbaru</a></li>
          <li><a class="dropdown-item" href="#">Terlaris</a></li>
          <li><a class="dropdown-item" href="#">Harga Tertinggi</a></li>
          <li><a class="dropdown-item" href="#">Harga Terendah</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="py-3">
  <div class="container">
    <div class="row g-3 text-center">
      <div class="col-md-4">
        <div class="border rounded p-3 bg-light summary-card">
          <h6 class="mb-1">Total Points</h6>
          <span class="fs-4 fw-bold" id="total-produk">0</span>
        </div>
      </div>
      <div class="col-md-4">
        <div class="border rounded p-3 bg-light summary-card">
          <h6 class="mb-1">Sub Total</h6>
          <span class="fs-4 fw-bold" id="total-stok">0</span>
        </div>
      </div>
      <div class="col-md-4">
        <div class="border rounded p-3 bg-light summary-card">
          <h6 class="mb-1">Kategori</h6>
          <span class="fs-4 fw-bold" id="total-kategori">0</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4 g-lg-5" id="container-barang">
      <!-- Produk 1 (JDM) -->
      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-lg border-0 produk-card" data-category="JDM">
          <div class="image-container">
            <img src="assets/1.png" class="card-img-top product-image" alt="Hot Wheels 1">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">Nisan Silvia S13</h5>
            <p class="card-text fw-bold text-primary fs-5">Rp 65.000</p>
            <p class="card-text stok-text">Stok: 5</p>
            <div class="d-flex gap-2 mt-auto">
              <button class="btn btn-dark flex-fill btn-detail py-2">Beli</button>
              <button class="btn btn-outline-danger flex-fill btn-wishlist py-2"><i class="bi bi-heart"></i> Wishlist</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-lg border-0 produk-card" data-category="Muscle">
          <div class="image-container">
            <img src="assets/2.png" class="card-img-top product-image" alt="Hot Wheels 2">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">1970 Road Runner</h5>
            <p class="card-text fw-bold text-primary fs-5">Rp 85.000</p>
            <p class="card-text stok-text">Stok: 3</p>
            <div class="d-flex gap-2 mt-auto">
              <button class="btn btn-dark flex-fill btn-detail py-2">Beli</button>
              <button class="btn btn-outline-danger flex-fill btn-wishlist py-2"><i class="bi bi-heart"></i> Wishlist</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-lg border-0 produk-card" data-category="Classic">
          <div class="image-container">
            <img src="assets/3.png" class="card-img-top product-image" alt="Hot Wheels 3">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">1970 Monte Carlo</h5>
            <p class="card-text fw-bold text-primary fs-5">Rp 55.000</p>
            <p class="card-text stok-text">Stok: 8</p>
            <div class="d-flex gap-2 mt-auto">
              <button class="btn btn-dark flex-fill btn-detail py-2">Beli</button>
              <button class="btn btn-outline-danger flex-fill btn-wishlist py-2"><i class="bi bi-heart"></i> Wishlist</button>
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-lg border-0 produk-card" data-category="JDM">
          <div class="image-container">
            <img src="assets/4.png" class="card-img-top product-image" alt="Hot Wheels 4">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">Nisan Silvia S15</h5>
            <p class="card-text fw-bold text-primary fs-5">Rp 75.000</p>
            <p class="card-text stok-text">Stok: 2</p>
            <div class="d-flex gap-2 mt-auto">
              <button class="btn btn-dark flex-fill btn-detail py-2">Beli</button>
              <button class="btn btn-outline-danger flex-fill btn-wishlist py-2"><i class="bi bi-heart"></i> Wishlist</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-lg border-0 produk-card" data-category="JDM">
          <div class="image-container">
            <img src="assets/5.png" class="card-img-top product-image" alt="Hot Wheels 5">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-semibold">Nisan 350Z Custom</h5>
            <p class="card-text fw-bold text-primary fs-5">Rp 70.000</p>
            <p class="card-text stok-text">Stok: 4</p>
            <div class="d-flex gap-2 mt-auto">
              <button class="btn btn-dark flex-fill btn-detail py-2">Beli</button>
              <button class="btn btn-outline-danger flex-fill btn-wishlist py-2"><i class="bi bi-heart"></i> Wishlist</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="wishlistModalLabel">Wishlist Kamu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="wishlist-items">
        <!-- Isi akan diisi oleh JavaScript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<footer class="bg-dark text-light text-center py-3">
  <p class="mb-0">© 2026 Hot Wheels Toys | Koleksi Resmi</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/script.js"></script>
</body>
</html>
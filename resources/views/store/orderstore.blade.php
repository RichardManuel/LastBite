<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Restaurant Order - LastBite Eatery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --brand-yellow-navbar: #F5C563;
      --brand-orange-accent: #F9A826;
      --brand-text-dark: #3A2E39;
      --brand-text-light: #584957;
      --footer-bg: #F5C563;
      --footer-text: #3A2E39;
    }

    body {
      font-family: 'Instrument Serif', 'Instrument Sans';
      color: var(--brand-text-dark);
      background-color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .navbar-eatery {
      background-color: #F3C148;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar-eatery .nav-link {
      color: #F9F1E4 !important;
      font-weight: 600;
      padding-left: 4rem;
      padding-right: 2rem;
    }

    .order-card {
      background: #f5f5f5;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .btn-input-code {
      background-color: var(--brand-yellow-navbar);
      color: white;
      font-weight: bold;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
    }

    .btn-input-code:hover {
      background-color: #e0931f;
    }

    .code-form {
      margin-top: 1.5rem;
      background-color: #eeeeee;
      padding: 1.5rem;
      border-radius: 10px;
    }

    .footer-custom {
      background-color: var(--footer-bg);
      color: var(--footer-text);
      padding: 3rem 0;
      text-align: center;
      margin-top: auto;
    }

    /* Kuning brand */
    .text-yellow-brand {
    color: var(--brand-yellow-navbar) !important;
    }

    /* Gaya dasar tombol tab */
    .tab-button {
    border: none;
    background: #F5C563;
    color: var(--brand-yellow-navbar);
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 6px;
    }

    /* Gaya tombol yang aktif */
    .tab-button.active-tab {
    background-color: var(--brand-yellow-navbar);
    color: white !important;
    }

    .order-card (strong) {
      font-family: 'Instrument Sans';
    }

  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-eatery">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="{{ asset('img/logo lastbite putih 1.png') }}" height="50"></a>
    <div class="collapse navbar-collapse" id="navbarNavMain">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">Order</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Stocks</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container py-5">
  <h1 class="mb-3">Restaurant Order.</h1>
  <p>Please confirm the order details before preparing and shipping the items.</p>

  <!-- Filter Buttons -->
 <div>
            <!-- Tab Navigation -->
            <div class="d-flex justify-content-end gap-2 gap-sm-3 mb-1 "> 
                <button class="btn btn-sm bg-custom-green text-white shadow-sm fw-semibold tab-button ">All Order</button>
                <button class="btn btn-sm text-yellow-brand fw-medium ">Ongoing</button>
                <button class="btn btn-sm text-yellow-brand fw-medium ">Completed</button>
            </div>
            <hr class="my-3 border-dark"> 
    </div>

  <!-- Order Card 1 -->
  <div class="order-card">
    <div class="row">
      <div class="col-md-3">Name <strong><br>Richard</strong></div>
      <div class="col-md-3">Restaurant <strong><br>Dunkin Donuts</strong></div>
      <div class="col-md-2">Payment<strong><br>COD</strong></div>
      <div class="col-md-2">Status<strong><br>Taken</strong></div>
      <div class="col-md-2 text-end">
        <button class="btn-input-code" onclick="toggleForm('form1')">Input Code</button>
      </div>
    </div>
    <div id="form1" class="mt-5 d-none">
      <div class="d-flex flex-column align-items-center">
        <label for="orderId1" class="mb-2">Enter Customer's Order ID here</label>
        <div class="w-100" style="max-width: 400px;">
          <input type="text" class="form-control mb-3" id="orderId1" placeholder="Order ID" />
          <div class="text-end">
            <button class="btn btn-secondary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Order Card 2 -->
  <div class="order-card">
    <div class="row">
      <div class="col-md-3">Name<strong><br>Iven</strong></div>
      <div class="col-md-3">Restaurant<strong><br>Krispy Kreme</strong></div>
      <div class="col-md-2">Payment<strong><br>Credit Card</strong></div>
      <div class="col-md-2">Status<strong><br>Pending</strong></div>
      <div class="col-md-2 text-end">
        <button class="btn-input-code" onclick="toggleForm('form2')">Input Code</button>
      </div>
    </div>
    <div id="form2" class="mt-5 d-none">
      <div class="d-flex flex-column align-items-center">
        <label for="orderId2" class="mb-2">Enter Customer's Order ID here</label>
        <div class="w-100" style="max-width: 400px;">
          <input type="text" class="form-control mb-3" id="orderId2" placeholder="Order ID" />
          <div class="text-end">
            <button class="btn btn-secondary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Order Card 3 -->
  <div class="order-card">
    <div class="row">
      <div class="col-md-3">Name <strong><br>Richard</strong></div>
      <div class="col-md-3">Restaurant <strong><br>Holland</strong></div>
      <div class="col-md-2">Payment<strong><br>COD</strong></div>
      <div class="col-md-2">Status<strong><br>Canceled</strong></div>
      <div class="col-md-2 text-end">
        <button class="btn-input-code" onclick="toggleForm('form3')">Input Code</button>
      </div>
    </div>
    <div id="form3" class="mt-5 d-none">
      <div class="d-flex flex-column align-items-center">
        <label for="orderId3" class="mb-2">Enter Customer's Order ID here</label>
        <div class="w-100" style="max-width: 400px;">
          <input type="text" class="form-control mb-3" id="orderId3" placeholder="Order ID" />
          <div class="text-end">
            <button class="btn btn-secondary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer-custom">
  <div class="container">
    <div class="footer-logo mb-3">
      <img src="{{ asset('img/lastbite_logo_eatery_navbar.png') }}" alt="LastBite Footer Logo" height="40">
    </div>
    <h5>Thank you for your curiosity.</h5>
    <ul class="nav justify-content-center mb-3">
      <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Eatery</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Order</a></li>
    </ul>
    <div class="social-icons mb-3">
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-youtube"></i></a>
      <a href="#"><i class="bi bi-medium"></i></a>
    </div>
    <div class="copyright">
      © 2025 LastBite Inc. All rights reserved.
    </div>
  </div>
</footer>

<script>
  function toggleForm(formId) {
    document.querySelectorAll('.code-form').forEach(form => form.classList.add('d-none'));
    const targetForm = document.getElementById(formId);
    if (targetForm) {
      targetForm.classList.toggle('d-none');
    }
  }
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restaurant Profile Edit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #fff;
      color: #3a2e39;
    }
    .navbar {
      background-color: #f5c563;
    }
    .navbar-brand img {
      height: 30px;
    }
    .nav-link {
      color: #3a2e39;
      font-weight: 500;
    }
    .nav-link:hover {
      opacity: 0.8;
    }
    .profile-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 3rem 1rem;
    }
    h1 {
      font-family: 'Playfair Display', serif;
      margin-bottom: 2rem;
    }
    .form-control {
      background-color: #f1f1f1;
      border: none;
    }
    .form-label {
      font-weight: 500;
      margin-bottom: 0.3rem;
    }
    .btn-save {
      background-color: #f9a826;
      color: #fff;
      font-weight: 500;
    }
    .btn-save:hover {
      background-color: #e0931f;
    }
    .footer {
      background-color: #f5c563;
      color: #3a2e39;
      padding: 3rem 1rem;
      text-align: center;
    }
    .footer a {
      color: #3a2e39;
      margin: 0 0.5rem;
    }
    .restaurant-photo {
      max-width: 100%;
      border-radius: 10px;
    }
    .change-photo {
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="logo.png" alt="LastBite Logo"></a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#">Order</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Stocks</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="profile-container">
    <h1>Restaurant Profile</h1>
    <div class="row mb-4">
      <div class="col-md-6">
        <label class="form-label">Restaurant Photos</label>
        <img src="https://via.placeholder.com/600x250" class="restaurant-photo" alt="Restaurant">
        <div class="change-photo">
          <button class="btn btn-sm btn-dark"><i class="bi bi-camera"></i> Change Profile Image</button>
        </div>
      </div>
    </div>

    <form>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Applicant Name</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Telephone</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Bank account</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Restaurant</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Account name</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Location</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Pricing</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Operational Time</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Best Before</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Description</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Type of food sold</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-save">Save</button>
      </div>
    </form>
  </div>

  <footer class="footer">
    <img src="logo.png" alt="LastBite Logo" style="height: 40px;">
    <h5 class="mt-3">Thank you for your curiosity.</h5>
    <div class="mb-2">
      <a href="#">Home</a> | <a href="#">Eatery</a> | <a href="#">Order</a>
    </div>
    <div>
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-youtube"></i></a>
      <a href="#"><i class="bi bi-envelope-fill"></i></a>
    </div>
    <small class="d-block mt-2">© 2025 LastBite Inc. All rights reserved.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

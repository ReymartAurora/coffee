<?php
// Database connection settings
$host = 'localhost'; // Change if your DB host is different
$user = 'root';      // Change to your DB username
$pass = '';          // Change to your DB password
$dbname = 'coffee_db'; // Change to your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
// $conn is now your active database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Brew Haven Coffee</title>
  
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }
    .register-body { background: #f5eee6; }
    .login-body { background: #ede0d4; }
    .auth-container {
      background-color: #fff;
      padding: 30px 40px;
      max-width: 400px;
      margin: 100px auto;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .auth-container h2 {
      margin-bottom: 20px;
      font-size: 30px;
    }
    .auth-container form input, .auth-container button {
      width: 100%;
      margin: 10px 0;
      padding: 14px 16px;
      font-size: 16px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
    .auth-container button {
      border: none;
      background-color: #6b4f4f;
      color: #fff;
      cursor: pointer;
    }
    .auth-container p { margin-top: 15px; font-size: 14px; }
    .auth-container a { text-decoration: none; color: #6b4f4f; }


    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
      line-height: 1.6;
      background-color: #fdf6f0;
      color: #3e2f23;
    }

    img {
      max-width: 100%;
      height: 50%;
      border-radius: 10px;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* Container */
    .header {
      width: 100%;
      max-width: 1200px;
      margin: auto;
      padding: 2rem 0;
    }

    /* Header */
    header {
      background-color: #4b2e1f;
      height: 90px;
      color: #fff;
      padding: 1rem 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    header h1 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      margin-left: -6%;
      margin-top: -2.5%;
    }


    nav ul {
      list-style: none;
      display: flex;
      gap: 5rem;
      justify-content: center;
      margin-top: -4%;
      margin-left: 20%;
      align-items: center;
      padding-right: 2rem; 
    }

    nav ul li:last-child {
      margin-left: auto; 
      display: flex;
      align-items: center;
      gap: 10px;
      padding-right: 1rem; 
    }

    nav a {
      color: #fff;
      font-weight: bold;  
      font-size: 18px;
      transition: color 0.3s ease;
      padding: 5px;
      
    }

    nav a:hover {
      color: #b1885e;
      background-color: #e5ded6;
      width: 100px;
      border-radius: 15px;
      
    }

    #clientName {
      color: #ffffff;
      font-weight: bold;
      margin-right: 10px;
      margin-left: auto;
      font-size: 16px;
      align-self: center;
      margin-left: 60%;
    }

    .logout-btn {
      background-color: #b1885e;
      color: #ffffff;
      border: none;
      padding: 8px 18px;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-left: 15%;
    }

    .logout-btn:hover {
      background-color: #a17450;
    }


    /* Full-screen sections */
    .section,
    .home {
      min-height: 87.5vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .section .container,
    .home .home-content {
      text-align: center;
    }

    /* Hero Section */
    .home {
      position: relative;
      background-image: url('img/SHOP.jpg'); 
      background-size: cover;
      background-position: center;
      padding: 4rem 2rem;
      z-index: 0;
    }

    .home::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(20, 20, 20, 0.6); /* adjust transparency here */
      z-index: -1;
    }


    .home h2 {
      color: #e5ded6;
      font-size: 5rem;
      margin-bottom: 1rem;
    }

    .home p {
      color: #e5ded6;
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    .home-img {
      max-width: 600px;
      height: 300px;
      border: 4px solid #4b2e1f;
    }

    /* Section Style */
    .menu.light {
      background-color: #f4ede4;
    }

    .menu-content {
      width: 100%;
      max-width: 1200px;
      min-height: auto;
      margin: auto;
      padding: 2rem 0;
      height: 80px;
    }


    .menu h2 {
      font-size: 2rem;
      margin-bottom: 3rem;
      margin-top: -4.5%;
    }

    /* Menu Grid */
    .menu-grid {
      margin-top: 3%;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }

    .menu-item {
      text-align: center;
      padding: 1.5rem 1rem 1.2rem 1rem;
      min-height: 420px;
      background: linear-gradient(135deg, #fff8f0 60%, #f5eee6 100%);
      border-radius: 18px;
      box-shadow: 0 6px 24px 0 rgba(177,136,94,0.15), 0 1.5px 4px #b1885e;
      transition: transform 0.18s, box-shadow 0.18s;
      position: relative;
      overflow: hidden;
    }

    .menu-item:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 16px 32px 0 rgba(177,136,94,0.22), 0 2px 8px #b1885e;
      background: linear-gradient(135deg, #f5eee6 60%, #fff8f0 100%);
    }

    .menu-item img {
      height: 140px;
      width: 140px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #b1885e;
      margin-bottom: 1rem;
      background: #fff;
      box-shadow: 0 2px 8px #e5ded6;
    }

    .menu-item h3 {
      margin-top: 0.5rem;
      font-size: 1.3rem;
      color: #4b2e1f;
      letter-spacing: 0.5px;
    }

    .menu-item .description {
      margin: 0.5rem 0 0.7rem 0;
      color: #6b4f4f;
      font-size: 1.05rem;
      min-height: 40px;
    }

    .menu-item .price {
      font-weight: bold;
      margin: 10px 0 0.7rem 0;
      color: #a17450;
      font-size: 1.1rem;
    }

    .menu-item .delete-product-btn {
      padding: 10px 22px;
      background-color: #b1885e;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      margin-top: 10px;
      transition: background 0.2s;
      box-shadow: 0 2px 8px #b1885e33;
    }

    .menu-item .delete-product-btn:hover {
      background-color: #a17450;
    }



    .about-content {
      width: 100%;
      max-width: 1200px;
      min-height: auto;
      margin: auto;
      padding: 2rem 0;
    }

    .about h2 {
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    /* About Image */
    .about-img {
      display: block;
      margin: 2rem auto;
      max-width: 650px;
      border: 4px solid #ccc;
    }

    .about p {
      margin: 2rem 0;
      font-size: 1.2rem;
      line-height: 1.5;
    }



    .contact {
      background-color: #ffffff; 
      padding: 60px 20px; 
      display: flex;
      justify-content: center; 
      align-items: center; 
      height: 100vh;
      /* Center the contact section horizontally and vertically */
    }

    .contact-content {
      text-align: center; 
      width: 500px; 
      height: 500px;
      padding: 30px; 
      border-radius: 10px;
      box-shadow: 0 10px 20px #b1885e; 
      background-color: #fff;
      margin: auto; /* Ensure centering in flex parent */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    h2 {
      font-size: 2.5rem; 
      font-weight: bold;
      color: #333; 
      margin-bottom: 20px;
    }

    p {
      font-size: 1.2rem;
      color: #555; 
      margin-top: 15%;
      margin-bottom: 15px; 
      line-height: 1.5; 
    }

    p:hover {
      color: #b1885e; 
      cursor: pointer;
      transition: color 0.3s ease;
    }





    @media (max-width: 768px) {
      header {
        height: 80px;
        padding: 1rem;
        text-align: center;
      }

      header h1 {
        font-size: 1.2rem;
        margin: 0;
        margin-top: -9%;
      }

      nav ul {
        flex-direction: row; /* keep inline */
        justify-content: center;
        gap: 1rem;
        margin-top: 0.5rem;
        margin-left: -25%;
        padding: 0;
      }

      nav li {
        display: inline-block;
      }

      nav a {
        font-size: 13px;
        padding: 5px 8px;
      }

      #logoutBtn {
        margin-right: -200px; /* Remove large margin */
        margin-top: 2px;
        background-color: #6b4f4f;
        color: white;
        border: none;
        padding: 2px 2px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
      }

      .home {
        padding: 2rem 1rem;
        background-position: center;
      }

      .home h2 {
        font-size: 3rem;
      }

      .home p {
        font-size: 1.5rem;
      }

      .menu-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .about-content {
        padding: 2rem 1rem;
      }

      .about-img {
        max-width: 90%;
      }

      .about p {
        font-size: 1.2rem;
        margin: 2rem 0;
      }

      .contact-content {
        width: 90%;
        height: auto;
        padding: 20px;
      }

      h2 {
        font-size: 2rem;
      }

      p {
        font-size: 1rem;
        margin-top: 10%;
        margin-bottom: 10px;
      }
    }


  </style>

</head>

<body>

<!-- Pages -->
<div id="index" class="page" style="display:none;">
  <header>
    <div class="header">
      <h1>Brew Haven</h1>
      <nav>
        <ul>
          <li><a href="#index/home" class="section-link" data-section="home">Dashboard</a></li>
          <li><a href="#index/menu" class="section-link" data-section="menu">Menu</a></li>
          <li><a href="#index/about" class="section-link" data-section="about">About</a></li>
          <li><a href="#index/contact" class="section-link" data-section="contact">Contact</a></li>
          <li id="userNav" style="display:none;">
            <!-- Order button beside client name -->
            <span id="orderNav" style="margin-right:10px;">
              <a href="javascript:void(0);" id="orderBtn" style="color:#fff;font-weight:bold;">Order</a>
            </span>
            <span id="clientName"></span>
            <button onclick="logout()" class="logout-btn">Log out</button>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <div id="section-container">
    <section id="home" class="home section-content">
      <div class="home-content">
        <h2>Welcome to Brew Haven</h2>
        <p>Your daily dose of perfect coffee</p>
      </div>
    </section>

    <section id="menu" class="menu section-content" style="display:none;">
      <div class="menu-content">
        <div style="display: flex; justify-content: flex-end; margin-top: 0; margin-bottom: 20px;">
          <button id="addProductBtn" style="background:#4CAF50;color:#fff;font-weight:bold;padding:10px 18px;border:none;border-radius:8px;cursor:pointer;">Add Product</button>
        </div>
        <h2>Admin Product Dashboard</h2>
        <div class="menu-grid" id="adminMenuGrid">
          <!-- Products will be rendered here -->
        </div>
      </div>
    </section>
    
    <section id="about" class="about section-content" style="display:none;">
      <div class="about-content">
        <h2>About Us</h2>
        <img src="img/barista.jpg" alt="Barista preparing coffee" class="about-img">
        <p>At Brew Haven, we're passionate about serving quality coffee in a warm, welcoming space. We source our beans ethically and roast them locally for the freshest cup every time.</p>
      </div>
    </section>

    <section id="contact" class="contact section-content" style="display:none;">
      <div class="contact-content">
        <h2>Contact Us</h2>
        <p>237 Rizal St. Dapa</p>
        <p>Email: hello@brewhaven.com</p>
        <p>Phone: (123) 456-7890</p>
      </div>
    </section>
  </div>
</div>

<div id="register" class="page" style="display:none;">
  <div class="auth-container">
    <h2>Brew Haven</h2>
    <h2>Register</h2>
    <form id="registerForm">
      <input type="text" id="regUsername" placeholder="Username" required>
      <input type="password" id="regPassword" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="#login">Login here</a></p>
  </div>
</div>

<div id="login" class="page" style="display:none;">
  <div class="auth-container">
    <h2>Brew Haven</h2>
    <h2>Login</h2>
    <form id="loginForm">
      <input type="text" id="loginUsername" placeholder="Username" required>
      <input type="password" id="loginPassword" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="#register">Register here</a></p>
  </div>
</div>

<!-- Scripts -->
<script>
  function showPage(page) {
    document.querySelectorAll('.page').forEach(p => p.style.display = 'none');
    document.getElementById(page).style.display = 'block';
    document.body.className = page + '-body';
    // Removed scroll-to-top logic
  }

  // Remove login check on page load, always show index if hash is missing
  document.addEventListener('DOMContentLoaded', () => {
    if (location.hash) {
      handleRouting();
    } else {
      location.hash = 'index';
      showPage('index');
    }
    updateClientName();
  });

  window.addEventListener('hashchange', () => {
    handleRouting();
    updateClientName();
  });

  // Show only the selected section inside the index page
  function showSection(sectionId) {
    document.querySelectorAll('#section-container .section-content').forEach(sec => {
      sec.style.display = (sec.id === sectionId) ? 'block' : 'none';
    });
    // Removed scroll-to-top logic
  }

  // Modified routing: show only the selected section in the container
  function handleRouting() {
    const hash = location.hash.substring(1);
    if (hash.startsWith('index')) {
      showPage('index');
      const sectionId = hash.split('/')[1] || 'home';
      showSection(sectionId);
    } else {
      showPage(hash);
    }
  }

  // Add click handlers to nav links to update hash and show section
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.section-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const section = link.getAttribute('data-section');
        location.hash = 'index/' + section;
      });
    });
    updateClientName();
  });

  // Register
  document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('regUsername').value.trim();
    const password = document.getElementById('regPassword').value.trim();

    if (localStorage.getItem(username)) {
      Swal.fire('Error', 'Username already exists!', 'error');
    } else {
      localStorage.setItem(username, password);
      Swal.fire('Success', 'Registered Successfully!', 'success').then(() => {
        location.hash = 'login';
      });
    }
  });

  // Login
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('loginUsername').value.trim();
    const password = document.getElementById('loginPassword').value.trim();

    const storedPassword = localStorage.getItem(username);

    if (storedPassword && storedPassword === password) {
      localStorage.setItem('loggedInUser', username);
      Swal.fire('Success', 'Login Successful!', 'success').then(() => {
        location.hash = 'index';
        updateClientName();
      });
    } else {
      Swal.fire('Error', 'Invalid Username or Password!', 'error');
    }
  });

  

  // Show client name beside logout if logged in
  function updateClientName() {
    const user = localStorage.getItem('loggedInUser');
    const nameSpan = document.getElementById('clientName');
    const userNav = document.getElementById('userNav');
    const orderNav = document.getElementById('orderNav');
    if (user && nameSpan && userNav) {
      nameSpan.textContent = user;
      nameSpan.style.display = 'inline-block';
      userNav.style.display = 'flex';
      if (orderNav) orderNav.style.display = 'inline-block';
    } else if (nameSpan && userNav) {
      nameSpan.textContent = '';
      nameSpan.style.display = 'none';
      userNav.style.display = 'none';
      if (orderNav) orderNav.style.display = 'none';
    }
    renderMenuRatings();
  }



  // Product CRUD for admin
  function getProducts() {
    return JSON.parse(localStorage.getItem('products') || '[]');
  }
  function setProducts(products) {
    localStorage.setItem('products', JSON.stringify(products));
  }
  function renderAdminMenu() {
    const grid = document.getElementById('adminMenuGrid');
    if (!grid) return;
    const products = getProducts();
    grid.innerHTML = '';
    if (products.length === 0) {
      grid.innerHTML = '<div style="color:#888;">No products yet.</div>';
      return;
    }
    products.forEach((prod, idx) => {
      const div = document.createElement('div');
      div.className = 'menu-item';
      div.innerHTML = `
        <img src="${prod.img}" alt="${prod.name}">
        <h3>${prod.name}</h3>
        <p class="description">${prod.desc}</p>
        <p class="price">$${Number(prod.price).toFixed(2)}</p>
        <button class="delete-product-btn" data-idx="${idx}" style="background:#b1885e;">Delete</button>
      `;
      grid.appendChild(div);
    });
    // Delete logic
    grid.querySelectorAll('.delete-product-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const idx = Number(btn.getAttribute('data-idx'));
        const products = getProducts();
        products.splice(idx, 1);
        setProducts(products);
        renderAdminMenu();
      });
    });
  }

  // Modal for adding a product
  function showAddProductModal() {
    Swal.fire({
      title: 'Add Product',
      html: `
        <input id="swal-prod-name" class="swal2-input" placeholder="Product Name">
        <input id="swal-prod-desc" class="swal2-input" placeholder="Description">
        <input id="swal-prod-price" class="swal2-input" placeholder="Price" type="number" min="0.01" step="0.01">
        <input id="swal-prod-img" class="swal2-input" placeholder="Image URL">
      `,
      background: '#f5eee6',
      showCancelButton: true,
      confirmButtonText: 'Add',
      confirmButtonColor: '#4CAF50',
      cancelButtonColor: '#b1885e',
      preConfirm: () => {
        const name = document.getElementById('swal-prod-name').value.trim();
        const desc = document.getElementById('swal-prod-desc').value.trim();
        const price = document.getElementById('swal-prod-price').value.trim();
        const img = document.getElementById('swal-prod-img').value.trim();
        if (!name || !desc || !price || !img) {
          Swal.showValidationMessage('All fields are required.');
          return false;
        }
        return { name, desc, price, img };
      }
    }).then(result => {
      if (result.isConfirmed && result.value) {
        const products = getProducts();
        products.push(result.value);
        setProducts(products);
        renderAdminMenu();
        Swal.fire('Success', 'Product added!', 'success');
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    // Add product modal button
    const addProductBtn = document.getElementById('addProductBtn');
    if (addProductBtn) {
      addProductBtn.addEventListener('click', showAddProductModal);
    }
    renderAdminMenu();
  });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bistro Blis</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../assets/css/buyer.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        .menu-categories button {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
        }
        .menu-categories button:hover {
            background-color: #ddd;
        }
        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .menu-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .menu-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .menu-item-content {
            padding: 15px;
        }
        .menu-item-content h3 {
            font-size: 1.2rem;
            margin: 10px 0;
        }
        .menu-item-content p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .menu-item-content .price {
            font-weight: bold;
            color: #333;
        }
        .apps-section {
            margin-top: 50px;
            text-align: center;
        }
        .apps-section img {
            width: 100px;
            margin: 10px;
        }
    </style>
</head>

<body>
   <!-- Topbar Start -->
   <div class="container-fluid py-2 border-bottom d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>(414)857-0107</a>
                    <span class="text-body">|</span>
                    <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>yummy@bistrobliss</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-body px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-body ps-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <a href="home.php" class="navbar-brand d-flex align-items-center">
                <h1 class="m-0 text-uppercase" style="color: #8B4513;">
                    <i class="fa fa-utensils"></i> Kantin
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 align-items-center">
                    <a href="home.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="menu.php" class="nav-item nav-link active">Menu</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                    <a href="" class="btn btn-primary btn-sm text-white ms-3" style="font-size: 14px; padding: 5px 10px;">Login</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<div class="container">
    <h1>Our Menu</h1>
    <p>We consider all the choices and change every day the components
        prepared to design to create a truly happy menu.</p>

    <div class="menu-categories">
        <button>All</button>
        <button>Breakfast</button>
        <button>Main Dishes</button>
        <button>Drinks</button>
        <button>Desserts</button>
    </div>

    <!-- Breakfast -->
    <div class="menu-items">
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/nasigoreng.jpg" alt="Nasi Goreng Telur">
            <div class="menu-item-content">
                <h3>Nasi Goreng Telur</h3>
                <p>Indonesian fried rice with fried egg and spices.</p>
                <span class="price">29.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/rotibakar.jpg" alt="Roti Bakar Keju">
            <div class="menu-item-content">
                <h3>Roti Bakar Keju</h3>
                <p>Toasted bread filled with melted cheese that is savory and delicious.</p>
                <span class="price">25.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/buburayam.jpg" alt="Bubur Ayam">
            <div class="menu-item-content">
                <h3>Bubur Ayam</h3>
                <p>Rice porridge topped with shredded chicken, crackers, and broth.</p>
                <span class="price">20.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/omelette.jpg" alt="Omelet Sayur">
            <div class="menu-item-content">
                <h3>Omelet Sayur</h3>
                <p>Omelette with mixed fresh vegetables and cheese.</p>
                <span class="price">15.000</span>
            </div>
        </div>
    </div>

      

 <!-- Main Dishes -->
    <div class="menu-items">
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/sate ayam.jpg" alt="Sate Ayam">
            <div class="menu-item-content">
                <h3>Sate Ayam</h3>
                <p>Chicken satay with savory peanut sauce and lontong.</p>
                <span class="price">30.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/rendang.jpg" alt="Rendang Daging">
            <div class="menu-item-content">
                <h3>Rendang Daging</h3>
                <p>Tender beef with Padang's signature rendang spices.</p>
                <span class="price">45.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/ayam.jpg" alt="Ayam Goreng Sambal">
            <div class="menu-item-content">
                <h3>Ayam Goreng Sambal</h3>
                <p>Crispy fried chicken with delicious spicy chili sauce.</p>
                <span class="price">28.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/ikanbakar.jpg" alt="Ikan Bakar">
            <div class="menu-item-content">
                <h3>Ikan Bakar</h3>
                <p>Fresh fish grilled with soy sauce and shrimp paste sauce.</p>
                <span class="price">35.000</span>
            </div>
        </div>
    </div>

    <!-- Drinks -->
    <div class="menu-items">
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/esteh.jpg" alt="Es Teh Manis">
            <div class="menu-item-content">
                <h3>Es Teh Manis</h3>
                <p>Refreshing cold sweet tea to quench your thirst.</p>
                <span class="price">10.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/esjeruk.jpg" alt="Es Jeruk">
            <div class="menu-item-content">
                <h3>Es Jeruk</h3>
                <p>Freshly squeezed orange juice with ice for a sour and sweet taste.</p>
                <span class="price">12.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/kopi.jpg" alt="Kopi Tubruk">
            <div class="menu-item-content">
                <h3>Kopi Tubruk</h3>
                <p>Typical Indonesian coffee with a strong aroma and authentic taste.</p>
                <span class="price">15.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/smooties.jpg" alt="Smoothie Buah">
            <div class="menu-item-content">
                <h3>Smoothie Buah</h3>
                <p>Fresh smoothies mixed with selected fruits.</p>
                <span class="price">20.000</span>
            </div>
        </div>
    </div>

     <!-- Dessert -->
     <div class="menu-items">
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/escampur.jpg" alt="Es Campur">
            <div class="menu-item-content">
                <h3>Es Campur</h3>
                <p>A refreshing mix of ice, fruit and sweet syrup.</p>
                <span class="price">18.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/pudding.jpg" alt="Pudding Cokelat">
            <div class="menu-item-content">
                <h3>Pudding Cokelat</h3>
                <p>Soft chocolate pudding with vanilla sauce.</p>
                <span class="price">22.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/pisang.jpg" alt="Pisang Goreng">
            <div class="menu-item-content">
                <h3>Pisang Goreng</h3>
                <p>Crispy fried bananas sprinkled with powdered sugar.</p>
                <span class="price">15.000</span>
            </div>
        </div>
        <div class="menu-item">
            <img src="../../assets/img/foodMenu/klepon.jpg" alt="Klepon">
            <div class="menu-item-content">
                <h3>Klepon</h3>
                <p>Traditional snacks with liquid brown sugar inside.</p>
                <span class="price">12.000</span>
            </div>
        </div>
    </div>

    <div class="apps-section">
        <h2>Order Made Easy</h2>
        <p>Log in now to access exclusive menus and simplify your dining experience.</p>
        <a href="" class="btn btn-primary rounded-pill px-4 py-2">Login to Order</a>
    </div>
</div>
    

    


     <!-- Footer Start -->
     <div class="container-fluid bg-brown text-light text-center py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Bistro Blis</h4>
                    <p class="mb-4" style="color: #D7CCC8;">In the new era of technology we look in the future with certainty and pride for our company</p>
                    <p class="mb-2" style="color: #D7CCC8;"><i class="fa fa-map-marker-alt me-3" style="color: #D7CCC8;"></i>123 Street, Surakarta, Indonesia</p>
                    <p class="mb-2" style="color: #D7CCC8;"><i class="fa fa-envelope me-3" style="color: #D7CCC8;"></i>yummy@bistrobliss</p>
                    <p class="mb-0" style="color: #D7CCC8;"><i class="fa fa-phone-alt me-3" style="color: #D7CCC8;"></i>(414) 857 - 0107</p>
                </div>                
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Pages</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Menu</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Pricing</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Blog</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Delivery</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Utility Pages</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Start Here</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Styleguide</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Password Protected</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>404 Not Found</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Licenses</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Changelog</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>View More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-brown text-light py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-primary" href="#">BistroBlis</a>. All Rights Reserved.</p>
        </div>
    </div>
    
    <style>
        .bg-brown {
            background-color: #5D4037; /* Warna cokelat */
        }
    
        .bg-brown .text-light {
            color: #f8f9fa; /* Warna teks yang kontras */
        }
    
        .text-center {
            text-align: center;
        }
    
        .text-primary {
            color: #D7CCC8 !important; /* Emas untuk kontras */
        }
    
        .btn-primary {
            background-color: #D7CCC8;
            border-color: #D7CCC8;
        }
    
        .btn-primary:hover {
            background-color: #D7CCC8;
            border-color: #D7CCC8;
        }
    </style>
    

    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>
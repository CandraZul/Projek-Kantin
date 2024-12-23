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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial</title>
    <style>
        .testimonial-container {
            display: flex; /* Mengatur elemen anak menjadi baris horizontal */
            gap: 20px; /* Jarak antar testimonial */
            overflow-x: auto; /* Scroll horizontal jika konten melebihi lebar layar */
            padding: 20px;
        }

        .testimonial-item {
            flex: 0 0 auto; /* Membuat elemen tetap dalam ukuran aslinya */
            width: 300px; /* Ukuran lebar masing-masing testimonial */
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .testimonial-item img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .testimonial-item .quote-icon {
            width: 60px;
            height: 60px;
            line-height: 60px;
            border-radius: 50%;
            background-color: #fff;
            color: #007bff;
            font-size: 24px;
            position: relative;
            margin: -30px auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .testimonial-item p {
            font-size: 16px;
            color: #555;
        }

        .testimonial-item h3 {
            margin-top: 15px;
            font-size: 20px;
            color: #333;
        }

        .testimonial-item h6 {
            font-size: 14px;
            color: #007bff;
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
                        <a href="home.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="menu.php" class="nav-item nav-link">Menu</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-white mb-md-4">Best Food For Your Taste</h1>
                    <p>Discover delectable cuisine and unforgettable moments in our welcoming culinary haven</p>
                    <div class="pt-2">
                        <a href="" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Explore Menu</a>
                        <a href="" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Explore Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="../../assets/img/icon/about.jpeg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">About Us</h5>
                        <h1 class="display-4">We provide healthy food for your family.</h1>
                    </div>
                    <p>Our story began with a vision to create a unique dining experience that merges fine dining, exceptional service, and a vibrant ambiance. Rooted in city's rich culinary culture, we aim to honor our local roots while infusing a global palate</p>
                    <a>At place, we believe that dining is not just about food, but also about the overall experience. Our staff, renowned for their warmth and dedication, strives to make every visit an unforgettable event</a>
                    <div class="pt-4">
                        <a href="" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2" style="background-color: brown; color: white;">More About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="../../assets/img/icon/about1.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="mb-4">
                        <h1 class="display-4">Fastest Food Delivery in City</h1>
                    </div>
                    <p>Our visual designer lets you quickly and of drag a down your way to customapps for both keep desktop</p>
                    <div style="display: flex; flex-direction: column; gap: 15px; font-family: Arial, sans-serif;">
                        <!-- Item 1 -->
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; height: 40px; background-color: brown; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 18px;">
                                <i class="fa fa-clock"></i>
                            </div>
                            <p style="margin: 0; color: #333; font-size: 16px;">Delivery within 30 minutes</p>
                        </div>
                        
                        <!-- Item 2 -->
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; height: 40px; background-color: brown; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 18px;">
                                <i class="fa fa-tag"></i>
                            </div>
                            <p style="margin: 0; color: #333; font-size: 16px;">Best Offer & Prices</p>
                        </div>
                        
                        <!-- Item 3 -->
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 40px; height: 40px; background-color: brown; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 18px;">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <p style="margin: 0; color: #333; font-size: 16px;">Online Services Available</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Menu Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Menu</h5>
                <h1 class="display-4">Browse Our Menu</h1>
            </div>
            <div class="row g-5">
                <!-- Breakfast -->
                <div class="container">
                    <div class="row g-4">
                        <!-- Breakfast -->
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item bg-cream rounded d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="service-icon mb-4">
                                    <i class="fa fa-2x fa-mug-hot text-dark"></i>
                                </div>
                                <h4 class="mb-3">Breakfast</h4>
                                <p class="m-0">Just like the first meal of the day, breakfast sets the tone for a day full of energy and possibilities, fueling our journey ahead.</p>
                                <a class="btn btn-lg btn-dark rounded-pill" href="">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                
                        <!-- Main Dishes -->
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item bg-cream rounded d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="service-icon mb-4">
                                    <i class="fa fa-2x fa-utensils text-dark"></i>
                                </div>
                                <h4 class="mb-3">Main Dishes</h4>
                                <p class="m-0">Just like a hearty main course, the journey of life is enriched with bold flavors and meaningful experiences that nourish our aspirations.</p>
                                <a class="btn btn-lg btn-dark rounded-pill" href="">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                
                        <!-- Drinks -->
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item bg-cream rounded d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="service-icon mb-4">
                                    <i class="fa fa-2x fa-wine-glass text-dark"></i>
                                </div>
                                <h4 class="mb-3">Drinks</h4>
                                <p class="m-0">Just like refreshing beverages, drinks quench our thirst and add a spark of joy, revitalizing us for the moments ahead.</p>
                                <a class="btn btn-lg btn-dark rounded-pill" href="">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                
                        <!-- Desserts -->
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item bg-cream rounded d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="service-icon mb-4">
                                    <i class="fa fa-2x fa-ice-cream text-dark"></i>
                                </div>
                                <h4 class="mb-3">Desserts</h4>
                                <p class="m-0">Just like sweet treats, desserts bring a delightful finish to our meals, leaving a lasting impression of joy and satisfaction.</p>
                                <a class="btn btn-lg btn-dark rounded-pill" href="">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <style>
                    .bg-cream {
                        background-color: #D7CCC8; /* Warna krem elegan */
                    }
                
                    .text-dark {
                        color: #5D4037; /* Warna cokelat tua */
                    }
                
                    .btn-dark {
                        background-color: #5D4037; /* Tombol cokelat tua */
                        border-color: #5D4037;
                    }
                
                    .btn-dark:hover {
                        background-color: #4E342E; /* Warna lebih gelap untuk hover */
                        border-color: #4E342E;
                    }
                
                    .service-item {
                        padding: 20px;
                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                    }
                
                    .service-icon {
                        width: 80px;
                        height: 80px;
                        background-color: #5D4037; /* Background icon cokelat tua */
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                    }
                </style>
            </div>
        </div>
    </div>
    


    <!-- Testimonial Start -->
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Testimonial</h5>
            <h1 class="display-4">What Our Customers Say</h1>
        </div>
        <div class="testimonial-container">
            <div class="testimonial-item">
                <img src="../../assets/img/icon/testimonial-1.jpg" alt="">
                <div class="quote-icon">“</div>
                <p>Last night, we dined at place and were simply blown away. From the moment we stepped in, we were enveloped in an inviting atmosphere and greeted with warm smiles.</p>
                <h3>Annisa Rahma</h3>
                <h6>Klaten</h6>
            </div>
            <div class="testimonial-item">
                <img src="../../assets/img/icon/testimonial-2.jpg" alt="">
                <div class="quote-icon">“</div>
                <p>Place exceeded my expectations on all fronts. The ambiance was cozy and relaxed, making it a perfect venue for our anniversary dinner.</p>
                <h3>Dinda Amelia</h3>
                <h6>Jepara</h6>
            </div>
            <div class="testimonial-item">
                <img src="../../assets/img/icon/testimonial-3.jpg" alt="">
                <div class="quote-icon">“</div>
                <p>The culinary experience at place is first to none. The atmosphere is vibrant. The food was the highlight of our evening. Highly recommended.</p>
                <h3>Candra Zulkarnain</h3>
                <h6>Klaten</h6>
            </div>
            <div class="testimonial-item">
                <img src="../../assets/img/icon/testimonial-3.jpg" alt="">
                <div class="quote-icon">“</div>
                <p>A truly unforgettable experience! The service was impeccable, and the ambiance was perfect for a special evening. Every dish exceeded expectations.</p>
                <h3>Farreli Pandya</h3>
                <h6>Solo</h6>
            </div>
            <div class="testimonial-item">
                <img src="../../assets/img/icon/testimonial-3.jpg" alt="">
                <div class="quote-icon">“</div>
                <p>The food and drink selection here is outstanding. We loved every bite! It's a great place for both casual meals and special occasions.</p>
                <h3>Iqbal Cahyono</h3>
                <h6>Salatiga</h6>
            </div>
            <div class="testimonial-item">
                <img src="../../assets/img/icon/testimonial-1.jpg" alt="">
                <div class="quote-icon">“</div>
                <p>Exceptional! This place offers a perfect blend of ambiance and delicious food. I can't wait to come back again with friends and family.</p>
                <h3>Rina Mawar</h3>
                <h6>Yogyakarta</h6>
            </div>
        </div>
    </div>


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Blog Post</h5>
                <h1 class="display-4">Our Blog & Articles</h1>
            </div>
            <div class="row g-5">
                <!-- Artikel 1 -->
                <div class="col-xl-4 col-lg-6">
                    <a href="https://www.foodinfotech.com/the-art-of-food-plating-turning-plates-into-masterpiece/" target="_blank" class="text-decoration-none">
                        <div class="bg-light rounded overflow-hidden h-100">
                            <img class="img-fluid w-100" src="../../assets/img/icon/a1.jpeg" alt="Food Presentation">
                            <div class="p-4">
                                <h3 class="d-block mb-3 text-dark">The Art of Plating: How Presentation Makes Food Taste Better</h3>
                                <p class="m-0 text-dark">Food is not just about taste; it's about the experience. Learn how the art of plating elevates the overall dining experience and how presentation can make a significant difference in how we perceive taste.</p>
                            </div>
                            <div class="d-flex justify-content-between border-top p-4">
                                <div class="d-flex align-items-center">
                                    <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>5498</small>
                                    <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>87</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Artikel 2 -->
                <div class="col-xl-4 col-lg-6">
                    <a href="https://tazaproducts.com/blog/top-5-ingredients-every-home-chef-should-have-in-their-pantry/" target="_blank" class="text-decoration-none">
                        <div class="bg-light rounded overflow-hidden h-100">
                            <img class="img-fluid w-100" src="../../assets/img/icon/a2.jpeg" alt="Essential Ingredients">
                            <div class="p-4">
                                <h3 class="d-block mb-3 text-dark">5 Essential Ingredients Every Chef Should Know About</h3>
                                <p class="m-0 text-dark">From olive oils to fresh herbs, discover the five must-have ingredients that can transform any dish into a masterpiece. Learn why these essentials belong in every kitchen.</p>
                            </div>
                            <div class="d-flex justify-content-between border-top p-4">
                                <div class="d-flex align-items-center">
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>4623</small>
                                    <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>101</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Artikel 3 -->
                <div class="col-xl-4 col-lg-6">
                    <a href="https://www.businessinsider.com/how-to-eat-healthy-without-sacrificing-flavor-seasoning-dietitian-tips-2021-8" target="_blank" class="text-decoration-none">
                        <div class="bg-light rounded overflow-hidden h-100">
                            <img class="img-fluid w-100" src="../../assets/img/icon/a3.jpeg" alt="Healthy Eating">
                            <div class="p-4">
                                <h3 class="d-block mb-3 text-dark">How to Create Healthy, Balanced Meals Without Sacrificing Flavor</h3>
                                <p class="m-0 text-dark">Eating healthy doesn’t mean boring food. Discover tips and tricks to make nutritious meals taste delicious while maintaining balance in your diet.</p>
                            </div>
                            <div class="d-flex justify-content-between border-top p-4">
                                <div class="d-flex align-items-center">
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>3874</small>
                                    <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>55</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
                <h2 class="text-dark">Status Ibu Kos</h2>
                <ul class="list-unstyled">
                    <li>
                        <a href="artikel.php?id=1" target="_blank" class="text-decoration-none">
                            <strong>Menu Spesial Minggu Ini: Ayam Geprek Sambal Matah</strong>
                        </a>
                        <p class="m-0 text-dark">Dapatkan promo spesial minggu ini</p>
                    </li>
                    <li>
                        <a href="artikel.php?id=2" target="_blank" class="text-decoration-none">
                            <strong>Promo Sarapan Hemat di Kantin Kami!</strong>
                        </a>
                        <p class="m-0 text-dark">Daripada bingung mending sarapan disini</p>
                    </li>
                    <li>
                        <a href="artikel.php?id=3" target="_blank" class="text-decoration-none">
                            <strong>Kebersihan dan Kualitas Makanan Adalah Prioritas Kami</strong>
                        </a>
                        <p class="m-0 text-dark">Kami berkomitmen untuk memberikan yang terbaik</p>
                    </li>
                </ul>
            </div>

     <!-- Footer Start -->
    <div class="container-fluid bg-brown text-light text-center py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Bistro Blis</h4>
                    <p class="mb-4">In the new era of technology we look in the future with certainty and pride for our company</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, Surakarta, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>yummy@bistrobliss</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>(414) 857 - 0107</p>
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
<?php
require('connection.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $contact = $_POST['number'];
    $message = $_POST['message'];
    date_default_timezone_set("Asia/Kathmandu");
    $date = date("Y-m-d h:i:sa");
    $query = "INSERT INTO `message`(`date`,`email`,`contact`,`message`,`status`) VALUES('$date','$email','$contact','$message','0')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('your message sent successfully!!');window.location='home.php'</script>";
        // header("location:home.php");
    } else {
        echo "Error: " . mysqli_error($conn) . "<br/>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Management System</title>


    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Template Main CSS File -->
    <link href="style.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #364f7b;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-uppercase" href="#" style="font-size: 25px;">Inventory Management
                System</a>
            <div class="login">
                <a href="./admin/login.php"> <button class="btn-login">LOGIN</button></a>
            </div>
        </div>
    </nav>
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex justify-content-center justify-content-lg-start gap-2 mb-4">
                    </div>

                    <h1>Effortless Inventory Management</h1>
                    <h2>Transform Your Inventory Management Experience Today</h2>
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>About Us</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6">
                        <p>
                            Welcome to Inventory Management, the ultimate inventory management system designed to simplify and
                            streamline your inventory processes. Whether you own a small retail store or manage a large
                            warehouse, our platform is here to help you take control of your inventory like never
                            before.
                        </p>
                        <ul>
                            Say goodbye to endless spreadsheets and tedious
                            data entry.
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p>
                            At this Inventory, we understand the unique challenges of inventory management. That's why
                            we offer robust customer support, ensuring that you have assistance every step of the way.
                            Our team is dedicated to your success, helping you maximize efficiency, reduce costs, and
                            boost profitability.
                        </p>
                        <p>
                            Discover the power of Inventory today and unlock the full potential of your inventory!
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Why Inventory Management System?</h2>
                </div>

                <div class="row why-section">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box text-center">
                            <div class="icon"><i class="bi bi-dribbble"></i></div>
                            <h4><a href="#">Simple and Rich</a></h4>
                            <p>Streamline your inventory management with a user-friendly interface and comprehensive
                                features.
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box text-center">
                            <div class="icon"><i class="bi bi-file"></i></div>
                            <h4><a href="#">Easy Customizable</a></h4>
                            <p>Tailor Inventory Management System to your specific business needs with customizable
                                settings and
                                configurations.
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0">
                        <div class="icon-box text-center">
                            <div class="icon"><i class="bi bi-speedometer"></i></div>
                            <h4><a href="#">Fast and scalable</a></h4>
                            <p>Enjoy high-performance and scalability to handle your growing inventory demands
                                efficiently.
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0">
                        <div class="icon-box text-center">
                            <div class="icon"><i class="bi bi-layer-forward"></i></div>
                            <h4><a href="#">Excellent Support</a></h4>
                            <p>Our dedicated support team is here to assist you every step of the way, ensuring your
                                success with Digital Kirana.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </main>
    <section id="why-us" class="section-bg">
        <div class="container-fluid">
            <div class="section-title">
                <h2>Contact Us</h2>
            </div>
            <div class="row bg-white border rounded-2 p-2 m-2 cta">
                <div class="col-lg-6 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1" id="header">
                    <div class="d-flex justify-content-center justify-content-lg-start gap-2 mb-4">
                    </div>
                    <h1 class="ms-5 fw-bold">If you have any queries, then send us message.</h1>
                    <h4 class="ms-5 mt-3"><strong>Address:</strong> Itahari, Nepal</h4>
                    <h4 class="ms-5"><strong>Contact:</strong> 026-520-052</h4>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">
                    <div class="card">
                        <form action="" method="post">
                            <div class="card-body p-5">
                                <div class="mb-3 form-floating">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email">
                                    <label for="email">Email*</label>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="number" id="number" class="form-control" name="number" placeholder="Enter your number">
                                    <label for="number">Contact Number*</label>
                                </div>
                                <div class="mb-3 form-floating">
                                    <textarea id="message" class="form-control" name="message" placeholder="Enter your number"></textarea>
                                    <label for="message">Message*</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="location" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Location</h2>
            </div>
            <div class="google-map" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 400px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3431.1876997474096!2d87.27362577515997!3d26.653761071171534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef6c69f0145601%3A0xfe60e85ae5fd9719!2sSathi%20Petrol%20Pump!5e1!3m2!1sen!2snp!4v1695825084587!5m2!1sen!2snp" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-5 col-md-6 footer-contact">
                        <h3>Inventory Management System</h3>
                        <p>
                            Streamline inventory management, optimize stock levels, and simplify your business
                            operations.
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links align-content-center">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#why-us">Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Our Social Networks</h4>
                        <p>Follow us on social media for new updates</p>
                        <div class="social-links mt-3">
                            <a href="https://twitter.com/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="https://www.skype.com/en/" target="_blank" class="google-plus"><i class="bi bi-skype"></i></a>
                            <a href="https://www.linkedin.com/" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>2023</span></strong>. Developed by <a href="" style="color: white; font-weight: bold;">Pawan Acharya</a>
            </div>
        </div>
    </footer>
    <script src=""></script>
</body>

</html>
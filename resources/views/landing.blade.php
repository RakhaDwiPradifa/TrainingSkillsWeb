<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | Learning Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        .navbar-custom {
            background-color: #2d3e50;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }
        .navbar-custom .nav-link:hover {
            color: #ff6f61;
        }
        .hero-section {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            height: 80vh;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            border-bottom: 5px solid rgba(0, 0, 0, 0.1);
        }
        .hero-section h1 {
            font-size: 4rem;
            font-weight: 700;
            letter-spacing: 2px;
            animation: fadeInUp 1.5s ease-out;
        }
        .hero-section p {
            font-size: 1.5rem;
            font-weight: 300;
            animation: fadeInUp 2s ease-out;
        }
        .btn-primary-custom {
            background-color: #ff6f61;
            border: none;
            font-size: 1.3rem;
            padding: 15px 40px;
            border-radius: 50px;
            transition: transform 0.3s ease, background-color 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary-custom:hover {
            background-color: #ff3b2a;
            transform: translateY(-5px);
        }
        .features-section {
            padding: 100px 0;
            background-color: #f9f9f9;
        }
        .feature-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        .feature-card img {
            border-bottom: 3px solid #ecf0f1;
            object-fit: cover;
            height: 250px;
            width: 100%;
        }
        .feature-card-body {
            padding: 30px;
        }
        .feature-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #34495e;
        }
        .feature-description {
            font-size: 1rem;
            color: #7f8c8d;
        }
        footer {
            background-color: #2d3e50;
            color: white;
            padding: 60px 0;
            position: relative;
            text-align: center;
        }
        footer .footer-links a {
            color: #ecf0f1;
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease;
        }
        footer .footer-links a:hover {
            color: #ff6f61;
        }
        .cta-section {
            background-color: #ff6f61;
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            z-index: 3;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .cta-section .btn-primary-custom {
            background-color: #ff6f61;
            padding: 15px 40px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Learnify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div>
            <h1>Transform Your Future With Us</h1>
            <p>Unlock new skills and open doors to endless opportunities through our interactive learning platform.</p>
            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="display-4 text-center mb-5">Our Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Quality Courses">
                        <div class="card-body feature-card-body">
                            <h5 class="feature-title">World-Class Courses</h5>
                            <p class="feature-description">Learn from top industry experts and transform your career with world-class content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Interactive Learning">
                        <div class="card-body feature-card-body">
                            <h5 class="feature-title">Interactive Learning</h5>
                            <p class="feature-description">Engage with practical lessons, quizzes, and live sessions that keep you on track.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://via.placeholder.com/500x300" class="card-img-top" alt="Certification">
                        <div class="card-body feature-card-body">
                            <h5 class="feature-title">Earn Certification</h5>
                            <p class="feature-description">Get recognized certification to boost your professional profile and open new career doors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Start Your Learning Journey Today</h2>
            <p>Join thousands of learners who have already transformed their careers with Learnify!</p>
            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg">Join Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Learnify. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FitLife | Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
    }

    .hero {
      height: 100vh;
      color: white;
      position: relative;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      transition: background-image 1s ease-in-out;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
      z-index: 1;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      position: relative;
      z-index: 3;
    }

    .navbar h1 {
      font-size: 45px;
      font-weight: 800;
      color: white;
    }

    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
      position: fixed;
      top: 25px;
      right: 25px;
      z-index: 101;
    }

    .hamburger div {
      width: 25px;
      height: 3px;
      background-color: white;
      margin: 4px 0;
      transition: 0.4s;
    }

    .nav-buttons {
      display: flex;
      gap: 10px;
    }

    .nav-buttons a,
    .nav-buttons span {
      text-decoration: none;
      font-weight: 600;
      color: white;
      padding: 10px 20px;
      border: 2px solid white;
      border-radius: 25px;
      transition: all 0.3s ease;
    }

    .nav-buttons a:hover {
      background-color: white;
      color: black;
    }

    .logout-btn {
      background-color: red;
      border: none;
      color: white;
    }

    .content {
      position: relative;
      top: 50%;
      left: 10%;
      transform: translateY(-50%);
      z-index: 2;
      max-width: 700px;
    }

    .content h2 {
      font-size: 42px;
      font-weight: 800;
      margin-bottom: 10px;
      animation: slideInLeft 1s ease-out forwards;
      opacity: 0;
    }

    .typing-text {
      font-size: 22px;
      font-weight: 500;
      color: #eee;
      white-space: nowrap;
      overflow: hidden;
      border-right: 2px solid #fff;
      width: 0;
      animation:
        typing 4s steps(40, end) infinite alternate,
        blink 0.8s infinite,
        slideInLeft 1.5s ease-out forwards;
      animation-delay: 0.5s;
      opacity: 0;
    }

    .content p {
      font-size: 18px;
      color: #ddd;
      margin-bottom: 30px;
      animation: slideInLeft 1.8s ease-out forwards;
      opacity: 0;
    }

    .content a.btn {
      text-decoration: none;
      background-color: #ffcc00;
      color: black;
      padding: 14px 28px;
      font-weight: bold;
      border-radius: 30px;
      transition: background 0.3s ease;
      animation: slideInLeft 2s ease-out forwards;
      opacity: 0;
    }

    .content a.btn:hover {
      background-color: #e6b800;
    }

    section {
      padding: 80px 60px;
      background: white;
    }

    .motivation-wrapper {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 40px;
      max-width: 1200px;
      margin: auto;
    }

    .motivation-text,
    .motivation-img {
      flex: 1;
      min-width: 280px;
    }

    .motivation-text h2 {
      font-size: 36px;
      font-weight: 800;
      margin-bottom: 15px;
      color: #111;
    }

    .motivation-text p {
      font-size: 18px;
      color: #444;
    }

    .motivation-img img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }

    .section-heading {
      font-size: 36px;
      font-weight: 800;
      margin-bottom: 30px;
      text-align: center;
      opacity: 0;
      transform: translateX(-60px);
    }

    .section-content {
      max-width: 1000px;
      margin: auto;
      font-size: 18px;
      line-height: 1.6;
      text-align: center;
      color: #333;
      opacity: 0;
      transform: translateX(-60px);
    }

    .footer {
      background-color: #222;
      color: #ccc;
      padding: 30px 0;
      text-align: center;
    }

    .slide-right-text {
      opacity: 0;
      transform: translateX(-80px);
      transition: all 0.8s ease;
    }

    .slide-right-text.animate-slide {
      opacity: 1;
      transform: translateX(0);
    }

    .slider-container {
      position: relative;
      max-width: 900px;
      margin: auto;
      overflow: hidden;
      border-radius: 10px;
    }

    .slider {
      display: flex;
      transition: transform 2.5s ease-in-out;
    }

    .slider img {
      min-width: 100%;
      height: 450px;
      object-fit: cover;
    }

    .slider-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      padding: 10px;
      font-size: 20px;
      cursor: pointer;
      border-radius: 50%;
    }

    .slider-btn.left {
      left: 15px;
    }

    .slider-btn.right {
      right: 15px;
    }

    @media (max-width: 768px) {
      .hamburger {
        display: flex;
      }
      .nav-buttons {
        flex-direction: column;
        position: fixed;
        top: 0;
        right: -100%;
        height: 100vh;
        width: 220px;
        background-color: rgba(20, 20, 20, 0.86);
        padding: 70px 20px;
        transition: right 0.3s ease;
        z-index: 100;
      }
       .nav-buttons a:hover,
         .nav-buttons span:hover {
          color:white;
          background-color: transparent !important; 
          /* background-color: white; */
  }
      .nav-buttons.active {
        right: 0;
      }

      .nav-buttons a,
      .nav-buttons span {
        margin: 10px 0;
        padding: 10px 0;
        font-size: 18px;
        border: none;
        display: block;
      }

      .logout-btn {
        background-color: transparent;
        color: red;
        font-weight: bold;
        padding: 8px 0;
      }

      .content {
        left: 5%;
        width: 90%;
        max-width: 100%;
      }

      .motivation-wrapper {
        flex-direction: column;
        text-align: center;
      }

      .slider img {
        height: 250px;
      }
    }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes typing {
      0% {
        width: 0;
      }

      100% {
        width: 100%;
      }
    }

    @keyframes blink {
      50% {
        border-color: transparent;
      }
    }
  </style>
</head>
<body>
  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="overlay"></div>
    <nav class="navbar">
      <h1>FitLife</h1>
      <div class="hamburger" onclick="toggleMenu()">
        <div></div><div></div><div></div>
      </div>
      <div class="nav-buttons" id="navMenu">
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="workout.php">Workouts</a>
        <a href="#contact">Contact</a>
        <?php if ($isLoggedIn): ?>
          <span>Welcome, <?= htmlspecialchars($_SESSION['username']); ?></span>
          <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
          <a href="signup.php">Sign Up</a>
        <?php endif; ?>
      </div>
    </nav>
    <div class="content">
      <h2>Reach Your Best</h2>
      <div class="typing-text">Level Up Your Fitness Journey with Us.</div>
      <p>Whether you're training for a marathon or your biggest season yet, we're here to help you make serious progress.</p>
      <a href="workout.php" class="btn">Get Started</a>
    </div>
  </section>

  <!-- Motivation Section -->
  <section id="motivation">
    <div class="motivation-wrapper">
      <div class="motivation-text slide-right-text">
        <h2>SET GOALS.<br>LOG WORKOUTS.<br>STAY ON TRACK.</h2>
        <p>Easily track your Workouts, set Training Plans, and discover new Workout Routines to crush your goals.</p>
      </div>
      <div class="motivation-img">
        <img src="motivation1.jpg" alt="Motivation Image">
      </div>
    </div>
  </section>

  <!-- Slider Section -->
  <section id="transformation" style="background-color: white; padding: 80px 0;">
    <div class="slider-container">
      <div class="slider" id="slider">
        <img src="yoga_back1.jpg" alt="Before">
        <img src="login_back8.jpg" alt="After">
         <img src="home_back1.jpg" alt="After">
      </div>
    </div>
  </section>

  <section id="about">
   <h2 class="section-heading slide-right-text">About FitLife</h2>
    <div class="section-content slide-right-text">
      FitLife is your personal gateway to fitness excellence. Whether you're new or experienced, our programs, nutrition guides, and coaching services are tailored to help you grow strong, healthy, and confident.<br><br>
      Founded by <strong>Piyush Gupta</strong>, <strong>Harnoor Singh Nagpal</strong>, and <strong>Tushar Ghalot</strong>, FitLife is built with a passion for wellness and a commitment to helping you transform your lifestyle through sustainable fitness routines.
    </div>
  </section>

  <section id="services">
    <h2 class="section-heading slide-right-text">Our Service</h2>
    <div class="section-content slide-right-text">
      • Personalized Workout Plans<br>
      • 24/7 Virtual Training Access<br>
      • Nutritional Guidance<br>
      • Online Progress Tracking<br>
      • Community Support & Motivation
    </div>
  </section>

  <section id="testimonials">
    <h2 class="section-heading slide-right-text">Testimonials</h2>
    <div class="section-content slide-right-text">
      “FitLife changed my life. I’ve lost 20kg and feel stronger than ever!” – Aman<br><br>
      “Their online training program is super flexible and effective.” – Priya<br><br>
      “Excellent coaching and an inspiring community!” – Raj
    </div>
  </section>

  <section id="contact">
    <h2 class="section-heading slide-right-text">Contact Us</h2>
    <div class="section-content slide-right-text">
      📧 Email: fitlife21team@gmail.com<br>
      📞 Phone: +91-7827908079<br>
    </div>
  </section>

  <!-- Footer -->
  <div class="footer">&copy; 2025 FitLife. All rights reserved.</div>

  <!-- JavaScript -->
  <script>
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.getElementById('navMenu');

    function toggleMenu() {
      navMenu.classList.toggle('active');
    }

    document.addEventListener('click', function (e) {
      if (!navMenu.contains(e.target) && !hamburger.contains(e.target)) {
        navMenu.classList.remove('active');
      }
    });

    const hero = document.getElementById('hero');
    const images = ['login_back6.jpg', 'login_back2.jpg', 'login_back3.jpg', 'login_back4.jpg', 'login_back7.jpg'];
    let index = 0;

    function changeBackground() {
      hero.style.backgroundImage = `url('${images[index]}')`;
      index = (index + 1) % images.length;
    }

    changeBackground();
    setInterval(changeBackground, 3000);

    const slideTextElements = document.querySelectorAll('.slide-right-text');
    const slideObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-slide');
        } else {
          entry.target.classList.remove('animate-slide');
        }
      });
    }, { threshold: 0.3 });

    slideTextElements.forEach(el => slideObserver.observe(el));

    const slider = document.getElementById('slider');
    let slideIndex = 0;
    const totalSlides = slider.children.length;

    function showSlide(index) {
      slider.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
      slideIndex = (slideIndex + 1) % totalSlides;
      showSlide(slideIndex);
    }

    setInterval(nextSlide, 4000);
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Med Priority — Home</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.4/lottie.min.js"></script>

  <style>
    :root {
      --blue: #4a90e2;
      --purple: #07040e;
      --dark: #1a1a2e;
      --light: #eef4ff;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--light);
      color: var(--dark);
      line-height: 1.6;
    }

    /* HEADER */
    header {
      background: linear-gradient(135deg, var(--purple), var(--blue));
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      font-size: 26px;
      font-weight: 800;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin-left: 18px;
      font-weight: 600;
    }

    /* HERO SECTION */
    .hero-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      padding: 60px 80px;
      align-items: center;
      background: white;
    }
    .hero-section h2 {
      font-size: 40px;
      font-weight: 800;
      color: var(--purple);
    }
    .hero-section p {
      margin-top: 12px;
      font-size: 18px;
      color: #333;
    }
    #heroAnimation {
      width: 100%;
      height: 420px;
    }
    .btn-primary {
      display: inline-block;
      margin-top: 25px;
      padding: 14px 26px;
      background: var(--purple);
      color: white;
      border-radius: 8px;
      font-weight: 700;
      text-decoration: none;
    }

    /* FEATURES */
    .section {
      padding: 60px 80px;
      background: var(--light);
    }
    .section h3 {
      font-size: 32px;
      margin-bottom: 25px;
      font-weight: 800;
      color: var(--purple);
    }
    .feature-box {
      background: white;
      padding: 20px 25px;
      margin-bottom: 20px;
      border-left: 6px solid var(--blue);
      border-radius: 8px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    .feature-box h4 {
      margin-bottom: 8px;
      color: var(--purple);
      font-size: 22px;
    }

    /* FOOTER */
    footer {
      background: var(--purple);
      color: white;
      text-align: center;
      padding: 16px;
      margin-top: 40px;
      font-size: 15px;
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header>
    <h1>Med Priority</h1>
    <video style="display:none;" autoplay loop muted>
      <source src="medpriority.mp4" type="video/mp4"> 
    <nav>
      <a href="mainhome.php">Home</a>
      <a href="userlogin.php">Login</a>
      <a href="userregister.php">Register</a>
    </nav>
  </header>

  <!-- HERO -->
  <section class="hero-section">
    <div>
      <h2>Emergency & Patient Management Reimagined</h2>
      <p>“In India, many patients lose their lives in the first 5 minutes of an emergency — our system gives those 5 minutes back.”</p>
      <a href="login.html" class="btn-primary">Get Started</a>
    </div>
    <div>
      <div id="heroAnimation"></div>
    </div>
  </section>

  <!-- FEATURES SECTION -->
  <section class="section">
    <h3>Core Features</h3>

    <div class="feature-box">
      <h4>AI Disease Prediction</h4>
      <p>The system predicts possible diseases based on symptoms. Helps identify urgency (mild, moderate, emergency).</p>
    </div>

    <div class="feature-box">
      <h4>Smart Appointment System</h4>
      <p>Patients get the earliest doctor slot without waiting in long lines. Reduces crowds in hospitals.</p>
    </div>

    <div class="feature-box">
      <h4>Emergency First-Step Guidance</h4>
      <p>Instant first-step instructions for heart attack, choking, burns, accidents — lifesaving before help arrives.</p>
    </div>

    <div class="feature-box">
      <h4>Nearest Hospital Suggestions (GPS)</h4>
      <p>Shows the closest hospital with route guidance. Saves crucial time during emergencies.</p>
    </div>

    <div class="feature-box">
      <h4>Future Vision</h4>
      <p>Voice-based emergency activation & ambulance integration to save even more lives.</p>
    </div>

  </section>

  <!-- FOOTER -->
  <footer>
    © 2025 Med Priority — Developed by Nextgen Coders | GM University
  </footer>

  <!-- LOTTIE ANIMATION SCRIPT -->
  <script>
    lottie.loadAnimation({
      container: document.getElementById("heroAnimation"),
      renderer: "svg",
      loop: true,
      autoplay: true,
      path: "https://assets10.lottiefiles.com/packages/lf20_tutvdkg0.json"
    });
  </script>

</body>
</html>

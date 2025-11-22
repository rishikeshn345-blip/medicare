<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Healthcare System — Home</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --blue: #4a90e2;
    --purple: #07040e;
    --blue-light: #e5f0fd;
    --text: #1a1a2e;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: "Inter", sans-serif;
    background: var(--blue-light);
    color: var(--text);
  }

  .wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 35px;
    padding: 40px 20px;
  }

  h1 {
    font-size: 32px;
    font-weight: 800;
    text-align: center;
  }

  .btn-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
    width: 100%;
    max-width: 500px;
  }

  .btn {
    width: 100%;
    padding: 16px;
    border-radius: 10px;
    border: none;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.25s;
    text-align: center;
  }

  .user-btn { background: var(--blue); color: white; }
  .hospital-btn { background: var(--purple); color: white; }
  .emergency-btn { background: red; color: white; }
  .ai-btn { background: #00b894; color: white; }

  .btn:hover { opacity: 0.85; }

  .about-section {
    max-width: 900px;
    background: white;
    padding: 26px 30px;
    border-radius: 12px;
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    line-height: 1.55;
    font-size: 16px;
  }

  .about-section h2 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 14px;
    text-align: center;
  }

  .points {
    margin-top: 12px;
  }

  .points li {
    margin-bottom: 8px;
  }
</style>

</head>

<body>

<div class="wrapper">

  <h1>Healthcare Management System</h1>

  <div class="btn-container">
    <button class="btn user-btn" onclick="navigate('home.php')">User</button>
    <button class="btn hospital-btn" onclick="navigate('hosplogin.php')">Hospital</button>
    <button class="btn emergency-btn" onclick="navigate('emergency.php')">Emergency Support</button>
    <button class="btn ai-btn" onclick="navigate('doctlogin.php')">Doctor Login</button>
  </div>

  <div class="about-section">
    <h2>Our Project: MED PRIORITY</h2>

    <p>
      Med Priority is a smart healthcare platform that helps patients get quick medical
      help and proper treatment without wasting time. In many emergencies, the first 5 minutes
      are very important. Our system helps people take the right action and reach the hospital faster.
    </p>

    <ul class="points">
      <li><strong>Smart Appointment Booking:</strong> Book doctor appointments online — no long waiting lines.</li>
      <li><strong>Emergency First Help:</strong> Simple step-by-step instructions for heart attack, burns, choking, etc.</li>
      <li><strong>Nearest Hospital Locator:</strong> Uses GPS to show the nearest hospital with directions.</li>
      <li><strong>Improves Hospital Management:</strong> Reduces crowding and helps doctors focus on urgent patients.</li>
      <li><strong>Helps People Living Alone:</strong> Guides them if they face sudden medical issues.</li>
    </ul>

    <p>
      Our aim is not to replace doctors — but to make sure patients reach doctors faster,
      safer and with the right guidance. In future, we plan to connect ambulance services
      and voice-based emergency calling to save more lives.
    </p>

  </div>

</div>

<script>
function navigate(path) {
  window.location.href = path;
}

function emergencySupport() {
  alert("Emergency Support Activated!\nCalling nearest hospital… (Demo)");
}
</script>

</body>
</html>

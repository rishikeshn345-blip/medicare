<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register — Healthcare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
     --blue: #4a90e2;
      --purple: #07040e;
      --blue-light: #e5f0fd;
      --text: #1a1a2e;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background: var(--blue-light);
      color: var(--text);
    }
    .page {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 32px;
    }
    .card {
      max-width: 1000px;
      width: 100%;
      display: grid;
      grid-template-columns: 1fr 400px;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 12px 34px rgba(0,0,0,0.12);
    }
    .hero {
      position: relative;
      min-height: 450px;
      background: #f0f4f8;
    }
    .hero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(1.05);
    }
    .panel {
      padding: 40px 36px;
      background: linear-gradient(135deg, var(--purple), var(--blue));
      color: white;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }
    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .brand .logo {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .brand .logo svg {
      width: 28px;
      height: 28px;
      fill: var(--purple);
    }
    .brand .name {
      font-weight: 700;
      font-size: 22px;
      color: white;
    }
    h1 {
      margin: 0;
      font-size: 26px;
      font-weight: 700;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }
    label {
      font-size: 14px;
      font-weight: 500;
    }
    input {
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      outline: none;
    }
    input[type="text"],
    input[type="email"] {
      background: rgba(255, 255, 255, 0.9);
    }
    input[type="password"] {
      background: rgba(255, 255, 255, 0.9);
    }
    input:focus {
      box-shadow: 0 0 0 3px rgba(255,255,255,0.6);
    }
    .btn {
      padding: 14px;
      background: white;
      color: var(--purple);
      font-weight: 600;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn:hover {
      background: #f0f0f0;
    }
    .link {
      color: white;
      font-size: 14px;
      text-decoration: none;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="page">
    <div class="card">
      <div class="hero">
        <img src="https://static.toiimg.com/thumb/msid-53004364,width-400,resizemode-4/53004364.jpg" alt="Doctor">
      </div>
      <div class="panel">
        <div class="brand">
          <div class="logo">
            <svg viewBox="0 0 24 24">
              <path d="M12 2C13.1046 2 14 2.8954 14 4C14 5.1046 13.1046 6 12 6C10.8954 6 10 5.1046 10 4C10 2.8954 10.8954 2 12 2Z"/>
              <path d="M4 18.5C4 15 7 12.5 12 12.5C17 12.5 20 15 20 18.5V20H4V18.5Z"/>
            </svg>
          </div>
          <div class="name">Healthcare</div>
        </div>

        <h1>Create Account</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div>
            <label for="fullName">Full Name</label><br>
            <input id="fullName" type="text" name="name" maxlength="25" required placeholder="Your name">
          </div>
          <div>
            <label for="phno">Phone</label><br>
            <input id="phno" type="tel" name="phno" max="999999999" placeholder="1234567890" required>
          </div>
          <div>
            <label for="age">Age</label><br>
            <input id="age" type="number" name="age" max="100" placeholder="Enter your age" required>
          </div>
          <div>
            <label for="gender">Gender</label><br>
            <input id="gender" type="radio" name="gender" value="male" required>Male
            <input id="gender" type="radio" name="gender" value="femail" required>Female
          </div>
          <div>
            <label for="password">Password</label><br>
            <input id="password" type="password" name="password" maxlength="25" required placeholder="Enter password">
          </div>
          <div>
            <label for="confirmPassword">Confirm Password</label><br>
            <input id="confirmPassword" type="password" name="cpassword" maxlength="25" required placeholder="Confirm password">
          </div>
          <button class="btn" name="submit" type="submit" value="submit">Register</button>
        </form>

        <a href="userlogin.php" class="link">Already have an account? Login</a>
      </div>
    </div>
  </div>

  <script>
    function handleRegister(e) {
      e.preventDefault();
      alert("Register clicked (demo)");
    }
  </script>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $name=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
  $phno=$_POST['phno'];
  $phno=filter_var($phno,FILTER_SANITIZE_NUMBER_INT);
  $gender=$_POST['gender'];
  $password=$_POST['password'];
  $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
  $cpassword=$_POST['cpassword'];
  $cpassword=filter_var($cpassword,FILTER_SANITIZE_SPECIAL_CHARS);
  if()
}

?>

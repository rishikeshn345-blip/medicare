<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login — Healthcare</title>
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
      transition: 0.2s;
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

      <!-- Left doctor image -->
      <div class="hero">
        <img src="https://static.toiimg.com/thumb/msid-53004364,width-400,resizemode-4/53004364.jpg" alt="Doctor">
      </div>

      <!-- Right gradient panel -->
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

        <h1>Login</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div>
            <label for="name">Username</label><br>
            <input id="name" type="text" name="name" required placeholder="Enter the usename">
          </div>

          <div>
            <label for="password">Password</label><br>
            <input id="password" name="password" type="password" required placeholder="Enter password">
          </div>

          <button class="btn" name="submit" value="submit" type="submit">Login</button>
        </form>

        <a href="userregister.php" class="link">Don’t have an account? Register</a>

      </div>
    </div>
  </div>

  <script>
    function handleLogin(e) {
      e.preventDefault();
      alert("Login clicked (demo)");
    }
  </script>

</body>
</html>
<?php
  if(isset($_POST['submit']))
  {
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
    $password=$_POST['password'];
    $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
    $conn=new mysqli("localhost","root","","health system");
    if($conn->connect_error)
    {
      echo "<script>window.alert('Unable to connect to the database')</script>";
      die("Unable to connect");
    }
    else
    {
      $sql="SELECT * FROM users WHERE name='$name' AND password='$password'";
      $result=$conn->query($sql);
      if($result->num_rows>0)
      {
          echo "<script> window.location='search.php'</script>";
      }
      else
      {
        echo "<script>window.alert('No user found with the given username and password')</script>";
      }
    }
    $conn->close();
  }

?>

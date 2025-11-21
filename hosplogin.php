<?php
if(isset($_POST['submit']))
{
  $hname=$_POST['hname'];
  $hname=filter_var($hname,FILTER_SANITIZE_SPECIAL_CHARS);
  $hname=strtolower($hname);
  $lno=$_POST['lno'];
  $lno=filter_var($lno,FILTER_SANITIZE_SPECIAL_CHARS);
  $password=$_POST['password'];
  $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
  $conn=new mysqli("localhost","root","","health system");
  if($conn->connect_error)
  {
    die("Unable to connect to the database!");
    echo "<script>window.alert('Connection failed')</script>";
  }
  else
  {
    $sql="SELECT * FROM hospitals WHERE hname='$hname' AND password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      setcookie("hname",$hname);
      echo "<script>window.alert('Log in successful')</script>";
      echo "<script>window.location='gate.php'</script>";
    }
  }
  $conn->close();
}

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hospital Login — Med Priority</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --blue: #4a90e2;
      --purple: #07040e;
      --blue-light: #e5f0fd;
      --text: #1a1a2e;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
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

    .hero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(1);
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
    .brand svg {
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
      gap: 20px;
      margin-top: 10px;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    label {
      font-size: 14px;
      font-weight: 500;
    }

    input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      background: rgba(255, 255, 255, 0.9);
      outline: none;
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
      margin-top: 5px;
    }
    .btn:hover {
      background: #f0f0f0;
    }

    .link {
      color: white;
      font-size: 14px;
      text-decoration: none;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>

<body>

  <div class="page">
    <div class="card">

      <!-- Doctor Image Left Side -->
      <div class="hero">
        <img src="https://static.toiimg.com/thumb/msid-53004364,width-400,resizemode-4/53004364.jpg" alt="Doctor">
      </div>

      <!-- Hospital Login Panel -->
      <div class="panel">
        
        <div class="brand">
          <div class="logo">
            <svg viewBox="0 0 24 24">
              <path d="M21 8H16V3H8V8H3V16H8V21H16V16H21V8Z"/>
            </svg>
          </div>
          <div class="name">Hospital Login</div>
        </div>

        <h1>Login</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

          <div class="field">
            <label>Hospital Name</label>
            <input type="text" name="hname" required placeholder="Enter hospital name">
          </div>

          <div class="field">
            <label>License Number</label>
            <input type="text" name="lno" required placeholder="Enter license number">
          </div>

          <div class="field">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter password">
          </div>

          <button class="btn" name="submit" value="submit" type="submit">Login</button>
        </form>

        <a href="hospitalregi.php" class="link">Don't have a account register now</a>
      </div>

    </div>
  </div>
</body>
</html>

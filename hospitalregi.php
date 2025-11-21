<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hospital Registration — Healthcare</title>

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
    }

    .panel {
      padding: 40px 36px;
      background: linear-gradient(135deg, var(--purple), var(--blue));
      color: white;
      display: flex;
      flex-direction: column;
      gap: 22px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .brand .logo {
      width: 50px; height: 50px;
      border-radius: 50%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .brand svg {
      width: 28px; height: 28px; fill: var(--purple);
    }

    h1 {
      font-size: 26px;
      font-weight: 700;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 18px;
      margin-top: 10px;
    }

    .field { display: flex; flex-direction: column; gap: 6px; }

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

    textarea {
      padding: 12px;
      resize: none;
      border-radius: 6px;
      border: none;
      background: rgba(255,255,255,0.9);
      height: 80px;
      font-size: 15px;
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
      margin-top: 5px;
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
      margin-top: 5px;
    }
  </style>
</head>

<body>

<div class="page">
  <div class="card">

    <!-- IMAGE -->
    <div class="hero">
      <img src="https://t4.ftcdn.net/jpg/02/63/12/76/360_F_263127679_lu6mP4bZOhjzPaoMzlQp4t0I1S9dyUbA.jpg" alt="Hospital">
    </div>

    <!-- FORM PANEL -->
    <div class="panel">

      <div class="brand">
        <div class="logo">
          <svg viewBox="0 0 24 24">
            <path d="M12 2c1.1 0 2 .9 2 2v2h2c1.1 0 2 .9 2 2v2h2v4h-2v2c0 1.1-.9 2-2 2h-2v2c0 1.1-.9 2-2 2h-4c-1.1 0-2-.9-2-2v-2H6c-1.1 0-2-.9-2-2v-2H2v-4h2V8c0-1.1.9-2 2-2h2V4c0-1.1.9-2 2-2h4z"/>
          </svg>
        </div>
        <div class="name">Healthcare</div>
      </div>

      <h1>Hospital Registration</h1>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        
        <div class="field">
          <label>Hospital Name</label>
          <input type="text" name="hname" required placeholder="Enter hospital name">
        </div>

        <div class="field">
          <label>Address</label>
          <textarea required name="haddress" placeholder="Enter hospital address"></textarea>
        </div>

        <div class="field">
          <label>License Number</label>
          <input type="text" name="lno" required placeholder="Enter license number">
        </div>

        <div class="field">
          <label>Password</label>
          <input type="password" name="password" required placeholder="Create password">
        </div>

        <div class="field">
          <label>Confirm Password</label>
          <input type="password" name="cpassword" required placeholder="Re-enter password">
        </div>

        <button class="btn" name="submit" value="submit" type="submit">Register Hospital</button>
      </form>

      <a href="#" class="link">Back to Home</a>
    </div>
  </div>
</div>

<script>
  function hospitalRegister(e) {
    e.preventDefault();
    alert("Hospital Registered Successfully (Demo)");
  }
</script>

</body>
</html>
<?php
if(isset($_POST['submit']))
{
  $hname=$_POST['hname'];
  $hname=filter_var($hname,FILTER_SANITIZE_SPECIAL_CHARS);
  $hname=strtolower($hname);
  $haddress=$_POST['haddress'];
  $haddress=filter_var($haddress,FILTER_SANITIZE_SPECIAL_CHARS);
  $lno=$_POST['lno'];
  $lno=filter_var($lno,FILTER_SANITIZE_SPECIAL_CHARS);
  $password=$_POST['password'];
  $password=filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
  $cpassword=$_POST['cpassword'];
  $cpassword=filter_var($cpassword,FILTER_SANITIZE_SPECIAL_CHARS);
  $conn=new mysqli("localhost","root","","health system");
  if($password!==$cpassword)
  {
    echo "<script>window.alert('Passwords do not match!!')</script>";
  }
  else
  {
      if($conn->connect_errno)
    {
      die("Unable to connect");
      echo "<script>window.alert('Unable to connect to the database')</script>";
    }
    else
    {
      $sql="SELECT * FROM hospitals WHERE hname='hname'";
      $result=$conn->query($sql);
      if($result->num_rows>0)
      {
        echo "<script>window.alert('Hospital name already taken!!')</script>";
      }
      else
      {
        $sql = "INSERT INTO hospitals (hname,haddress,lno, password, datetime)
          VALUES ('$hname', '$haddress', '$lno', '$password', NOW())";
          if($conn->query($sql))
          {
            echo "<script>window.alert('Hospital added successfully!!')</script>";
            echo "<script> window.location='hosplogin.php'</script>";
          }
          else
          {
            echo "<script>window.alert('Unable to add something went wrong')</script>";
          }
      }
    }
  }
  
  $conn->close();
}


?>

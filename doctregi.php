<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Doctor Registration — Healthcare</title>

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

    h1 {
      margin: 0;
      font-size: 26px;
      font-weight: 700;
    }

    /* FIXED INPUT ALIGNMENT */
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

    input, select {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      background: rgba(255, 255, 255, 0.9);
      outline: none;
    }

    input:focus, select:focus {
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
    }
    img scr {
        width: 45%;
    }
  </style>
</head>

<body>

  <div class="page">
    <div class="card">

      <!-- LEFT SIDE PHOTO -->
      <div class="hero">
        <img src="https://static.toiimg.com/thumb/msid-53004364,width-494,resizemode-4/53004364.jpg" alt="Doctor">
      </div>

      <!-- RIGHT SIDE FORM -->
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

        <h1>Doctor Registration</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

          <div class="field">
            <label>ID</label>
            <input type="text" name="id" required placeholder="Enter unique id">
          </div>
          <div class="field">
            <label>Full Name</label>
            <input type="text" name="name" required placeholder="Enter doctor's name">
          </div>

          <div class="field">
            <label>Age</label>
            <input type="number" name="age" required placeholder="Enter age">
          </div>

          <div class="field">
            <label>Gender</label>
            <select name="gender" required>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>

          <div>
        <label>Department</label>
        <select name="department" required>
        <option value="General Medicine">General Medicine</option>
        <option value="Physician">Physician</option>
        <option value="Cardiologist">Cardiologist</option>
        <option value="Neurologist">Neurologist</option>
        <option value="Pediatrician">Pediatrician</option>
        <option value="Dentist">Dentist</option>
        <option value="Orthopedic">Orthopedic</option>
        <option value="Dermatologist">Dermatologist</option>
        <option value="Gynecologist">Gynecologist</option>
        <option value="ENT Specialist">ENT Specialist</option>
        <option value="Surgeon">Surgeon</option>
        
  </select>
</div>


          <div class="field">
            <label>Experience</label>
            <input type="text" name="ep" placeholder="Years of experience">
          </div>

          <div class="field">
            <label>Email</label>
            <input type="email" name="email" required placeholder="doctor@example.com">
          </div>

          <div class="field">
            <label>Phone Number</label>
            <input type="text" name="phno" required placeholder="Enter phone number">
          </div>

          <div class="field">
            <label>Education</label>
            <input type="text" name="edu" required placeholder="Enter education">
          </div>
          
          <div class="field">
            <label>Working hours</label>
            <input type="text" name="working" required placeholder="Enter working hours">
          </div>

          <div class="field">
            <label>Enter HID:</label>
            <input type="text" name="hid" required placeholder="Enter HID">
          </div>

          <div class="field">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Create password">
          </div>



          <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="cpassword" required placeholder="Re-enter password">
          </div>

          <button class="btn" name="submit" value="submit" type="submit">Register Doctor</button>
        </form>

        <a href="gate.php" class="link">Back to Home</a>

      </div>
    </div>
  </div>

</body>
</html>
<?php
if(isset($_POST['submit']))
{
  $cpassword=$_POST['cpassword'];
  $password=$_POST['password'];
  $phno=$_POST['phno'];
  $email=$_POST['email'];
  $ep=$_POST['ep'];
  $education=$_POST['edu'];
  $department=$_POST['department'];
  $gender=$_POST['gender'];
  $age=$_POST['age'];
  $name=$_POST['name'];
  $id=$_POST['id'];
  $working=$_POST['working'];
  $hid=$_POST['hid'];


  $id=filter_var($id);
  $name=filter_var($name);
  $age=filter_var($age);
  $ep=filter_var($ep);
  $email=filter_var($email);
  $phno=filter_var($phno);
  $password=filter_var($password);
  $cpassword=filter_var($cpassword);
  $working=filter_var($working,FILTER_SANITIZE_SPECIAL_CHARS);
  $education=filter_var($education);

  if($password!==$cpassword)
  {
    echo "<script>window.alert('Passwords do not match')</script>";
  }
  else
  {
    $conn=new mysqli("localhost","root","","health system");
    if($conn->connect_error)
    {
      die("Unable to connect");
      echo "<script>windows.alert('Connection failed')</script>";
    }
    else
    {
      $sql="SELECT * FROM doctors WHERE id='$id'";
      $result=$conn->query($sql);
      if($result->num_rows>0)
      {
        echo "<script>windows.alert('ID exists')</script>";
      }
      else
      {
        $sql="INSERT INTO doctors (id,name,gender,education,department,experience,email,phone,password,working,datetime,age,hid)
        VALUES('$id','$name','$gender','$education','$department','$ep','$email','$phno','$password','$working',NOW(),'$age','$hid')";
        if($conn->query($sql))
        {
          echo "<script>window.alert('Registration successful')</script>";
        }
        else
        {
          echo "<scsript>window.alert('Unable to add data')</script>";
          echo "<script>window.location='gate.php'</script>";
        }
      }
    }
  }
  $conn->close();
}

?>
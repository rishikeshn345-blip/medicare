<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Doctor Registration — Healthcare</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#eaf3ff;
      --panel-start:#0e1b2b;
      --panel-end:#2d79d6;
      --accent:#0b2850;
      --muted:#6b7280;
      --white: #ffffff;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background:var(--bg);
      color:var(--accent);
      display:flex;
      align-items:center;
      justify-content:center;
      padding:28px;
    }

    /* card */
    .card{
      width:100%;
      max-width:1000px;
      display:grid;
      grid-template-columns: 1fr 420px;
      border-radius:12px;
      overflow:hidden;
      box-shadow: 0 18px 40px rgba(11,30,60,0.12);
      background:var(--white);
      min-height:560px;
    }

   

    /* right panel (form) */
    .panel{
      padding:34px;
      background: linear-gradient(135deg, var(--panel-start), var(--panel-end));
      color: white;
      display:flex;
      flex-direction:column;
      gap:18px;
      justify-content:center;
    }

    .brand{
      display:flex;
      gap:12px;
      align-items:center;
      margin-bottom:6px;
    }
    .logo{
      width:44px;
      height:44px;
      border-radius:50%;
      background:var(--white);
      display:flex;
      align-items:center;
      justify-content:center;
    }
    .logo svg{ width:26px; height:26px; fill:var(--panel-start); }

    .brand .title{
      font-weight:700;
      letter-spacing:0.2px;
    }

    h1{
      margin:0;
      font-size:20px;
      font-weight:700;
    }
    p.lead{
      margin:0;
      color:rgba(255,255,255,0.92);
      font-size:13px;
    }

    form{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap:12px;
      margin-top:6px;
    }

    .field{
      display:flex;
      flex-direction:column;
      gap:8px;
    }
    label{
      font-size:13px;
      font-weight:600;
      color:rgba(255,255,255,0.95);
    }
    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    select{
      padding:10px 12px;
      border-radius:8px;
      border: none;
      outline: none;
      font-size:14px;
      background: rgba(255,255,255,0.95);
      color: var(--panel-start);
    }
    input::placeholder{ color: #9aa8c7; }

    /* full-width elements */
    .full { grid-column: 1 / -1; display:flex; gap:12px; }
    .full .field{ flex:1; }

    .btn{
      grid-column: 1 / -1;
      padding:12px 14px;
      border-radius:8px;
      background:var(--white);
      color:var(--panel-start);
      font-weight:700;
      border:none;
      cursor:pointer;
      margin-top:6px;
      font-size:15px;
      box-shadow: 0 8px 20px rgba(11,30,60,0.12);
    }
    .btn:hover{ transform: translateY(-2px); transition: all 120ms ease; }

    .note{
      grid-column:1 / -1;
      font-size:13px;
      color: rgba(255,255,255,0.9);
      opacity:0.95;
    }

    /* responsive */
    @media (max-width:900px){
      .card{ grid-template-columns: 1fr; min-height:unset; }
      .visual{ display:block; padding:18px; }
      .panel{ padding:22px; }
      form{ grid-template-columns: 1fr; }
      .visual img{ max-width:100%; height:200px; object-fit:cover; }
    }

    /* small helper for required */
    .req{ color: #ffd6d6; font-size:12px; margin-left:6px; font-weight:700; opacity:0.9; }
  </style>
</head>
<body>
  <div class="card" role="main" aria-labelledby="heading">
    <!-- left visual area -->
    <!-- right panel with form -->
    <div class="panel">
      <div>
        <div class="brand" aria-hidden="true">
          <div class="logo" aria-hidden="true">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2a2 2 0 0 1 2 2 2 2 0 0 1-2 2 2 2 0 0 1-2-2 2 2 0 0 1 2-2zm-8 16v-1.5C4 13 7 11.5 12 11.5s8 1.5 8 5V20H4z"/>
            </svg>
          </div>
          <div>
            <div class="title">Healthcare</div>
            <div style="font-size:12px; color:rgba(255,255,255,0.9)">Doctor Registration</div>
          </div>
        </div>

        <h1 id="heading">Create Doctor Account</h1>
        <p class="lead">Fill in the details below to register a doctor. Fields marked with * are required.</p>
      </div>

      <!-- FORM (no server action so it's safe to drop into any workflow) -->
      <form id="doctorForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="field">
          <label for="id">Id <span class="req">*</span></label>
          <input id="email" name="id" type="text" placeholder="Enter id:" required>
        </div>
        <div class="field">
          <label for="name">Full Name <span class="req">*</span></label>
          <input id="name" name="name" type="text" placeholder="e.g. Dr. Asha Sharma" required>
        </div>

        <div class="field">
          <label for="age">Age <span class="req">*</span></label>
          <input id="age" name="age" type="number" placeholder="e.g. 42" required>
        </div>

        <div class="field">
          <label for="gender">Gender <span class="req">*</span></label>
          <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female" >Female</option>
          </select>
        </div>

        <div class="field">
          <label for="education">Education <span class="req">*</span></label>
          <input id="education" name="education" type="text" placeholder="MBBS, MD, etc." required>
        </div>

        <div class="field">
          <label for="hid">Hospital ID (HID) <span class="req">*</span></label>
          <input id="hid" name="hid" type="text" placeholder="Hospital ID" required>
        </div>

        <div class="field">
          <div>
  <label>Department</label>
  <select name="department" required>
    <option value="General Medicine">General Medicine</option>
    <option value="Physician">Physician</option>
    <option value="Cardiologist">Cardiologist</option>
    <option value="Neurologist" >Neurologist</option>
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
          <label for="experience">Experience (years) <span class="req">*</span></label>
          <input id="experience" name="exp" type="number"  placeholder="e.g. 8" required>
        </div>

        <div class="field">
          <label for="email">Email <span class="req">*</span></label>
          <input id="email" name="email" type="email" placeholder="doctor@example.com" required>
        </div>
        <div class="field">
          <label for="email">Working hours: <span class="req">*</span></label>
          <input id="email" name="working" type="number" placeholder="doctor@example.com" required>
        </div>
        <div class="field">
          <label for="phone">Phone Number <span class="req">*</span></label>
          <input id="phone" name="phone" type="text" placeholder="+91 9XXXXXXXXX" pattern="[\d+\-\s]+" required>
        </div>

        <div class="field">
          <label for="password">Password <span class="req">*</span></label>
          <input id="password" name="password" type="password"  placeholder="Create password" required>
        </div>

        <div class="field">
          <label for="cpassword">Confirm Password <span class="req">*</span></label>
          <input id="cpassword" name="cpassword" type="password" placeholder="Re-enter password" required>
        </div>

        <div class="full">
          <div style="font-size:13px; color:rgba(255,255,255,0.9); align-self:center;">
            By registering you confirm the information is accurate.
          </div>
          <button class="btn" name="submit" type="submit">Register Doctor</button>
        </div>
      </form>

    </div>
  </div>
</body>
</html>
<?php
    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];
        $education=$_POST['education'];
        $hid=$_POST['hid'];
        $department=$_POST['department'];
        $exp=$_POST['exp'];
        $id=$_POST['id'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $working=$_POST['working'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        if($cpassword!==$password)
        {
            echo "<script>window.alert('Passwords do not match')</script>";
        }
        else
        {
            $sql = "INSERT INTO doctors 
(id, name, gender, education, department, experience, email, phone, password, working, age, hid)
VALUES
('$id', '$name', '$gender', '$education', '$department', '$exp', '$email', '$phone', '$password', '$working', '$age', '$hid')";


            $conn=new mysqli("localhost","root","","health system");
            if($conn->connect_error)
            {
                die("fAILED");
            }
            else
            {
                if($conn->query($sql))
                {
                    echo "<script>window.alert('Registration successful')</script>";
                }
            }
        }
    }

?>


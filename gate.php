<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hospital Manage Doctors</title>

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

.page {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 32px;
}

.card {
  max-width: 950px;
  width: 100%;
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 12px 34px rgba(0,0,0,0.12);
  padding: 35px;
}

h1 {
  font-size: 28px;
  font-weight: 700;
  color: var(--purple);
  margin-bottom: 20px;
  text-align: center;
}

/* 2-Column Hospital Details */
.details {
  display: grid;
  grid-template-columns: 200px 1fr;
  row-gap: 14px;
  margin-bottom: 30px;
  font-size: 16px;
}

.label {
  font-weight: 700;
}

.answer {
  background: rgba(0,0,0,0.06);
  padding: 10px;
  border-radius: 6px;
}

/* Buttons */
.btn-section {
  display: flex;
  gap: 12px;
  justify-content: center;
  margin-bottom: 20px;
}

.btn {
  padding: 12px 18px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: .25s;
}

.add-btn { background: var(--blue); color: #fff; }
.remove-btn { background: red; color: #fff; }

.btn:hover { opacity: .8; }

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  padding: 14px;
  font-size: 15px;
  border-bottom: 1px solid #ddd;
}

th {
  background: var(--purple);
  color: white;
  text-align: left;
}

td {
  background: #fafafa;
}
</style>
</head>

<body>

<div class="page">
  <div class="card">

    <h1>Hospital Panel — Manage Doctors</h1>

    <!-- Hospital Details (2 Columns) -->
    <div class="details">
      <div class="label">Hospital Name:</div>
      <div class="answer">City Care Hospital</div>

      
      
      
    </div>

    <?php
      $conn= new mysqli("localhost","root","","health system");
      if($conn->connect_error)
      {
       die("Connection failed!!!");
      }
      else
      {
        $hn=$_COOKIE["hname"];
        $sql="SELECT * FROM hospitals WHERE hname='$hn'";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
          while ($row=$result->fetch_assoc()) 
          {
            echo "<div class='details'>";
            echo "<div class='label'>Hospital Name:</div>";
            echo "<div class='answer'>".$row['hname']."</div>";
    
            echo "<div class='label'>License Number:</div>";
            echo "<div class='answer'>".$row['lno']."</div>";
    
            echo "<div class='label'>Address:</div>";
            echo "<div class='answer'>".$row['haddress']."</div>";
            echo "</div>";
          }

        }
      }
      $conn->close();
    ?>

    <!-- Buttons -->
    <div class="btn-section">
      <button class="btn add-btn" onclick="addDoctor()">Add Doctor</button>
      <button class="btn remove-btn" onclick="removeDoctor()">Remove Doctor</button>
    </div>

    <!-- Table -->
    <table id="doctorTable">
      <tr>
        <th>Doctor Name</th>
        <th>Department</th>
        <th>Experience</th>
      </tr>
      <tr>
        <td>Dr. John Carter</td>
        <td>Cardiology</td>
        <td>8 Years</td>
      </tr>
    </table>

  </div>
</div>

</body>
</html>

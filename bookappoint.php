<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Book Appointment</title>

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
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container {
  width: 850px;
  background: #fff;
  padding: 35px;
  border-radius: 14px;
  box-shadow: 0 12px 34px rgba(0,0,0,0.12);
}

h1 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
  color: var(--purple);
  font-weight: 800;
}

/* Table Styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  padding: 15px;
  text-align: left;
  font-size: 16px;
}

th {
  background: var(--purple);
  color: #fff;
}

td {
  background: #fafafa;
  border-bottom: 1px solid #ddd;
}

/* Book Button */
.book-btn {
  background: var(--blue);
  color: #fff;
  padding: 10px 14px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: .25s;
}

.book-btn:hover {
  opacity: .85;
}

</style>
</head>

<body>

<div class="container">

  <h1>Book Doctor Appointment</h1>

  <?php
  echo "<table>";
  echo "<tr>";
  echo "<th>Doctor Name</th>";
  echo "<th>Department</th>";
  echo "<th>Education</th>";
  echo "</tr>";
  $conn=new mysqli("localhost","root","","health system");
  if($conn->connect_error)
  {
    die("Connection failed!");
  }
  else
  {
    $lno=$_COOKIE['lno'];
    $sql="SELECT * FROM doctors WHERE lno='$lno'";
    $result=$conn->query($sql);
    if($result->fetch_assoc())
    {
      while($row=$result->fetch_assoc())
      {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['department']."</td>";
        echo "<td>".$row['education']."</td>";
        echo "</tr>";
      }
    }
    echo "</table>";
  }
  $conn->close();
  ?>
  
    
      
     
      
    

    
      
      
      <td><button class="book-btn" onclick="bookDoctor('Dr. John Carter')">Book</button></td>
    </tr>

    <tr>
      <td>Dr. Priya Sharma</td>
      <td>Cardiologist</td>
      <td><button class="book-btn" onclick="bookDoctor('Dr. Priya Sharma')">Book</button></td>
    </tr>

    <tr>
      <td>Dr. Michael Brown</td>
      <td>Orthopedic</td>
      <td><button class="book-btn" onclick="bookDoctor('Dr. Michael Brown')">Book</button></td>
    </tr>

  </table>

</div>

<script>
function bookDoctor(name) {
  alert("Appointment booked with " + name + "! (Demo)");
}
</script>

</body>
</html>

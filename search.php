<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hospitals — Appointment</title>

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
    padding: 35px;
    color: var(--text);
  }

  h2 {
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 25px;
  }

  .search-box {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 25px;
  }

  input {
    padding: 12px;
    border-radius: 6px;
    border: none;
    width: 260px;
    font-size: 15px;
    background: rgba(0,0,0,0.06);
    outline: none;
  }

  input:focus {
    box-shadow: 0 0 0 3px rgba(74,144,226,0.3);
  }

  .btn {
    background: var(--blue);
    padding: 12px 18px;
    color: white;
    font-size: 15px;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    cursor: pointer;
  }

  .btn:hover { background: #3b7acd; }

  .list {
    max-width: 650px;
    margin: auto;
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .item {
    background: white;
    padding: 18px;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .h-details {
    display: flex;
    flex-direction: column;
    gap: 3px;
  }

  .h-name {
    font-size: 18px;
    font-weight: 700;
  }

  .h-address {
    font-size: 14px;
    color: gray;
  }

  .visit-btn {
    background: var(--purple);
    color: white;
    padding: 10px 14px;
    border-radius: 6px;
    border: none;
    font-size: 14px;
    cursor: pointer;
  }

  .visit-btn:hover {
    background: #140c22;
  }

  table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  font-family: "Inter", sans-serif;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

th, td {
  padding: 12px 16px;
  border-bottom: 1px solid #eee;
}

th {
  background: #4a90e2;
  color: #fff;
  font-weight: 600;
  text-align: left;
}

tr:last-child td {
  border-bottom: none;
}

tr:nth-child(even) {
  background: #f8faff;
}

tr:hover {
  background: #eaf1ff;
  cursor: pointer;
}


</style>
</head>

<body>

<h2>Welcome</h2>

<div class="search-box">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <input type="text" name="hospital" id="searchInput" placeholder="Search hospitals...">
  <button class="btn" type="submit" name="submit">Submit</button>
  </form>
</div>

<div class="list" id="hospitalList">

</div>

</body>
</html>
<?php
if(isset($_POST['submit']))
{
  $hospital=$_POST['hospital'];
  $conn=new mysqli("localhost","root","","health system");
  if($conn->connect_error)
  {
    die("Unable to connect!");
    echo "<script>window.alert('Sorry unable to connect')</script>";
  }
  else
  {
    $sql="SELECT * FROM hospitals WHERE hname='$hospital' OR haddress='$hospital' OR lno='$hospital'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      echo "<table>";
      echo "<th>Name</th>";
      echo "<th>Address</th>";
      echo "<th>L_no</th>";
      echo "<th>Take appointment</th>";
      setcookie("hname",$hospital);
      while($row=$result->fetch_assoc())
      {
        echo "<tr>";
        echo "<td>".$row['hname']."</td>";
        echo "<td>".$row['haddress']."</td>";
        echo "<td>".$row['lno']."</td>";
        echo "<td><a href='booking.php'>Brouse</a></td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    else
    {
      echo "<script>window.alert('No Hospital found')</script>";
    }
  }
  $conn->close();
}

?>
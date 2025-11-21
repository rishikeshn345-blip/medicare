<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update Working Time</title>

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
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

.container {
  width: 420px;
  background: #fff;
  padding: 32px;
  border-radius: 14px;
  box-shadow: 0 12px 34px rgba(0,0,0,0.12);
}

h1 {
  text-align: center;
  font-size: 26px;
  font-weight: 800;
  color: var(--purple);
  margin-bottom: 22px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

label {
  font-size: 15px;
  font-weight: 600;
}

input {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 15px;
  outline: none;
}

input:focus {
  border-color: var(--blue);
  box-shadow: 0 0 0 3px rgba(74,144,226,0.25);
}

.btn {
  padding: 14px;
  background: var(--blue);
  color: #fff;
  font-size: 16px;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: .25s;
}

.btn:hover {
  opacity: 0.85;
}

.link {
  display: block;
  margin-top: 10px;
  font-size: 14px;
  text-align: center;
  color: var(--purple);
  text-decoration: none;
  font-weight: 600;
}
</style>
</head>

<body>

<div class="container">
  <h1>Update Working Time</h1>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div>
      <label>Doctor ID</label>
      <input type="text" name="id" id="doctorId" required placeholder="Enter Doctor ID">
    </div>

    <div>
      <label>Doctor Name</label>
      <input type="text" name="name" id="doctorName" required placeholder="Enter Doctor Name">
    </div>

    <div>
      <label>New Working Hours</label>
      <input type="text" name="nw" id="doctorTime" required placeholder="E.g. 10:00 AM - 5:00 PM">
    </div>

    <button type="submit" name="submit" value="submit" class="btn">Update</button>
  </form>

  <a href="hospital-manage-doctors.html" class="link">Back to Hospital Panel</a>
</div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{
  $id=$_POST['id'];
  $name=$_POST['name'];
  $nw=$_POST['nw'];

  $id=filter_var($id,FILTER_SANITIZE_SPECIAL_CHARS);
  $name=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
  $nw=filter_var($nw,FILTER_SANITIZE_SPECIAL_CHARS);

  $conn=new mysqli("localhost","root","","health system");
  if($conn->connect_errno)
  {
    die("Database connection failed");
  }
  else
  {
    $sql="SELECT * FROM doctors WHERE id='$id' AND name='$name'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      $sql="UPDATE TABLE doctors SET working='$nw' WHERE id='$id'";
      if($conn->query($sql))
      {
        echo "<script>window.alert('Updated successfully')</script>";
      }
      else
      {
        echo "<script>window.alert('Unable update')</script>";
      }
    }
    else
    {
      echo "<script>window.alert('Id or Username did not match')</script>";
    }
  }
  $conn->close();
}

?>

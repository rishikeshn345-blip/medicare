<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Delete Doctor</title>

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

.card {
  width: 420px;
  background: white;
  border-radius: 14px;
  padding: 32px;
  box-shadow: 0 12px 34px rgba(0,0,0,0.12);
}

h1 {
  font-size: 26px;
  font-weight: 800;
  color: var(--purple);
  text-align: center;
  margin-bottom: 22px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

label {
  font-weight: 600;
  font-size: 15px;
}

input {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  outline: none;
  font-size: 15px;
}

input:focus {
  border-color: var(--blue);
  box-shadow: 0 0 0 3px rgba(74,144,226,0.25);
}

.btn {
  padding: 14px;
  background: red;
  color: white;
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
  margin-top: 12px;
  font-size: 14px;
  text-align: center;
  display: block;
  text-decoration: none;
  color: var(--purple);
  font-weight: 600;
}
</style>
</head>

<body>

<div class="card">
  <h1>Delete Doctor</h1>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div>
      <label>Doctor ID</label>
      <input type="text" name="id" id="doctorId" required placeholder="Enter Doctor ID">
    </div>

    <div>
      <label>Doctor Name</label>
      <input type="text" name="name" id="doctorName" required placeholder="Enter Doctor Name">
    </div>

    <button type="submit" name="submit" class="btn">Delete Doctor</button>
  </form>

  <a href="gate.php"link">Back to Hospital Panel</a>
</div>
</body>
</html>
<?php 
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $id=$_POST['id'];

  $name=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
  $id=filter_var($id,FILTER_SANITIZE_SPECIAL_CHARS);

  $conn=new mysqli("localhost","root","","health system");
  if($conn->connect_error)
  {
    die("Connection failed");
  }
  else
  {
    $sql="SELECT * FROM doctors WHERE id='$id' AND name='$name'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      $sql="DELETE FROM doctors WHERE id='$id'";
      if($conn->query($sql))
      {
        echo "<script>window.alert('Deleted successfully')</script>";
      }
      else
      {
        echo "<script>window.alert('Unable to delete')</script>";
      }
    }
    else
    {
      echo "<select>window.alert('Id or name is incorrect')</script>";
    }
  }
}

?>
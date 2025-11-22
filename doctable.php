<?php
session_start();

// If doctor not logged in, redirect to login page
if (!isset($_SESSION['doctor']) || !isset($_SESSION['doctor_id'])) {
    header('Location: doctor_login.php');
    exit;
}

$doctorName = $_SESSION['doctor'];
$doctorId = $_SESSION['doctor_id'];

// DB connection (change DB name if different)
$conn = new mysqli("localhost", "root", "", "health system");
if ($conn->connect_error) {
    die("Database connection failed: " . htmlspecialchars($conn->connect_error));
}
$conn->set_charset('utf8mb4');

// Fetch appointments for this doctor (matching by dname). Order by date then time.
$sql = "SELECT id, name, dname, date, `time`, `type` FROM appointments WHERE dname = ? ORDER BY date ASC, `time` ASC";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}
$stmt->bind_param('s', $doctorName);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

$stmt->close();
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Doctor Panel — Appointments</title>

<style>
  :root { --blue:#4a90e2; --purple:#07040e; --blue-light:#e5f0fd; --text:#1a1a2e; }
  body { font-family:"Inter",sans-serif; background:var(--blue-light); margin:0; padding:40px; display:flex; justify-content:center; }
  .container { width:100%; max-width:950px; background:white; border-radius:12px; box-shadow:0 12px 34px rgba(0,0,0,0.12); padding:32px; }
  h1 { text-align:center; background:linear-gradient(135deg,var(--purple),var(--blue)); color:white; padding:16px; border-radius:10px; margin-bottom:18px; }
  .meta { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; gap:12px; }
  .meta .left { font-weight:600; }
  .meta .right a { color:var(--purple); text-decoration:none; font-weight:600; background:#f3f6ff; padding:8px 12px; border-radius:6px; }
  table { width:100%; border-collapse:collapse; font-size:16px; text-align:center; }
  th, td { padding:14px 10px; border-bottom:1px solid #ccc; }
  th { background:var(--blue); color:white; }
  tr:nth-child(even) { background:#f4f8ff; }
  .no-data { text-align:center; padding:24px; color:#666; }
  .action-btn { padding:8px 12px; border-radius:6px; border:none; cursor:pointer; background:var(--purple); color:white; font-weight:600; }
  .logout { background:#fff; border:1px solid #ddd; color:#333; padding:8px 12px; border-radius:6px; text-decoration:none; }
</style>
</head>

<body>

<div class="container">

  <h1>Doctor Appointment Panel</h1>

  <div class="meta">
    <div class="left">
      Logged in as: <strong><?php echo htmlspecialchars($doctorName); ?></strong>
      &nbsp;|&nbsp;
      Doctor ID: <strong><?php echo htmlspecialchars($doctorId); ?></strong>
    </div>
    <div class="right">
      <a class="logout" href="logout.php">Logout</a>
    </div>
  </div>

  <?php if (count($appointments) === 0): ?>
    <div class="no-data">No appointments scheduled.</div>
  <?php else: ?>
    <table>
      <tr>
        <th>Patient Name</th>
        <th>Appointment ID</th>
        <th>Date</th>
        <th>Time</th>
        <th>Type</th>
        <th>Action</th>
      </tr>

      <?php foreach ($appointments as $appt): 
          // format date/time nicely
          $dateDisplay = htmlspecialchars($appt['date']);
          $timeDisplay = htmlspecialchars(date("g:i A", strtotime($appt['time'])));
          // map type integer to label if you want; here we show raw value
          $typeLabel = htmlspecialchars($appt['type']);
      ?>
      <tr>
        <td><?php echo htmlspecialchars($appt['name']); ?></td>
        <td><?php echo htmlspecialchars($appt['id']); ?></td>
        <td><?php echo $dateDisplay; ?></td>
        <td><?php echo $timeDisplay; ?></td>
        <td><?php echo $typeLabel; ?></td>
      </tr>
      <?php endforeach; ?>

    </table>
  <?php endif; ?>

</div>

</body>
</html>

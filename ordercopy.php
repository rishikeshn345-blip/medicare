<html lang="en">
<head>
<meta charset="UTF-8">
<title>Appointment Order Copy</title>

<style>
  body {
    font-family: "Inter", sans-serif;
    background: #f4f6fb;
    padding: 40px;
    display: flex;
    justify-content: center;
  }

  /* A4 size page */
  .document {
    width: 210mm;
    min-height: 297mm;
    padding: 25mm;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 0;
    box-shadow: 0 0 18px rgba(0,0,0,0.15);
  }

  @page {
    size: A4;
    margin: 0;
  }

  /* Remove background & shadows when printing */
  @media print {
    body {
      background: #fff;
      padding: 0;
    }
    .document {
      border: none;
      box-shadow: none;
      width: auto;
      min-height: auto;
    }
  }

  .header {
    text-align: center;
    border-bottom: 3px solid #000;
    padding-bottom: 12px;
    margin-bottom: 18px;
  }

  .header h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 900;
  }
  .header p {
    margin: 4px 0;
    font-size: 14px;
  }

  h2 {
    font-size: 20px;
    text-align: center;
    margin: 16px 0 26px;
    font-weight: 800;
    text-decoration: underline;
  }

  table {
    width: 100%;
    font-size: 16px;
    border-collapse: collapse;
    margin-bottom: 22px;
  }

  td {
    padding: 10px 0;
  }

  .label {
    font-weight: 700;
    width: 220px;
  }

  h3 {
    margin-top: 10px;
    font-size: 18px;
    font-weight: 700;
  }

  .footer {
    margin-top: 46px;
    display: flex;
    justify-content: space-between;
    margin-top: 500px;
  }

  .sign-box {
    text-align: center;
  }

  .sign-line {
    margin-top: 40px;
    width: 200px;
    border-top: 2px solid #000;
    margin-bottom: 8px;
  }
</style>

</head>

<body>

<div class="document">

  <div class="header">
    <h1>City Care Hospital</h1>
    <p>Main Road, Bangalore — 560001</p>
    <p>Phone: +91 99887 66554 | Email: info@citycare.com</p>
  </div>

  <h2>APPOINTMENT ORDER COPY</h2>

  <?php
  /*
    Edited PHP block:
      - Generates 20-min slots grouped in blocks of 4 slots + 10min buffer.
      - Picks earliest available slot for given doctor (by name) and date.
      - Inserts into appointments table (fields: id,name,dname,date,time,type).
      - Uses prepared statements & transaction to reduce races.
      - If form posts 'date' (YYYY-MM-DD) it will use it; otherwise uses today.
      - If your DB name still contains a space, please rename it to health_system.
  */

  // get inputs (sanitize lightly)
  $name  = isset($_POST['name'])  ? trim($_POST['name'])  : 'Unknown Patient';
  $dname = isset($_POST['dname']) ? trim($_POST['dname']) : 'Unknown Doctor';
  $type  = isset($_POST['type'])  ? trim($_POST['type'])  : '';
  $dis   = isset($_POST['dis'])   ? trim($_POST['dis'])   : '';
  // optional posted date in YYYY-MM-DD
  $appt_date = isset($_POST['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['date']) ? $_POST['date'] : date('Y-m-d');

  // defaults for scheduling
  $slot_length = 20; // minutes
  $slots_per_block = 4;
  $buffer_minutes = 10;
  // default doctor work hours (you can change these defaults or add form fields)
  $work_start = '09:00';
  $work_end   = '17:00';

  // DB connection (note: database name uses underscore)
  $conn = new mysqli("localhost", "root", "", "health system");
  if ($conn->connect_error) {
      die('<div style="color:red">Connection failed: ' . htmlspecialchars($conn->connect_error) . '</div>');
  }
  $conn->set_charset('utf8mb4');

  // helper: generate list of candidate slot start times (H:i:s strings) for the date
  function generate_candidate_slots($date, $work_start, $work_end, $slot_length, $slots_per_block, $buffer_minutes) {
      $candidates = [];
      $block_minutes = $slots_per_block * $slot_length + $buffer_minutes; // 4*20 + 10 = 90
      $currentBlock = DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $work_start);
      $workEndDT = DateTime::createFromFormat('Y-m-d H:i', $date . ' ' . $work_end);

      if (!$currentBlock || !$workEndDT) return $candidates;
      if ($currentBlock >= $workEndDT) return $candidates;

      while ($currentBlock < $workEndDT) {
          for ($i = 0; $i < $slots_per_block; $i++) {
              $slotStart = clone $currentBlock;
              if ($i > 0) $slotStart->modify('+' . ($i * $slot_length) . ' minutes');
              $slotEnd = clone $slotStart;
              $slotEnd->modify('+' . $slot_length . ' minutes');
              if ($slotEnd > $workEndDT) {
                  // does not fit fully
                  break 2;
              }
              $candidates[] = $slotStart->format('H:i:s');
          }
          // advance to next block
          $currentBlock->modify('+' . $block_minutes . ' minutes');
      }
      return $candidates;
  }

  // booking procedure: pick earliest candidate not already taken for this doctor+date
  $allocated_time = null;
  $error_message = null;

  // transaction to reduce race conditions
  $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
  try {
      // lock relevant rows to reduce races: select for update all rows for this doctor & date
      // we use dname and date fields as per your schema
      $lockSql = "SELECT id FROM appointments WHERE dname = ? AND date = ? FOR UPDATE";
      $lockStmt = $conn->prepare($lockSql);
      if (!$lockStmt) throw new Exception("Prepare failed: " . $conn->error);
      $lockStmt->bind_param('ss', $dname, $appt_date);
      $lockStmt->execute();
      $lockStmt->store_result();
      $lockStmt->close();

      // get already taken times for this doctor & date
      $taken = [];
      $sel = $conn->prepare("SELECT `time` FROM appointments WHERE dname = ? AND date = ?");
      if (!$sel) throw new Exception("Prepare failed: " . $conn->error);
      $sel->bind_param('ss', $dname, $appt_date);
      $sel->execute();
      $res = $sel->get_result();
      while ($row = $res->fetch_assoc()) {
          // normalize to H:i:s
          $taken[] = date('H:i:s', strtotime($row['time']));
      }
      $sel->close();

      // generate candidate times
      $candidates = generate_candidate_slots($appt_date, $work_start, $work_end, $slot_length, $slots_per_block, $buffer_minutes);

      // find earliest candidate NOT in $taken
      foreach ($candidates as $ct) {
          if (!in_array($ct, $taken)) {
              $allocated_time = $ct;
              break;
          }
      }

      if ($allocated_time === null) {
          // no slot available
          $conn->rollback();
          $error_message = "No available slots for Dr. " . htmlspecialchars($dname) . " on " . htmlspecialchars($appt_date);
      } else {
          // attempt insert with a generated id - your table expects id; if id is auto-increment you can send '' or NULL.
          // To avoid id collisions if id is not auto-increment, try to generate a random id and fallback to NULL (let DB auto-id)
          $rn = rand(1000, 999999);
          // try insert
          $ins = $conn->prepare("INSERT INTO appointments (id, name, dname, date, time, type) VALUES (?, ?, ?, ?, ?, ?)");
          if (!$ins) throw new Exception("Prepare failed: " . $conn->error);
          // bind id as string to allow DB to auto-assign if your schema is auto_increment, we will pass NULL then.
          // However mysqli doesn't accept null for integer bind easily; so we'll try numeric id first.
          $ins->bind_param('isssss', $rn, $name, $dname, $appt_date, $allocated_time, $type);
          if (!$ins->execute()) {
              // if failed because of duplicate id, try letting DB assign id (pass NULL by preparing a different query)
              // attempt fallback without id column (assumes id is AUTO_INCREMENT)
              $ins->close();
              $ins2 = $conn->prepare("INSERT INTO appointments (name, dname, date, time, type) VALUES (?, ?, ?, ?, ?)");
              if (!$ins2) throw new Exception("Fallback prepare failed: " . $conn->error);
              $ins2->bind_param('sssss', $name, $dname, $appt_date, $allocated_time, $type);
              if (!$ins2->execute()) {
                  $ins2->close();
                  throw new Exception("Insert failed: " . $conn->error);
              } else {
                  $appointment_id = $ins2->insert_id;
                  $ins2->close();
              }
          } else {
              $appointment_id = $ins->insert_id ?: $rn;
              $ins->close();
          }

          // commit
          $conn->commit();

          // notify success (will also appear on printed copy)
          echo "<script>window.alert('Appointment request sent. Allotted time: " . htmlspecialchars($allocated_time) . " on " . htmlspecialchars($appt_date) . "');</script>";
      }

  } catch (Exception $e) {
      $conn->rollback();
      $error_message = "Error: " . $e->getMessage();
  }

  // close connection
  $conn->close();
  ?>

  <table>
    <tr>
      <td class="lebal">ID</td>
      <td><?php echo htmlspecialchars($rn)?></td>
    </tr>  

    <tr>
      <td class="label">Patient Name:</td>
      <td><?php echo htmlspecialchars($name); ?></td>
    </tr>

    <tr>
      <td class="label">Doctor Name:</td>
      <td><?php echo htmlspecialchars($dname); ?></td>
    </tr>

    <tr>
      <td class="label">Department:</td>
      <td><?php echo htmlspecialchars($type); ?></td>
    </tr>

    <tr>
      <td class="label">Appointment Date:</td>
      <td><?php echo htmlspecialchars($appt_date); ?></td>
    </tr>

    <tr>
      <td class="label">Allotted Time:</td>
      <td><?php echo $allocated_time ? htmlspecialchars($allocated_time) : '<span style="color:red;">Not allotted</span>'; ?></td>
    </tr>

    <tr>
      <td class="label">Disease / Problem:</td>
      <td><?php echo nl2br(htmlspecialchars($dis)); ?></td>
    </tr>
  </table>
<h3 text-align:left;>description:</h3>
  <div class="footer">
    <div class="sign-box">
      <div class="sign-line"></div>
      <span>Doctor Signature</span>
    </div>

    <div class="sign-box">
      <div class="sign-line"></div>
      <span>Hospital Seal</span>
    </div>
  </div>
  <center>
    <button onclick="window.print()">PRINT</button>
  </center>
</div>
<script>

</script>
</body>
</html>

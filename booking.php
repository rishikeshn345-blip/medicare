<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Appointment — Healthcare</title>

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
    padding: 40px;
    color: var(--text);
  }

  .container {
    max-width: 600px;
    margin: auto;
    background: white;
    padding: 30px 28px;
    border-radius: 12px;
    box-shadow: 0px 8px 28px rgba(0,0,0,0.12);
  }

  h2 {
    text-align: center;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 25px;
  }

  .field {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
  }

  label {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 6px;
  }

  input, select, textarea {
    padding: 12px;
    width: 100%;
    border-radius: 6px;
    border: none;
    font-size: 15px;
    background: rgba(0,0,0,0.06);
    outline: none;
  }

  textarea {
    resize: none;
    height: 90px;
  }

  input:focus, select:focus, textarea:focus {
    box-shadow: 0 0 0 3px rgba(74,144,226,0.3);
  }

  .btn {
    width: 100%;
    padding: 14px;
    border: none;
    background: var(--blue);
    color: #fff;
    font-size: 17px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
    margin-top: 5px;
  }

  .btn:hover {
    background: #3b7acd;
  }
  
  .back {
    display: block;
    text-align: center;
    margin-top: 16px;
    color: var(--purple);
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
  }
</style>

</head>
<body>

<div class="container">

  <h2>Book Appointment</h2>

  <form onsubmit="submitAppointment(event)">
    
    <div class="field">
      <label>Your Name</label>
      <input type="text" placeholder="Enter your name" required>
    </div>

    <div class="field">
      <label>Select Doctor</label>
      <select required>
        <option value="">Choose Doctor</option>
        <option>Dr. James (Cardiology)</option>
        <option>Dr. Smith (Neurology)</option>
        <option>Dr. Priya (General Physician)</option>
      </select>
    </div>

    <div class="field">
      <label>Date</label>
      <input type="date" required>
    </div>

    <div class="field">
      <label>Time</label>
      <input type="time" required>
    </div>

    <div class="field">
      <label>Describe Your Problem</label>
      <textarea placeholder="Example: Fever, headache, body pain..." required></textarea>
    </div>

    <button class="btn" type="submit">Book Appointment</button>

  </form>

  <a href="home.html" class="back">Back to Home</a>

</div>

<script>
function submitAppointment(e){
  e.preventDefault();
  alert("Appointment Booked Successfully (Demo)");
}
</script>

</body>
</html>

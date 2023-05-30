<?php
// Connect to MySQL database
$host = "localhost:3310";
$user = "root";
$password = "Rbj100700";
$dbname = "student";
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Move selected enrollment data to grade7 table and delete from enrollment table
if (isset($_POST["submit"])) {
  if (isset($_POST["selected"])) {
    foreach ($_POST["selected"] as $rfid) {
      $sql = "INSERT INTO grade7 SELECT * FROM enrollment WHERE rfid='$rfid'";
      mysqli_query($conn, $sql);
      $sql = "DELETE FROM enrollment WHERE rfid='$rfid'";
      mysqli_query($conn, $sql);
    }
    echo "Selected records moved to Grade 7";
  } else {
    echo "No records selected";
  }
}

// Retrieve enrollment data from database
$sql = "SELECT * FROM enrollment";
$result = mysqli_query($conn, $sql);

// Generate HTML table to display enrollment data
echo "<!DOCTYPE html>
<html>
  <head>
    <title>Enrollment Queue</title>
    <link rel='stylesheet' type='text/css' href='admin.css' />
  </head>
  <body>
    <div class='topnav'>
      <a class='active' href='#'>Home</a>
      <a href='#'>About</a>
      <a href='#'>Contact</a>
    </div>

    <div class='container'>
      <h2>Enrollment Queue</h2>
      <form action='admin.php' method='POST'>
        <table>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Grade Level</th>
            <th>Address</th>
            <th>Birthday</th>
            <th>Contact</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Select</th>
          </tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
              <td>" . $row["rfid"] . "</td>
              <td>" . $row["name"] . "</td>
              <td>" . $row["grlvl"] . "</td>
              <td>" . $row["address"] . "</td>
              <td>" . $row["birthday"] . "</td>
              <td>" . $row["contact"] . "</td>
              <td>" . $row["gender"] . "</td>
              <td>" . $row["email"] . "</td>
              <td><input type='checkbox' name='selected[]' value='" . $row["rfid"] . "'></td>
          </tr>";
}

echo "</table>
        <input type='submit' name='submit' value='Submit' />
      </form>
    </div>
  </body>
</html>";

// Close database connection
mysqli_close($conn);

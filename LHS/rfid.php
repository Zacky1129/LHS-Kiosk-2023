<?php
// get the RFID value submitted through the form
$rfid = $_POST['rfid'];

// connect to the database (replace with your own database credentials)
$servername = "localhost";
$username = "root";
$password = "Rbj100700";
$dbname = "student";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// search for the RFID value in the different tables
$tables = ['grade7', 'grade8', 'grade9', 'grade10'];
foreach ($tables as $table) {
    $sql = "SELECT * FROM $table WHERE rfid='$rfid'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // the RFID value was found in this table, get the user's name
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];

        // redirect to the welcome page with the user's name as a URL parameter
        header("Location: welcome.php?name=$name");
        exit();
    }
}

// if the RFID value was not found in any of the tables, show an error message
echo "RFID not found";
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>RFID Login</title>
    <link rel="stylesheet" type="text/css" href="sample style.css" />
  </head>
  <body>
    <div class="login-box">
      <h1>Please Scan your RFID</h1>
      <img src="rfid.png" alt="RFID" style="width:100%">
      <form method="POST">
        <input
          type="text"
          name="rfid"
          placeholder="Scan your RFID"
          required
        />
        <input type="submit" name="submit" value="Log In" />
      </form>
    </div>
  </body>
</html>

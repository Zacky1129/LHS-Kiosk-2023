<?php
if (isset($_POST['rfid'])) {

  $servername = "localhost:3310";
  $username = "root";
  $password = "Rbj100700";
  $dbname = "student";

  $dsn = "mysql:host=localhost:3310;dbname=student";

  try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
  }

  // get the form inputs
  $rfid = $_POST['rfid'];
  $grlvl = $_POST['grlvl'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $bio = $_POST['bio'];

  // create a new PDO object to connect to the database
  $pdo = new PDO('mysql:host=localhost:3310;dbname=student', 'root', 'Rbj100700');

  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql_delete = "";
  $sql_insert = "";

  if ($grlvl == "7") {
    $sql_update = "UPDATE enrollment SET name=:name, address=:address, contact=:contact, gender=:gender, email=:email, bio=:bio WHERE rfid=:rfid";
    $sql_insert = "INSERT INTO enrollment (rfid, grlvl, name, address, contact, gender, email, bio) 
           VALUES (:rfid, :grlvl, :name, :address, :contact, :gender, :email, :bio)";
    $sql_delete = "DELETE FROM enrollment WHERE rfid=:rfid";
  } elseif ($grlvl == "8") {
    $sql_update = "UPDATE grade8 SET name=:name, address=:address, contact=:contact, gender=:gender, email=:email, bio=bio WHERE rfid=:rfid";
    $sql_insert = "INSERT INTO grade8 (rfid, grlvl, name, address, contact, gender, email, bio) 
           VALUES (:rfid, :grlvl, :name, :address, :contact, :gender, :email, :bio)";
    $sql_delete = "DELETE FROM grade7 WHERE rfid=:rfid";
  } elseif ($grlvl == "9") {
    $sql_update = "UPDATE grade9 SET name=:name, address=:address, contact=:contact, gender=:gender, email=:email, bio=bio WHERE rfid=:rfid";
    $sql_insert = "INSERT INTO grade9 (rfid, grlvl, name, address, contact, gender, email, bio) 
           VALUES (:rfid, :grlvl, :name, :address, :contact, :gender, :email, :bio)";
    $sql_delete = "DELETE FROM grade8 WHERE rfid=:rfid";
  } elseif ($grlvl == "10") {
    $sql_update = "UPDATE grade10 SET name=:name, address=:address, contact=:contact, gender=:gender, email=:email, bio=bio WHERE rfid=:rfid";
    $sql_insert = "INSERT INTO grade10 (rfid, grlvl, name, address, contact, gender, email, bio) 
           VALUES (:rfid, :grlvl, :name, :address, :contact, :gender, :email, :bio)";
    $sql_delete = "DELETE FROM grade9 WHERE rfid=:rfid";
  } else {
    // handle the case when $grlvl is not equal to any of the specified values
    echo "Invalid grade level.";
    exit();
  }

  // delete the old row with the same RFID value
  $stmt_delete = $pdo->prepare($sql_delete);
  $stmt_delete->execute([':rfid' => $rfid]);

  // prepare and execute the UPDATE statement
  $stmt_update = $pdo->prepare($sql_update);
  $stmt_update->execute([
    ':rfid' => $rfid,
    ':name' => $name,
    ':address' => $address,
    ':contact' => $contact,
    ':gender' => $gender,
    ':email' => $email,
    ':bio' => $bio
  ]);

  // get the number of rows affected by the UPDATE statement
  $count = $stmt_update->rowCount();

  // if no row was updated, execute the INSERT statement to insert a new row
  if ($count == 0) {
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([
      ':rfid' => $rfid,
      ':grlvl' => $grlvl,
      ':name' => $name,
      ':address' => $address,
      ':contact' => $contact,
      ':gender' => $gender,
      ':email' => $email,
      ':bio' => $bio
    ]);
  }

  header("Location: uploaddocs.php");
  exit();
}

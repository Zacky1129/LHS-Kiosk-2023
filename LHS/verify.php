<?php
// Connect to the MySQL database on the main PC
$host = "192.168.0.112";
$username = "root";
$password = "Rbj100700";
$database = "student";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate the form inputs
$rfid = $_POST["rfid"];
$grlvl = $_POST["grlvl"];
$name = $_POST["name"];
$address = $_POST["address"];
$bday = $_POST["bday"];
$contact = $_POST["contact"];
$gender = $_POST["gender"];
$email = $_POST["email"];

// Add your custom validation code here
// ...

// Check if form is submitted
if (isset($_POST['Submit'])) {

    // Get form data
    $rfid = $_POST['rfid'];
    $grlvl = $_POST['grlvl'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $bday = $_POST['bday'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];

    // Perform validation
    $errors = array();

    // Check if RFID is a number
    if (!is_numeric($rfid)) {
        $errors[] = "RFID must be a number";
    }

    // Check if Grade Level is a number
    if (!is_numeric($grlvl)) {
        $errors[] = "Grade Level must be a number";
    }

    // Check if Name is not empty
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Check if Birthday is a valid date
    if (!strtotime($bday)) {
        $errors[] = "Invalid Birthday format. Please use yyyy-mm-dd.";
    }

    // Check if Contact Number is a valid 11-digit number
    if (!preg_match("/^[0-9]{11}$/", $contact)) {
        $errors[] = "Invalid Contact Number. Please use 11-digit format.";
    }

    // Check if Gender is either "Male" or "Female"
    if (!in_array($gender, array("Male", "Female"))) {
        $errors[] = "Invalid Gender. Please use either 'Male' or 'Female'.";
    }

    // Check if Email is a valid email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Address";
    }

    // If there are errors, display them and stop processing
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        exit;
    }

    // If there are no errors, continue processing and insert into database
    // Code to insert into database goes here
}


// If the inputs pass the validation, send them to the main PC for final verification
$url = "http://192.168.0.112/verify.php";
$data = http_build_query(array(
    "rfid" => $rfid,
    "grlvl" => $grlvl,
    "name" => $name,
    "address" => $address,
    "bday" => $bday,
    "contact" => $contact,
    "gender" => $gender,
    "email" => $email
));
$options = array(
    "http" => array(
        "method" => "POST",
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "content" => $data
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Show the result to the user
echo $result;

// Close the database connection
mysqli_close($conn);
?>

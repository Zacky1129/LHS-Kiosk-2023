<?php
// check if the bio value was submitted through the form
if (isset($_POST['bio'])) {
    // get the bio value submitted through the form
    $bio = $_POST['bio'];

    // connect to the database (replace with your own database credentials)
    $servername = "localhost:3310";
    $username = "root";
    $password = "Rbj100700";
    $dbname = "student";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // search for the bio value in the different tables
    $tables = ['enrollment', 'grade7', 'grade8', 'grade9', 'grade10'];
    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table WHERE bio='$bio'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // the bio value was found in this table, get the user's name
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];

            // redirect to the welcome page with the user's name as a URL parameter
            header("Location: dashboard.php?name=$name");
            exit();
        }
    }

    // if the bio value was not found in any of the tables, show an error message
    echo "Biometric not found";
    mysqli_close($conn);
} else {
    // show an error message if the bio value was not submitted through the form
    echo "error";
}

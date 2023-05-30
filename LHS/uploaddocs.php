<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dir_path = 'C:/Users/jekje/Desktop/Document/' . $name . '/';

    // Create directory with the user's name if it doesn't exist
    if (!file_exists($dir_path)) {
        mkdir($dir_path);
    }

    if (!empty($_FILES['bcert']['name'])) {
        $bcert_file = $_FILES['bcert']['name'];
        $bcert_target = $dir_path . basename($bcert_file);
        if (file_exists($bcert_target)) {
            echo "Error: The Bcert file already exists.";
        } else {
            move_uploaded_file($_FILES['bcert']['tmp_name'], $bcert_target);
        }
    }

    if (!empty($_FILES['f138']['name'])) {
        $f138_file = $_FILES['f138']['name'];
        $f138_target = $dir_path . basename($f138_file);
        if (file_exists($f138_target)) {
            echo "Error: The F138 file already exists.";
        } else {
            move_uploaded_file($_FILES['f138']['tmp_name'], $f138_target);
        }
    }

    if (!empty($_FILES['pic']['name'])) {
        $pic_file = $_FILES['pic']['name'];
        $pic_target = $dir_path . basename($pic_file);
        if (file_exists($pic_target)) {
            echo "Error: The picture file already exists.";
        } else {
            move_uploaded_file($_FILES['pic']['tmp_name'], $pic_target);
        }
    }
    // Redirect to dashboard.php
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Documents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 2em;
            margin: 0 0 20px;
        }

        button {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2em;
            margin: 0 10px;
            cursor: pointer;
        }

        #birth-certificate {
            background-color: #008cba;
            color: white;
            border: none;
        }
    </style>
</head>

<body>
    <h1>Upload Documents</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <br><br>
        <label for="bcert">Birth Certificate:</label>
        <input type="file" name="bcert" id="bcert">
        <br><br>
        <label for="f138">Form 138:</label>
        <input type="file" name="f138" id="f138">
        <br><br>
        <label for="pic">Picture:</label>
        <input type="file" name="pic" id="pic">
        <br><br>
        <button type="submit" name="submit">Upload</button>
    </form>
</body>

</html>
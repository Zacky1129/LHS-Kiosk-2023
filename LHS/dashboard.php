<!DOCTYPE html>
<html>

<head>
  <title>LHS Dashboard</title>
  <link rel="stylesheet" type="text/css" href="dashboard.css" />
  <style></style>
</head>

<body style="background-color: grey">
  <div class="sidebar">
    <div class="dropdown">
      <button class="dropbtn"><?php echo $_GET['name']; ?></button>
      <div class="dropdown-content">
        <a href="edit profile.html">Update Profile</a>
        <br />
        <a href="uploaddocs.php">Upload Requirements</a>
        <br />
        <a href="printing.html">Request Document</a>
        <br />
        <a href="page1.html">Logout</a>
      </div>
    </div>
  </div>
  <div class="main">
    <h1 class="h1">
      Welcome to the Lagro High School Student Assistant Kiosk
    </h1>
    <img class="img" src="lhsunif.png" width="1040" height="550" alt="LHS" />
  </div>
</body>

</html>
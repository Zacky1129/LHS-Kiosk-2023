<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    * {
      box-sizing: border-box;
    }

    .row {
      display: flex;
    }

    /* Create two equal columns that sit next to each other */
    .column {
      flex: 50%;
      padding: 5px;
    }

    button {
      background-color: dimgray;
      color: whitesmoke;
      font-family: georgia;
      padding: 14px 20px;
      border: none;
      cursor: pointer;
      width: 90%;
      display: block;
      margin: 10px auto;
    }
  </style>
</head>

<body style="background-color: #04aa6d">
  <div class="welcome-box">
    <h1>Welcome, <?php echo $_GET['name']; ?>!</h1>

    <img src="lhsunif.png" alt="Lagro High School Uniform" />
    <div class="row">
      <div class="column">

        <button onclick="enroll()" type="button" class="magenta">ENROLLMENT</button>
        <script>
          function enroll() {
            window.location.href = "reenroll.html";
          }
        </script>
      </div>

      <div class="column">

        <button type="button" class="magenta">REQUEST DOCUMENT</button>

      </div>
    </div>

</body>

</html>
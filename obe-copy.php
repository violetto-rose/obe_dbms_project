<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>OBE CO-PO Tracker</title>

  <meta name="author" content="violetto-rose" />
  <meta name="description"
    content="A project on OBE (Outcome based education) tracker with Course and Program outcome details along with subject information." />

  <!--Styles-->
  <link rel="stylesheet" href="obe-copy.css" />

  <!--Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
</head>

<!--Body-->

<body>
  <?php

  // Function to add suffix to semester numbers
  function addSuffix($semester)
  {
    switch ($semester) {
      case 3:
        return $semester . 'rd';
      case 4:
        return $semester . 'th';
      case 5:
        return $semester . 'th';
      case 6:
        return $semester . 'th';
      case 7:
        return $semester . 'th';
      case 8:
        return $semester . 'th';
    }
  }

  // Establish a database connection
  $servername = "localhost";
  $username = "root";
  $dbname = "csd";

  $conn = new mysqli($servername, $username, "", $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch data from the database based on the selected scheme and semester
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheme = $_POST["scheme"];
    $semester = $_POST["semester"];
    $sql = "SELECT * FROM csd WHERE scheme_year = $scheme AND semester = $semester";

    echo "<div class='head'>
            <h1>Department of Computer Science and Design</h1>
            <h2>OBE Report of " . addSuffix($semester) . " Semester, $scheme Scheme</h2>
            <br />
            <hr />
          </div>";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
              <tr>
                <th>Serial Number</th>
                <th>Subject Number</th>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Faculty</th>
              </tr>";

      while ($row = $result->fetch_assoc()) {

        echo "<div class='outcomes'>
                <tr>
                  <td>" . $row["serial_number"] . "</td>
                  <td>" . $row["subject_number"] . "</td>
                  <td>" . $row["subject_code"] . "</td>
                  <td>" . $row["subject_name"] . "</td>
                  <td>" . $row["faculty"] . "</td>
                </tr>
              </div>";
      }
      echo "</table>";
    } else {
      echo "<div class='result'>
              <p>NO RESULTS</p>
            </div>";
    }
  }
  $conn->close();
  ?>
  <div class='button'>
    <span class="btn">
      <a href='attainment.xlxs' target="_blank">CO-PO Attainment</a>
</span>
  </div>
  <div class="button-container">
    <a href="main-copy.html" class="home-button">Home</a>
  </div>

</body>

</html>
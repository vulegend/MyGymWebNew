<?php
    session_start();

    if ( isset( $_SESSION['uid'] ) ) {
        // Grab user data from the database using the user_id
        // Let them access the "logged in only" pages
    } else {
        // Redirect them to the login page
        header("Location: /mygym/login.html");
    }

    require('params.php');

    
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($mysqli->connect_error) {
        exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Knjige</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!--   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        

    <!-- Custom styles for this template -->
    <style>
        /* Show it is fixed to the top */
        body {
        min-height: 75rem;
        padding-top: 90px;

        }


    </style>

  </head>

  <body>
  <nav id="nav1" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">MY_GYM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Lista <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add.php">Dodaj Novu</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0" action="logout.php">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
        </form>
      </div>
    </nav>

    <table class="table" id="table1">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Slika</th>
          <th scope="col">Naziv</th>
          <th scope="col">Opis</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>

        <?php 
          $stmt = $mysqli->prepare("SELECT * FROM gym ORDER BY id");
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows === 0) exit('No rows');
          while($row = $result->fetch_assoc()) {
                          
//echo $row['book_id'] . " " . $row['first_name'] . " " . $row['last_name'] . "<br/>";
              echo "<tr>" .
              "<th scope='row' id='" . $row['id'] . "'>" . $row['id'] . "</th>" .
              "<td>" . $row['logo'] . "</td>" .
              "<td>" . $row['name'] . "</td>" .
              "<td>" . $row['description'] . "</td>" .
              "<td>" .
              "<form method='post' action='edit.php'><input type='hidden' name='bookID' value='" . $row['id'] . "'> <button type='Submit'>Izmeni</button></form>" .
              "</td>" .
              "</tr>";
              
          }
          $stmt->close();
      ?>

      </tbody>
    </table>

        
  </body>
</html>

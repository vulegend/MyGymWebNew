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

    $bookID = $_POST['bookID'];

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
    

    <title>Dodaj novu</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        

    <!-- Custom styles for this template -->
    <style>
        /* Show it is fixed to the top */
        body {
        min-height: 75rem;
        padding-top: 4.5rem;
        }

        #formID {
            width : 90%;
            display : inline-block;
            margin-left : 5%;
        }

    </style>

  </head>

  <body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">MY_GYM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Lista <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Dodaj Novu</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0" action="logout.php">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
        </form>
      </div>
    </nav>

<?php

	$firstName;
	$lastName;
	$profileLink;
	$address;
	$note;
	$date;
	$profileTypeIndex = 0;
	$sentIndex = 0;

	$stmt = $mysqli->prepare("SELECT * FROM book WHERE book_id = ?");
	$stmt->bind_param("s", $bookID);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) exit('No rows');
	while($row = $result->fetch_assoc()) {

	$firstName = $row['first_name'];
	$lastName = $row['last_name'];
	$profileLink = $row['profile_link'];
	$address = $row['address'];
	$note = $row['note'];
	$date = $row['date'];
	$profileTypeIndex = $row['profile_type'];
	$sentIndex = $row['sent'];
	  
	}
	$stmt->close();

echo <<<EOL

    <form action="updateBook.php" method="post" role="form">
    <div class="form-group" id="formID">
    	<input type="hidden" name="bookID" value='$bookID' />
        <label for="firstName"><b>Ime</b></label>
        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Unesite ime" value="$firstName">
        <br/>
        <label for="lastName"><b>Prezime</b></label>
        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Unesite prezime" value="$lastName">
        <br/>
        <label for="profileLink"><b>Profil link</b></label>
        <input type="text" class="form-control" id="profileLink" name="profileLink" placeholder="Unesite link profila" value="$profileLink">
        <br/>
        <label for="address"><b>Adresa</b></label>
        <textarea class="form-control" id="address" name="address" rows="3">$address</textarea>
        <br/>
        <label for="profileType"><b>Izvor (izaberite)</b></label>
        <select class="form-control" id="profileType" name="profileType">
            <option>Facebook</option>
            <option>Instagram</option>
            <option>Website</option>
        </select>
        <br/>
        <label for="note"><b>Napomena</b></label>
        <textarea class="form-control" id="note" name="note" rows="3">$note</textarea>
        <br/>
        <label for="sent"><b>Da li je poslato? (izaberite)</b></label>
        <select class="form-control" id="sent" name="sent">
            <option>Poslato</option>
            <option>Nije poslato</option>
        </select>
        <br/>
        <button type="submit" class="btn btn-primary form-control">Izmeni</button>
    </div>
    </form>
    
EOL;

    if($profileTypeIndex == 0)
    	echo "<script>document.getElementById('profileType').selectedIndex = '0'</script>";
    else if($profileTypeIndex == 1)
    	echo "<script>document.getElementById('profileType').selectedIndex = '1'</script>";
    else
    	echo "<script>document.getElementById('profileType').selectedIndex = '2'</script>";

    if($sentIndex == 1)
    	echo "<script>document.getElementById('sent').selectedIndex = '0'</script>";
    else
    	echo "<script>document.getElementById('sent').selectedIndex = '1'</script>";

?>

  </body>
</html>

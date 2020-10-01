<?php
if(isset($_POST["Btn"])) {
    $host = "localhost";
    $user = "nwillems";
    $pass = "nwillems";
    $db = "nwillems";
    
    $mysqli = new mysqli($host, $user, $pass, $db);
    if (mysqli_connect_errno()) {
        die("Unable to connect to database!");
    }
    
    $updateSucceeded = true;
    
    for($i = 0; $i < count($_POST['date']); $i++) {
        $church = trim($_POST['Church']);
        $location = trim($_POST['Location']);
        $numSeats = trim($_POST['numSeats']);
        $Sunday = ($_POST['date'][$i]);
        $time = trim($_POST['DepartureTime']);
        $name= trim($_POST['DriverName']);
        $phone = trim($_POST['DriverPhone']);
        
        $query = $mysqli->prepare("INSERT INTO RIDES (Church, DepartingFrom, NumSeats, AvailableDates, DepartureTime, DriverName, DriverPhone) VALUES (?, ?, ?, ?, ?, ?, ?);");
        $query->bind_param("ssisssi", $church, $location, $numSeats, $Sunday, $time, $name, $phone);
       if ($result = $query->execute()) {
           
       } else {
           $updateSucceeded = false;
       }
    }
    // close connection
    $mysqli->close();
    if($updateSucceeded) {
        echo "Uploaded successfully.";
    } else {
        echo "Upload failed.";
    }
}
?>
<html>
<head>
<title>Register as a Driver</title>

<H1>Register as a Driver</H1>
</head>
<body>
<form action="enterRideInfo.php" method="post">

	Name:<input type="text", name="DriverName"size="10"> <br><br>
	Phone number: <input type="number", name="DriverPhone"size="10"> <br><br>
	Church: <input type="text", name="Church"size="10"> <br><br>
	Number of available seats: <input type="Number", name="numSeats"size="10"> <br><br>
	Time leaving: <input type="time", name="DepartureTime"> <br><br>
	Meeting location: 	<input type="radio" name="Location" value="Mac Circle"> Mac Circle 
						<input type="radio" name="Location" value="Carter Circle">Carter Circle <br>

<?php
$date = new DateTime();
// get the day of the week
$DofW = $date->format('w');
//get the number of days until Sunday
$interval = 7 - $DofW;
$date->add(new DateInterval('P'.$interval.'D'));

echo "<BR>Select available dates below:";
for($i=0; $i < 15; $i++) {
    echo "<BR>";
    echo 
    "<input type=\"checkbox\" id=\"date\" name=\"date[]\" value=\"".$date->format('Y-m-d')."\"> 
    <label for=\"date\">";
    $date->add(new DateInterval('P7D'));
    echo $date->format('Y-m-d');
}

echo "<BR>";
?>
<br>
<input type="submit" name="Btn" value="Submit Info"><br>
</form>

</body>
</html>

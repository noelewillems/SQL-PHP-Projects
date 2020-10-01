<?php

?>
<html>
<head>
<title>Reserve a Ride</title>

<H1>Reserve a Ride</H1>
</head>
<body>
<form action="reserveRide.php" method="post">
	Ride ID of desired ride: <input type="number", name="RideID"size="10"> <br>
	Rider name: <input type = "text", name = "RiderName" size = "10"> <br>
	Rider phone number: <input type = "number", name = "RiderPhone" size = "10"> <br>
	<input type="submit" name="Btn" value="Reserve Ride"><br>
</form>
</body>
</html>
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
        $rideID = trim($_POST['RideID']);
        $riderName = trim($_POST['RiderName']);
        $riderPhone = trim($_POST['RiderPhone']);
        $query = $mysqli->prepare("INSERT INTO RIDERS (Name, RiderPhone, RideID) VALUES (?, ?, ?);");
        $query2 = $mysqli->prepare("UPDATE RIDES SET NumSeats = NumSeats - 1 WHERE RideID = ?;");
        $query->bind_param("ssi", $riderName, $riderPhone, $rideID);
        $query2->bind_param("i", $rideID);
        if ($result = $query->execute() && $result = $query2->execute()) {
            
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
?>
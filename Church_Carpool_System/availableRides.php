
<html>
<head>
<title>Available Rides</title>

<H1>Available Rides</H1>
<H3> Leave blank to view all available rides (present - future).</H3>
</head>
<body>
<form action="availableRides.php" method="post">
	Church:<input type="text", name="Church"size="10"> <br>
	<label for="rideDate">Date needed:</label>
	<input type="date" id="rideDate" name="rideDate"><br>
	<input type="submit" name="Btn" value="View Available Rides"><br>

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
    
    $church = trim($_POST['Church']);
    $Sunday = trim($_POST['rideDate']);
    $hasChurch = strlen($church) > 0;
    
    if($hasChurch && (empty($Sunday))) {
        $query = $mysqli->prepare("SELECT * FROM RIDES WHERE Church = ?");
        $query -> bind_param("s", $church);
       if ($query->execute()) {
           $result = $query->get_result();
            if ($result->num_rows > 0) {
                echo "<table cellpadding=9 style=\"border:3px dotted #564256;border-spacing:2px;margin-left:auto;margin-right:auto;\">";
                echo "<tr>";
                echo "<th>Ride ID</th>";
                echo "<th>Church</th>";
                echo "<th>Departing From</th>";
                echo "<th>Seats</th>";
                echo "<th>Date</th>";
                echo "<th>Departure Time</th>";
                echo "<th>Driver Name</th>";
                echo "<th>Driver Phone</th>";
                echo "</tr>";
                while($data = $result->fetch_assoc()) {
                    // I received assistance from Caleb Hummel in understanding how the indices of the array work.
                    echo "<tr>";
                    echo "<td>".$data["RideID"]."</td>";
                    echo "<td>".$data["Church"]."</td>";
                    echo "<td>".$data["DepartingFrom"]."</td>";
                    echo "<td>".$data["NumSeats"]."</td>";
                    echo "<td>".$data["AvailableDates"]."</td>";
                    echo "<td>".$data["DepartureTime"]."</td>";
                    echo "<td>".$data["DriverName"]."</td>";
                    echo "<td>".$data["DriverPhone"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
       }
    } else if($hasChurch && !(empty($Sunday))) {
        $query = $mysqli->prepare("SELECT * FROM RIDES WHERE Church = ? AND AvailableDates = ?");
        $query -> bind_param("ss", $church, $Sunday);
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                echo "<table cellpadding=9 style=\"border:3px dotted #564256;border-spacing:2px;margin-left:auto;margin-right:auto;\">";
                echo "<tr>";
                echo "<th>Ride ID</th>";
                echo "<th>Church</th>";
                echo "<th>Departing From</th>";
                echo "<th>Seats</th>";
                echo "<th>Date</th>";
                echo "<th>Departure Time</th>";
                echo "<th>Driver Name</th>";
                echo "<th>Driver Phone</th>";
                echo "</tr>";
                while($data = $result->fetch_assoc()) {
                    // I received assistance from Caleb Hummel in understanding how the indices of the array work.
                    echo "<tr>";
                    echo "<td>".$data["RideID"]."</td>";
                    echo "<td>".$data["Church"]."</td>";
                    echo "<td>".$data["DepartingFrom"]."</td>";
                    echo "<td>".$data["NumSeats"]."</td>";
                    echo "<td>".$data["AvailableDates"]."</td>";
                    echo "<td>".$data["DepartureTime"]."</td>";
                    echo "<td>".$data["DriverName"]."</td>";
                    echo "<td>".$data["DriverPhone"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    } else if(empty($Sunday) && !$hasChurch) {
        $query = $mysqli->prepare("SELECT * FROM RIDES");
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                echo "<table cellpadding=9 style=\"border:3px dotted #564256;border-spacing:2px;margin-left:auto;margin-right:auto;\">";
                echo "<tr>";
                echo "<th>Ride ID</th>";
                echo "<th>Church</th>";
                echo "<th>Departing From</th>";
                echo "<th>Seats</th>";
                echo "<th>Date</th>";
                echo "<th>Departure Time</th>";
                echo "<th>Driver Name</th>";
                echo "<th>Driver Phone</th>";
                echo "</tr>";
                while($data = $result->fetch_assoc()) {
                    // I received assistance from Caleb Hummel in understanding how the indices of the array work.
                    echo "<tr>";
                    echo "<td>".$data["RideID"]."</td>";
                    echo "<td>".$data["Church"]."</td>";
                    echo "<td>".$data["DepartingFrom"]."</td>";
                    echo "<td>".$data["NumSeats"]."</td>";
                    echo "<td>".$data["AvailableDates"]."</td>";
                    echo "<td>".$data["DepartureTime"]."</td>";
                    echo "<td>".$data["DriverName"]."</td>";
                    echo "<td>".$data["DriverPhone"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    } else if(!$hasChurch && !(empty($Sunday))) {
        $query = $mysqli->prepare("SELECT * FROM RIDES WHERE AvailableDates = ?");
        $query -> bind_param("s", $Sunday);
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                echo "<table cellpadding=9 style=\"border:3px dotted #564256;border-spacing:2px;margin-left:auto;margin-right:auto;\">";
                echo "<tr>";
                echo "<th>Ride ID</th>";
                echo "<th>Church</th>";
                echo "<th>Departing From</th>";
                echo "<th>Seats</th>";
                echo "<th>Date</th>";
                echo "<th>Departure Time</th>";
                echo "<th>Driver Name</th>";
                echo "<th>Driver Phone</th>";
                echo "</tr>";
                while($data = $result->fetch_assoc()) {
                    // I received assistance from Caleb Hummel in understanding how the indices of the array work.
                    echo "<tr>";
                    echo "<td>".$data["RideID"]."</td>";
                    echo "<td>".$data["Church"]."</td>";
                    echo "<td>".$data["DepartingFrom"]."</td>";
                    echo "<td>".$data["NumSeats"]."</td>";
                    echo "<td>".$data["AvailableDates"]."</td>";
                    echo "<td>".$data["DepartureTime"]."</td>";
                    echo "<td>".$data["DriverName"]."</td>";
                    echo "<td>".$data["DriverPhone"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    }
    $mysqli->close();
}
    
?>
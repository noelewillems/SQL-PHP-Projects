<?php

?>
<html>
<head>
<title>Driver Report</title>

<H1>Driver Report</H1>
</head>
<body>
<form action="driverReport.php" method="post">
	Driver Name: <input type="text", name="DriverName"size="10"> <br>
	<input type="submit" name="Btn" value="View Driver Report"><br>
	
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
        
        $driverName = trim($_POST['DriverName']);
        $query = $mysqli->prepare("SELECT * FROM RIDES WHERE DriverName = ?");
        $query -> bind_param("s", $driverName);
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
    

?>
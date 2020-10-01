
<html>
<head>
<title>Nations and Symbols</title>
</head>
<body>
//echo print_r($_POST);
<form  action="addNationSymbol.php" method="post">
<?php

if(isset($_POST["Btn"])) {
    echo "issset";
    $host = "localhost";
    $user = "nwillems";
    $pass = "Jasper*130";
    $db = "nwillems";

    // create mysqli object
    // open connection
    $mysqli = new mysqli($host, $user, $pass, $db);

    // check for connection errors
    if (mysqli_connect_errno()) {
        die("Unable to connect!!");
    }

    // create query
    //echo print_r($_POST);
    $country = trim($_POST['country']);
    $symbol = trim($_POST['symbol']);
    $hasCountry = strlen($country) > 0;
    $hasSymbol = strlen($symbol) > 0;

    if($hasCountry && $hasSymbol) {
        $query = $mysqli->prepare("INSERT INTO SYMBOLS (country, animal) VALUES (?,?);");
        $query->bind_param("ss", $country, $symbol);
        // execute query
        //echo "<br>".$query."<br>";
        if ($result = $query->execute()) {
            echo "update succeded";
        } else {
            echo "update failed";
        }
        // close connection
        $mysqli->close();

    } else {
         die("<br><h1>Must have country and symbol</h1><br>");
    }
    
    echo "<table cellpadding=10 border=1>";
    echo "<tr>";
    echo "<th>Country</th>";
    echo "<th>Symbol</th>";
    echo "</tr>";
    Header("Location: addNationSymbol.php");
} else {
?>
    <H1>Add Nations and Symbols</H1>
    <H2>Add a nation and symbol</H2>
    <form action="addNationSymbol.php" method="post">

    Nation: <input type="text" name="country" size="30"><br>
    Symbol: <input type="text" name="symbol" size="30"><br>

    <input type="submit" name='Btn' value="Send">

    </form>

    <?php
    $host = "localhost";
    $user = "nwillems";
    $pass = "Jasper*130";
    $db = "nwillems";

    // create mysqli object
    // open connection
    $mysqli = new mysqli($host, $user, $pass, $db);

    // check for connection errors
    if (mysqli_connect_errno()) {
        die("Unable to connect!!!");
    }

    $query = "SELECT * FROM SYMBOLS;";
    // execute query
    //echo "<br>".$query."<br>";
    if ($result = $mysqli->query($query)) {
        // see if any rows were returned
        if ($result->num_rows > 0) {
            // yes
            // print them one after another
            echo "<table cellpadding=10 border=1>";
            while($row = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[2]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else {
            // no
            // print status message
            echo "No rows found!";
        }

        // free result set memory
        $result->close();
    }
}
?>
</body>
</html>
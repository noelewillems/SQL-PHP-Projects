<?php
session_start();
if(!isset($_POST["Btn"])) {

?>
<html>
<body background="https://i.pinimg.com/originals/e2/2d/0c/e22d0c9e7dd9f758a7a7deff5549a215.jpg">
<head>
<style>
body {background-color: #E4DFDA;}
h1   {color: #564256;}
p    {color: red;}
</style>
<title>Phone Book</title>

</head>
<body>
	<img src="http://clipart-library.com/images/8iAbG5x5T.gif" align = right>
	<H1>Phone Book</H1>

	<form action="PhoneForm.php" method="post">
<?php
// you probably want to pull cur_name out of $_SESSION but its up to you, for this starting point I just set it to empty string
$cur_name = "";
echo 'Name: <input type="text", name="ServiceName", value="'.$cur_name.'", size="15">';
?>

<input type="submit" name="Btn" value="Add Name"> 
<input type="submit" name="Btn"value="Delete Name"> <BR> 
Update Name To: <input type="text", name="UpdatedName"size="10"> 
<input type="submit" name="Btn"value="Update Name"> <BR>

Phone: <input type="text" , name="phone"size="10"> 
<input type="radio" name="phonetype" value="other" CHECKED>Other
<input type="radio" name="phonetype" value="home">Home <input
type="radio" name="phonetype" value="work">Work <input type="radio"
name="phonetype" value="cell">Cell <input type="radio"
name="phonetype" value="fax">Fax <BR> <input type="submit" name="Btn"
value="Add Phone"> 
<input type="submit" name="Btn" value="Delete Phone">
</form>
<?php
// set server access variables
$host = "localhost";
$user = "nwillems";
$pass = "nwillems";
$db = "nwillems";

$mysqli = new mysqli($host, $user, $pass, $db);
if (mysqli_connect_errno()) {
    die("Unable to connect to database!");
}
$query = 'SELECT USER_PHONEBOOK.Name, PHONE_PHONEBOOK.PhoneNumber, PHONE_PHONEBOOK.PhoneType
FROM USER_PHONEBOOK, PHONE_PHONEBOOK
WHERE USER_PHONEBOOK.UserID = PHONE_PHONEBOOK.UserID
ORDER BY USER_PHONEBOOK.Name DESC;';
if ($result = $mysqli->query($query)) {
    // see if any rows were returned
    if ($result->num_rows > 0) {
        echo "<table style=\"border:3px dotted #564256;padding:2px;border-spacing:20px;margin-left:auto;margin-right:auto;\">";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Phone Type</th>";
        echo "</tr>";
        while($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td>".$row[0]."</td>";
            echo "<td>".$row[1]."</td>";
            echo "<td>".$row[2]."</td>";
            echo "</tr>";
        }
    }

    echo "</table>";
}

$name = trim($_POST['name']);
echo $name;
$phone = trim($_POST['phone']);
$phoneType = trim($_POST['phoneType']);
$hasName = strlen($name) > 0;
$hasPhone = strlen($phone) > 0;

echo '</textarea>';
?>

<?php
} else {
    $host = "localhost";
    $user = "nwillems";
    $pass = "Jasper*130";
    $db = "nwillems";
    $mysqli = new mysqli($host, $user, $pass, $db);
    if (mysqli_connect_errno()) {
        die("Unable to connect to database!");
    }
    switch($_POST['Btn']) {
        case 'Add Name':
            $query = "INSERT INTO USER_PHONEBOOK (Name) VALUES (\"".$_POST['ServiceName']."\");";
            $mysqli->query($query);
            $query = "INSERT INTO PHONE_PHONEBOOK VALUES ((SELECT USER_PHONEBOOK.UserID FROM USER_PHONEBOOK WHERE USER_PHONEBOOK.Name = \"".$_POST['ServiceName']."\" LIMIT 1), \"N/A\", \"N/A\");";
            $mysqli->query($query);
            break;
        case 'Update Name':
            $query = "UPDATE USER_PHONEBOOK SET Name = \"".$_POST['UpdatedName']."\" WHERE Name = \"".$_POST['ServiceName']."\";";
            $mysqli->query($query);
            break;
        case 'Delete Name':
            $query = "DELETE FROM USER_PHONEBOOK WHERE Name LIKE \"".$_POST['ServiceName']."\";";
            $mysqli-> query($query);
            break;
        case 'Add Phone':
            $query = "DELETE FROM PHONE_PHONEBOOK WHERE PhoneNumber = \"N/A\" AND UserID = (SELECT USER_PHONEBOOK.UserID FROM USER_PHONEBOOK WHERE USER_PHONEBOOK.Name = \"".$_POST['ServiceName']."\" LIMIT 1);";
            echo $query;
            $mysqli->query($query);
            $query = "INSERT INTO PHONE_PHONEBOOK VALUES ((SELECT USER_PHONEBOOK.UserID FROM USER_PHONEBOOK WHERE USER_PHONEBOOK.Name LIKE \"%".$_POST['ServiceName']."%\"), \"".$_POST['phone']."\",\"".$_POST['phonetype']."\");";       
            $mysqli-> query($query);
            break;
        case 'Delete Phone':
            $query = "DELETE FROM PHONE_PHONEBOOK WHERE PhoneNumber = \"".$_POST['phone']."\";";
            $mysqli->query($query);
            break;
    }
    header('Location: PhoneForm.php');
}
?>
</body>
</html>
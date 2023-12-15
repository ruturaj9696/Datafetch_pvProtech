<?php
// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "new_schema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_serial_number'])) {
    $serial_number = $_POST['serial_number'];
    
    // Query to fetch fields based on the provided serial number
    $sql = "SELECT `Sr.No.`, `Date`, `Power Generation at 12:00pm`, `Power Generation at 12:00pm`, `Submitted by`, `Remark`, `EPI` FROM book1 WHERE `Sr.No.` = '$serial_number'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Serial Number: " . $row["Sr.No."] . "<br>";
            echo "Date: " . $row["Date"] . "<br>";
            echo "Power Generation at 12:00pm: " . $row["Power Generation at 12:00pm"] . "<br>";
            echo "Submitted by: " . $row["Submitted by"] . "<br>";
            echo "Remark: " . $row["Remark"] . "<br>";
            echo "EPI: " . $row["EPI"] . "<br>";
        }
    } else {
        echo "No results found for the provided serial number.";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Serial Number</title>
</head>
<body>
    <h2>Search Serial Number</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Serial Number: <input type="text" name="serial_number">
        <input type="submit" name="search_serial_number" value="Search">
    </form>
</body>
</html>

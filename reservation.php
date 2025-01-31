
<?php

$servername = "localhost"; 
$username = "root";       
$password = "";            
$dbname = "reservation_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $persons = (int) filter_var($_POST['person'], FILTER_SANITIZE_NUMBER_INT);
    $reservation_date = $_POST['reservation-date'];
    $reservation_time = $_POST['reservation-time'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO reservations (name, phone, persons, reservation_date, reservation_time, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $name, $phone, $persons, $reservation_date, $reservation_time, $message);

    if ($stmt->execute()) {
        echo "Reservation successfully booked!";
    } else {
        echo "Error: " . $stmt->error;
    }

  
    $stmt->close();
    $conn->close();
}
?>
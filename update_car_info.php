<?php
// Connect to the database (you can use your own database connection code)
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the car ID and updated values from the form
    $car_id = $_POST['car_id'];
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_number = $_POST['vehicle_number'];
    $seating_capacity = $_POST['seating_capacity'];
    $rent_per_day = $_POST['rent_per_day'];

    // Update the car information in the database
    $sql = "UPDATE cars SET vehicle_model = '$vehicle_model', vehicle_number = '$vehicle_number', seating_capacity = '$seating_capacity', rent_per_day = '$rent_per_day' WHERE id = $car_id";
    
    if ($mysqli->query($sql) === TRUE) {
        // echo"secucces";
        header("Location: index.php");
            // exit();

    } else {
        echo '<p>Error updating car information: ' . $mysqli->error . '</p>';
        header("Location: index.php");
    }

    // Close the database connection
    $mysqli->close();
}
?>

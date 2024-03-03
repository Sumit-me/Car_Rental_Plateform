<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the user is logged in as an agency
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'agency') {
        // Redirect to a permission-denied page or the login page
        // echo'please loggin';
        header("Location: login.php");
        exit();
    }

    // Retrieve form data
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_number = $_POST['vehicle_number'];

    // Check if a car with the same details already exists
    require_once 'dbconnect.php';

    $sql = "SELECT id FROM cars WHERE vehicle_model = ? AND vehicle_number = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $vehicle_model, $vehicle_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Car with the same details already exists, handle accordingly (e.g., show an error message)
        echo "Error: A car with the same details already exists.";
        $stmt->close();
        $mysqli->close();
    } else {
        // Car with the same details does not exist, proceed to insert the new car
        $stmt->close();

        $seating_capacity = $_POST['seating_capacity'];
        $rent_per_day = $_POST['rent_per_day'];
        $agency_id = $_SESSION['user_id'];

        // Insert the new car into the database
        $sql = "INSERT INTO cars (vehicle_model, vehicle_number, seating_capacity, rent_per_day, agency_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssidi", $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $agency_id);

        if ($stmt->execute()) {
            // Car added successfully, redirect to a confirmation page or the dashboard
            header("Location: index.php");
            exit();
        } else {
            // Handle database insertion error
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>

<?php
session_start();

// Include your database connection code here (replace 'include_db.php' with your actual database connection script)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in as a customer
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'customer') {
        // Redirect to a permission-denied page or the login page
        // echo'please login';
        header("Location: index.php");
        exit();
    }

    // Retrieve form data
    $car_id = $_POST['car_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $rental_days = $_POST['rental_days'];

    // Validate user input (e.g., date format, date range, etc.)
    $errors = array();

    // Perform additional validation as needed

    if (empty($errors)) {
        // Retrieve the daily rate for the selected car from the database
        require_once 'dbconnect.php';

        $sql = "SELECT rent_per_day FROM cars WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $daily_rate = $row['rent_per_day'];

            // Calculate the total cost based on the daily rate and rental days
            $total_cost = $daily_rate * $rental_days;

            // Insert the booking into the database (assuming you have the code for this)
            require_once 'dbconnect.php';
            
            $customer_id = $_SESSION['user_id']; // Get the customer's user ID from the session

            $sql = "INSERT INTO bookings (customer_id, car_id, start_date, end_date, total_cost) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iissd", $customer_id, $car_id, $start_date, $end_date, $total_cost);

            if ($stmt->execute()) {
                // Booking successful, redirect to a confirmation page or the dashboard
                header("Location: index.php");
                exit();
            } else {
                // Handle database insertion error
                echo "Error: " . $stmt->error;
            }

            // $stmt->close();
            // $mysqli->close();
            // Redirect to a confirmation page or the dashboard
            // header("Location: index.php");
            // exit();
        } else {
            // Handle car not found error
            echo "Error: Car not found.";
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Car</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php";?>
    <?php 
    if (!isset($_SESSION['user_id'])) {
            // Redirect to a permission-denied page or the login page
            // echo'please login';
            header("Location: login.php");
            exit();
        }
        ?>
    <!-- <h1>Book a Car</h1> -->

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- <form method="POST" action="book_car.php"> -->
    <!-- Hidden field to store the car_id -->
    <!-- <input type="hidden" name="car_id" value="<?php echo $_GET['id']; ?>"> -->

    <!-- <label for="start_date">Start Date:</label> -->
    <!-- <input type="date" name="start_date" required> -->

    <!-- <label for="end_date">End Date:</label>
    <input type="date" name="end_date" required>

    <label for="rental_days">Number of Rental Days:</label>
    <input type="number" name="rental_days" required> -->

    <div id="forgetpassModel" tabindex="-1" aria-labelledby="forgetpassLabel">
                    <div class="modal-dialog">
                        <div class="modal-content body-form">
                            <div class="form-card">
                                <div class="form-card-image">
                                    <h2 class="form-card-heading">
                                        Get started
                                        <small>Let us Book The Car</small>
                                    </h2>
                                </div>
                                <!-- <p> &nbsp;</p> -->
                                <form class="form-card-form" method="POST" action="book_car.php" name="update">
                                    <input type="hidden" name="action" value="update" />
                                    <input type="hidden" name="car_id" value="<?php echo $_GET['id']; ?>">
                                        <div class="form-input">
                                            <input type="date" name="start_date"class="form-input-field" required />
                                            <label for="start_date" class="form-input-label">Start Date</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="date" name="end_date" class="form-input-field" required />
                                            <label for="end_date" class="form-input-label">End Date</label>
                                        </div>  
                                        <div class="form-input">
                                            <input minlength = "1" type="number" name="rental_days"  class="form-input-field" required />
                                            <label for="rental_days" class="form-input-label">Number of Rental Days</label>
                                        </div>  
                                        
                                        <div class="form-action">
                                        <input type="hidden" name="username1" value="<?php echo $username;?>"/>
                                            <button type="submit" value="Reset Password" class="form-action-button">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    <button type="submit">Book</button>
</form>

</body>
</html>
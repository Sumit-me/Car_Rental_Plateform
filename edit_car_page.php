<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Information</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php";?>
    <?php
    // Check if a car ID is provided in the query string
    if (isset($_GET['id'])) {
        // Connect to the database (you can use your own database connection code)
        include "dbconnect.php";

        // Get the car ID from the query string
        $car_id = $_GET['id'];

        // Fetch the car details from the database
        $sql = "SELECT * FROM cars WHERE id = $car_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $car = $result->fetch_assoc();
            ?>
            


            <div id="forgetpassModel" tabindex="-1" aria-labelledby="forgetpassLabel">
                <div class="modal-dialog">
                    <div class="modal-content body-form">
                        <div class="form-card">
                            <div class="form-card-image">
                                <h2 class="form-card-heading">
                                    Get started
                                    <small>Let us Edit Car info</small>
                                </h2>
                            </div>
                            <!-- <p> &nbsp;</p> -->
                            <form class="form-card-form" method="POST" action="update_car_info.php" name="update">
                                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>" />
                                    <div class="form-input">
                                        <input minlength = "4" type="text" name="vehicle_model" maxlength="15"   value="<?php echo $car['vehicle_model']; ?>" class="form-input-field" required />
                                        <label for="vehicle_model" class="form-input-label">Enter Vehicle model</label>
                                    </div>
                                    <div class="form-input">
                                        <input minlength = "8" type="text" name="vehicle_number" maxlength="15" value="<?php echo $car['vehicle_number']; ?>" class="form-input-field" required />
                                        <label for="vehicle_number" class="form-input-label">Enter Vehicle number</label>
                                    </div>  
                                    <div class="form-input">
                                        <input minlength = "8" type="number" name="seating_capacity"  value="<?php echo $car['seating_capacity']; ?>" class="form-input-field" required />
                                        <label for="seating_capacity" class="form-input-label">Enter seating capacity</label>
                                    </div>  
                                    <div class="form-input">
                                        <input minlength = "2" type="number" name="rent_per_day"  step="0.01" value="<?php echo $car['rent_per_day']; ?>" class="form-input-field" required />
                                        <label for="rent_per_day" class="form-input-label">Enter Rent Per Day</label>
                                    </div>
                                    <!-- <input type="hidden" name="email" value=""/> -->
                                    <div class="form-action">
                                        <input type="hidden" name="username1" value=""/>
                                        <button type="submit" value="Submit" class="form-action-button">Update info</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo '<p>Car not found.</p>';
        }

        // Close the database connection
        $mysqli->close();
    } else {
        echo '<p>Car ID not provided.</p>';
    }
    ?>
    <?php include "footer.php";?>
</body>
</html>

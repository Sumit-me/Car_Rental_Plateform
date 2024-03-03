<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php";?>
    <!-- <h1>Add New Car</h1> -->

    <!-- <form method="POST" action="process_add_car.php">
        <label for="vehicle_model">Vehicle Model:</label>
        <input type="text" name="vehicle_model" required>

        <label for="vehicle_number">Vehicle Number:</label>
        <input type="text" name="vehicle_number" required>

        <label for="seating_capacity">Seating Capacity:</label>
        <input type="number" name="seating_capacity" required>

        <label for="rent_per_day">Rent Per Day:</label>
        <input type="number" step="0.01" name="rent_per_day" required>

        <button type="submit">Add Car</button>
    </form> -->
    <?php
    // session_start();
    if (!isset($_SESSION['user_id'])) {
            // Redirect to a permission-denied page or the login page
            // echo'please login';
            header("Location: login.php");
            exit();
        }
        // session_abort();
        ?>
        
    <div id="forgetpassModel" tabindex="-1" aria-labelledby="forgetpassLabel">
        <div class="modal-dialog">
            <div class="modal-content body-form">
                <div class="form-card">
                    <div class="form-card-image">
                        <h2 class="form-card-heading">
                            Get started
                            <small>Let us Add New Car</small>
                        </h2>
                    </div>
                    <!-- <p> &nbsp;</p> -->
                    <form class="form-card-form" method="POST" action="process_add_car.php" name="update">
                        <input type="hidden" name="action" value="update" />
                            <div class="form-input">
                                <input minlength = "4" type="text" name="vehicle_model" maxlength="15" class="form-input-field" required />
                                <label for="vehicle_model" class="form-input-label">Enter Vehicle model</label>
                            </div>
                            <div class="form-input">
                                <input minlength = "8" type="text" name="vehicle_number" maxlength="15" class="form-input-field" required />
                                <label for="vehicle_number" class="form-input-label">Enter Vehicle number</label>
                            </div>  
                            <div class="form-input">
                                <input minlength = "8" type="number" name="seating_capacity"  class="form-input-field" required />
                                <label for="seating_capacity" class="form-input-label">Enter seating capacity</label>
                            </div>  
                            <div class="form-input">
                                <input minlength = "2" type="number" name="rent_per_day"  step="0.01" class="form-input-field" required />
                                <label for="rent_per_day" class="form-input-label">Enter Rent Per Day</label>
                            </div>
                            <!-- <input type="hidden" name="email" value=""/> -->
                            <div class="form-action">
                                <input type="hidden" name="username1" value=""/>
                                <button type="submit" value="Submit" class="form-action-button">Add New Car</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>
</body>
</html>

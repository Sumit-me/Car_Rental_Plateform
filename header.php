<?php
echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Car Rental</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="add_car.php">Add Car</a>
                    </li>';
                        session_start();
                        if (isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "agency") {
                            echo'<li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="show_booking.php">Show_Booking</a>
                            </li>';
                        }
                    
                echo'</ul>
                <div class="mr-5">';
                    if (isset($_SESSION["user_id"])) {
                        // User is logged in, display "Logout" button
                        echo'<button class="btn btn-outline-success "><a class="nav-link" href="logout.php"
                        style=" color: white;">log out</a></button>';
                    } else {
                      
                        echo'<button class="btn btn-outline-success "><a class="nav-link" href="login.php"
                        style=" color: white;">login</a></button>
                <button class="btn btn-outline-success"><a class="nav-link" href="signup.php"
                        style=" color: white;">Ragister</a></button>';
                        }
                echo'</div>

            </div>
    </nav>';
?>
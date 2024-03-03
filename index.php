<?php include "dbconnect.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <!-- <style>
        .carousel {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
        }
        
        .carousel-item {
            flex: 0 0 auto;
            width: 18rem;
            margin-right: 10px;
        }
    </style> -->
</head>

<body>

    <?php include "header.php";?>
    <p> &nbsp;</p>
    <h1 style="text-align:center; font-family: monospace">Welcome to the Car Rental Dashboard</h1>

    <h2>Available Cars</h2>
    <?php include "available_car1.php";?>
    
    <!-- ---------------------------------------------------------------------------------- -->
    <!-- <header>
        <h1>Welcome to the Car Rental Dashboard</h1>
    </header> -->

    <!-- Navigation -->
    <?php
        // session_start();

        // Check if the user is logged in
        // if (isset($_SESSION['user_id'])) {
            // User is logged in, display "Logout" button
            // echo '<a href="logout.php">Logout</a>';
        // } else {
            // User is not logged in, display "Login" and "Register" buttons
            // echo '
            //     <nav>
            //         <ul>
            //             <li><a href="signup.php">Register</a></li>
            //             <li><a href="login.php">Login</a></li>
            //             <!-- Add more navigation items as needed -->
            //         </ul>
            //     </nav>';
            // }
    ?>
    <!-- <a href="add_car.php">add car</a> -->
    <!-- Main Content -->

    <main>
        <!-- <h2>Available Cars</h2> -->

        <?php
        
        // if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'agency') {
        //         // Include the "Bookings" section
        //         echo '<a href="show_booking.php">show booking</a>';
        //     }
            // include "available_car.php";
        ?>
    </main>

    <!-- <footer>
        <p>&copy; 2023 Car Rental Dashboard</p>
    </footer> -->
    <?php include "footer.php";?>
    <script src="script.js"></script>
</body>

</html>
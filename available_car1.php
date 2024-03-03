<?php
    $sql = "SELECT * FROM cars";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo'
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">Car model: ' . $row['vehicle_model'] . '</p>
                        <p class="card-text">Car Number: ' . $row['vehicle_number'] . '</p>
                        <p class="card-text">Seating Capacity: ' . $row['seating_capacity'] . '</p>
                        <p class="card-text">Rent Per Day Book: ' . $row['rent_per_day'] . '</p>
                        <a href="book_car.php?id=' . $row['id'] . '" class="btn btn-primary m-2">Book</a>';
                        if (isset($_SESSION["user_id"]) && $_SESSION["user_role"] == "agency") {
                            echo'<a href="edit_car_page.php?id=' . $row['id'] . '" class="btn btn-primary">Edit</a>';
                        }
                        echo'
                    </div>
                </div>';
        }
    } else {
        echo '<p>No available cars at the moment.</p>';
    }

    $mysqli->close();
?>

 <?php
// Assuming you have already established a database connection ($mysqli)

// Fetch the data from the 'cars' table
// $sql = "SELECT * FROM cars";
// $result = $mysqli->query($sql);

// if ($result->num_rows > 0) {
//     echo '<div id="carCarousel" class="carousel slide" data-ride="carousel">';
//     echo '<div class="carousel-inner">';

//     $firstItem = true;
//     while ($row = $result->fetch_assoc()) {
//         // Determine if this is the first item (active) in the carousel
//         $activeClass = $firstItem ? ' active' : '';
//         $firstItem = false;

//         echo '<div class="carousel-item' . $activeClass . '">';
//         echo '<div class="card" style="width: 18rem;">
//                 <div class="card-body">
//                     <p class="card-text">Car model: ' . $row['vehicle_model'] . '</p>
//                     <p class="card-text">Car Number: ' . $row['vehicle_number'] . '</p>
//                     <p class="card-text">Seating Capacity: ' . $row['seating_capacity'] . '</p>
//                     <p class="card-text">Rent Per Day Book: ' . $row['rent_per_day'] . '</p>
//                     <a href="book_car.php?id=' . $row['id'] . '" class="btn btn-primary">Book</a>
//                 </div>
//             </div>';
//         echo '</div>';
//     }

//     echo '</div>';
//     echo '<a class="carousel-control-prev" href="#carCarousel" role="button" data-slide="prev">
//             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
//             <span class="sr-only">Previous</span>
//           </a>';
//     echo '<a class="carousel-control-next" href="#carCarousel" role="button" data-slide="next">
//             <span class="carousel-control-next-icon" aria-hidden="true"></span>
//             <span class="sr-only">Next</span>
//           </a>';
//     echo '</div>';
// } else {
//     echo '<p>No available cars at the moment.</p>';
// }

// Close the database connection
// $mysqli->close();
?>

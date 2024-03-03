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

</head>

<body>

<?php include "header.php";?>
<?php
include "dbconnect.php";
$sql1 = "SELECT b.id, u.username AS customer_name, c.vehicle_model, c.vehicle_number, b.start_date, b.end_date, b.total_cost
FROM bookings b
INNER JOIN users u ON b.customer_id = u.id
INNER JOIN cars c ON b.car_id = c.id";
$result1 = $mysqli->query($sql1);

if ($result1->num_rows > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th>Booking ID</th>';
    echo '<th>Customer</th>';
    echo '<th>Vehicle Model</th>';
    echo '<th>Vehicle Number</th>';
    echo '<th>Start Date</th>';
    echo '<th>End Date</th>';
    echo '<th>Total Cost</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row = $result1->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['customer_name'] . '</td>';
        echo '<td>' . $row['vehicle_model'] . '</td>';
        echo '<td>' . $row['vehicle_number'] . '</td>';
        echo '<td>' . $row['start_date'] . '</td>';
        echo '<td>' . $row['end_date'] . '</td>';
        echo '<td>' . $row['total_cost'] . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<p>No bookings available at the moment.</p>';
}

$mysqli->close();
?>
<?php include "footer.php";?>
</body>

</html>

<?php 
include 'dbconnect.php';
// Include database connection code here
// Replace 'include_db.php' with your actual database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the registration form
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password before storing it in the database
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Validate user input (e.g., check for empty fields, valid email format, etc.)
    $errors = array();

    if (empty($username) || empty($password) || empty($email) || empty($role)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Check if the username is already taken (you need to implement this)
    // You can perform a database query to check if the username exists
    $sql = "SELECT id FROM users WHERE username = ? AND email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Car with the same details already exists, handle accordingly (e.g., show an error message)
        echo "Error: A user with the same details already exists.";
        $stmt->close();
        $mysqli->close();
    }
    else {
        
    // If there are no errors, insert the user into the database
        if (empty($errors)) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
            // Insert the user into the database
            $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param("ssss", $username, $hashedPassword, $email, $role);
        
                if ($stmt->execute()) {
                    // Registration successful, redirect to login page
                    header("Location: login.php");
                    exit();
                } else {
                    $errors[] = "Registration failed. Please try again later.";
                }
        
                $stmt->close();
            } else {
                $errors[] = "SQL statement preparation failed.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php";?>
    <!-- <h1>User Registration</h1> -->

    <?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- <form method="POST" action="signup.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="role">Role:</label>
        <select name="role" required>
            <option value="customer">Customer</option>
            <option value="agency">Car Rental Agency</option>
        </select>

        <button type="submit">Register</button> -->

    <div id="forgetpassModel" tabindex="-1" aria-labelledby="forgetpassLabel">
        <div class="modal-dialog">
            <div class="modal-content body-form">
                <div class="form-card">
                    <div class="form-card-image">
                        <h2 class="form-card-heading">
                            Get started
                            <small>Let us create new account</small>
                        </h2>
                    </div>
                    <!-- <p> &nbsp;</p> -->
                    <form class="form-card-form" method="POST" action="signup.php" name="update">
                        <input type="hidden" name="action" value="update" />
                        <div class="form-input">
                            <input minlength="5" type="Username" name="username" maxlength="15" class="form-input-field"
                                required />
                            <label for="username" class="form-input-label">Enter Username</label>
                        </div>
                        <div class="form-input">
                            <input minlength="8" type="password" name="password" maxlength="15" class="form-input-field"
                                required />
                            <label for="password" class="form-input-label">Enter Password</label>
                        </div>
                        <div class="form-input">
                            <input minlength="8" type="email" name="email" class="form-input-field" required />
                            <label for="email" class="form-input-label">Enter Email</label>
                        </div>
                        <div class="form-input">
                            <select name="role" required>
                                <option value="customer">Customer</option>
                                <option value="agency">Car Rental Agency</option>
                            </select>
                            <!-- <input minlength = "8" type="password" name="password" maxlength="15" class="form-input-field" required />
                                            <label for="password" class="form-input-label">Enter Password</label> -->
                        </div>
                        <!-- <input type="hidden" name="email" value=""/> -->
                        <div class="form-action">
                            <input type="hidden" name="username1" value="<?php echo $username;?>" />
                            <button type="submit" value="Reset Password" class="form-action-button">Submit</button>
                        </div>
                    </form>
                    <div class="form-card-info">
                        <p>Already have account. <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>
</body>

</html>
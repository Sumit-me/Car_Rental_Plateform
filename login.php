<?php
// Include database connection code here
// Replace 'include_db.php' with your actual database connection script
include 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user input (e.g., check for empty fields)
    $errors = array();

    if (empty($username) || empty($password)) {
        $errors[] = "Both username and password are required.";
    }

    // If there are no errors, attempt to log in the user
    if (empty($errors)) {
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variables and redirect to dashboard
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_role'] = $row['role'];
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Username not found.";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "header.php";?>
    <!-- <h1>User Login</h1> -->

    <?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form> -->

    <div id="forgetpassModel" tabindex="-1" aria-labelledby="forgetpassLabel">
        <div class="modal-dialog">
            <div class="modal-content body-form">
                <div class="form-card">
                    <div class="form-card-image">
                        <h2 class="form-card-heading">
                            Get started
                            <small>Let us login</small>
                        </h2>
                    </div>
                    <p> &nbsp;</p>
                    <form class="form-card-form" method="POST" action="login.php" name="update">
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
                        <!-- <input type="hidden" name="email" value=""/> -->
                        <div class="form-action">
                            <input type="hidden" name="username1" value="<?php echo $username;?>" />
                            <button type="submit" value="Submit" class="form-action-button">Submit</button>
                        </div>
                    </form>
                    <div class="form-card-info">
                        <p><a href="signup.php">Create new account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>
</body>

</html>
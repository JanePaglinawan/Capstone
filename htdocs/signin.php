<?php
// Start the session
session_start();

// Define a success message
$success_message = '';

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the email (ensure it’s a Gmail address)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
        $error_message = 'Please enter a valid Gmail address.';
    }
    // Check if the password matches the confirmation password
    elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        // Hash the password for security before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Here you would insert the data into a database, for example:
        // $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        // $pdo->execute([$email, $hashed_password]);

        // Assuming successful insertion into DB
        $success_message = 'Your account has been created successfully! You can now log in.';

        // Optionally, redirect the user to the login page
        // header('Location: login.php');
        // exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .signup-container {
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .signup-container h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .input-field:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .error-message, .success-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer a {
            text-decoration: none;
            color: #4CAF50;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Sign Up</h2>

        <!-- Show success message -->
        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <!-- Show error message -->
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <!-- Gmail Email Field -->
            <input type="email" name="email" class="input-field" placeholder="Enter Gmail address" required>
            
            <!-- Password Field -->
            <input type="password" name="password" class="input-field" placeholder="Password" required>
            
            <!-- Confirm Password Field -->
            <input type="password" name="confirm_password" class="input-field" placeholder="Confirm Password" required>
            
            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Sign Up</button> <window.location='login.php'>
        </form>

        <div class="footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

</body>
</html>

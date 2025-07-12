
<?php
session_start(); // Start a session to store user data
include('db.php'); // Include the database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to check if username exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // If user exists in the database
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch user data

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Store username in session
            $_SESSION['username'] = $username;
            header("Location: gym2.html"); // Redirect to gym2.html
            exit();
        } else {
            $error_message = "Invalid password."; // Password doesn't match
        }
    } else {
        $error_message = "Invalid username."; // Username doesn't exist
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FitLife Gym | Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .background-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            z-index: -1;
            transition: background-image 1s ease-in-out;
            background-color: #000; /* fallback color */
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
            width: 400px;
            padding: 0px;
            text-align: center;
            color: white;
            z-index: 1;
        }

        .form-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px 30px;
            border-radius: 10px;
        }

        h2 {
            color: #ffcc00;
            margin-bottom: 25px;
            font-size: 30px;
        }

        input {
            width: 100%;
            padding: 15px;
            margin: 12px 0;
            border: none;
            border-radius: 8px;
            background: #f1f1f1;
            font-size: 16px;
            color: #333;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background-color: #ffcc00;
            color: black;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #e6b800;
        }

        p {
            margin-top: 20px;
            font-size: 14px;
            color: #ccc;
        }

        a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="background-slideshow"></div> <!-- Background slideshow container -->

    <div class="container">
        <div class="form-box active">
            <h2>Login</h2>

            <!-- Display error message if login fails -->
            <?php if (isset($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <!-- Login form -->
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>

            <!-- Link to signup page -->
            <p>New to FitLife? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = [
                'login_back1.jpg',
                'login_back2.jpg',
                'login_back3.jpg',
                'login_back4.jpg'
            ];

            let currentIndex = 0;
            const slideshow = document.querySelector('.background-slideshow');
            const preloadedImages = [];

            // Preload all images
            images.forEach((src, index) => {
                preloadedImages[index] = new Image();
                preloadedImages[index].src = src;
            });

            function changeBackground() {
                const img = preloadedImages[currentIndex];
                if (img.complete) {
                    slideshow.style.backgroundImage = `url('${img.src}')`; // Corrected line
                    currentIndex = (currentIndex + 1) % images.length;
                } else {
                    // Wait and retry if the image isn't ready
                    setTimeout(changeBackground, 100);
                    return;
                }
            }
            // Initial background setup
            changeBackground();
            setInterval(changeBackground, 3000); // Change background every 3 seconds
        });
    </script>

</body>
</html>

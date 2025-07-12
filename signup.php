
<?php
session_start();
include('db.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input fields
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Validate username and password lengths
    if (strlen($username) < 4 || strlen($password) < 6) {
        $error_message = "Username must be at least 4 characters and password at least 6 characters.";
    } else {
        // Check if the username already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error_message = "Username already taken.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL to insert new user including email, phone
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $hashed_password, $email, $phone);

            if ($stmt->execute()) {
                header("Location: login.php"); // Redirect to login page
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
        $checkStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FitLife Gym | Sign Up</title>
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
            background-color: #000; /* fallback */
            background-image: url('images/login_back1.jpg'); /* fallback image */
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
            width: 400px;
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

    <!-- Background slideshow container -->
    <div class="background-slideshow"></div>

    <div class="container">
        <div class="form-box active">
            <h2>Sign Up</h2>

            <!-- Error message if signup fails -->
            <?php if (isset($error_message)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <form action="signup.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <button type="submit">Sign Up</button>
            </form>

            <p>Already have an account? <a href="login.php">Login</a></p>
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
                    slideshow.style.backgroundImage = `url('${img.src}')`;
                    currentIndex = (currentIndex + 1) % images.length;
                } else {
                    // Wait and retry if image isn't ready
                    setTimeout(changeBackground, 100);
                    return;
                }
            }

            // Initial background
            changeBackground();
            setInterval(changeBackground, 5000);
        });
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup Form</title>
    <style>
       body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        height: 100vh;
    }
    .main-block {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        margin-top: 300px;
      
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input,
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .form-container.left {
        margin-right: 20px;
    }

    .form-container.right {
        margin-left: 20px;
    }
    </style>
</head>
<body>
    <div class="main-block">
        <div class="form-container left">
            <form id="loginForm" method="POST">
                <h2>Login</h2>
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername">
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="form-container right">
            <form id="signupForm" method="POST">
                <h2>Sign Up</h2>
                <label for="signupUsername">Username</label>
                <input type="text" id="signupUsername" name="signupUsername" required>
                <label for="signupEmail">Email</label>
                <input type="email" id="signupEmail" name="signupEmail" required>
                <label for="signupPassword">Password</label>
                <input type="password" id="signupPassword" name="signupPassword" required>
                <label>
                    <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                        I agree to the Terms of Service
                </label>
                <button type="submit">Sign Up</button>
            </form>
        </div>

    </div>
    
    <?php 
        // Initialize connection credentials and connect to the database

$servername = "localhost";
$database = "credentials";
$username = "evildove";
$password = "Jason007";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// login

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginUsername'], $_POST['loginPassword'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Welcome back, " . $row["username"] . '<br>';
        }
    } else {
        echo "Wrong username or password.<br>";
    }

    $stmt->close();
}

// signup

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signupUsername"], $_POST["signupPassword"], $_POST["signupEmail"])) {
    $username = $_POST["signupUsername"];
    $password = $_POST["signupPassword"];
    $email = $_POST["signupEmail"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "This user exists.<br>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "This email exists.<br>";
        } else {
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
                $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password, $email);
                $stmt->execute();
                echo "User created successfully!<br>";
            } else {
                echo "Password is not strong enough or contains some blacklist characters.<br>";
            }
        }
    }

    $stmt->close();
}

mysqli_close($conn);

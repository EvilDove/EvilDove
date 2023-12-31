<?php
session_start();

function checkLogin($conn, $username, $password)
{
    $query = "SELECT * FROM credentials.users WHERE username='$username'";
    $res = mysqli_query($conn, $query);

    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            return true;
        }
    }
    return false;
}

function rememberMe($username)
{
    setcookie('user', $username, time() + 86400 * 7); // Remember for 7 days
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $database = "credentials";
    $username = "perrito";
    $password = "Vandau2004@";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["username"], $_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (strlen(trim($username)) > 0 && strlen(trim($password)) > 0) {
            if (checkLogin($conn, $username, $password)) {
                $mess =  "Login successfully!<br>";
                if (isset($_POST['remember'])) {
                    rememberMe($username);
                    $messCookie = "Your login session has been remembered for 7 days!<br>";
                }
            } else {
                $mess = "Username or password is incorrect!";
            }
        } else {
            $mess = "Please enter valid username and password!";
        }
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <!-- Your form fields -->
        </form>

        <?php
        if (isset($mess)) {
            echo $mess;
        }
        if (isset($messCookie)) {
            echo $messCookie;
            echo "<br>" . $_COOKIE["user"];
        }
        ?>
    </div>
</body>
</html>

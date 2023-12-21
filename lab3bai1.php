<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accounts = array(
            "admin" => "123123",
            "user" => "123456"
        );

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (isset($accounts[$username]) && $accounts[$username] === $password) {
            echo "<p>Chào mừng trở lại $username!</p>";
        } else {
            echo "<p>Tên đăng nhập hoặc mật khẩu không đúng!</p>";
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>

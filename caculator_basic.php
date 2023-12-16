<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Calculator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="text" name="a" placeholder="Enter a number" required /><br>
        <input type="text" name="b" placeholder="Enter another number" required /><br>
        <input type="submit" value="Calculate"/>
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a = $_POST["a"];
            $b = $_POST["b"];
            if(is_numeric($a) && is_numeric($b)) {
                echo "Addition: ".($a + $b)."<br>";
                echo "Subtraction: ".($a - $b)."<br>";
                echo "Multiplication: ".($a * $b)."<br>";
                if ($b != 0) {
                    echo "Division: ".($a / $b)."<br>";
                } else {
                    echo "Division by zero is not allowed.<br>";
                }
            } else {
                echo "Please enter valid numeric values.<br>";
            }
        }
    ?>
</body>
</html>
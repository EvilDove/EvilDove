<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phương Trình Bậc Nhất</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="text" name="a" placeholder="Nhập hệ số a" required />x + 
        <input type="text" name="b" placeholder="Nhập hệ số b" required /> = 0<br>
        <input type="submit" value="Tính"/>

    </form>

    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["a"], $_GET["b"])) {
                $a = $_GET["a"];
                $b = $_GET["b"];
                if(is_numeric($a) && is_numeric($b) && $a != 0){
                    echo "Phương trình có nghiệm là x = " . (-$b / $a);
                } else {
                    if ($a == 0) {
                        echo "Hệ số a phải khác 0 để tìm nghiệm.";
                    } else {
                        echo "Vui lòng nhập hệ số là số.";
                    }
                }
            }
        }
    ?>
</body>
</html>
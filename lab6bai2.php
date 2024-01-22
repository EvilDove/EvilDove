<?php
$db_user = "root";
$db_pass = "";
$db_name = "ehclab6b1";

try {
    $db = new PDO("mysql:host=localhost;dbname=" . $db_name . ';charset=utf8', $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function userExists($db, $mssv, $stname, $pnumber, $mail)
    {
        $stmt = $db->prepare("SELECT * FROM ehc WHERE stname = ? OR mssv = ? OR pnumber = ? OR mail = ?");
        $stmt->execute([$stname, $mssv, $pnumber, $mail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function insertUser($db, $stname, $mssv, $pnumber, $mail)
    {
        $stmt = $db->prepare("INSERT INTO ehc (stname, mssv, pnumber, mail) VALUES (?, ?, ?, ?)");
        $stmt->execute([$stname, $mssv, $pnumber, $mail]);
        echo "Your student details have been saved";
    }

    function displayUserInfo($user)
    {
        if ($user) {
            echo "MSSV: " . $user['mssv'] . "<br>Name: " . $user['stname'] . "<br>Mobile: " . $user['pnumber'] . "<br>Email: " . $user['mail'];
        } else {
            echo "No record found for the given MSSV.";
        }
    }

    function deleteUser($db, $mssv)
    {
        $stmt = $db->prepare("DELETE FROM ehc WHERE mssv = ?");
        $stmt->execute([$mssv]);
        echo "Student with MSSV: " . $mssv . " has been deleted.";
    }

    function updateUser($db, $id, $stname, $pnumber, $mail)
    {
        $stmt = $db->prepare("UPDATE ehc SET stname = ?, pnumber = ?, mail = ? WHERE id = ?");
        $stmt->execute([$stname, $pnumber, $mail, $id]);
        echo "Student information updated successfully.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 13px;
        }
        input[type=text], input[type=email]{
            width: 300px;
            padding: 5px;
            box-sizing: border-box;
            border: 1px solid;
        }
        /* Your other CSS styles */
    </style>
</head>
<body>
    <!-- Student Registration Form -->
    <form action="lab6b1.php" method="post">
        <!-- Your HTML Code for Student Registration Form -->
    </form>

    <!-- Display User Information Form -->
    <form action="lab6b1.php" method="post">
        <!-- Your HTML Code for Display User Information Form -->
    </form>

    <!-- Delete Student Form -->
    <form action="lab6b1.php" method="post">
        <!-- Your HTML Code for Delete Student Form -->
    </form>

    <!-- Change Information Form -->
    <form action="lab6b1.php" method="post">
        <!-- Your HTML Code for Change Information Form -->
    </form>
</body>
</html>

<?php
// Handle form submissions here
?>

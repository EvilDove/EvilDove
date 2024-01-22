<?php
$db_user = "root";
$db_pass = "";
$db_name = "ehclab6b2";

$db = new PDO("mysql:host=localhost;dbname=". $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function recordExists($db, $mssv, $stname, $mobile, $email) {
    $stmt = $db->prepare("SELECT * FROM ehc WHERE mssv = ? OR stname = ? OR mobile = ? OR email = ?");
    $stmt->execute([$mssv, $stname, $mobile, $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertRecord($db, $mssv, $stname, $mobile, $email) {
    $stmt = $db->prepare("INSERT INTO ehc (mssv, stname, mobile, email) VALUES (?, ?, ?, ?)");
    $stmt->execute([$mssv, $stname, $mobile, $email]);
    echo "Record inserted successfully!\n";
}

// Student 1
$mssv1 = 'HE189013';
$stname1 = 'Nguyen Trong Minh';
$mobile1 = '0913081110';
$email1 = 'trongminh0712@gmail.com';

$user1 = recordExists($db, $mssv1, $stname1, $mobile1, $email1);

if (!$user1) {
    insertRecord($db, $mssv1, $stname1, $mobile1, $email1);
} else {
    echo "Record already exists!";
}

// Student 2
$mssv2 = 'HE18999';
$stname2 = 'Nguyen Jason';
$mobile2 = '0913092220';
$email2 = 'evildove0712@gmail.com';

$user2 = recordExists($db, $mssv2, $stname2, $mobile2, $email2);

if (!$user2) {
    insertRecord($db, $mssv2, $stname2, $mobile2, $email2);
} else {
    echo "Record already exists!";
}

// Repeat for other students...

// Display all student info
$stmt = $db->prepare("SELECT mssv, stname, mobile, email FROM ehc");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<br> Student info <br>";
if ($result) {
    foreach($result as $row) {
        echo "mssv: " . $row['mssv']. " - Name: " . $row['stname']. " - Mobile: " . $row['mobile']." - Email: ". $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}
?>

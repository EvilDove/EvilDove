<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["UploadedFile"], $_POST["submit"])) {
    $targetDirectory = "uploads3/";
    $targetFile = $targetDirectory . basename($_FILES["UploadedFile"]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = true;

    $check = getimagesize($_FILES["UploadedFile"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = false;
    }

    if ($_FILES["UploadedFile"]["size"] > 2 * 1024 * 1024) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = false;
    }

    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedFormats)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG, and GIF files are allowed.')</script>";
        $uploadOk = false;
    }

    if ($uploadOk) {
        if (move_uploaded_file($_FILES["UploadedFile"]["tmp_name"], $targetFile)) {
            echo "The file <a href='$targetFile'>$targetFile</a> has been uploaded.";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Upload an image file</h1>
        <input type="file" name="UploadedFile">
        <input type="submit" name="submit" value="Upload File">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["UploadedFile"])) {
    $file = $_FILES["UploadedFile"];

    if ($file["error"] > 0) {
        echo "Error: Something went wrong!";
    } else {
        $target_path = "uploads2/" . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $target_path)) {
            echo "Upload successful<br/>";
            echo "The file <a href='$target_path'>$target_path</a> has been uploaded<br>";
            echo "File type: " . $file["type"] . "<br>";
            echo "Size: " . round($file["size"] / 1024, 2) . "KB";
        } else {
            echo "Error: Failed to upload file.";
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
    <title>Upload File</title>
</head>
<body>
    <form action="file_upload.php" method="POST" enctype="multipart/form-data">
        <h1>Upload an image</h1>
        <input type="file" name="UploadedFile">
        <input type="submit" value="Upload File">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Length of Strings</title>
</head>
<body>
<?php
$my_array = array('EHC', 'HackYourLimits', 'Training');

$minLength = PHP_INT_MAX;
$maxLength = 0;

foreach ($my_array as $element) {
    $length = strlen($element);
    
    if ($length < $minLength) {
        $minLength = $length;
    }
    
    if ($length > $maxLength) {
        $maxLength = $length;
    }
}

echo "minLength = $minLength; maxLength = $maxLength;";
?>
</body>
</html>
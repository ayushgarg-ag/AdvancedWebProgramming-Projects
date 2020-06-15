<!DOCTYPE html>
<?php include "library.php"; ?>

<html>
<head>
<!--
  Assignment: Temperature Converter
  Name: Ayush
  Extension: Display Form with embedded error messages
-->
<title>Temperature Converter</title>
<style>
body {
    background-color: lightblue;
    font-size: 30px;
}
div#title {
    font-size: 50px;
    text-align: center;
    margin: auto;
    text-decoration: underline;
}
input[type="text"] {
    height: 30px;
    font-size: 30px;
    text-align: center;
    width: 30%;
    margin: auto;
}
input[type="submit"] {
    height: 30px;
    font-size: 20px;
    text-align: center;
    width: 20%;
    margin: auto;
}

</style>
</head>
<body>
<?php

$errorF = false;
$errorC = false;
$valueC = '';
$valueF = '';

if (isPost()) {
    $valueF = getValue('degreesF');
    $valueC = getValue('degreesC');
    if (getValue('convert') == 'Convert to F') {
            $errorC = numberError(getValue('degreesC'), -273.15, INF);
            if ($errorC == false) {
                $valueF = ((($valueC *9)/5)+32);
            }
    }
    else if (getValue('convert') == 'Convert to C') {
        $errorF = numberError(getValue('degreesF'), -459.67, INF);
        if ($errorF == false) {
            $valueC = ((($valueF - 32)*5)/9);
        }
    }
    else {
        return false;
    }
}
else {
    $valueF = getValue('degreesF');
    $valueC = getValue('degreesC');
}
echo "<div id='title'>Temperature Converter</div>";
startForm ('post', $_SERVER['PHP_SELF']);
echo "<br>\n";
textInput ("Fahreinheit: \n", 'degreesF', 50, 10, $valueF, $errorF);
makeSubmit('Convert to C', 'convert');
echo "<br>\n\n";
echo "<br>\n\n";
textInput ("Celsius: \n", 'degreesC', 50, 10, $valueC, $errorC);
makeSubmit('Convert to F', 'convert');
echo "\n";
endForm();
?>
</body>
</html>
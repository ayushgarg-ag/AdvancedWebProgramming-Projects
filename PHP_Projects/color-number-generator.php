<!DOCTYPE html>
<?php
@$low = $_GET['low'];
@$high = $_GET['high'];
@$bgcolor = $_GET['bgcolor'];
$randomnum = rand($low, $high);
$align = "center";
$position = "absolute";
$formSize = "30px";
$margin = "auto";
?>
<html>
<head>
<!--
  Assignment: Color Number Generator
  Name: Ayush Garg
  Extension: 1) Visual representation of the random number through random position and random font-size; 2)Uses php to generate CSS rules
-->
<title>Color Number Generator</title>
<style type="text/css">
body {
    background-color: blue;
   background-color: <?php echo $bgcolor; ?>;
   color: <?php echo "rgb(" . rand(1, 255) . "," . rand(1, 255) . "," . rand(1, 255). ")"; ?>;
}
#number {
    font-size: <?php echo rand(50,1000); ?>%;
    right: <?php echo rand(10,90);?>%;
    position: <?php echo $position; ?>;    
}
#form {
    text-align: <?php echo $align; ?>;
    margin: <?php echo $margin; ?>;
    font-size: <?php echo $formSize; ?>;
}
input {
    width: 60px;
    
}
</style>
</head>

<body>
<div id = "form">
<form action="Assignment1.1.php">
Low: <input name="low" value = "0"><br>
High: <input name="high" value = "100"><br>
Bgcolor: <input name="bgcolor"><br>
<input type="Submit" name="submit" value="Submit">
</form>
</div>

<br><br><br>

<div id = "number">
<?php
    echo "<br>" .  $randomnum;
?>
</div>
</body>
</html>
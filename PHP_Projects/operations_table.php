<!DOCTYPE html>
<?php
if (isset ($_GET['value']) == true) {
    $value = $_GET['value'];
}
else {
    $value = "9";
}

if (isset ($_GET['op']) == true) {
    $op = $_GET['op'];
}
else {
    $op = 'multiply';
}

if(is_numeric($value) == false){
    exit("You have <b>FAILED</b> to provide a value for your times table!");
}

?>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

<!--
  Assignment: Operations Table
  Name: Ayush Garg
  Extensions: Allows user to select operation. Choices are to add, subtract, multiply, divide, average, power, modulo.
-->
<title>Operations Table</title>
<style>
body{
    font-family: 'Roboto Condensed', sans-serif;
    margin: auto;
    text-align: center;
    background-color: #83C4EA;
}

table,tr,td {
    border: 3px solid #204B57;
    border-collapse: collapse;
    padding: 15px;
    margin: auto;
}
td {
    width: 115px;
    height: 15px;
}
td:hover {
    background-color: #2484B7;
    color: white;
}
#form {
    font-size: 30px;
    display: inline;
}
input, select {
    width: 200px;
    height: 30px;
}
option {
    font-size: 15px;
    text-align: center;
    display: inline;
}

</style>
</head>
<body>
<div id= "form">
    <form action = "Assignment1.3.php">
        Value: <input id="num" name="value"><br>
        Operator:
        <select name="op">
            <option value="add">Addition</option>
            <option value="sub">Subtract</option>
            <option value="divide">Divide</option>
            <option value="average">Average</option>
            <option value="power">Power</option>
            <option value="modulo">Modulo</option>
        </select><br>
        <input value = "Submit" type="submit"><br>
    </form>
</div>

<?php
echo "<table>\n";
for($i = 0.0; $i <= 9; $i++){
    if($op == 'multiply'){
        $mathsign = $value * $i;
        $sign = 'x';
    }
    else if($op == 'add'){
        $mathsign = $value + $i;
        $sign = '+';
    }
    else if($op == 'sub'){
        $mathsign = $value - $i;
        $sign = '-';
    }
    else if($op == 'divide'){
        $mathsign = $value/$i;
        $sign = '/';
    }
    else if($op == 'average'){
        $mathsign = ($value+$i)/2;
        $sign = ' and ';
    }
    else if($op == 'power'){
        $mathsign = pow($value, $i);
        $sign = '^';
    }
    else if($op == 'modulo'){
        $mathsign = $value % $i;
        $sign = '%';
    }
    echo "<tr>\n<td>";
    echo $value . $sign . $i;
    echo "</td>";
    echo "<td>";
    echo $mathsign;
    echo "</td>\n</tr>";
}
    echo "</table>\n";

?>


</body>
</html>
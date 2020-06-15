<!DOCTYPE html>

<?php
// get Tech Library functions
include 'library.php';
  
// start document
startDoc ();
 
// generate <head> element
startHead ();
makeTitle ('My Page');
addCSSLink ('main.css');
endHead ();
 
// generate <body>
startBody();
 
// create a form
echo "<h1>All About You</h1>\n<div class=\"form\">\n";
startForm('get', 'processForm.php');
textInput ('Username: ', 'user', 50, 15, 'Your username');
passInput ('Password: ', 'pass', 50, 15, null);
textArea ('Describe Yourself: ', 'description', 5, 60, 'Enter text');
echo "\n<div class=\"radio\">\n";
radioGroup2 ('What grade are you in: ', 'grade', array ('9th', '10th', '11th', '12th'), '10th');
echo "</div>\n";
echo "<div class=\"checkbox\">";
prnt ('What pets do you own: ');
checkBox ('Dog', 'dog', 'dog', false);
checkBox ('Cat', 'cat', 'cat', false);
checkBox ('Bird', 'bird', 'bird', 'bird');
checkBox ('Other', 'other', 'other', false);
echo "</div>\n\n<div class=\"dropdown\">";
dropDown ('Favorite Car Brand: ', 'car', array('Ford', 'Chevy', 'Dodge'), 'Chevy');
echo "\n\n<div class=\"extra\">\n";
makeSubmit ('Enter', 'submit');
makeReset ();
echo "</div>";
endForm();
echo "</div>";
 
// close body
endBody();
 
// close document
endDoc ();
?>

<!DOCTYPE html>

<?php
// get Tech Library functions
include 'library.php';
  
// start document
startDoc ();
 
// generate <head> element
startHead ();

//   Assignment: Assignment 3.2
//   Name: Ayush Garg
//   Extension: Fieldset and legend

makeTitle ('Tech Suvey');
addCSSLink ('index.css');
endHead ();
 
// generate <body>
startBody();
// $what = showValue(this.value);
// create a form
echo "<h1>Technology Survey</h1>\n<div class=\"form\">\n";
startForm('post', 'Handler3.2.php');

$name = getValue ('user');
textInput ('Name: ', 'user', 50, 15, $name);

$ID = getValue ('ID');
passInput ('School ID #: ', 'ID', 6, 6, $ID);

$desc = getValue('description');
textArea ('How you use technology on an everyday basis: ', 'description', 5, 60, $desc);

echo "<div class=\"checkbox\">";
prnt ('What other screens do you use: ');

checkBox ('TV', 'tv', 'tv', getValue('tv'));
checkBox ('Computer', 'computer', 'computer', getValue('computer'));
checkBox ('Chromebook', 'chromebook', 'chromebook', getValue('chromebook'));
checkBox ('I-pad', 'ipad', 'ipad', getValue('ipad'));
checkBox ('Gaming Console', 'gaming console', 'gaming console', getValue('gaming console'));
checkBox ('Other', 'other', 'other', getValue('other'));
echo "</div>\n\n";
echo "<div class=\"dropdown\">";
dropDown ('What is the main reason you use electronics? ', 'electronics', array('School work', 'Gaming', 'Netflix', 'Music', 'Social Media', 'Shopping', 'Reading', 'Other entertainment'), getValue('electronics'));
echo "</div>";

echo "\n<div class=\"radio\">\n";
radioGroup ('phone', array ('iPhone', 'Samsung', 'Microsoft', 'Google', 'Nokia', 'Sony', 'BlackBerry', 'Motorola', 'LG', 'HTC'), getValue ('phone'), 'What phone do you prefer?');
echo "</div><div class=\"slider\">\n";
slider('0', '21', '1', getValue('name'), 'phone', 'name');

echo "<div><div class=\"colorpicker\">";
colorpicker('Favorite color', 'color');

echo "</div>\n\n<div class=\"extra\">\n";
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

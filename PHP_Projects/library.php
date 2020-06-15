<?php
session_start(); // make this the first line of your library outside of your functions

//calculate and return the absolute value of $x
function absVal($value) {
    if(is_numeric($value) === false) {
       return false;
    }
    if($value < 0){
        return -1 * $value;
    }
    else {
        return $value;
    }
}

//Prints doctype tag
// function printDoctype (){
//     include "../Library/doctype.html";
// }

//checks if it is coming from a post
function isPost () {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		return true;
	}
	else {
		return false;
	}
}


//get value of a variable
function getValue ($key, $default = false) {
    if (isset ($_REQUEST[$key])) {
        return $_REQUEST[$key];
    }
    else {
        return $default;
    }
}

function sleepIn ($weekday, $vacation) {
   if ($weekday == false || $vacation == true) {
       return true;
   }
   else {
      return false;
   }
}

function makes10($a, $b) {
    if($a == 10 || $a + $b == 10) {
        return true;
    }
    if($b == 10 || $a + $b == 10) {
        return true;
    }
    else {
        return false;
    }
}

function nearHundred($n) {
    if ('90' <= $n && $n <= '110' || '190' <= $n && $n <= '210') {
        return true;
    }
    else {
        return false;
    }
}

function posNeg ($a, $b, $negative) {
    if($negative === true && $a < 0 && $b < 0) {
        return true;
    }
    else if($negative === false && ($a < 0 && $b > 0 || $a > 0 && $b < 0)) {
        return true;
    }
    else {
        return false;
    }
}

function notString($str) {
    if((substr($str, 0, 3)) == 'not') {
        return $str;
    }
    else {
        return "not " . $str;
    }
}

function missingChar($str, $n) {
    if($n < strlen($str)) {
        $first = substr($str, 0, $n);
        $second = substr($str, $n);
        $delete = substr($second, 1);
        return $first . $delete;
    }
    else {
        return false;
    }
}

function frontBack($str) {
    if(strlen($str) > 1) {
    $first = substr($str, 0, 1);
    $close = strlen($str) - 2;
    $middle = substr($str, 1, $close);
    $last = substr($str, - 1);
    return $last . $middle . $first;
    }
    elseif(strlen($str) == 1) {
        return $str;
    }
    else {
        return false;
    }
}

function inOrder ($x, $y, $z) {
    if (is_numeric ($x) == false || is_numeric ($y) == false ||  is_numeric ($z) == false) {
        return false;
    }
    elseif ($x <= $y && $y <= $z) {
        return true;
    }
    else {
        return false;
    }
}

//prints the file list
function printFileList ($dir) {
    $path = realpath($dir);
    echo "<h1>File listing of: $path</h1>\n";
    if ($path == false) {
        die("No directory provided!");
    }
    $handle = opendir($dir);
    $filename = readdir($handle);
    $filenumber = 0;
    echo "\n<ol>\n";
    while($filename !== false) {
    if ($filename != '.' && $filename != '..'){
        if (@is_dir ($path . '/' . $filename) == false) {
            echo "<li class='file'>$filename</li>\n";
            $filenumber = $filenumber + 1;
        }
        else if (@is_dir ($path . '/' . $filename) == true) {
                echo "<li class='dir'>$filename</li>\n";
                
                $dir1 = "../$filename";
                $path1 = realpath($dir1);
                $handle1 = opendir($path1);
                $filename1 = readdir($handle1);
                echo "\n<ol>\n";
                while ($filename1 !== false){
                    if ($filename1 != '.' && $filename1 != '..') {
                    echo "<li class='file'>$filename1</li>\n";
                    }
                    $filename1 = readdir($handle1);
                }
                $filenumber = $filenumber + 1;
                echo "</ol>\n\n";
                
                closedir ($handle1);
        }
            }
    $filename = readdir($handle);
    }
    echo "</ol>\n";
    echo "\n<h2>Total files: $filenumber</h2>\n";
    closedir ($handle);
}

//Assignment 2.1.2 - Prints files without using opendir, readdir, closedir
function printFileList2($path) {
    $paths = realpath($path);

    if ($paths == false) {
        die("No directory provided!");
    }

    $arr = scandir($path);
    $filenumber = 0;
    echo "\n<ol>\n";
    foreach($arr as $value) {

            if ($value != '.' && $value != '..') {
                if (@is_dir($path.'/'.$value) == false) {
                    echo "<li class='file'>$value</li>\n";
                    $filenumber = $filenumber + 1;
                }
                else if (@is_dir($path.'/'.$value) == true) {
                    echo "<li class='dir'>$value</li>\n";
                    $filenumber = $filenumber + 1;
                    printFileList2($path . '/' . $value);
                }
        }

    }
    echo "</ol>\n";
    echo "\n<h2>Total files: $filenumber</h2>\n";
}

//gets image names for the folder and subfolder. Adds the sub folder file name to the ret array so it can choose a random file from there too.
function getImageNames($path) {
    $ret = array();
    // $realpath = realpath($path);
    $files = scandir($path);
    foreach($files as $single) {
        if ($single != '.' && $single != '..') {
            $path2 = $path . '/' . $single;
            if (@is_dir($path2) == false) {
                $ret[] = $single;
            }
            else if (@is_dir($path2) == true) {
                $files2 = getImageNames('./images/'.$single);
                foreach($files2 as $single2) {
                    $ret[] = $single . '/' . $single2;
                }
            }
        }
    }
    return $ret;
}

function pickRandom($array) {
        $count = count($array);
        if ($count == 0) {
            return false;
        }
        $rand = rand(0, $count-1);
        $random = $array[$rand];
        return $random;
}
// ASSIGNMENT 3.1 FUNCTIONS - FORMS
function startDoc () {
    echo "<html>\n";
}
function startHead () {
    echo "<head>\n<link href=\"https://fonts.googleapis.com/css?family=Slabo+27px\" rel=\"stylesheet\">\n";
}

// makeTitle: adds a title to the page
// Parameters:
//   $title: the title you want for the page
function makeTitle ($title) {
    echo "<title>$title</title>\n";
}

// addCSSLink: adds an external style sheet
// Parameters:
//   $file: link to the external CSS style sheet
function addCSSLink ($file) {
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$file\">\n";
}
function endHead() {
    echo "</head>\n";
}
function startBody() {
    echo "<body>\n";
}

// startForm: echo out a form tag to start the form which will be used to create an HTML form for user input
// Parameters:
//   $method: Specifies the HTTP method to use when sending form-data
//   $body: Specifies where to send the form-data when a form is submitted
function startForm ($method, $body) {
    echo "<form method=\"$method\" action=\"$body\">\n\n";
}

// textInput: Defines a single-line text field that a user can enter text into
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $size: specifies the visible width, in characters, of an <input> element
//   $maxLength: specifies the maximum number of characters allowed in the <input> element
//   $prefill: the text that should automatically be put in the text box
//   $errMsg: displays an error message
function textInput($label, $name, $size, $maxLength, $prefill, $errMsg = null) {
    echo "$label <input type=\"text\" name=\"$name\" size=\"$size\" maxlength=\"$maxLength\" value=\"$prefill\">";
    if ($errMsg !== null) {
        echo "<span class=\"error\">$errMsg</span>";
    }
    echo "<br>\n";
}

// passInput: Defines a password field
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $size: specifies the visible width, in characters, of an <input> element
//   $maxLength: specifies the maximum number of characters allowed in the <input> element
//   $prefill: the text that should automatically be put in the text box
function passInput ($label, $name, $size, $maxLength, $prefill) {
    echo "$label\n <input type=\"password\" name=\"$name\" size = \"$size\" maxlength=\"$maxLength\" value=\"$prefill\" autocomplete=\"off\"><br>\n\n";
}

// textArea: defines a multi-line text input control
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $rows: Specifies the visible number of lines in a text area
//   $cols: Specifies the visible width of a text area
//   $prefill: the text that should automatically be put in the textarea
function textArea ($label, $name, $rows, $cols, $prefill) {
    echo "$label\n <textarea name=\"$name\" rows=\"$rows\" cols=\"$cols\">$prefill</textarea><br>\n\n";
}

// radioGroup: lets a user select only one of a limited number of choices
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $valueArr: an array that defines the value associated with each input
//   $precheck: specifies that an <input> element should be pre-selected (checked) when the page loads
function radioGroup($name, $valueArr, $preCheck, $label) {
    echo "<br><fieldset><legend>$label</legend>\n";
    for ($i = 0; $i < count($valueArr); $i++) {
        if ($valueArr[$i] == $preCheck) {
            echo "<input type=\"radio\" name = \"$name\" value=\"".$valueArr[$i]."\" checked=\"checked\">".$valueArr[$i]."<br>\n";
        }
        else {
            echo "<input type=\"radio\" name = \"$name\" value=\"".$valueArr[$i]."\">".$valueArr[$i]."<br>\n";
        }
    }
    echo "</fieldset>";
}

// radioGroup: lets a user select only one of a limited number of choices
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $valueArr: an array that defines the value associated with each input
//   $precheck: specifies that an <input> element should be pre-selected (checked) when the page loads
function radioGroup2($label, $name, $valueArr, $preCheck) {
    echo "$label<br>\n";
    for ($i = 0; $i < count($valueArr); $i++) {
        if ($valueArr[$i] == $preCheck) {
            echo "<input type=\"radio\" name = \"$name\" value=\"".$valueArr[$i]."\" checked=\"checked\">".$valueArr[$i]."<br>\n";
        }
        else {
            echo "<input type=\"radio\" name = \"$name\" value=\"".$valueArr[$i]."\">".$valueArr[$i]."<br>\n";
        }
    }
}

// prnt: prints text specified and creates a new line on the page and the script
// Parameters:
//   $text: the text that should be displayed on the page
function prnt ($text) {
    echo "$text<br>\n";
}

// checkBox: lets a user select one or more options of a limited number of choices
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $value: defines the value associated with the input
//   $precheck: specifies that an <input> element should be pre-selected (checked) when the page loads
function checkBox($label, $name, $value, $preCheck) {
    if ($value == $preCheck) {
        echo "<input type=\"checkbox\" name = \"$name\" value=\"$value\" checked=\"checked\">$label<br>\n";
    }
    else {
        echo "<input type=\"checkbox\" name = \"$name\" value=\"$value\">$label<br>\n";
    }
}

// dropDown: creates a drop-down list
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
//   $valueArr: an array that defines the value associated with each input
//   $precheck: specifies that an <input> element should be pre-selected (checked) when the page loads
function dropDown ($label, $name, $valueArr, $preSelect) {
    echo "\n$label \n";
    echo "<select name=\"$name\">\n";
    foreach ($valueArr as $value) {
        if ($preSelect == $value) {
            echo "<option value=\"$value\" selected=\"selected\">$value</option>\n";
        }
        else {
            echo "<option value=\"$value\">$value</option>\n";
        }
    }
    echo "</select><br><br>\n\n";
}

// makeSubmit: echo out an input tag to display a submit button
// Parameters:
//   $label: the text to be displayed on the button
//   $name: the name of the button element
function makeSubmit ($label, $name) {
    echo "<input type=\"submit\" name=\"$name\" value=\"$label\">\n";
}
// makeReset: Defines a reset button (resets all form values to default values)
function makeReset () {
    echo "<input type=\"reset\" name=\"Reset\"><br>\n";
}
// endForm: echo out an end div and form tag
function endForm () {
    echo "</div></form>\n";
}
// endBody: echo out an end body tag
function endBody () {
    echo "</body>\n";
}
// endDoc: echo out an end html tag to end the document
function endDoc () {
    echo "</html>\n";
}

// ASSIGNMENT 3.2
function slider($min, $max, $step, $value, $ID, $name) {
    echo "What age did you get your first phone? <br><input type=\"range\" min=\"$min\" max=\"$max\" step=\"$step\" value=\"$value\" id=\"$ID\" name=\"$name\" onchange='document.getElementById(\"bar\").value = document.getElementById(\"$ID\").value;'/>";
    echo "<input type=\"text\" name=\"bar\" id=\"bar\" value=\"$value\" disabled />";
    // Example:
    // echo "What age did you get your first phone? <br><input type=\"range\" min=\"0\" max=\"21\" step=\"1\" value=\"13\" id=\"phone\" name=\"age\" onchange='document.getElementById(\"bar\").value = document.getElementById(\"phone\").value;'/>";
    // echo "<input type=\"text\" name=\"bar\" id=\"bar\" value=\"13\" disabled />";
}
function colorpicker($label, $name) {
    echo "<br>\n$label: <input type=\"color\" name=\"$name\" value=\"#A9D8B8\"><br><br>\n";
}
//Checks if the input is too long or too short
function textError($str, $minLength, $maxLength) {
    $length = strlen($str);
    if($length < $minLength) {
        return "<div style='color: red'>The text input is too short!</div>";
    }
    else if($length > $maxLength) {
        return "<div style='color: red'>The text input is too long!</div>";
    }
    else {
        return false;
    }
}

//Checks if the input is a numeric value, too long, or too short
function numberError($str, $minValue, $maxValue) {
    if ($str === false) {
        return "\n<span style='color: red' class='error'>Error! The number input does not contain anything!</span>\n";
    }
    else if(is_numeric($str) === false) {
        return "\n<span style='color: red' class='error'>Error! The number input is not numeric!</span>\n";
    }
    else if($str < $minValue) {
        return "\n<span style='color: red' class='error'>Error! The number entered is too small!</span>\n";
    }
    else if($str > $maxValue) {
        return "\n<span style='color: red' class='error'>Error! The number entered is too large!</span>\n";
    }
    else {
        return false;
    }
}

function cleanUp($user) {
    $user = trim ($user);
    $user = strip_tags ($user);
    $user = htmlspecialchars ($user);
    return $user;
}

// function verifyLogin() {
//     if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
//         if ((($_SERVER['PHP_AUTH_USER']) == "tech30") && (($_SERVER['PHP_AUTH_PW']) == "Puma$" )) {
//             return true;
//         }
//         else {
//             header('WWW-Authenticate: Basic realm="Tech 30"');
//             header('HTTP/1.0 401 Unauthorized');
//             echo "Unauthorized";
//             exit;
//         }
//         // echo($_SERVER['PHP_AUTH_USER']);
//         // echo($_SERVER['PHP_AUTH_PW']);
//     }
//     else {
//         header('WWW-Authenticate: Basic realm="Tech 30"');
//         header('HTTP/1.0 401 Unauthorized');
//         echo "Unauthorized";
//         exit;
//     }
// }
function verifyLogin () {
    $users = file ('passwd.txt', FILE_IGNORE_NEW_LINES);

    if (isset($_SERVER['PHP_AUTH_USER'])) {
            $thisUser = sha1($_SERVER['PHP_AUTH_USER']).' '.sha1($_SERVER['PHP_AUTH_PW']);
        // $username = $_SERVER['PHP_AUTH_USER'];
        // $password = $_SERVER['PHP_AUTH_PW'];

        // var_dump($_SERVER['PHP_AUTH_USER']);
        // var_dump($_SERVER['PHP_AUTH_PW']);
        // var_dump($users);
        
        if (array_search("$thisUser", $users) !== false) {
            return;
        }
        else {
                header('WWW-Authenticate: Basic realm="Tech 30"');
                header('HTTP/1.0 401 Unauthorized');
                exit();
        }
    }
    else {
        header('WWW-Authenticate: Basic realm="Tech 30"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'You canceled - bad user!';
        exit ();
    }  
}

// setcookie ($name, $value, $expiration);
// this function is built-in to php
// $name is the cookie's name you are setting
// $value is the cookie's value
// $expiration is the "timestamp" when you want the cookie to expire:
// -- use 0 for a "session cookie" that lasts only until the browser is closed
// -- use 1 to force a cookie to expire and be deleted
// -- use time() + $offset, to have the cookie expire $offset seconds from now

function getcookie ($name, $default=null) {
	return getValue ($name, $default);
}

function clearcookie ($name) {
	setcookie ($name, false, 1);
}

function setSession ($key, $value) {
   $_SESSION[$key]=$value;
}
function getSession ($key, $def=null) {
	$ret = isset($_SESSION[$key])?$_SESSION[$key]:$def;
	return $ret;
}

function delSession ($key) {
	unset ($_SESSION[$key]);	// deletes one session value
}
function restartSession () {
	$_SESSION = array ();		// deletes ALL session values
}

function verifyGLogin () {
    // check to see if user is already logged in
    if (getSession('userInfo', null) !== null) {
        return; 
    }
    else {
        // setup some sessions to configure the sign-in page's behavior
        setSession('returnURL', "http://www.pumatech.org" . $_SERVER['PHP_SELF']);
        setSession('cssURL', "http://www.pumatech.org/Classes/AdvWeb/Period6/Garg.Ayush/Library/Google.css");
        setSession('signinMsg', "Welcome to <u>Ayush's</u> secure website!");
        setSession('signoutMsg', "You have left <u>Ayush's</u> secure website.");

        // redirect to signin page
        header ('Location: http://www.pumatech.org/glogin/Tech30Signin.php');
        exit ();
    }
}

function MYSQLConnect () {
    $host = 'localhost';
    $un = 'teacher_agarg01';
    $pw = 'P2P.506784';
    $db = 'teacher_agarg01';
    
	// connect to the mySQL server
	$link = @mysqli_connect($host, $un, $pw) or die (mysqli_error($link));
	
	// select the database
	mysqli_select_db($link, $db) or die (mysqli_error($link));

	// return link to the connection (to be used to close it later)
	return $link;
}

function MYSQLQuery ($link, $query) {
	// send query
	$result = mysqli_query ($link, $query) or die (mysqli_error($link));

    // there was an error;
    if ($result === false) 
        return false;
    
	// check for a success for a query OTHER than SELECT, SHOW, DESCRIBE, or EXPLAIN
	// returns the number of rows affected by the query
	if ($result === true) 
	    return mysqli_affected_rows ($link);
	
	// for SELECT, SHOW, DESCRIBE, or EXPLAIN collect the results into an array and return them	
	$resArr = array();
	while (($row = mysqli_fetch_assoc ($result)) != false) {
		$resArr[] = $row;
	}	
	return $resArr;
}

function MYSQLClose ($link) {
	mysqli_close ($link);
}
?>
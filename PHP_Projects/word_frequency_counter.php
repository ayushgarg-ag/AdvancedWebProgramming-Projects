<!DOCTYPE html>
<?php include "library.php"; ?>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
<!--
  Assignment: Word Frequency
  Name: Ayush Garg
  Extensions: 1) Added two additional keys to the URL ('sort' and 'order')
              2) Separate file-list column which presents the user with a list of text files in the folder
              3) Statistics about the word count
              4) Separate by sentences
-->
<title>Word Frequency</title>
<style>
body{
    font-family: 'Lora', serif;
    background-color: #3E7CB1;
    /*scrollbar-base-color: #367CD2;*/
}
h2 {
    text-decoration: underline;
}
#text, #count, #files {
    border: 1px solid black;
    position: fixed;
    top: 50px;
    bottom: 50px;
    width: 28%;
    height: 500px;
    text-align: center;
    background-color: rgba(201,236,255, .8);
}
div#text {
    left: 5%;
    overflow-y: scroll;
}
div#count {
    left: 36%;
    overflow-y: scroll;
}
div#files {
    left: 67%;
}
body {
    background: url(../nice.jpg);
}
</style>
</head>
<body>

<?php
$fname = getValue('file', 'samples/sample5.txt');
$sort = getValue('sort', 'count');
$order = getValue('order');
$length = 0;
$count = 0;
if ($fname == false) {
    exit("Not real file.");
}
echo "<div id = 'text'>";
$lines = file($fname);
echo "<h2>File: $fname</h2><br>";
    $everything = "";
foreach($lines as $line) {
    $everything = "$everything$line";
}

$sentences = explode('.', $everything);
$sentence = array();
foreach($sentences as $line) {
    $word = explode('!', $line);

    foreach($word as $lines) {
        $words = explode('?', $lines);
        foreach($words as $key => $values) {
            $sentence[] = $values;
        }
    }
}

for ($i = 1; $i < count($sentence); $i++) {
        echo $sentence[$i] . "<br><br>\n";
}

echo "</div>";

$wordCount = array();

// var_dump ($sentence);
echo "<div id = 'count'><h2>Word Frequency Counter</h2>";
foreach($sentence as $line) {
    $char = array(',', '.', '?', '!', '/', '`', '-', '+', '*', '^', '~', '"', '\'');
    for ($i = 0; $i < count($char); $i++) {
        $character = $char[$i];
        $line = str_replace($character, "", $line);
    }
    $line = strtolower($line);
    $line = trim($line);
    $words = explode(' ', $line);


    foreach($words as $word) {
        if ($word != "") {
            if (array_key_exists($word, $wordCount) == true) {
                $wordCount[$word]++;
            }
            else {
                $wordCount[$word] = 1;
            }
        }
    }
}

if (isset($sort) || isset($order)) {
    if ($sort == 'word') {
        if ($order == 'asc') {
            ksort($wordCount);
        }
        else if ($order == 'desc') {
            krsort($wordCount);
        }
        else {
            ksort($wordCount);
        }
    }
    else if ($sort == 'count') {
        asort($wordCount);
        if ($order == 'asc') {
            // $sort = false;
            asort($wordCount);
        }
        else if ($order == 'desc') {
            // $sort = false;
            arsort($wordCount);
        }

    }
    else if ($order == 'asc' || ($sort == 'count' && $order == 'asc')) {
        $sort = false;
        asort($wordCount);
    }
    else if ($order == 'desc' || ($sort == 'count' && $order == 'desc')) {
        $sort = false;
        arsort($wordCount);
    }
    else {
        return false;
    }
}
foreach($wordCount as $word => $count1) {
    echo "$word: $count1<br>\n";
    if ($count1 > 1) {
        $len = strlen($word) * $count1;
    }
    else {
        $len = strlen($word);
    }
    $length = $length + $len;
    $count = $count + $count1;
    $counting = count($wordCount);
}
echo "</div>";
echo "<div id = 'files'><h2>Sample Text Files</h2>";
$files = scandir('../Unit2/samples/');

foreach($files as $file) {
        $last3 = substr($file, -3);
        if ($last3 == 'txt') {
            echo "<a href='Assignment2.3.php?file=samples/$file'>$file</a><br>\n";
        }
    }
$average = $length / $count;
$round = round($average, 2);
echo "<h2>Word Count Statistics</h2>Average Word Length: $round<br>";
echo "Total Letters: $length<br>Total Words: $count<br>Unique Words: $counting<br>";
echo "</div>";

?>

</body>
</html>
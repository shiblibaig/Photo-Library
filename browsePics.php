<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse!</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="icon" href="P.png">
</head>
<body>
<H1 align="center">A place to see all pics.</H1>
<?php
$con = mysqli_connect('localhost','shibli','shibli');
mysqli_select_db($con,'piclib');
$i=1;
$res = mysqli_query($con,'select image from imgdata;');
while($row = mysqli_fetch_row($res)){
    echo $row[0];
    $i++;
    if($i%3){
        print('\n');
        echo '<br/>';
    }
}
?>
</body>
</html>
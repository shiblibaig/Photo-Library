<?php
/**
 * Created by PhpStorm.
 * User: hp1
 * Date: 05-12-2015
 * Time: 01:42
 */
$con = mysqli_connect('localhost','shibli','shibli');
if(!$con)
{
    die('No connection because, ' . mysqli_errno($con));
}
mysqli_select_db($con,'piclib');
echo $_POST['username']."+=+".$_POST['password'];
session_start();
$row2=0;
$_SESSION['typo']="login";

if(empty($_POST['username']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.css");
if(empty($_POST['password']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
$query1=0;
$query1 = "select count(*)from users where uname = '$_POST[username]';";
$result1 = mysqli_query($con,$query1);
$row1 = mysqli_fetch_row($result1);
if($row1[0]>0){
    $query2 = "select * from users where uname = '$_POST[username]';";
    $result2 = mysqli_query($con,$query2);
    $row2 = mysqli_fetch_row($result2);
    if($row2[2]==$_POST['password']){
        $_SESSION['user']= $_POST['username'];
        $_SESSION['contact']=$row2[4];
        header("location: http://localhost:63342/VideoLibraryApp/views/displayLogged.php");
    }
    else{
        header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
    }
}
else{
    header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
}
if(!mysqli_query($con,$query1)){
    echo 'No conn...';
}
mysqli_close($con);
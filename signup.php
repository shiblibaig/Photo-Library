<?php
/**
 * Created by PhpStorm.
 * User: hp1
 * Date: 02-12-2015
 * Time: 16:56
 */
$con = mysqli_connect('localhost','shibli','shibli');
if(!$con)
{
    die('No connection because, ' . mysqli_errno($con));
}
session_start();
$_SESSION['typo']="signup";
mysqli_select_db($con,'piclib');
if(empty($_POST['name']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if(empty($_POST['username']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if(empty($_POST['password']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if(empty($_POST['repassword']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if($_POST['password']!=$_POST['repassword'])header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if(empty($_POST['age']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if($_POST['age']>99 || $_POST['age']<10)header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if(empty($_POST['email']))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
if(!strstr($_POST['email'],'@') || !strstr($_POST['email'],'.'))header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
//enter an email check !
$query1 = "insert into piclib.users values ('$_POST[name]','$_POST[username]','$_POST[password]','$_POST[age]','$_POST[email]');";
$_SESSION['user']=$_POST['username'];
$_SESSION['contact']=$_POST['email'];
if(!mysqli_query($con,$query1)){
    echo 'No execution '.mysqli_error($con);
}
mysqli_close($con);
header("location: http://localhost:63342/VideoLibraryApp/views/displayLogged.php");

<?php
session_start();
$con = mysqli_connect('localhost','shibli','shibli');
if(!$con)
{
    die('No connection because, ' . mysqli_errno($con));
}
mysqli_select_db($con,'piclib');
//in place of image ID create a randomization code.
$query1 = "select image from imgdata where imageID=3";
$res1 = mysqli_query($con,$query1);
$row1 = mysqli_fetch_row($res1);
$check=0;
$_SESSION['typo']="logged";
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <!----->
    <link rel="icon" href="P.png">
    <link rel="stylesheet" href="//codepen.io/assets/reset/normalize.css">
    <link rel="stylesheet prefetch" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,700italic,400italic">
    <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script>
        window.console = window.console || function(t) {};
    </script>
    <!----->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="animate.css">
    <meta charset="UTF-8">
    <title>Your Desk</title>
</head>
<body id="dispbody">
<div align="right" class="animated fadeInLeftBig" id="dispdiv1">
    <h1>User: '; echo $_SESSION['user']; echo'</h1>
    <h1>Contact: '; echo $_SESSION['contact']; echo '</h1>
</div>
<div id="dispdiv2">
    <a id="modal_trigger" href="#modal" class="btn">Show me my Pics!</a>
    <div id="modal" class="popupContainer" style="display:none;">
        <header class="popupHeader">
            <span class="header_title">Enter the Name/ID of Pic</span>
            <span class="modal_close"><i class="fa fa-times"></i></span>
        </header>
        <section class="popupBody">
            <form method="post" action="displayOnly.php">
                <input name ="imagesignal" type="text">
                <input type="submit" name="subbut">
            </form>
        </section>
    </div>
    <br/>
    <form method="post" action="originsert.php">
        <input value="Upload Pics!" type="submit" id="upldpic">
    </form>
</div>
<div id="image1">
    <img id="im1" src="imageshow/file_display.php" width="200" height="200" alt="No image in your database."/>
</div>
<script src="//assets.codepen.io/assets/common/stopExecutionOnTimeout-f961f59a28ef4fd551736b43f94620b5.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://andwecode.com/wp-content/uploads/2015/10/jquery.leanModal.min_.js"></script>

<script src ="my_js.js"></script>


<script>
    if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
}
</script>

</body>
</html>';

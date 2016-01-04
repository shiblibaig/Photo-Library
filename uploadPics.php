<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <link rel="icon" href="P.png">
    <link rel="stylesheet" href="animate.css">
    <title>Upload Image</title>
</head>
<body>
<div id="main">
    <div align="center" id ="h11">
        <h2>Choose a file to upload!</h2>
    </div>
    <div align="center" id="uplddiv1">
        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input id="inputfile" name="userfile" type="file"/>
            <br/>
            <h4>Give a name for the image:</h4>
            <input type="text" name="imageName">
            <br/><br/>
            <input type="submit" id="btn2" value="PUSH!!"/>
        </form>
    </div>
</div>
<?php
$msg=0;
session_start();
if(isset($_FILES['userfile'])){
    try {
        $msg= upload();
        echo $msg;
    }
    catch(Exception $e) {
        echo $e->getMessage();
        echo 'Sorry, could not upload file';
    }
}

function get_extension($file) {
$extension = end(explode(".", $file));
return $extension;
}
function upload() {
    $msg =9;
    $con = mysqli_connect('localhost','shibli','shibli');
    mysqli_select_db ($con,'piclib');
    $imaget = mysqli_real_escape_string($con,$_FILES["userfile"]["type"]);
    $f = substr($imaget,0,5);
    if($f=="image"){
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
            header("location: http://localhost:63342/VideoLibraryApp/views/fun.php");
        }
        $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
        $ext = get_extension($_FILES['userfile']['name']);
        $query2= " Select max(imageID) from imgdata;";
        $result2 = mysqli_query($con,$query2);
        $row2 = mysqli_fetch_row($result2);
        $r = $row2[0]+1;
        $sql = "INSERT INTO imgdata values($r,'$ext','$_POST[imageName]','$_POST[user]','{$imgData}')";
        mysqli_query($con,$sql) or die("Error in Query: " . mysqli_error($con));
        header("location: http://localhost:63342/VideoLibraryApp/views/displayLogged.php");
    }
    else{
        //$finfo = finfo_open(FILEINFO_MIME_TYPE);
        //finfo_file($finfo, $_FILES['userfile']['tmp_name']);
        header("location: http://localhost:63342/VideoLibraryApp/views/main.css");
    }
    return $msg;
}
?>
</body>
</html>
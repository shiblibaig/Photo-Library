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
        <!--<form enctype="multipart/form-data" action="<?php// echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input name="userfile" type="file" />
            <input type="submit" value="Submit" />
        </form>-->
        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input  type="file" name="userfile"/>
            <br/>
            <h4>Give a name for the image:</h4>
            <input type="text" name="imageName">
            <br/><br/>
            <input type="submit" id="btn2" value="PUSH!!"/>
        </form>
    </div>
</div>
<?php
session_start();
// check if a file was submitted
if(!isset($_FILES['userfile']))
{
    echo '<p></p>';
}
else
{
    try {
        $msg= upload();  //this will upload your image
        echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
        echo $e->getMessage();
        echo 'Sorry, could not upload file';
    }
}

// the upload function
function get_extension($file) {
    $extension = end(explode(".", $file));
    return $extension;
}
function upload() {
    $maxsize = 10000000; //set to approx 10 MB

    //check associated error code
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {

        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['userfile']['tmp_name']))    {

            //checks size of uploaded image on server side
            if( $_FILES['userfile']['size'] < $maxsize) {

                //checks whether uploaded file is of image type
                //if(strpos(mime_content_type($_FILES['userfile']['tmp_name']),"image")===0) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {

                    // prepare the image for insertion
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));

                    // put the image in the db...
                    // database connection
                    $con = mysqli_connect('localhost','shibli','shibli') OR DIE (mysqli_error($con));

                    // select the db
                    mysqli_select_db ($con,'piclib') OR DIE ("Unable to select db".mysqli_error($con));

                    // our sql query
                    $ext = get_extension($_FILES['userfile']['name']);
                    $query2= " Select max(imageID) from imgdata;";
                    $result2 = mysqli_query($con,$query2);
                    $row2 = mysqli_fetch_row($result2);
                    $r = $row2[0]+1;
                    $sql = "INSERT INTO imgdata values($r,'$ext','$_POST[imageName]','$_POST[user]','{$imgData}')";
                    header('location: http://localhost:63342/VideoLibraryApp/views/displayLogged.php');
                    // insert the image
                    mysqli_query($con,$sql) or die("Error in Query: " . mysqli_error($con));
                    $msg='<p>Image successfully saved in database with id ='. mysqli_insert_id($con).' </p>';
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
            else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
                    ' bytes</div><hr />';
            }
        }
        else
            $msg="File not uploaded successfully.";

    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    return $msg;
}

// Function to return error message based on error code

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>
</body>
</html>
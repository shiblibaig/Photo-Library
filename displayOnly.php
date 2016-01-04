<?php
session_start();
error_reporting(E_ALL);
$con = mysqli_connect("localhost", "shibli", "shibli");
mysqli_select_db($con,'piclib');
$id = settype($_POST['imagesignal'],"integer");

if(is_numeric($_POST['imagesignal'])){
    $query3 = "select count(*) from imgdata where imageID = '$id';";
    $result3 = mysqli_query($con,$query3);
    $row3 = mysqli_fetch_row($result3);
    if($row3[0]==0){
        echo 'No image for you!';
    }
    else{
        $query4 = "select image from imgdata where imageID = '$id';";
        $result4 = mysqli_query($con,$query4);
        $row4 = mysqli_fetch_row($result4);
        echo $row4[0];
        echo '<html>
               <body>
               <div>
               <form method="post" action="displayLogged.php">
               <input type="submit" value="Go to Dash!">
               </form>
               <br/><br/>
               <p>Next pic function is still being buillt. Apologies for inconvenience.</p>
               </div>
               </body>
               </html>';
               }
}
else{
    $query5 = "select count(*) from imgdata where imageName = '$_POST[imagesignal]';";
    $result5 = mysqli_query($con,$query5);
    $row5 = mysqli_fetch_row($result5);
    if($row5[0]==0){
        echo 'No image for you!';
    }
    else{
        $queery6 = "select image from imgdata where imageName = '$_POST[imagesignal]';";
        $result6 = mysqli_query($con,$queery6);
        $row6 = mysqli_fetch_row($result6);
        echo $row6[0];
        echo '<html>
               <body>
               <div>
               <form method="post" action="displayLogged.php">
               <input type="submit" value="Go to Dash!">
               </form>
               <br/><br/>
               <p>Next pic function is still being buillt. Apologies for inconvenience.</p>
               </div>
               </body>
               </html>';
    }
}
mysqli_select_db($con,'piclib');
$query1 = "select count(*) from imgdata where imageUser = '$_POST[user]';";
$result1 = mysqli_query($con,$query1);
$row1 = mysqli_fetch_row($result1);
if($row1[0]==0){
    echo 'No image!';
}
else{
    $sql = "SELECT image FROM imgdata where imageID = '$_POST[id]';";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    header("Content-type: image/png");
    echo $row[0];
}
mysqli_close($con);
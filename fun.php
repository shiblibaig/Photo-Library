<?php
session_start();
echo'
<html>
<head>
    <link rel="stylesheet" href="experimental.css">
</head>
<title>ERROR!</title>
<body id = "funbd">
';
if($_SESSION['typo']=="login"){
    echo'<div class="confirm">
    <h1>Wait!</h1>
    <p>Hey, there was some issue, I would request you to re-fill or re-upload.</p>
    <form action="loginPage.html">
        <button>OK!</button>
    </form>
</div>
</body>
</html>';
}
else if($_SESSION['typo']=="signup") {
    echo '<div class="confirm">
    <h1>Wait!</h1>
    <p>Hey, there was some issue, I would request you to re-fill or re-upload.</p>
    <form action="signupPage.html">
        <button>OK!</button>
    </form>
</div>
</body>
</html>';
}
elseif($_SESSION['typo']=="logged"){
    echo '<div class="confirm">
    <h1>Wait!</h1>
    <p>Hey, there was some issue, I would request you to re-fill or re-upload.</p>
    <form action="displayLogged.php">
        <button>OK!</button>
    </form>
</div>
</body>
</html>';
}


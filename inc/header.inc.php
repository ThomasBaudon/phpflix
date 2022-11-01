<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPFLIX - regardez des futurs dev’ se planter lamentablement !</title>
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <header>
            <a href="index.php"><img src="./img/phpflix-logo.svg" alt="phpflix logo" class="logo"></a>

            <?php if(userConnected()): ?>

                <a href="<?php URL?>index.php?action=deconnexion"> DECONNEXION  &#x21e8;</a>

            <?php else: ?>
            
            <a href="inscription.php"> INSCRIVEZ-VOUS  &#x21e8;</a>
            <?php endif ?>
    </header>
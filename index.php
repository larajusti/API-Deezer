<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deezer-API</title>
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- <img class="mx-auto d-block" src="./images/Deezerlogo.png" height="80px" width="120px"> -->
    <div class="container pt-3">
        <div class="row">
            <form class="mt-5 input-group" action="." method="post">
                <input class="col-5 input" type="text" placeholder="Nome do artista..." name="artist" value="">
                <input class="col-2 btn btn-dark btn-lg" type="submit" name="btn-submit" value="Buscar">
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['artist'])) {
        include_once('search.php');
    }
    ?>
    <h1 class="text-center mt-4 display-4"><?php echo $artistName ?></h1>

    <div class="container mt-5">
        <div class="row">
            <img class="col-sm-5 rounded" src="<?php echo $artistImage ?>">
            <ul class="col-sm-7 text-center list-group">
                <?php if ($artistName == '') {
                    echo '';
                } else {
                    echo getTracks($trackList);
                }  ?></ul>
        </div>
    </div>

</body>

</html>
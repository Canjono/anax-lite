<?php
$myStylesheet = $app->url->asset("style/style.css");
?>

<!doctype html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>

    <!-- Get bootstrap stylesheet -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= $myStylesheet ?>" rel="stylesheet">

</head>
<body role="document">
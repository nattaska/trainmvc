<!DOCTYPE html>
<html>
<head>
    <!-- <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <title>MVC Train</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
    <?php 
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
            }
        }
    ?>
</head>
<body>

<?php Session::init() ?>
<div id="header" >
    header <br/>
    <a href="<?php echo URL; ?>index">Index</a>
    <a href="<?php echo URL; ?>help">Help</a>
    <?php if (Session::get('loggedIn') == true): ?>
        <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
    <?php else: ?>
        <a href="<?php echo URL; ?>login">Login</a>
    <?php endif; ?>

</div>

<div id="content">
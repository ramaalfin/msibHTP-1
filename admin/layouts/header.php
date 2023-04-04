<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>

    <!-- CSS -->
    <?php
    if (isset($style)) {
        foreach ($style as $s) {
    ?>
            <link rel="stylesheet" href="<?php echo $s; ?>">
    <?php
        }
    }
    ?>

    <!-- script -->
    <?php
    if (isset($script)) {
        foreach ($script as $s) {
    ?>
            <script crossorigin="anonymous" src="<?php echo $s; ?>"></script>
    <?php
        }
    }
    ?>
</head>
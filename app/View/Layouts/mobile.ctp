<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    <base href="<?php echo Router::url("/", true); ?>" />
    <meta name="viewport" content="width=device-width,
                                   initial-scale=1.0,
                                   maximum-scale=1.0,
                                   user-scalable=no,
                                   minimal-ui">
    <link rel="stylesheet" href="//cdn.kik.com/app/3.0.0/app.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css"/>
    <script src="//code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <?= $this->Html->script('mobile') ?>
    <?= $this->Html->css('mobile') ?>
</head>
<body>
    <!-- put your pages here -->
    <script src="//zeptojs.com/zepto.min.js"></script>
    <script src="//cdn.kik.com/app/3.0.0/app.min.js"></script>
    <?php echo $this->fetch('content'); ?>
</body>
</html>


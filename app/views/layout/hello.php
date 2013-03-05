<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Hello</title>
</head>
<body>
    <div>
        <?php echo $content ?>
    </div>

    <div>
        <ul>
            <li><a href="<?php echo url('default/index') ?>">Home</a></li>
            <li><a href="<?php echo url('hello/index') ?>">Say hello</a></li>
            <li><a href="<?php echo url('hello/show_registration') ?>">Register form</a></li>
        </ul>
    </div>
</body>
</html>

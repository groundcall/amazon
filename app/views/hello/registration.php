<?php $view->extend('layout/hello') ?>

<h1>Enter your details below</h1>

<?php $view->render('hello/_form', array('user' => $user)) ?>

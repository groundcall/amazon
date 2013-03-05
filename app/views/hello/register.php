<?php $view->extend('layout/hello') ?>

<h1>Review your details and correct the mistakes</h1>

<?php $view->render('hello/_form', array('user' => $user)) ?>

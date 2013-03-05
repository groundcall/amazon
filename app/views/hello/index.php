<?php $view->extend('layout/hello') ?>

<form action="<?php echo url('hello/sayHello'); ?>" method="post">
    <div>
        <label>Name:</label>
        <input type="text" name="name">
    </div>

    <div>
        <input type="submit">
    </div>
</form>


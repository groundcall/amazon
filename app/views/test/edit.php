Edit user <?php echo $user->getId() ?>

<form action="<?php echo url('test/update', array('id' => $user->getId())); ?>" method="post">
    <div>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user->getUsername()?>">
    </div>

    <div>
        <input type="submit">
        <a href="<?php echo url("test/index") ?>">Cancel</a>
    </div>
</form>

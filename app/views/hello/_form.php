<form action="<?php echo url('hello/register') ?>" method="POST">
    <ul>
        <li>
            <label>First Name:</label>
            <input type="text" name="user[firstName]" value="<?php echo $user->getFirstName() ?>">
            <span><?php echo $view->errorFor($user, 'firstName') ?></span>
        </li>

        <li>
            <label>Last Name:</label>
            <input type="text" name="user[lastName]" value="<?php echo $user->getLastName()?>">
            <span><?php echo $view->errorFor($user, 'lastName') ?></span>
        </li>

        <li>
            <label>Email:</label>
            <input type="text" name="user[email]" value="<?php echo $user->getEmail() ?>">
            <span><?php echo $view->errorFor($user, 'email') ?></span>
        </li>
        <li><input type="submit" name="submit" value="Register" /></li>
    </ul>
</form>

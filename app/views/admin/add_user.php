<?php $view->extend('masterpages/cpanel'); ?>

<div id="page-heading"><h1>Add user</h1></div>

<?php if (isset($_POST['submit'])): ?>
    <!--  start message-red -->
    <?php if ($user != null): ?>
        <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="red-left">Error. <a href="<?php echo url('admin_users/add_user'); ?>">Please try again.</a></td>
                    <td class="red-right"><a class="close-red" href="<?php echo url('admin_users'); ?>"><img src="../images/table/icon_close_red.gif"   alt="" /></a></td>
                </tr>
            </table>
        </div>
        <!--  end message-red -->

        <!--  start message-green -->
    <?php else: ?>
        <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="green-left">User added sucessfully. <a href="<?php echo url('admin_users/add_user'); ?>">Add new one.</a></td>
                    <td class="green-right"><a class="close-green" href="<?php echo url('admin_users'); ?>"><img src="../images/table/icon_close_green.gif"   alt="" /></a></td>
                </tr>
            </table>
        </div>
        <!--  end message-green -->
    <?php endif; ?>
<?php endif; ?>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
    <tr>
        <th rowspan="3" class="sized"><img src="../images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="../images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
    </tr>
    <tr>
        <td id="tbl-border-left"></td>
        <td>
            <!--  start content-table-inner -->
            <div id="content-table-inner">

                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                        <td>
                            <!-- start id-form -->
                            <form method="post" action="<?php echo url('admin_users/add_user'); ?>">
                                <table border="0" cellpadding="0" cellspacing="0"  id="id-form">

                                    <tr>
                                        <th valign="top">Username:</th>
                                        <td><input type="text" class="inp-form" name="data[username]" value="<?php echo ($user) ? $user->getUsername() : ""; ?>" /></td>
                                        <td>
                                            <?php if ($user && $user->hasError('username')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, "username"); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">First Name:</th>
                                        <td><input type="text" class="inp-form" name="data[firstname]" value="<?php echo ($user) ? $user->getFirstname() : ""; ?>"/></td>
                                        <td>
                                            <?php if ($user && $user->hasError('firstname')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'firstname'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Last Name:</th>
                                        <td><input type="text" class="inp-form" name="data[lastname]" value="<?php echo ($user) ? $user->getLastname() : ""; ?>"/></td>
                                        <td>
                                            <?php if ($user && $user->hasError('lastname')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'lastname'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Password:</th>
                                        <td><input type="password" class="inp-form" name="data[password]" value="" /></td>
                                        <td>
                                            <?php if ($user && $user->hasError('password')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'password'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Retype Password:</th>
                                        <td><input type="password" class="inp-form" name="data[password2]" value="" /></td>
                                        <td>
                                            <?php if ($user && $user->hasError('password2')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'password2'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Email:</th>
                                        <td><input type="text" class="inp-form" name="data[email]" value="<?php echo ($user) ? $user->getEmail() : ""; ?>" /></td>
                                        <td>
                                            <?php if ($user && $user->hasError('email')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'email'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Phone:</th>
                                        <td><input type="text" class="inp-form" name="data[phone]" value="<?php echo ($user) ? $user->getPhone() : ""; ?>" /></td>
                                        <td>
                                            <?php if ($user && $user->hasError('phone')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'phone'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th valign="top">Gender:</th>
                                        <td>
                                            <input type="radio" name="data[gender]" value="M" <?php echo ($user && $user->getGender()=='M')? 'checked' : ''; ?>>M                                   
                                            <input type="radio" name="data[gender]" value="F" <?php echo ($user && $user->getGender()=='F')? 'checked' : ''; ?>>F
                                        </td>
                                        <td>
                                            <?php if ($user && $user->hasError('gender')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner"><?php echo $view->errorFor($user, 'gender'); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th>&nbsp;</th>
                                        <td valign="top">
                                            <input type="submit" value="Add" class="form-submit" name='submit' />
                                            <a href="<?php echo url('admin_users/show_user_form'); ?>" class="form-reset" ></a>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </form>
                            <!-- end id-form  -->
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
                        <td></td>
                    </tr>
                </table>
                <div class="clear"></div>
            </div>
            <!--  end content-table-inner  -->
        </td>
        <td id="tbl-border-right"></td>
    </tr>
    <tr>
        <th class="sized bottomleft"></th>
        <td id="tbl-border-bottom">&nbsp;</td>
        <th class="sized bottomright"></th>
    </tr>
</table>
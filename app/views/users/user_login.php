<?php $view->extend('masterpages/products'); ?>

<div class="account-login">
    <div class="page-title">
        <h1>Login or Create an Account</h1>
    </div>
    <form action="<?php echo url('users/login'); ?>" method="post" id="login-form">
        <div class="col2-set">
            <div class="col-1 new-users">
                <div class="content">
                    <h2>New Customers</h2>
                    <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                </div>
            </div>
            <div class="col-2 registered-users">
                <div class="content">
                    <h2>Registered Customers</h2>
                    <p>If you have an account with us, please log in.</p>
                    <ul class="form-list">
                        <li>
                            <label for="email" class="required"><em>*</em>Email Address</label>
                            <div class="input-box">
                                <input type="text" name="email" value="<?php echo isset($userLogin) ? $userLogin->getEmail() : ''; ?>" id="email" class="input-text required-entry <?php echo (isset($userLogin) && $view->errorFor($userLogin, "email")) ? ' validation-failed' : '' ?>" title="Email Address" />
                                <?php if (isset($userLogin) && $userLogin->hasError('email')): ?>
                                    <?php $emailError = explode(",", $view->errorFor($userLogin, "email")); ?> 
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $emailError[0]; ?></div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <label for="password" class="required"><em>*</em>Password</label>
                            <div class="input-box">
                                <input type="password" name="password" class="input-text required-entry <?php echo (isset($userLogin) && $view->errorFor($userLogin, "password")) ? ' validation-failed' : '' ?>" id="pass" title="Password" />
                                <?php if (isset($userLogin) && $userLogin->hasError('password')): ?>
                                    <?php $passwordError = explode(",", $view->errorFor($userLogin, "password")); ?>
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $passwordError[0]; ?></div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <p class="input-box" style="color: red;">* Required Fields</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col2-set">
            <div class="col-1 new-users">
                <div class="buttons-set">
                    <button type="button" title="Create an Account" class="button" onclick="window.location = '<?php echo url('users/show_user_form'); ?>';"><span><span>Create an Account</span></span></button>
                </div>
            </div>
            <div class="col-2 registered-users">
                <div class="buttons-set">
                    <a href="<?php echo url('users/forgot_password'); ?>" class="f-left">Forgot Your Password ?</a>
                    <button type="submit" class="button" title="Login" name="send" id="send2"><span><span>Login</span></span></button>
                </div>
            </div>
        </div>
    </form>
</div>

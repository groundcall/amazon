<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>

        <div class="wrapper">
            <div class="page">
                
                <?php $view->render('users/user_navigation'); ?>
                
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <div class="account-create">
                                <form action="<?php echo url('users/change_password'); ?>" method="post" id="newsletter-validate-detail">
                                    <div class="fieldset">
                                        <h2 class="legend">Reset password</h2>

                                        <div>
                                            <fieldset>
                                                <h4>Reset yout password</h4>
                                                <ul class="form-list">
                                                    <li>
                                                        <label for="password" class="required"><em>*</em>New password</label>
                                                        <div class="input-box">
                                                            <input class="input-text required-entry <?php echo (isset($resetPassword) && $view->errorFor($resetPassword, "password")) ? ' validation-failed' : '' ?>" id="email" name="password" type="password" />
                                                            <?php if (isset($resetPassword) && $resetPassword->hasError('password')): ?>
                                                                <?php $passwordError = explode(",", $view->errorFor($resetPassword, "password")); ?> 
                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $passwordError[0]; ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <ul class="form-list">
                                                    <li>
                                                        <label for="password2" class="required"><em>*</em>Confirm your new password</label>
                                                        <div class="input-box">
                                                            <input class="input-text required-entry <?php echo (isset($resetPassword) && $view->errorFor($resetPassword, "password2")) ? ' validation-failed' : '' ?>" id="email" name="password2" type="password" />
                                                            <?php if (isset($resetPassword) && $resetPassword->hasError('password2')): ?>
                                                                <?php $password2Error = explode(",", $view->errorFor($resetPassword, "password2")); ?> 
                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $password2Error[0]; ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <input name="context" value="checkout" type="hidden" />
                                            </fieldset>
                                        </div>
                                        <div>
                                            <div class="buttons-set">
                                                <p class="required">* Required Fields</p>
                                                <button type="submit" class="button"><span><span>Reset password</span></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="buttons-set">
                                <p class="back-link"><a href="<?php echo url('users/show_login_form'); ?>" class="back-link"><small>&laquo; </small>Back</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-container">
                <div class="footer">
                    <?php $view->render('users/user_footer'); ?>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
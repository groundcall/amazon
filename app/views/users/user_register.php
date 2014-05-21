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
                                <div class="page-title">
                                    <h1>Create an Account</h1>
                                </div>
                                <form action="<?php echo url('users/add_user'); ?>" method="post" id="form-validate">
                                    <div class="fieldset">
                                        <input type="hidden" name="success_url" value="" />
                                        <input type="hidden" name="error_url" value="" />
                                        <h2 class="legend">Personal Information</h2>
                                        <ul class="form-list">
                                            <li class="fields">
                                                <div class="customer-name">
                                                    <div class="field name-firstname">
                                                        <label for="firstname" class="required"><em>*</em>First Name</label>
                                                        <div class="input-box">
                                                            <input type="text" id="firstname" name="data[firstname]" value="<?php echo ($user) ? $user->getFirstname() : ""; ?>" title="First Name" maxlength="255" class="input-text required-entry <?php echo ($user->errorFor($user, "firstname"))? ' validation-failed' : '' ?>"  />
                                                            <?php if ($user->hasError('firstname')): ?>
                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "firstname"); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="field name-lastname">
                                                        <label for="lastname" class="required"><em>*</em>Last Name</label>
                                                        <div class="input-box">
                                                            <input type="text" id="lastname" name="data[lastname]" value="" title="Last Name" maxlength="255" class="input-text required-entry validation-failed"  />
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="field">
                                                    <label for="email_address" class="required"><em>*</em>Email Address</label>
                                                    <div class="input-box">
                                                        <input type="text" name="email" id="email_address" value="" title="Email Address" class="input-text validate-email required-entry" />
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <label for="mobile">Mobile</label>
                                                    <div class="input-box">
                                                        <input type="text" name="mobile" id="mobile" value="" title="Mobile" class="input-text" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="field">
                                                    <label>Gender</label>
                                                    <div class="input-box">
                                                        <input type="radio" name="gender" title="Female" value="0" id="gender-female" class="radio" />Female
                                                        <input type="radio" name="gender" title="Male" value="1" id="gender-male" class="radio" />Male
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <label for="education" class="required">Education</label>
                                                    <div class="input-box">
                                                        <select name="education" title="Education" id="education" class="select">
                                                            <option value="0"></option>
                                                            <option value="1">Under graduate</option>
                                                            <option value="2">Graduate</option>
                                                            <option value="3">University</option>
                                                            <option value="4">Post university</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fieldset">
                                        <h2 class="legend">Login Information</h2>
                                        <ul class="form-list">
                                            <li>
                                                <label for="username" class="required"><em>*</em>Username</label>
                                                <div class="input-box">
                                                    <input type="text" name="username" id="username" value="" title="Username" class="input-text required-entry" />
                                                </div>
                                            </li>
                                            <li class="fields">
                                                <div class="field">
                                                    <label for="password" class="required"><em>*</em>Password</label>
                                                    <div class="input-box">
                                                        <input type="password" name="password" id="password" title="Password" class="input-text required-entry validate-password" />
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <label for="confirmation" class="required"><em>*</em>Confirm Password</label>
                                                    <div class="input-box">
                                                        <input type="password" name="confirmation" title="Confirm Password" id="confirmation" class="input-text required-entry validate-cpassword" />
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div id="window-overlay" class="window-overlay" style="display:none;"></div>
                                        <div id="remember-me-popup" class="remember-me-popup" style="display:none;">
                                            <div class="remember-me-popup-head">
                                                <h3>What's this?</h3>
                                                <a href="#" class="remember-me-popup-close" title="Close">Close</a>
                                            </div>
                                            <div class="remember-me-popup-body">
                                                <p>Checking &quot;Remember Me&quot; will let you access your shopping cart on this computer when you are logged out</p>
                                                <div class="remember-me-popup-close-button a-right">
                                                    <a href="#" class="remember-me-popup-close button" title="Close"><span>Close</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons-set">
                                        <p class="required">* Required Fields</p>
                                        <p class="back-link"><a href="/login.html" class="back-link"><small>&laquo; </small>Back</a></p>
                                        <button type="submit" title="Submit" class="button"><span><span>Submit</span></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-container">
                    <?php $view->render('users/user_footer'); ?>
                </div>
            </div>
        </div>
    </body>
</html>

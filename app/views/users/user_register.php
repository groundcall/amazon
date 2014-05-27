<?php $view->extend('masterpages/products'); ?>

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
                                    <input type="text" id="firstname" name="data[firstname]" value="<?php echo ($user) ? $user->getFirstname() : ""; ?>" title="First Name" maxlength="255" class="input-text required-entry <?php echo ($user && $view->errorFor($user, "firstname")) ? ' validation-failed' : '' ?>"  />
                                    <?php if ($user && $user->hasError('firstname')): ?>
                                        <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "firstname"); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="field name-lastname">
                                <label for="lastname" class="required"><em>*</em>Last Name</label>
                                <div class="input-box">
                                    <input type="text" id="lastname" name="data[lastname]" value="<?php echo ($user) ? $user->getLastname() : ""; ?>" title="Last Name" maxlength="255" class="input-text required-entry <?php echo ($user && $view->errorFor($user, "lastname")) ? ' validation-failed' : '' ?>"  />
                                    <?php if ($user && $user->hasError('lastname')): ?>
                                        <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "lastname"); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="field">
                            <label for="email_address" class="required"><em>*</em>Email Address</label>
                            <div class="input-box">
                                <input type="text" name="data[email]" id="email_address" value="<?php echo ($user) ? $user->getEmail() : ""; ?>" title="Email Address" class="input-text validate-email required-entry <?php echo ($user && $view->errorFor($user, "email")) ? ' validation-failed' : '' ?>" />
                                <?php if ($user && $user->hasError('email')): ?>
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "email"); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field">
                            <label for="mobile">Mobile</label>
                            <div class="input-box">
                                <input type="text" name="data[phone]" id="mobile" value="<?php echo ($user) ? $user->getPhone() : ""; ?>" title="Mobile" class="input-text <?php echo ($user && $view->errorFor($user, "phone")) ? ' validation-failed' : '' ?>" />
                                <?php if ($user && $user->hasError('phone')): ?>
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "phone"); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="field">
                            <label>Gender</label>
                            <div class="input-box">
                                <input type="radio" name="data[gender]" title="Female" value="F" id="gender-female" class="radio" <?php echo ($user && $user->getGender() == 'F') ? 'checked' : ''; ?>/>Female
                                <input type="radio" name="data[gender]" title="Male" value="M" id="gender-male" class="radio" <?php echo ($user && $user->getGender() == 'M') ? 'checked' : ''; ?>/>Male
                                <?php if ($user && $user->hasError('gender')): ?>
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "gender"); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field">
                            <label for="education" class="required">Education</label>
                            <div class="input-box">
                                <select name="data[education]" title="Education" id="education" class="select">
                                    <?php $education = $view->getEducations(); ?>
                                    <?php foreach ($education as $edu): ?>
                                        <option value="<?php echo $edu->getId(); ?>" <?php echo ($user && $user->getEducation_id() == $edu->getId()) ? 'selected' : ''; ?>><?php echo $edu->getDescription(); ?></option>
                                    <?php endforeach; ?> 
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
                            <input type="text" name="data[username]" id="username" value="<?php echo ($user) ? $user->getUsername() : ""; ?>" title="Username" class="input-text required-entry <?php echo ($user && $view->errorFor($user, "username")) ? ' validation-failed' : '' ?>" />
                            <?php if ($user && $user->hasError('username')): ?>
                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "username"); ?></div>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="fields">
                        <div class="field">
                            <label for="password" class="required"><em>*</em>Password</label>
                            <div class="input-box">
                                <input type="password" name="data[password]" id="password" title="Password" class="input-text required-entry <?php echo ($user && $view->errorFor($user, "firstname")) ? ' validation-failed' : '' ?>" />
                                <?php if ($user && $user->hasError('password')): ?>
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "password"); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="field">
                            <label for="confirmation" class="required"><em>*</em>Confirm Password</label>
                            <div class="input-box">
                                <input type="password" name="data[password2]" title="Confirm Password" id="confirmation" class="input-text required-entry <?php echo ($user && $view->errorFor($user, "firstname")) ? ' validation-failed' : '' ?>" />
                                <?php if ($user && $user->hasError('password2')): ?>
                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($user, "password2"); ?></div>
                                <?php endif; ?>
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
                <p class="back-link"><a href="<?php echo url('products/'); ?>" class="back-link"><small>&laquo; </small>Back</a></p>
                <button type="submit" title="Submit" class="button"><span><span>Submit</span></span></button>
            </div>
        </form>
    </div>

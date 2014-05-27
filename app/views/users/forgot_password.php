<?php $view->extend('masterpages/products'); ?>

                            <div class="account-create">
                                <form action="<?php echo url('users/reset_password'); ?>" method="post" id="newsletter-validate-detail">
                                    <div class="fieldset">
                                        <h2 class="legend">Forgot password</h2>

                                        <div>
                                                <fieldset>
                                                    <h4>Forgot your password?</h4>
                                                    <p>Please enter your email below:</p>
                                                    <ul class="form-list">
                                                        <li>
                                                            <label for="email" class="required"><em>*</em>Email</label>
                                                            <div class="input-box">
                                                                <input type="text" name="email" value="<?php echo isset($resetPassword) ? $resetPassword->getEmail() : ''; ?>" id="email" class="input-text required-entry <?php echo (isset($resetPassword) && $view->errorFor($resetPassword, "email")) ? ' validation-failed' : '' ?>" title="Email Address" />
                                                                <?php if (isset($resetPassword) && $resetPassword->hasError('email')): ?>
                                                                    <?php $emailError = explode(",", $view->errorFor($resetPassword, "email")); ?> 
                                                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $emailError[0]; ?></div>
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
                       
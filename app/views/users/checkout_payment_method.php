<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>

        <div class="wrapper">
            <div class="page">
                
                <?php $view->render('users/user_navigation'); ?>

                <div class="main-container col2-right-layout">
                    <div class="main">
                        <div class="col-main">
                            <div class="page-title">
                                <h1>Checkout</h1>
                            </div>
                            <ol class="opc" id="checkoutSteps">
                                <li id="opc-payment" class="section slide5 allow active">
                                    <div class="step-title">
                                        <span class="number">4</span>
                                        <h2>Payment Information</h2>
                                        <a href="#">Edit</a>
                                    </div>

                                    <div id="checkout-step-payment" class="step a-item">

                                        <form action="<?php echo url('checkout/select_payment_method'); ?>" id="co-payment-form" method="post">
                                            <fieldset>
                                                <dl class="sp-methods" id="checkout-payment-method-load">
                                                    <?php $paymentMethods = $view->getPaymentMethods(); ?>
                                                    <?php for ($i = 0; $i < sizeof($paymentMethods); $i++): ?>
                                                        <dt>
                                                            <input <?php echo ($i == 0) ? 'checked' : ''; ?> id="p_method_checkmo" value="<?php echo $paymentMethods[$i]->getId(); ?>" name="payment" title="Check / Money order" class="radio" type="radio" />
                                                            <label for="p_method_checkmo"><?php echo $paymentMethods[$i]->getName(); ?></label>
                                                        </dt>
                                                    <?php endfor; ?>
                                                </dl>
                                            </fieldset>
                                            <div class="buttons-set" id="payment-buttons-container">
                                                <p class="required">* Required Fields</p>
                                                <p class="back-link"><a href="<?php echo url('checkout/'); ?>" ><small>« </small>Back</a></p>
                                                <button type="submit" class="button"><span><span>Continue</span></span></button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>

                <div class="footer-container">
                    <?php $view->render('users/user_footer'); ?>
                </div>
            </div>

    </body>
</html>
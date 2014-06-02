<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col2-right-layout">
    <div class="main">
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
                                <?php foreach ($paymentMethods as $paymentMethod): ?>
                                    <dt>
                                    <input <?php echo ($order->getPayment_method()->getId() == $paymentMethod->getId()) ? 'checked' : ''; ?> id="p_method_checkmo" value="<?php echo $paymentMethod->getId(); ?>" name="payment" title="Check / Money order" class="radio" type="radio" />
                                    <label for="p_method_checkmo"><?php echo $paymentMethod->getName(); ?></label>
                                    </dt>
                                <?php endforeach; ?>
                            </dl>
                        </fieldset>
                        <div class="buttons-set" id="payment-buttons-container">
                            <p class="required">* Required Fields</p>
                            <p class="back-link"><a href="<?php echo url('checkout/show_shipping_method'); ?>" ><small>« </small>Back</a></p>
                            <button type="submit" class="button"><span><span>Continue</span></span></button>
                        </div>
                    </form>

                </div>
            </li>
        </ol>
    </div>
</div>

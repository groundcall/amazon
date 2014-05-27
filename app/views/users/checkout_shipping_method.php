<?php $view->extend('masterpages/products'); ?>

<div class="page-title">
    <h1>Checkout</h1>
</div>
<ol class="opc" id="checkoutSteps">
    <li id="opc-shipping_method" class="section slide4 allow active">
        <div class="step-title">
            <span class="number">3</span>
            <h2>Shipping Method</h2>
            <a href="#">Edit</a>
        </div>
        <div id="checkout-step-shipping_method" class="step a-item">
            <form id="co-shipping-method-form" action="">
                <fieldset>
                    <dl class="sp-methods" id="checkout-payment-method-load">
                        <dt>
                        <input autocomplete="off" id="p_method_checkmo" value="checkmo" name="payment[method]" title="Check / Money order" class="radio" type="radio">
                        <label for="p_method_checkmo">Shipping method 1</label>
                        </dt>
                        <dt>
                        <input autocomplete="off" id="p_method_checkmo" value="checkmo" name="payment[method]" title="Check / Money order" class="radio" type="radio">
                        <label for="p_method_checkmo">Shipping method 2</label>
                        </dt>
                    </dl>
                </fieldset>
            </form>
            <div class="buttons-set" id="payment-buttons-container">
                <p class="required">* Required Fields</p>
                <p class="back-link"><a href="javascript: window.location = '/checkout_shipping.html';" ><small>« </small>Back</a></p>
                <button type="button" class="button" onclick="window.location = '/checkout_payment.html'"><span><span>Continue</span></span></button>
            </div>
        </div>
    </li>
</ol>

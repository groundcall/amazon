<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col2-right-layout">
    <div class="main">
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
                    <form id="co-shipping-method-form" action="<?php echo url('checkout/select_shipping_method'); ?>" method="post">
                        <fieldset>
                            <dl class="sp-methods" id="checkout-payment-method-load">
                                <?php $shippingMethods = $view->getShippingMethods(); ?>
                                <?php for ($i = 0; $i < sizeof($shippingMethods); $i++): ?>
                                    <dt>
                                    <input <?php echo ($i == 0) ? 'checked' : ''; ?> id="p_method_checkmo" value="<?php echo $shippingMethods[$i]->getId(); ?>" name="shipping" title="Check / Money order" class="radio" type="radio" />
                                    <label for="p_method_checkmo"><?php echo $shippingMethods[$i]->getName(), ': ', $shippingMethods[$i]->getPrice(), ' US $'; ?></label>
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


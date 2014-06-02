<?php $view->extend('masterpages/front_masterpage'); ?>
<div class="main-container col2-right-layout">
    <div class="main">
        <div class="page-title">
            <h1>Checkout</h1>
        </div>
        <ol class="opc" id="checkoutSteps">
            <li id="opc-shipping" class="section slide3 allow active">
                <div class="step-title">
                    <span class="number">2</span>
                    <h2>Shipping Information</h2>
                    <a href="#">Edit</a>
                </div>
                <div id="checkout-step-shipping" class="step a-item">
                    <form action="<?php echo url('checkout/add_shipping_address'); ?>" method="post" id="co-shipping-form">
                        <ul class="form-list">
                            <li id="shipping-new-address-form">
                                <fieldset>
                                    <ul>
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field name-firstname">
                                                    <label for="firstname" class="required"><em>*</em>First Name</label>
                                                    <div class="input-box">
                                                        <input id="shipping:firstname" name="firstname" title="First Name" maxlength="255" class="input-text required-entry <?php echo ($order->getShipping_address() && $view->errorFor($order->getShipping_address(), "firstname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($order->getShipping_address()) ? $order->getShipping_address()->getFirstname() : ""; ?>' />
                                                        <?php if ($order->getShipping_address() && $order->getShipping_address()->hasError('firstname')): ?>
                                                            <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($order->getShipping_address(), "firstname"); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="field name-lastname">
                                                    <label for="lastname" class="required"><em>*</em>Last Name</label>
                                                    <div class="input-box">
                                                        <input id="shipping:lastname" name="lastname" title="Last Name" maxlength="255" class="input-text required-entry <?php echo ($order->getShipping_address() && $view->errorFor($order->getShipping_address(), "lastname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($order->getShipping_address()) ? $order->getShipping_address()->getLastname() : ""; ?>' />
                                                        <?php if ($order->getShipping_address() && $order->getShipping_address()->hasError('lastname')): ?>
                                                            <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($order->getShipping_address(), "lastname"); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="fields">
                                            <div class="field">
                                                <label for="email" class="required"><em>*</em>Email Address</label>
                                                <div class="input-box">
                                                    <input name="email" id="shipping:email" title="Email Address" class="input-text required-entry <?php echo ($order->getShipping_address() && $view->errorFor($order->getShipping_address(), "email")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($order->getShipping_address()) ? $order->getShipping_address()->getEmail() : ""; ?>' />
                                                    <?php if ($order->getShipping_address() && $order->getShipping_address()->hasError('email')): ?>
                                                        <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($order->getShipping_address(), "email"); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="wide">
                                            <label for="street1" class="required"><em>*</em>Address</label>
                                            <div class="input-box">
                                                <input title="Street Address" name="street1" id="billing:street1" class="input-text required-entry <?php echo ($order->getShipping_address() && $view->errorFor($order->getShipping_address(), "address")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($order->getShipping_address()) ? $order->getShipping_address()->getAddress() : ""; ?>' />
                                            </div>
                                        </li>

                                        <li class="wide">
                                            <div class="input-box">
                                                <input title="Street Address 2" name="street2" id="billing:street2" class="input-text required-entry <?php echo ($order->getShipping_address() && $view->errorFor($order->getShipping_address(), "address")) ? 'validation-failed' : '' ?>" type="text"/>
                                                <?php if ($order->getShipping_address() && $order->getShipping_address()->hasError('address')): ?>
                                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($order->getShipping_address(), "address"); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </li>

                                        <li class="fields">
                                            <div class="field">
                                                <label for="city" class="required"><em>*</em>City</label>
                                                <div class="input-box">
                                                    <input title="City" name="city" class="input-text required-entry <?php echo ($order->getShipping_address() && $view->errorFor($order->getShipping_address(), "city")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($order->getShipping_address()) ? $order->getShipping_address()->getCity() : ""; ?>' id="shipping:city" />
                                                    <?php if ($order->getShipping_address() && $order->getShipping_address()->hasError('city')): ?>
                                                        <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($order->getShipping_address(), "city"); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label for="country_id" class="required"><em>*</em>Country</label>
                                                <div class="input-box">
                                                    <select name="country_id" title="Country" id="billing:country_id" class="select">
                                                        <?php $countries = $view->getCountries(); ?>
                                                        <?php foreach ($countries as $country): ?>
                                                            <option value="<?php echo $country->getId(); ?>" <?php echo ($order->getShipping_address() && $order->getShipping_address()->getCountry_id() == $country->getId()) ? 'selected' : ''; ?>><?php echo $country->getName(); ?></option>
                                                        <?php endforeach; ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="no-display"><input name="save_in_address_book" value="1" type="hidden"></li>
                                    </ul>
                                </fieldset>
                            </li>
                            <li class="control">
                                <input name="same_as_billing" id="shipping:same_as_billing" value="1" title="Use Billing Address" class="checkbox" type="checkbox"><label for="shipping:same_as_billing">Use Billing Address</label>
                            </li>
                        </ul>
                        <div class="buttons-set" id="shipping-buttons-container">
                            <p class="required">* Required Fields</p>
                            <p class="back-link"><a href="<?php echo url('checkout/show_billing_address'); ?>" ><small>« </small>Back</a></p>
                            <button type="submit" class="button" title="Continue"><span><span>Continue</span></span></button>
                        </div>
                    </form>
                </div>
            </li>
        </ol>
    </div>
</div>

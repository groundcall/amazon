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
                                                        <input name="shipping[address_id]" value="<?php echo (isset($address)) ? $address->getId() : ''; ?>" id="shipping:address_id" type="hidden" />
                                                            <ul>
                                                                <li class="fields">
                                                                    <div class="customer-name">
                                                                        <div class="field name-firstname">
                                                                            <label for="shipping[firstname]" class="required"><em>*</em>First Name</label>
                                                                            <div class="input-box">
                                                                                <input id="shipping:firstname" name="shipping[firstname]" title="First Name" maxlength="255" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "firstname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getFirstname() : ""; ?>' />
                                                                                <?php if ($address && $address->hasError('firstname')): ?>
                                                                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "firstname"); ?></div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="field name-lastname">
                                                                            <label for="shipping[lastname]" class="required"><em>*</em>Last Name</label>
                                                                            <div class="input-box">
                                                                                <input id="shipping:lastname" name="shipping[lastname]" title="Last Name" maxlength="255" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "lastname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getLastname() : ""; ?>' />
                                                                                <?php if ($address && $address->hasError('lastname')): ?>
                                                                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "lastname"); ?></div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="fields">
                                                                    <div class="field">
                                                                        <label for="shipping[email]" class="required"><em>*</em>Email Address</label>
                                                                        <div class="input-box">
                                                                            <input name="shipping[email]" id="shipping:email" title="Email Address" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "email")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getEmail() : ""; ?>' />
                                                                            <?php if ($address && $address->hasError('email')): ?>
                                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "email"); ?></div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="wide">
                                                                    <label for="shipping[street1]" class="required"><em>*</em>Address</label>
                                                                    <div class="input-box">
                                                                        <input title="Street Address" name="shipping[street1]" id="billing:street1" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "address")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getAddress() : ""; ?>' />
                                                                    </div>
                                                                </li>

                                                                <li class="wide">
                                                                    <div class="input-box">
                                                                        <input title="Street Address 2" name="shipping[street2]" id="billing:street2" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "address")) ? 'validation-failed' : '' ?>" type="text"/>
                                                                        <?php if ($address && $address->hasError('address')): ?>
                                                                            <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "address"); ?></div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </li>

                                                                <li class="fields">
                                                                    <div class="field">
                                                                        <label for="shipping[city]" class="required"><em>*</em>City</label>
                                                                        <div class="input-box">
                                                                            <input title="City" name="shipping[city]" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "city")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getCity() : ""; ?>' id="shipping:city" />
                                                                            <?php if ($address && $address->hasError('city')): ?>
                                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "city"); ?></div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="field">
                                                                        <label for="shipping[country_id]" class="required"><em>*</em>Country</label>
                                                                        <div class="input-box">
                                                                            <select name="shipping[country_id]" title="Country" id="billing:country_id" class="select">
                                                                                <?php $countries = $view->getCountries(); ?>
                                                                                <?php foreach ($countries as $country): ?>
                                                                                    <option value="<?php echo $country->getId(); ?>" <?php echo ($address && $address->getCountry_id() == $country->getId()) ? 'selected' : ''; ?>><?php echo $country->getName(); ?></option>
                                                                                <?php endforeach; ?> 
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="no-display"><input name="shipping[save_in_address_book]" value="1" type="hidden"></li>
                                                            </ul>
                                                    </fieldset>
                                                </li>
                                                <li class="control">
                                                    <input name="shipping[same_as_billing]" id="shipping:same_as_billing" value="1" title="Use Billing Address" class="checkbox" type="checkbox"><label for="shipping:same_as_billing">Use Billing Address</label>
                                                </li>
                                            </ul>
                                            <div class="buttons-set" id="shipping-buttons-container">
                                                <p class="required">* Required Fields</p>
                                                <p class="back-link"><a href="<?php echo url('checkout/index'); ?>" ><small>« </small>Back</a></p>
                                                <button type="submit" class="button" title="Continue"><span><span>Continue</span></span></button>
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

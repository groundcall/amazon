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
                                <li id="opc-billing" class="section slide2 allow active">
                                    <div class="step-title">
                                        <span class="number">1</span>
                                        <h2>Billing Information</h2>
                                        <a href="#">Edit</a>
                                    </div>
                                    <div id="checkout-step-billing" class="step a-item">
                                        <form id="co-billing-form" action="<?php echo url('checkout/add'); ?>" method="post">
                                            <fieldset>
                                                <ul class="form-list">
                                                    <li id="billing-new-address-form">
                                                        <fieldset>
                                                            <!--<input name="billing[address_id]" value="" id="billing:address_id" type="hidden">-->
                                                                <ul>
                                                                    <li class="fields">
                                                                        <div class="customer-name">
                                                                            <div class="field name-firstname">
                                                                                <label for="billing[firstname]" class="required"><em>*</em>First Name</label>
                                                                                <div class="input-box">
                                                                                    <input id="billing:firstname" name="billing[firstname]" title="First Name" maxlength="255" class="input-text required-entry" type="text" value='<?php echo ($user) ? $user->getFirstname() : ""; ?>' />
                                                                                </div>
                                                                            </div>
                                                                            <div class="field name-lastname">
                                                                                <label for="billing[lastname]" class="required"><em>*</em>Last Name</label>
                                                                                <div class="input-box">
                                                                                    <input id="billing:lastname" name="billing[lastname]" title="Last Name" maxlength="255" class="input-text required-entry" type="text" value='<?php echo ($user) ? $user->getLastname() : ""; ?>' />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="fields">
                                                                        <div class="field">
                                                                            <label for="billing[email]" class="required"><em>*</em>Email Address</label>
                                                                            <div class="input-box">
                                                                                <input name="billing[email]" id="billing:email" title="Email Address" class="input-text validate-email required-entry" type="text" value='<?php echo ($user) ? $user->getEmail() : ""; ?>' />
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="billing[street1]" class="required"><em>*</em>Address</label>
                                                                        <div class="input-box">
                                                                            <input title="Street Address" name="billing[street][]" id="billing:street1" class="input-text  required-entry" type="text">
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <div class="input-box">
                                                                            <input title="Street Address 2" name="billing[street][]" id="billing:street2" class="input-text " type="text">
                                                                        </div>
                                                                    </li>
                                                                    <li class="fields">
                                                                        <div class="field">
                                                                            <label for="billing[city]" class="required"><em>*</em>City</label>
                                                                            <div class="input-box">
                                                                                <input title="City" name="billing[city]" class="input-text  required-entry" id="billing:city" type="text">
                                                                            </div>
                                                                        </div>
                                                                        <div class="field">
                                                                            <label for="billing[country_id]" class="required"><em>*</em>Country</label>
                                                                            <div class="input-box">
                                                                                <select name="billing[country_id]" title="Country" id="billing:country_id" class="select">
                                                                                    <?php $countries = $view->getCountries(); ?>
                                                                                        <?php foreach ($countries as $country): ?>
                                                                                            <option value="<?php echo $country->getId(); ?>"><?php echo $country->getName(); ?></option>
                                                                                        <?php endforeach; ?> 
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="no-display"><input name="billing[save_in_address_book]" value="1" type="hidden"></li>
                                                                </ul>
                                                        </fieldset>
                                                    </li>
                                                    <li class="control">
                                                        <input name="billing[use_for_shipping]" id="billing:use_for_shipping_yes" value="1" checked="checked" title="Ship to this address" class="radio" type="radio" />
                                                        <label for="billing[use_for_shipping_yes]">Ship to this address</label>
                                                    </li>
                                                    <li class="control">
                                                        <input name="billing[use_for_shipping]" id="billing:use_for_shipping_no" value="0" title="Ship to different address" class="radio" type="radio">
                                                        <label for="billing[use_for_shipping_no]">Ship to different address</label>
                                                    </li>
                                                </ul>
                                                <div class="buttons-set" id="billing-buttons-container">
                                                    <p class="required">* Required Fields</p>
                                                    <button type="submit" title="Continue" class="button"><span><span>Continue</span></span></button>
                                                </div>
                                            </fieldset>
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

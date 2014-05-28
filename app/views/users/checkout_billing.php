<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col2-right-layout">
    <div class="main">
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
                    <form id="co-billing-form" action="<?php echo url('checkout/add_billing_address'); ?>" method="post">
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
                                                            <input id="billing:firstname" name="billing[firstname]" title="First Name" maxlength="255" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "firstname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getFirstname() : ""; ?>' />
                                                            <?php if ($address && $address->hasError('firstname')): ?>
                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "firstname"); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="field name-lastname">
                                                        <label for="billing[lastname]" class="required"><em>*</em>Last Name</label>
                                                        <div class="input-box">
                                                            <input id="billing:lastname" name="billing[lastname]" title="Last Name" maxlength="255" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "lastname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getLastname() : ""; ?>' />
                                                            <?php if ($address && $address->hasError('lastname')): ?>
                                                                <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "lastname"); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="fields">
                                                <div class="field">
                                                    <label for="billing[email]" class="required"><em>*</em>Email Address</label>
                                                    <div class="input-box">
                                                        <input name="billing[email]" id="billing:email" title="Email Address" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "email")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getEmail() : ""; ?>' />
                                                        <?php if ($address && $address->hasError('email')): ?>
                                                            <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "email"); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wide">
                                                <label for="billing[street1]" class="required"><em>*</em>Address</label>
                                                <div class="input-box">
                                                    <input title="Street Address" name="billing[street1]" id="billing:street1" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "address")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getAddress() : ""; ?>' />
                                                </div>
                                            </li>
                                            <li class="wide">
                                                <div class="input-box">
                                                    <input title="Street Address 2" name="billing[street2]" id="billing:street2" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "address")) ? 'validation-failed' : '' ?>" type="text"/>
                                                    <?php if ($address && $address->hasError('address')): ?>
                                                        <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "address"); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                            <li class="fields">
                                                <div class="field">
                                                    <label for="billing[city]" class="required"><em>*</em>City</label>
                                                    <div class="input-box">
                                                        <input title="City" name="billing[city]" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "city")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($address) ? $address->getCity() : ""; ?>' id="billing:city" />
                                                        <?php if ($address && $address->hasError('city')): ?>
                                                            <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "city"); ?></div>
                                                        <?php endif; ?>
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
                                    <input name="billing[use_for_shipping]" id="billing:use_for_shipping_no" value="0" title="Ship to different address" class="radio" type="radio" />
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

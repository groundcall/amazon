<?php $view->extend('masterpages/front_masterpage'); ?>
<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div class="my-account">
                <div class="dashboard">
                    <div class="page-title">
                        <h1>Shipping Address</h1>
                    </div>


                    <div id="checkout-step-shipping" class="step a-item">
                        <form action="<?php echo url('dashboard/shipping_address'); ?>" method="post" id="co-shipping-form">
                            <ul class="form-list">
                                <li id="shipping-new-address-form">
                                    <fieldset>
                                        <?php $address = $user->getShipping_Address(); ?>

                                        <!--<input name="shipping[address_id]" value="<?php echo (isset($address)) ? $address->getId() : ''; ?>" id="shipping:address_id" type="hidden" />-->
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
                            </ul>
                            <div class="buttons-set" id="shipping-buttons-container">
                                <p class="required">* Required Fields</p>
                                <button type="submit" class="button" title="Continue"><span><span>Continue</span></span></button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-left sidebar">
            <?php include 'user_dashboard_navigation.php'; ?>
            <?php include 'user_cart_sidebar.php'; ?>
        </div>
    </div>
</div>


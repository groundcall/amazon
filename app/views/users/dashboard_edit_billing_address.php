<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div class="my-account">
                <div class="dashboard">
                    <div class="page-title">
                        <h1>Billing Address</h1>
                    </div>
                    <?php if ($_SESSION['update_status'] == 'ok'): ?>
                    <div id="messages_product_view">
                        <ul class="messages">
                            <li class="success-msg">
                                <ul>
                                    <li><span>Your billing address was updated.</span></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php $_SESSION['update_status'] = null; ?>
                    <?php endif; ?>
                    <div id="checkout-step-billing" class="step a-item">
                        <form id="co-billing-form" action="<?php echo url('dashboard/billing_address'); ?>" method="post">
                            <fieldset>
                                <ul class="form-list">
                                    <li id="billing-new-address-form">
                                        <fieldset>
                                            <?php  $address = $user->getBilling_Address(); ?>
                                            <!--<input name="billing[address_id]" value="" id="billing:address_id" type="hidden">-->
                                            <ul>
                                                <li class="fields">
                                                    <div class="customer-name">
                                                        <div class="field name-firstname">
                                                            <label for="billing[firstname]" class="required"><em>*</em>First Name</label>
                                                            <div class="input-box">
                                                                <input id="billing:firstname" name="billing[firstname]" title="First Name" maxlength="255" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "firstname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($user) ? $user->getFirstname() : $user->getFirstname(); ?>' />
                                                                <?php if ($address && $address->hasError('firstname')): ?>
                                                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $view->errorFor($address, "firstname"); ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="field name-lastname">
                                                            <label for="billing[lastname]" class="required"><em>*</em>Last Name</label>
                                                            <div class="input-box">
                                                                <input id="billing:lastname" name="billing[lastname]" title="Last Name" maxlength="255" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "lastname")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($user) ? $user->getLastname() : $user->getLastname(); ?>' />
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
                                                            <input name="billing[email]" id="billing:email" title="Email Address" class="input-text required-entry <?php echo ($address && $view->errorFor($address, "email")) ? 'validation-failed' : '' ?>" type="text" value='<?php echo ($user) ? $user->getEmail() : $user->getEmail(); ?>' />
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
                                </ul>
                                <div class="buttons-set" id="billing-buttons-container">
                                    <p class="required">* Required Fields</p>
                                    <button type="submit" title="Continue" class="button"><span><span>Continue</span></span></button>
                                </div>
                            </fieldset>
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

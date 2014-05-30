<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col2-right-layout">
    <div class="main">
        <div class="col-main">
            <div class="page-title">
                <h1>Checkout</h1>
            </div>
            <ol class="opc" id="checkoutSteps">
                <li id="opc-review" class="section slide6 allow active">
                    <div class="step-title">
                        <h2>Order number <?php echo $order->getId(); ?></h2>
                    </div>

                    <div id="checkout-step-review" class="step a-item">
                        <div class="order-review" id="checkout-review-load"><br/><br/>
                            <fieldset>
                                <table id="shopping-cart-table" class="data-table cart-table">
                                    <colgroup>
                                        <col width="1" />
                                        <col />
                                        <col width="1" />
                                        <col width="1" />
                                        <col width="1" />
                                        <col width="1" />
                                    </colgroup>
                                    <thead>
                                        <tr class="first last">
                                            <th rowspan="1">&nbsp;</th>
                                            <th rowspan="1"><span class="nobr">Product Name</span></th>
                                            <th class="a-center" colspan="1"><span class="nobr">Unit Price</span></th>
                                            <th rowspan="1" class="a-center">Quantity</th>
                                            <th class="a-center" colspan="1">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="first last">
                                            <td colspan="50" class="a-left first">
                                                <span style="font-weight: bold;">Billing Address:</span><br/>
                                                <?php $billing_address = $order->getBilling_address(); ?>
                                                <?php echo 'Firstname: ', $billing_address->getFirstname(); ?><br />
                                                <?php echo 'Lastname: ', $billing_address->getLastname(); ?><br />
                                                <?php echo 'Email: ', $billing_address->getEmail(); ?><br />
                                                <?php echo 'Address: ', $billing_address->getAddress(); ?><br />
                                                <?php echo 'City: ', $billing_address->getCity(); ?><br />
                                                <?php echo 'Country: ', $billing_address->getCountry()->getName(); ?><br />
                                            </td>
                                        </tr>
                                        <tr class="first last">
                                            <td colspan="50" class="a-left first">
                                                <span style="font-weight: bold;">Shipping Address:</span><br/>
                                                <?php $shipping_address = $order->getShipping_address(); ?>
                                                <?php echo 'Firstname: ', $shipping_address->getFirstname(); ?><br />
                                                <?php echo 'Lastname: ', $shipping_address->getLastname(); ?><br />
                                                <?php echo 'Email: ', $shipping_address->getEmail(); ?><br />
                                                <?php echo 'Address: ', $shipping_address->getAddress(); ?><br />
                                                <?php echo 'City: ', $shipping_address->getCity(); ?><br />
                                                <?php echo 'Country: ', $shipping_address->getCountry()->getName(); ?><br />
                                            </td>
                                        </tr>
                                        <tr class="first last">
                                            <td colspan="50" class="a-left first">
                                                <span style="font-weight: bold;">Shipping Method:</span>
                                                <?php $shipping_method = $order->getShipping_method(); ?>
                                                <?php echo $shipping_method->getName(); ?><br />
                                            </td>
                                        </tr>
                                        <tr class="first last">
                                            <td colspan="50" class="a-left first">
                                                <span style="font-weight: bold;">Payment Method:</span>
                                                <?php $payment_method = $order->getPayment_method(); ?>
                                                <?php echo $payment_method->getName(); ?><br />
                                            </td>
                                        </tr>
                                        <tr class="first last">
                                            <td colspan="50" class="a-right first">
                                                Subtotal: <?php echo $order->getCart()->getTotal(), ' US $'; ?><br/>
                                                Shipping method: <?php echo $order->getShipping_method()->getPrice(), ' US $'; ?><br/>
                                                Total: <?php echo $order->getTotal(), ' US $'; ?>
                                            </td>
                                        </tr>
                                        <tr class="first last">
                                            <td colspan="50" class="a-right last">
                                                <button type="button" class="button" onclick="window.location = '<?php echo url('dashboard/'); ?>'"><span><span>Back</span></span></button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $cartItems = $order->getCart()->getCart_item(); ?> 
                                        <?php if (isset($cartItems)): ?>
                                            <?php for ($i = 0; $i < sizeof($cartItems); $i++): ?>
                                                <tr class="<?php echo ($i % 2 == 0) ? 'first odd' : 'last even'; ?>">
                                                    <?php $products[$i] = $cartItems[$i]->getProduct(); ?>
                                                    <td>
                                                        <img src="<?php echo '../product_images' . $products[$i]->getImage(); ?>" alt="<?php echo $products[$i]->getTitle(); ?>" height="75" width="75" />
                                                    </td>
                                                    <td>
                                                        <h2 class="product-name"><?php echo $products[$i]->getTitle(); ?></h2>
                                                        <dl class="item-options" style="color: grey; font-size: 11px;">
                                                            <dt><?php echo $products[$i]->getShort_description(); ?></dt>
                                                        </dl>
                                                    </td>
                                                    <td class="a-right">
                                                        <span class="cart-price">
                                                            <span class="price"><?php echo $products[$i]->getPrice(); ?></span>
                                                        </span>
                                                    </td>
                                                    <td class="a-center">
                                                        <span class="cart-price">
                                                            <span class="price"><?php echo $cartItems[$i]->getQuantity(); ?></span>
                                                        </span>
                                                    </td>
                                                    <td class="a-right">
                                                        <span class="cart-price">
                                                            <span class="price"><?php echo $cartItems[$i]->getPrice(); ?></span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                </li>
            </ol>
        </div>

    </div>
</div>
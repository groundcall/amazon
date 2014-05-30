<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col3-layout">
    <div class="main">
        <div class="cart">
            <div class="page-title title-buttons">
                <h1>Shopping Cart</h1>
                <ul class="checkout-types">
                    <li>
                        <button type="button" title="Proceed to Checkout" <?php echo ($cart->getTotal() <= 0) ? 'disabled' : ''; ?> class="button btn-proceed-checkout btn-checkout" onclick='window.location = "<?php echo url('checkout/'); ?>"'><span><span>Proceed to Checkout</span></span></button>
                    </li>
                </ul>
            </div>
            <?php if (isset($_SESSION['updated_qty']) && $_SESSION['updated_qty'] == 1): ?>
                <ul class="messages">
                    <li class="success-msg">
                        <ul>
                            <li><span>Your cart was updated.</span></li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
            <?php $_SESSION['updated_qty'] = null; ?>
            
            <?php if (sizeof($cart->getCart_item()) > 0): ?>
                <form action="<?php echo url('cart/manage_cart'); ?>" method="post">
                    <fieldset>
                        <table id="shopping-cart-table" class="data-table cart-table">
                            <colgroup>
                                <col width="1" />
                                <col />
                                <col width="1" />
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
                                    <th rowspan="1" class="a-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="first last">
                                    <td colspan="50" class="a-right last">
                                        <button type="button" title="Continue Shopping" class="button btn-continue" onclick='window.location = "<?php echo url('products'); ?>"'><span><span>Continue Shopping</span></span></button>
                                        <button type="submit" name="update_qty" title="Update Shopping Cart" class="button btn-update"><span><span>Update Shopping Cart</span></span></button>
                                        <button type="submit" name="empty_cart" title="Clear Shopping Cart" class="button btn-empty" id="empty_cart_button"><span><span>Clear Shopping Cart</span></span></button>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $cartItems = $cart->getCart_item(); ?> 
                                <?php if (isset($cartItems)): ?>
                                    <?php for ($i = 0; $i < sizeof($cartItems); $i++): ?>
                                        <tr class="<?php echo ($i % 2 == 0) ? 'first odd' : 'last even'; ?>">
                                            <?php $products[$i] = $cartItems[$i]->getProduct(); ?>
                                            <td>
                                                <a href="<?php echo url('products/show_details', array('product_id' => $products[$i]->getId())); ?>" title="<?php echo $products[$i]->getTitle(); ?>" class="product-image">
                                                    <img src="<?php echo '../product_images' . $products[$i]->getImage(); ?>" alt="<?php echo $products[$i]->getTitle(); ?>" height="75" width="75" />
                                                </a>
                                            </td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="<?php echo url('products/show_details', array('product_id' => $products[$i]->getId())); ?>"><?php echo $products[$i]->getTitle(); ?></a>
                                                </h2>
                                                <dl class="item-options">
                                                    <dt><?php echo $products[$i]->getShort_description(); ?></dt>
                                                </dl>
                                            </td>
                                            <td class="a-right">
                                                <span class="cart-price">
                                                    <span class="price"><?php echo $products[$i]->getPrice(); ?></span>
                                                </span>
                                            </td>
                                            <td class="a-center">
                                                <input name="cart[<?php echo $cartItems[$i]->getId(); ?>]" size="4" title="Quantity" maxlength="12" class="input-text qty <?php echo ($view->errorFor($cartItems[$i], "quantity")) ? 'validation-failed' : '' ?>" value="<?php echo $cartItems[$i]->getQuantity(); ?>" />
                                                <?php if ($cartItems[$i]->hasError('quantity')): ?>
                                                    <?php $quantityError = explode(",", $view->errorFor($cartItems[$i], "quantity")); ?> 
                                                    <div class="validation-advice" id="advice-required-entry-email" style=""><?php echo $quantityError[0]; ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="a-right">
                                                <span class="cart-price">
                                                    <span class="price"><?php echo $cartItems[$i]->getPrice(); ?></span>
                                                </span>
                                            </td>
                                            <td class="a-center last">
                                                <!--<input type="hidden" name="cart_item_id" value="<?php //echo $cartItems[$i]->getId(); ?>" />-->
                                                <button type="submit" value="<?php echo $cartItems[$i]->getId(); ?>" class="btn-remove btn-remove2" style="width: 20px; height: 20px; border-style: none;" name="remove" title="Remove item"><span><span>Remove item</span></span></button>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </fieldset>
                </form>
            <?php else: ?>
                <table id="shopping-cart-table" class="data-table cart-table">
                    <tr class='first odd'>
                        <br/><br/><h2 style='font-size: 15px; text-align: center; color: red; '>The cart is empty !</h2><br/><br/><br/>
                    </tr>
                </table>
            <?php endif; ?>

            <div class="cart-collaterals">
                <div class="totals">
                    <table id="shopping-cart-totals-table">
                        <colgroup>
                            <col />
                            <col width="1" />
                        </colgroup>
                        <tfoot>
                            <tr>
                                <td style="" class="a-right" colspan="1">
                                    <strong>Grand Total</strong>
                                </td>
                                <td style="" class="a-right">
                                    <strong><span class="price"><?php echo $cart->getTotal(); ?> US$</span></strong>
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td style="" class="a-right" colspan="1">Subtotal</td>
                                <td style="" class="a-right"><span class="price"><?php echo $cart->getTotal(); ?> US$</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="checkout-types">
                        <li>
                            <button type="button" <?php echo ($cart->getTotal() <= 0) ? 'disabled' : ''; ?> title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" onclick="window.location = '<?php echo url('checkout/'); ?>'"><span><span>Proceed to Checkout</span></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>

        <div class="wrapper">
            <div class="page">
                
                <?php $view->render('users/user_navigation'); ?>
                
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <div class="cart">
                                <div class="page-title title-buttons">
                                    <h1>Shopping Cart</h1>
                                    <ul class="checkout-types">
                                        <li>
                                            <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" ><span><span>Proceed to Checkout</span></span></button>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="messages">
                                    <li class="success-msg">
                                        <ul>
                                            <li><span>Coalesce: Functioning On Impatience T-Shirt was added to your shopping cart.</span></li>
                                        </ul>
                                    </li>
                                </ul>

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
                                                    <th rowspan="1" class="a-center">Qty</th>
                                                    <th class="a-center" colspan="1">Subtotal</th>
                                                    <th rowspan="1" class="a-center">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="first last">
                                                    <td colspan="50" class="a-right last">
                                                        <button type="button" title="Continue Shopping" class="button btn-continue" ><span><span>Continue Shopping</span></span></button>
                                                        <button type="submit" name="update_qty" title="Update Shopping Cart" class="button btn-update"><span><span>Update Shopping Cart</span></span></button>
                                                        <button type="submit" name="empty_cart" title="Clear Shopping Cart" class="button btn-empty" id="empty_cart_button"><span><span>Clear Shopping Cart</span></span></button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
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
                                                                    <!--<dd>3</dd>-->
                                                                </dl>
                                                            </td>
                                                            <td class="a-right">
                                                                <span class="cart-price">
                                                                    <span class="price"><?php echo $products[$i]->getPrice(); ?></span>
                                                                </span>
                                                            </td>
                                                            <td class="a-center">
                                                                <input name="cart[595763][qty]" value="1" size="4" title="Qty" class="input-text qty" maxlength="12" />
                                                            </td>
                                                            <td class="a-right">
                                                                <span class="cart-price">
                                                                    <span class="price"><?php echo $cartItems[$i]->getPrice(); ?></span>
                                                                </span>
                                                            </td>
                                                            <td class="a-center last">
                                                                <a href="#" title="Remove item" class="btn-remove btn-remove2">Remove item</a>
                                                            </td>
                                                        </tr>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </form>

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
                                                        <strong><span class="price">$104.99</span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td style="" class="a-right" colspan="1">Subtotal</td>
                                                    <td style="" class="a-right"><span class="price">$104.99</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <ul class="checkout-types">
                                            <li>
                                                <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" ><span><span>Proceed to Checkout</span></span></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-container">
                    <?php $view->render('users/user_footer'); ?>
                </div>
            </div>
        </div>
    </body>
</html>
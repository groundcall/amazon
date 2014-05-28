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
                        <span class="number">6</span>
                        <h2>Thank you for your purchase !</h2>
                    </div>

                    <div id="checkout-step-review" class="step a-item">
                        <div class="order-review" id="checkout-review-load"><br/>
                            <fieldset>
                                <table id="shopping-cart-table" class="data-table cart-table">
                                    <tbody>
                                        <tr class='last even'>
                                            <td colspan="50" class="a-left first">
                                                <span style='text-align: center;'>
                                                    Your order number is <?php echo $order_id; ?>. <br/>
                                                    You will receive an order information email with details of your order and a link to track it's progress.
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="first last">
                                            <td colspan="50" class="a-right last">
                                                <button type="button" class="button" onclick="window.location = '<?php echo url('products/'); ?>'"><span><span>Continue to store</span></span></button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                </li>
            </ol>
        </div>

    </div>
</div>
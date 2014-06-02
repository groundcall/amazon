<?php $view->extend('masterpages/cpanel'); ?>

<div id="page-heading"><h1>View order</h1></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
    <tr>
        <th rowspan="3" class="sized"><img src="../images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="../images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
    </tr>
    <tr>
        <td id="tbl-border-left"></td>
        <td>
            <!--  start content-table-inner -->
            <div id="content-table-inner">

                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                <tr>
                                    <th valign="top">USER</th>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Username:</th>
                                    <td><input type="text" class="inp-form" name="username" readonly value="<?php echo ($order) ? $order->getUser()->getUsername() : ""; ?>" style="height: 18px;" /></td>
                                </tr>

                                <tr>
                                    <th valign="top">First Name:</th>
                                    <td><input type="text" class="inp-form" readonly name="firstname" value="<?php echo ($order) ? $order->getUser()->getFirstname() : ""; ?>" style="height: 18px;" /></td> 
                                </tr>

                                <tr>
                                    <th valign="top">Last Name:</th>
                                    <td><input type="text" class="inp-form" readonly name="lastname" value="<?php echo ($order) ? $order->getUser()->getLastname() : ""; ?>" style="height: 18px;" /></td>
                                </tr>         
                                        
                                <tr>
                                    <th valign="top"><br /><br />BILLING ADDRESS</th>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Name:</th>
                                    <td><input type="text" readonly class="inp-form" name="billing_name" value="<?php echo ($order) ? $order->getBilling_address()->getFirstname() . ' ' . $order->getBilling_address()->getLastname() : ""; ?>" style="height: 18px;"/></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Address:</th>
                                    <td><input type="text" readonly class="inp-form" name="billing_address" value="<?php echo ($order) ? $order->getBilling_address()->getAddress() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">City:</th>
                                    <td><input type="text" readonly class="inp-form" name="billing_city" value="<?php echo ($order) ? $order->getBilling_address()->getCity() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Country:</th>
                                    <td><input type="text" readonly class="inp-form" name="billing_country" value="<?php echo ($order) ? $order->getBilling_address()->getCountry()->getName() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top"><br /><br />SHIPPING ADDRESS</th>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Name:</th>
                                    <td><input type="text" readonly class="inp-form" name="shipping_name" value="<?php echo ($order) ? $order->getShipping_address()->getFirstname() . ' ' . $order->getShipping_address()->getLastname() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Address:</th>
                                    <td><input type="text" readonly class="inp-form" name="shipping_address" value="<?php echo ($order) ? $order->getShipping_address()->getAddress() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">City:</th>
                                    <td><input type="text" readonly class="inp-form" name="shipping_city" value="<?php echo ($order) ? $order->getShipping_address()->getCity() : ""; ?>" style="height: 18px;"/></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Country:</th>
                                    <td><input type="text" readonly class="inp-form" name="shipping_country" value="<?php echo ($order) ? $order->getShipping_address()->getCountry()->getName() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <?php if (sizeof($order->getCart()->getCart_item()) > 0): ?>
                                    <tr>
                                        <th valign="top"><br /><br />PRODUCTS</th>
                                        <td></td>
                                    </tr>

                                    <?php foreach ($order->getCart()->getCart_item() as $item): ?>
                                        <tr>
                                            <th valign="top">Product title:</th>
                                            <td><input type="text" readonly class="inp-form" readonly value="<?php echo $item->getProduct()->getTitle(); ?>" style="height: 18px;" /></td>
                                        </tr>

                                        <tr>
                                            <th valign="top">Quantity:</th>
                                            <td><input type="text" readonly class="inp-form" readonly value="<?php echo $item->getQuantity(); ?>" style="height: 18px;" /></td>
                                        </tr>
                                        
                                        <tr>
                                            <th valign="top">Price:</th>
                                            <td><input type="text" readonly class="inp-form" readonly value="<?php echo $item->getPrice(), ' US $'; ?>" style="height: 18px;" /></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <tr>
                                    <th valign="top">Subtotal:</th>
                                    <td><input type="text" readonly class="inp-form" name="subtotal" value="<?php echo ($order) ? $order->getCart()->getTotal() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top"><br /><br />SHIPPING METHOD:</th>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Shipping Method:</th>
                                    <td><input type="text" readonly class="inp-form" name="shipping_method" value="<?php echo ($order) ? $order->getShipping_method()->getName() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top">Price:</th>
                                    <td><input type="text" readonly class="inp-form" name="shipping_method" value="<?php echo ($order) ? $order->getShipping_method()->getPrice() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th valign="top"><br /><br />PAYMENT METHOD:</th>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th valign="top">Payment Method:</th>
                                    <td><input type="text" readonly class="inp-form" name="payment_method" value="<?php echo ($order) ? $order->getPayment_method()->getName() : ""; ?>" style="height: 18px;" /></td>
                                </tr>
                                
                                <tr>
                                    <th>
                                        <br/><br/>
                                    </th>
                                </tr>
                                
                                <tr> 
                                    <th valign="top" style="font-size: 20px;">Total:</th>
                                    <td><input type="text" readonly class="inp-form" name="payment_method" value="<?php echo ($order) ? $order->getTotal() : ""; ?>" style="font-size: 20px; height: 22px;" /></td>
                                </tr>
                            </table>
                            <!-- end id-form  -->
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
                        <td></td>
                    </tr>
                </table>
                <div class="clear"></div>
            </div>
            <!--  end content-table-inner  -->
        </td>
        <td id="tbl-border-right"></td>
    </tr>
    <tr>
        <th class="sized bottomleft"></th>
        <td id="tbl-border-bottom">&nbsp;</td>
        <th class="sized bottomright"></th>
    </tr>
</table>
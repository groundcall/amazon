<?php $view->extend('masterpages/front_masterpage'); ?>
<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div class="my-account">
                <div class="dashboard">
                    <div class="page-title">
                        <h1>Cart History</h1>
                    </div>
                    <?php if (isset($_SESSION['update_status']) && $_SESSION['update_status'] == 'ok'): ?>
                        <div id="messages_product_view">
                            <ul class="messages">
                                <li class="success-msg">
                                    <ul>
                                        <li><span>Update successful.</span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php $_SESSION['update_status'] = null; ?>
                    <?php endif; ?>

                    <table class="data-table" id="my-orders-table">
                        <tr>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Number</a>	</th>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Date</a>	</th>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Total</a></th>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Products</a></th>
                            <th class="table-header-repeat line-left"><a href="">Status</a></th>
                            <th class="table-header-repeat line-left"><a href="">Action</a></th>
                        </tr>
                        <?php $number = 1; ?>
                        <?php foreach ($allcarts as $cart): ?>
                            <tr>
                                <td><?php echo $number; ?></td>
                                <td><?php echo $cart->getDate(); ?></td>
                                <td><?php echo $cart->getTotal(); ?> US$</td>
                                <td><?php echo $view->getNumberOfItemsInCart($cart->getId()); ?> items  <a href="<?php echo url('cart/show_cart', array('cart_id' => $cart->getId())); ?>">See Cart</a></td>
                                <td class="options-width">
                                    <form action="<?php echo ($cart->getActive() == 1) ? '' : url('cart/activate_cart', array('cart_id' => $cart->getId())); ?>" method="post" >
                                        <input type="hidden" name="cart_id" value="<?php echo $cart->getId(); ?>" />
                                        <input type="submit" value="<?php echo ($cart->getActive() == 1) ? 'Deactivate' : 'Activate'; ?>" name="<?php echo ($cart->getActive() == 1) ? 'deactivate' : 'activate'; ?>" />
                                    </form>
                                </td>
                                <?php if ($cart->getActive() == 0):?>
                                <td class="options-width">   
                                    <form action="<?php echo url('cart/delete_cart'); ?>" method="post" >
                                        <input type="hidden" name="cart_id" value="<?php echo $cart->getId(); ?>" />
                                        <input type="submit" value="Delete"/>
                                    </form>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php $number = $number + 1; ?>
                        <?php endforeach; ?>
                    </table>
                    <!--  end product-table................................... --> 


                </div>
            </div>
        </div>
        <div class="col-left sidebar">
            <?php include 'user_dashboard_navigation.php'; ?>
            <?php include 'user_cart_sidebar.php'; ?>
        </div>
    </div>
</div>

<?php $view->extend('masterpages/front_masterpage'); ?>
<?php $orders = $view->getLastOrdersByUser($user); ?>

<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div class="my-account">
                <div class="dashboard">
                    <div class="page-title">
                        <h1>My Dashboard</h1>
                    </div>
                    <div class="welcome-msg">
                        <p class="hello"><strong>Hello, <?php echo $user->getFirstname(); ?> <?php echo $user->getLastname(); ?>!</strong></p>
                        <p>From your My Account Dashboard you have the ability to view a
                            snapshot of your recent account activity and update your account
                            information. Select a link below to view or edit information.
                        </p>
                    </div>
                    <div class="box-account box-recent">
                        <div class="box-head">
                            <h2>Recent Orders</h2>
                            <a href="<?php echo url('dashboard/show_all_orders'); ?>">View All</a>
                        </div>
                        <table class="data-table" id="my-orders-table">
                            <col width="1" />
                            <col width="1" />
                            <col />
                            <col width="1" />
                            <col width="1" />
                            <col width="1" />
                            <thead>
                                <?php if (sizeof($orders) > 0): ?>
                                    <tr class="first last">
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th style="width: 110px;">Ship To</th>
                                        <th style="width: 50px;"><span class="nobr">Order Total</span></th>
                                        <th style="width: 50px;">Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                <?php endif; ?>
                            </thead>
                            <tbody>
                                <?php if (sizeof($orders) <= 0): ?>
                                    <?php echo 'No orders'; ?>
                                <?php else: ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr class="first last odd">
                                            <td><?php echo $order->getId(); ?></td>
                                            <td><span class="nobr"><?php echo $order->getDate(); ?></span></td>
                                            <td><?php echo $order->getShipping_address()->getFirstname(); ?> <?php echo $order->getShipping_address()->getLastname(); ?></td>
                                            <td><span class="price"><?php echo $order->getTotal(); ?></span></td>
                                            <td><em><?php echo $order->getState()->getLabel(); ?></em></td>
                                            <td class="a-center last">
                                                <span class="nobr">
                                                    <a href="<?php echo url('dashboard/show_order_details', array('order_id' => $order->getId())); ?>">View Order</a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-account box-info">
                        <div class="box-head">
                            <h2>Account Information</h2>
                        </div>
                        <div class="col2-set">
                            <div class="col-1">
                                <div class="box">
                                    <div class="box-title">
                                        <h3>Contact Information</h3>
                                        <a href="#">Edit</a>
                                    </div>
                                    <div class="box-content">
                                        <p>
                                            <?php echo $user->getFirstname(); ?> <?php echo $user->getLastname(); ?><br />
                                            <?php echo $user->getEmail(); ?><br />
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col2-set">
                            <div class="box">
                                <div class="box-title">
                                    <h3>Address Book</h3>
                                </div>
                                <div class="box-content">
                                    <div class="col-1">
                                        <h4>Billing Address</h4>
                                        <address>
                                            <?php if (!empty($user->getBilling_address())): ?>
                                                <?php echo $user->getBilling_address()->getFirstname(); ?> <?php echo $user->getBilling_address()->getLastname(); ?><br />
                                                <?php echo $user->getBilling_address()->getAddress(); ?><br />
                                                <?php echo $user->getBilling_address()->getCity(); ?><br />
                                                <?php echo $user->getBilling_address()->getCountry()->getName(); ?><br />
                                            <?php else: ?>
                                                <?php echo 'Billing address is not set.'; ?><br />
                                            <?php endif; ?>
                                            <?php echo 'Phone: ', $user->getPhone(); ?><br />
                                            <a href="#">Edit Address</a>
                                        </address>
                                    </div>
                                    <div class="col-2">
                                        <h4>Shipping Address</h4>
                                        <address>
                                            <?php if (!empty($user->getShipping_address())): ?>
                                                <?php echo $user->getShipping_address()->getFirstname(); ?> <?php echo $user->getShipping_address()->getLastname(); ?><br />
                                                <?php echo $user->getShipping_address()->getAddress(); ?><br />
                                                <?php echo $user->getShipping_address()->getCity(); ?><br />
                                                <?php echo $user->getShipping_address()->getCountry()->getName(); ?><br />
                                            <?php else: ?>
                                                <?php echo 'Shipping address is not set.'; ?><br />
                                            <?php endif; ?>
                                            <?php echo 'Phone: ', $user->getPhone(); ?><br />
                                            <a href="#">Edit Address</a>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
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

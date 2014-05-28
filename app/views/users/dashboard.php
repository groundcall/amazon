<?php $view->extend('masterpages/front_masterpage'); ?>

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
                            information. Select a link below to view or edit information.</p>
                    </div>
                    <div class="box-account box-recent">
                        <div class="box-head">
                            <h2>Recent Orders</h2>
                            <a href="#">View All</a>
                        </div>
                        <table class="data-table" id="my-orders-table">
                            <col width="1" />
                            <col width="1" />
                            <col />
                            <col width="1" />
                            <col width="1" />
                            <col width="1" />
                            <thead>
                                <tr class="first last">
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Ship To</th>
                                    <th><span class="nobr">Order Total</span></th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="first last odd">
                                    <td>100027773</td>
                                    <td><span class="nobr">7/24/12</span></td>
                                    <td><?php echo $user->getFirstname(); ?> <?php echo $user->getLastname(); ?></td>
                                    <td><span class="price">$2,699.99</span></td>
                                    <td><em>Pending</em></td>
                                    <td class="a-center last">
                                        <span class="nobr">
                                            <a href="#">View Order</a>
                                        </span>
                                    </td>
                                </tr>
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
                                            John Doe<br />
                                            asd<br />
                                            asd,  Alaska, asd<br />
                                            United States<br />
                                            T: 123123
                                            <br />
                                            <a href="#">Edit Address</a>
                                        </address>
                                    </div>
                                    <div class="col-2">
                                        <h4>Shipping Address</h4>
                                        <address>
                                            John Doe<br />
                                            asd<br />
                                            asd,  Alaska, asd<br />
                                            United States<br />
                                            T: 321312
                                            <br />
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

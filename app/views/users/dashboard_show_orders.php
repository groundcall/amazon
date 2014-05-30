<?php $view->extend('masterpages/front_masterpage'); ?>

<div class="main-container col2-left-layout">
    <div class="main">
        <div class="col-main">
            <div class="my-account">
                <div class="dashboard">
                    <div class="page-title">
                        <h1>My Dashboard</h1>
                    </div>
                    <div class="box-account box-recent">
                        <div class="box-head">
                            <h2>All Orders</h2>
                            <a href="<?php echo url('dashboard/'); ?>">Back</a>
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
                            <br />
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
                        <br />
                        <div class="pager">
                            <?php if ($paginator->getCurrent() > $paginator->getPages()): ?>
                                <?php $paginator->setCurrent($paginator->getPages()); ?>
                            <?php endif; ?>      
                            <div class="pages">
                                <strong>Page:</strong>
                                <ol>
                                    <?php if ($paginator->getCurrent() >= 1): ?>
                                        <li>
                                            <a href="<?php echo url("dashboard/show_all_orders", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1))); ?>">
                                                <?php echo ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : ''; ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="current"><strong><?php echo $paginator->getCurrent(); ?></strong></li>

                                    <?php if ($paginator->getCurrent() <= $paginator->getPages()): ?>
                                        <li>
                                            <a href="<?php echo url("dashboard/show_all_orders", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()))); ?>">
                                                <?php echo ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : ''; ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ol>
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

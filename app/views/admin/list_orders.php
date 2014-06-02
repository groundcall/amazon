<?php $view->extend('masterpages/cpanel'); ?>
<!--  start page-heading -->
<?php if (!$orders): ?>
    <div id="page-heading">
        <h1>No orders found!</h1>
    </div>
<?php else: ?>
    <div id="page-heading">
        <h1>Order list</h1>
    </div>
    <!-- end page-heading -->
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
                <!--  start content-table-inner ...................................................................... START -->
                <div id="content-table-inner">
                    <div class="filter-product">
                        <!-- start filter form -->
                        <form action="<?php echo url('admin_orders/filter_orders'); ?>" method="get" >
                            <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                <tr>
                                    <th valign="top">Username:</th>
                                    <td><input type="text" name="username" class="inp-form" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>"/></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th valign="top">Status:</th>
                                    <td>	
                                        <select name="state">
                                            <option value="5" <?php echo (isset($_GET['state']) && ($_GET['state'] == 5)) ? 'selected="selected"' : ''; ?>>All states</option>
                                            <?php foreach ($view->getStates() as $state): ?>
                                                <option value="<?php echo $state->getId(); ?>" <?php echo (isset($_GET['state']) && ($_GET['state'] == $state->getId())) ? 'selected="selected"' : ''; ?>><?php echo $state->getLabel(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th valign="top">Created at:</th>
                                    <td>	
                                        <select name="time">
                                            <option value="not" <?php echo (isset($_GET['time']) && ($_GET['time'] == 'not')) ? 'selected="selected"' : ''; ?>>All</option>
                                            <option value="day" <?php echo (isset($_GET['time']) && ($_GET['time'] == 'day')) ? 'selected="selected"' : ''; ?>>1 day ago</option>
                                            <option value="week" <?php echo (isset($_GET['time']) && ($_GET['time'] == 'week')) ? 'selected="selected"' : ''; ?>>1 week ago</option>
                                            <option value="month" <?php echo (isset($_GET['time']) && ($_GET['time'] == 'month')) ? 'selected="selected"' : ''; ?>>1 month ago</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <td valign="top">
                                        <input type="submit" value="filter" class="form-submit" />
                                        <a href="<?php echo url('admin_orders'); ?>" class="form-reset" ></a>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
                        <!--  end filter form  -->
                    </div>
                    <!--  start table-content  -->
                    <div id="table-content">
                        <!--  start product-table ..................................................................................... -->

                        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                            <tr>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Username</a>	</th>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">First Name</a>	</th>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Last Name</a></th>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Status</a></th>
                                <th class="table-header-repeat line-left"><a href="">Created at</a></th>
                                <th class="table-header-repeat line-left"><a href="">Total value</a></th>
                                <th class="table-header-options line-left"><a href="">Options</a></th>
                            </tr>
                            <?php $i = 0; ?>
                            <?php foreach ($orders as $order): ?>

                                <tr <?php echo $i % 2 == 0 ? "" : "class='alternate-row'"; ?>>
                                    <td><?php echo $order->getUser()->getUsername(); ?></td>
                                    <td><?php echo $order->getUser()->getFirstname(); ?></td>
                                    <td><?php echo $order->getUser()->getLastname(); ?></td>
                                    <td> 
                                        <form action="<?php echo url('admin_orders/update_order_status'); ?>" method="post" >
                                            <select name="state">
                                                <?php foreach ($view->getStates() as $state): ?>
                                                    <option value="<?php echo $state->getId(); ?>" <?php echo ($order->getState() && ($order->getState()->getId() == $state->getId())) ? 'selected="selected"' : ''; ?>><?php echo $state->getLabel(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" name="order_id" value="<?php echo $order->getId(); ?>" />
                                            <input type="submit" value="Save"/>
                                        </form>
                                    </td>
                                    <td><?php echo $order->getDate(); ?></td>
                                    <td><?php echo $order->getTotal(); ?></td>

                                    <td class="options-width">
                                        <form action="<?php echo url('admin_orders/view_order'); ?>" method="get" >
                                            <input type="hidden" name="order_id" value="<?php echo $order->getId(); ?>" />
                                            <input type='submit' value='View' />
                                        </form>
                                        <form action="<?php echo url('admin_orders/delete_order'); ?>" method="post" >
                                            <input type="hidden" name="order_id" value="<?php echo $order->getId(); ?>" />
                                            <input type="submit" value="Delete"/>
                                        </form>

                                    </td>
                                </tr>
                                <?php $i = $i + 1; ?>
                            <?php endforeach; ?>
                        </table>
                        <!--  end product-table................................... --> 
                    </div>
                    <!--  end content-table  -->

                    <!--  start paging..................................................... -->
                    <table border="0" cellpadding="0" cellspacing="0" id="paging-table">
                        <tr>
                            <?php if ($paginator->getCurrent() > $paginator->getPages()): ?>
                                <?php $paginator->setCurrent($paginator->getPages()); ?>
                            <?php endif; ?>                        
                            <td>
                                <?php if (!(isset($_GET['username']) || isset($_GET['state']) || isset($_GET['time']))): ?>
                                    <a href="<?php echo url('admin_orders', array('page' => 1)); ?>" class="page-far-left"></a>
                                    <a href="<?php echo url("admin_orders", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1))); ?>" class="page-left"></a>
                                    <div id="page-info">Page <strong><?php echo $paginator->getCurrent(); ?></strong> / <?php echo $paginator->getPages(); ?></div>
                                    <a href="<?php echo url("admin_orders", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()))); ?>" class="page-right"></a>
                                    <a href="<?php echo url('admin_orders', array('page' => $paginator->getPages())); ?>" class="page-far-right"></a>
                                <?php else: ?>
                                    <a href="<?php echo url('admin_orders', array('page' => 1, 'username' => $_GET['username'], 'state' => $_GET['state'], 'time' => $_GET['time'])); ?>" class="page-far-left"></a>
                                    <a href="<?php echo url("admin_orders", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'username' => $_GET['username'], 'state' => $_GET['state'], 'time' => $_GET['time'])); ?>" class="page-left"></a>
                                    <div id="page-info">Page <strong><?php echo $paginator->getCurrent(); ?></strong> / <?php echo $paginator->getPages(); ?></div>
                                    <a href="<?php echo url("admin_orders", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'username' => $_GET['username'], 'state' => $_GET['state'], 'time' => $_GET['time'])); ?>" class="page-right"></a>
                                    <a href="<?php echo url('admin_orders', array('page' => $paginator->getPages(), 'username' => $_GET['username'], 'state' => $_GET['state'], 'time' => $_GET['time'])); ?>" class="page-far-right"></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <!--  end paging................ -->

                    <div class="clear"></div>

                </div>
                <!--  end content-table-inner ............................................END  -->
            </td>
            <td id="tbl-border-right"></td>
        </tr>
        <tr>
            <th class="sized bottomleft"></th>
            <td id="tbl-border-bottom">&nbsp;</td>
            <th class="sized bottomright"></th>
        </tr>
    </table>
<?php endif; ?>

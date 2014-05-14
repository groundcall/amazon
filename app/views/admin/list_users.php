<?php $view->extend('masterpages/cpanel'); ?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>User list</h1>
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

                <!--  start table-content  -->
                <div id="table-content">


                    <!--  start product-table ..................................................................................... -->

                    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                        <tr>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Username</a>	</th>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Last Name</a>	</th>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">First Name</a></th>
                            <th class="table-header-repeat line-left minwidth-1"><a href="">Email</a></th>
                            <th class="table-header-repeat line-left"><a href="">Status</a></th>
                            <th class="table-header-options line-left"><a href="">Options</a></th>
                        </tr>

                        <?php $i = 0; ?>
                        <?php foreach ($users as $user): ?>
                            <tr <?php echo $i % 2 == 0 ? "" : "class='alternate-row'"; ?>>
                                <td><?php echo $user->getUsername(); ?></td>
                                <td><?php echo $user->getLastname(); ?></td>
                                <td><a href=""><?php echo $user->getFirstname(); ?></a></td>
                                <td><?php echo $user->getEmail(); ?></td>
                                <td><?php echo ($user->getActivated() == 0) ? 'inactive' : 'active'; ?></td>
                                <td class="options-width">
                                    <form action="<?php echo url("admin_users/show_edit_user");?>" method="get" >
                                        <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>" />
                                        <input type="submit" value="Edit" />
                                    </form>

                                    <form action="<?php echo url('admin_users/delete_user'); ?>" method="post" >
                                        <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>" />
                                        <input type="submit" value="Delete"/>
                                    </form>

                                    <form action="<?php echo url('admin_users/activate_user'); ?>" method="post" >
                                        <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>" />
                                        <input type="submit" value="<?php echo ($user->getActivated() == 1) ? 'Deactivate' : 'Activate'; ?>" name="<?php echo ($user->getActivated() == 1) ? 'deactivate' : 'activate'; ?>" />
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
                        <td>
                            <a href="" class="page-far-left"></a>
                            <a href="" class="page-left"></a>
                            <div id="page-info">Page <strong>1</strong> / ??</div>
                            <a href="" class="page-right"></a>
                            <a href="" class="page-far-right"></a>
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
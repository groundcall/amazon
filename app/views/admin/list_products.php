<?php $view->extend('masterpages/cpanel'); ?>
<!--  start page-heading -->
<div id="page-heading">
    <h1>Product list</h1>
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
                    <form action="<?php echo url('admin_products/filter_products'); ?>" method="get" >
                        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                            <tr>
                                <th valign="top">Product name:</th>
                                <td><input type="text" class="inp-form" name="product_name" value="<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : ''; ?>"/></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th valign="top">Category:</th>
                                <td>	
                                    <select name="category">
                                        <option value="0" <?php echo (isset($_GET['category']) && ($_GET['category'] == 0)) ? 'selected="selected"' : ''; ?>>All categories</option>
                                        <?php foreach ($view->getCategories() as $category): ?>
                                            <option value="<?php echo $category->getId(); ?>" <?php echo (isset($_GET['category']) && ($_GET['category'] == $category->getId())) ? 'selected="selected"' : ''; ?>><?php echo $category->getLabel(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th valign="top">Stock:</th>
                                <td><input type="checkbox" class="inp-form" name="stock" <?php echo (isset($_GET['stock']) && ($_GET['stock'] == 'on')) ? 'checked="checked"' : ''; ?>/></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                                <td valign="top">
                                    <input type="submit" value="Filter" class="form-submit" />
                                    <a href="<?php echo url('admin_products'); ?>" class="form-reset" ></a>
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
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Product Name</a>	</th>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Category</a>	</th>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Short description</a></th>
                                <th class="table-header-repeat line-left minwidth-1"><a href="">Price</a></th>
                                <th class="table-header-repeat line-left"><a href="">Stock</a></th>
                                <th class="table-header-options line-left"><a href="">Options</a></th>
                            </tr>
                            <?php $i = 0; ?>
                            <?php foreach ($products as $product): ?>
                                 <tr <?php echo $i % 2 == 0 ? "" : "class='alternate-row'"; ?>>
                                    <td><?php echo $product->getTitle(); ?></td>
                                    <td><?php echo $product->getLabel(); ?></td>
                                    <td><?php echo $product->getShort_description(); ?></td>
                                    <td><?php echo $product->getPrice(); ?></td>
                                    <td><?php echo $product->getStock(); ?></td>
                                    <td class="options-width">
                                        <form action="<?php echo url('admin_products/show_edit_product'); ?>" method="get" >
                                            <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
                                            <input type="submit" value="Edit" />
                                        </form>
                                        
                                        <form action="<?php echo url('admin_products/delete_product'); ?>" method="post" >
                                            <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
                                            <input type="submit" value="Delete" />
                                        </form>
                                        
                                        <form action="<?php echo url('admin_products/activate_product'); ?>" method="post" >
                                            <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
                                            <input type="submit" value="<?php echo ($product->getActive() == 1) ? 'Deactivate' : 'Activate'; ?>" name="<?php echo ($product->getActive() == 1) ? 'deactivate' : 'activate'; ?>" />
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
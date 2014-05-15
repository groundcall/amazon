<?php $view->extend('masterpages/cpanel'); ?>

<div id="page-heading"><h1>Add product</h1></div>

<?php if (isset($_POST['submit'])): ?>
    <!--  start message-red -->
    <?php if ($product != null): ?>
        <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="red-left">Error. <a href="<?php echo url('admin_products/add_product'); ?>">Please try again.</a></td>
                    <td class="red-right"><a class="close-red" href="<?php echo url('admin_products'); ?>"><img src="../images/table/icon_close_red.gif"/></a></td>
                </tr>
            </table>
        </div>
        <!--  end message-red -->

        <!--  start message-green -->
    <?php else: ?>
        <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="green-left">Product added sucessfully. <a href="<?php echo url('admin_products/add_product'); ?>">Add new one.</a></td>
                    <td class="green-right"><a class="close-green" href="<?php echo url('admin_products'); ?>"><img src="../images/table/icon_close_green.gif"/></a></td>
                </tr>
            </table>
        </div>
        <!--  end message-green -->
    <?php endif; ?>
<?php endif; ?>

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
                            <!-- start id-form -->
                            <form  enctype="multipart/form-data" method="post" action="<?php echo url('admin_products/add_product'); ?>">
                                <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                    <tr>
                                        <th valign="top">Product name:</th>
                                        <td><input type="text" class="inp-form" name="data[title]" value="<?php echo ($product) ? $product->getTitle() : ""; ?>" /></td>
                                        <td>
                                            <?php if ($product && $product->hasError('title')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($product, "title"); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Category:</th>
                                        <td>	
                                            <select name="data[category_id]">
                                                <?php foreach ($view->getCategories() as $category): ?>
                                                    <option value="<?php echo $category->getId(); ?>" <?php echo (isset($_POST['data']['category_id']) && ($_POST['data']['category_id'] == $category->getId())) ? 'selected="selected"' : ''; ?>><?php echo $category->getLabel(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Short description:</th>
                                        <td><input type="text" class="inp-form" name="data[short_description]" value="<?php echo ($product) ? $product->getShort_description() : ""; ?>" /></td>
                                        <td>
                                            <?php if ($product && $product->hasError('short_description')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($product, "short_description"); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr> 

                                    <tr>
                                        <th valign="top">Price:</th>
                                        <td><input type="number" class="inp-form" name="data[price]" value="<?php echo ($product) ? $product->getPrice() : ''; ?>" placeholder="0"/></td>
                                        <td>
                                            <?php if ($product && $product->hasError('price')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($product, "price"); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th>Image:</th>
                                        <td><input type="file" class="file_1" name="image" /></td>
                                        <td>
                                            <?php if ($image && $image->hasError('type')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($image, "type"); ?></div>
                                            <?php endif; ?>
                                            <?php if ($image && $image->hasError('size')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($image, "size"); ?></div>
                                            <?php endif; ?></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Description:</th>
                                        <td>
                                            <textarea rows="" cols="" class="form-textarea" name="data[description]"><?php echo ($product) ? $product->getDescription() : ""; ?></textarea>
                                        </td>
                                        <td>
                                            <?php if ($product && $product->hasError('description')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($product, "description"); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th valign="top">Stock:</th>
                                        <td><input type="number" class="inp-form" name="data[stock]" value="<?php echo ($product) ? $product->getStock() : ''; ?>" placeholder="0"/></td>
                                        <td>
                                            <?php if ($product && $product->hasError('stock')): ?>
                                                <div class="error-left"></div>
                                                <div class="error-inner" style="font-size: 12px;"><?php echo $view->errorFor($product, "stock"); ?></div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>&nbsp;</th>
                                        <td valign="top">
                                            <input type="submit" value="Add" class="form-submit" name='submit' />
                                            <a href="<?php echo url('admin_products/show_product_form'); ?>" class="form-reset" ></a>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <!-- end id-form  -->
                            </form>
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

<div class="clear">&nbsp;</div>

</div>

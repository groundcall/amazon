<?php $view->extend('masterpages/products'); ?>

<div class="col-wrapper">
    <div class="col-main">
        <div class="box best-selling">
            <h3>Latest Products</h3>
            <table cellspacing="0" border="0">
                <tbody>
                    <?php $i = 0; ?>
                    <?php $products = $view->getLastSixProducts(); ?>
                    <?php for ($k = 0; $k < sizeof($products); $k += 2): ?>
                        <tr class="<?php echo ($i % 2 == 0) ? 'odd' : 'even'; ?>">
                            <td>
                                <a href="<?php echo url('products/show_details', array('product_id' => $products[$k]->getId())); ?>">
                                    <img width="95" alt="" src="<?php echo '../product_images' . $products[$k]->getImage(); ?>" class="product-img">
                                </a>
                                <div class="product-description">
                                    <p><a href="<?php echo url('products/show_details', array('product_id' => $products[$k]->getId())); ?>"><?php echo $products[$k]->getTitle(); ?></a></p>
                                    <p>See all <a href="<?php echo url('products/show_products', array('category' => $products[$k]->getCategory_id())) ?>"><?php echo $products[$k]->getCategory(); ?></a></p>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo url('products/show_details', array('product_id' => $products[$k + 1]->getId())); ?>">
                                    <img width="95" alt="" src="<?php echo '../product_images/' . $products[$k + 1]->getImage(); ?>" class="product-img">
                                </a>
                                <div class="product-description">
                                    <p><a href="<?php echo url('products/show_details', array('product_id' => $products[$k + 1]->getId())); ?>"><?php echo $products[$k + 1]->getTitle(); ?></a></p>
                                    <p>See all <a href="<?php echo url('products/show_products', array('category' => $products[$k + 1]->getCategory_id())) ?>"><?php echo $products[$k + 1]->getCategory(); ?></a></p>
                                </div>
                            </td>
                        </tr>
                        <?php $i = $i + 1; ?>
                    <?php endfor; ?>
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-left sidebar"></div>
</div>
<div class="col-right sidebar">
    <div class="block block-cart">
        <div class="block-title">
            <strong><span>My Cart</span></strong>
        </div>
        <div class="block-content">
            <p class="empty">You have no items in your shopping cart.</p>
        </div>
    </div>

</div>

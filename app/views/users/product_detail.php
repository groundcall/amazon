<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>
        <div class="wrapper">
            <div class="page">

                <?php $view->render('users/user_navigation'); ?>

                <div class="main-container col2-right-layout">
                    <div class="main">
                        <div class="breadcrumbs">
                            <ul>
                                <li class="home">
                                    <a href="<?php echo url('products/'); ?>" title="Go to Home Page">Home</a>
                                    <span>/ </span>
                                </li>

                                <li class="category10">
                                    <a href="<?php echo url('products/category', array('category' => $product->getCategory_id())); ?>" title=""><?php echo $product->getCategory(); ?></a>
                                    <span>/ </span>
                                </li>
                                <li class="product">
                                    <strong><?php echo $product->getTitle(); ?></strong>
                                </li>
                            </ul>
                        </div>
                        <div class="col-main">
                            <?php if (isset($_SESSION['add_status'])): ?>
                                <?php if ($_SESSION['add_status'] == 'ok'): ?>
                                    <div id="messages_product_view">
                                        <ul class="messages">
                                            <li class="success-msg">
                                                <ul>
                                                    <li><span><?php echo $product->getTitle(); ?> was added to your shopping cart.</span></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div id="messages_product_view">
                                        <ul class="error-msg">
                                            <li class="error">
                                                <ul>
                                                    <li><span><?php echo $_SESSION['add_status'][0]; ?></span></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php $_SESSION['add_status'] = null; ?>
                            <?php endif; ?>

                            <div class="product-view">
                                <div class="product-essential">
                                    <form action="<?php echo url('cart/add_cart_item_to_cart'); ?>" method="post" id="product_addtocart_form">
                                        <div class="product-shop">
                                            <div class="product-name">
                                                <h1><?php echo $product->getTitle(); ?></h1>
                                            </div>

                                            <div class="short-description">
                                                <h2><?php echo $product->getShort_description(); ?></h2>
                                                <div class="std"></div>
                                            </div>

                                            <p class="availability in-stock">Availability: <span><?php echo ($product->getStock() > 0) ? 'In stock (' . $product->getStock() . ')' : 'Not available'; ?></span></p>


                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-MyProductID">
                                                    <span class="price"><?php echo $product->getPrice() . ' $'; ?></span>
                                                </span>
                                            </div>


                                            <div class="add-to-box">
                                                <div class="add-to-cart">
                                                    <label for="qty">Quantity:</label>
                                                    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
                                                    <input type="text" name="quantity" id="qty" maxlength="12" value="1" title="Quantity" class="input-text qty" />
                                                    <button type="submit" title="Add to Cart" class="button btn-cart" ><span><span>Add to Cart</span></span></button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="product-img-box">
                                            <p class="product-image product-image-zoom">
                                                <img id="image" src="<?php echo '../product_images' . $product->getImage(); ?>" style="width: 200px; height: 280px;" alt="<?php echo $product->getTitle(); ?>" title="<?php echo $product->getTitle(); ?>" />
                                            </p>
                                        </div>

                                        <div class="clearer"></div>
                                    </form>

                                </div>

                                <div class="product-collateral">
                                    <div class="box-collateral box-description">
                                        <h2>Details</h2>
                                        <div class="std"><?php echo $product->getDescription(); ?></div>
                                    </div>
                                    <p><a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; ?>"><span>&laquo; Go Back</span></a></p>

                                    <div class="box-collateral box-up-sell">
                                        <h2>You may also be interested in the following product(s)</h2>
                                        <table class="products-grid" id="upsell-product-table">
                                            <tr>
                                                <?php foreach ($randomProducts as $randomProduct): ?>
                                                    <td>
                                                        <a href="<?php echo url('products/show_details', array('product_id' => $randomProduct->getId())); ?>" title="<?php echo $randomProduct->getTitle(); ?>" class="product-image">
                                                            <img src="<?php echo '../product_images' . $randomProduct->getImage(); ?>" width="125" height="125" alt="<?php echo $randomProduct->getTitle(); ?>" />
                                                        </a>
                                                        <h3 class="product-name">
                                                            <a href="<?php echo url('products/show_details', array('product_id' => $randomProduct->getId())); ?>" title="<?php echo $randomProduct->getTitle(); ?>"><?php echo $randomProduct->getTitle(); ?></a>
                                                        </h3>

                                                        <div class="price-box">
                                                            <p class="minimal-price">
                                                                <span class="price-label">Starting at:</span>
                                                                <span class="price" id="product-minimal-price-54-upsell"><?php echo $randomProduct->getPrice() . ' $'; ?></span>
                                                            </p>
                                                        </div>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($_SESSION)): ?>
                            <div class="col-right sidebar">
                                <div class="block block-cart">
                                    <div class="block-title">
                                        <strong><span>My Cart</span></strong>
                                    </div>
                                    <?php if (!$cart->getCart_item()): ?>
                                        <div class="block-content">
                                            <p class="empty">You have no items in your shopping cart.</p>
                                        </div>
                                    <?php else: ?>
                                        <div class="block-content">
                                            <p class="empty">There are <a href="<?php echo url('cart/show_cart'); ?>"> <?php echo $view->getNumberOfItemsInCart($cart->getId()); ?> items  </a>in your cart</p>
                                        </div>
                                        <p class="subtotal">
                                            <?php $total = $view->calculateCartTotal($cart->getId()); ?>
                                            <span class="label">Cart Subtotal:</span> <span class="price"><?php echo $total; ?> US$</span>
                                        </p>
                                        <div class="actions">
                                            <button type="button" title="Checkout" class="button" onclick='window.location="<?php echo url('checkout/'); ?>"'><span><span>Checkout</span></span></button>
                                        </div>

                                        <p class="block-subtitle">Recently added item(s)</p>

                                        <ol id="cart-sidebar" class="mini-products-list">

                                            <?php $cart_items = $cart->getCart_item() ?>
                                            <?php foreach ($cart_items as $cart_item): ?>
                                                <?php $product = $cart_item->getProduct(); ?> 
                                                <li class="item">
                                                    <a href="<?php echo url('products/show_details', array('product_id' => $product->getId())); ?>" title="<?php echo $product->getTitle(); ?>" class="product-image">
                                                        <img src="<?php echo '../product_images' . $product->getImage(); ?>" width="50" height="50" alt="Ottoman" />
                                                    </a>
                                                    <div class="product-details">
                                                        <a href="<?php echo url('cart/delete_cart_item_from_cart', array('cart_item_id' => $cart_item->getId())) ?>" title="Remove This Item" class="btn-remove">Remove This Item</a>
                                                        <a href="<?php echo url('cart/show_cart'); ?> " title="Edit item" class="btn-edit">Edit item</a>
                                                        <p class="product-name"><a href="<?php echo url('products/show_details', array('product_id' => $product->getId())); ?>"><?php echo $product->getTitle(); ?></a></p>
                                                        <strong><?php echo $cart_item->getQuantity(); ?></strong> x
                                                        <span class="price"><?php echo $product->getPrice(); ?> US$</span>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
                <div class="footer-container">
                    <?php $view->render('users/user_footer'); ?>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>



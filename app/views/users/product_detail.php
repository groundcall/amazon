
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>
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

                            <div id="messages_product_view">
                                <ul class="messages">
                                    <li class="success-msg">
                                        <ul>
                                            <li><span>Ottoman was added to your shopping cart.</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-view">
                                <div class="product-essential">
                                    <form action="" method="post" id="product_addtocart_form">
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
                                                    <input type="text" name="qty" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty" />
                                                    <button type="button" title="Add to Cart" class="button btn-cart" ><span><span>Add to Cart</span></span></button>
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
                                    <p><a href="<?php echo url('products/'); ?>"><span>&laquo; Back to list</span></a></p>
                                    
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
                        <div class="col-right sidebar">
                            <div class="block block-cart">
                                <div class="block-title">
                                    <strong><span>My Cart</span></strong>
                                </div>
                                <div class="block-content">
                                    <div class="summary">
                                        <p class="amount">There are <a href="cart.html">2 items</a> in your cart.</p>
                                        <p class="subtotal">
                                            <span class="label">Cart Subtotal:</span> <span class="price">299,98 US$</span>
                                        </p>
                                    </div>

                                    <div class="actions">
                                        <button type="button" title="Checkout" class="button" ><span><span>Checkout</span></span></button>
                                    </div>

                                    <p class="block-subtitle">Recently added item(s)</p>

                                    <ol id="cart-sidebar" class="mini-products-list">

                                        <li class="item">
                                            <a href="#" title="Ottoman" class="product-image">
                                                <img src="images/couchlarge_2.jpg" width="50" height="50" alt="Ottoman" />
                                            </a>
                                            <div class="product-details">
                                                <a href="#" title="Remove This Item" class="btn-remove">Remove This Item</a>
                                                <a href="#" title="Edit item" class="btn-edit">Edit item</a>
                                                <p class="product-name"><a href="#">Ottoman</a></p>
                                                <strong>1</strong> x
                                                <span class="price">199,99 US$</span>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="#" title="Chair" class="product-image">
                                                <img src="images/couchlarge_2.jpg" width="50" height="50" alt="Chair" />
                                            </a>
                                            <div class="product-details">
                                                <a href="#" title="Remove This Item" class="btn-remove">Remove This Item</a>
                                                <a href="#" title="Edit item" class="btn-edit">Edit item</a>
                                                <p class="product-name"><a href="#">Chair</a></p>
                                                <strong>1</strong> x
                                                <span class="price">99,99 US$</span>
                                            </div>
                                        </li>
                                    </ol>

                                </div>
                            </div>
                        </div>
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



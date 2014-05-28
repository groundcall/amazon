<?php if (isset($user)): $cart = $user->getCart(); ?>
<?php endif; ?>

<div class="col-right sidebar">
    <div class="block block-cart">
        <div class="block-title">
            <strong><span>My Cart</span></strong>
        </div>
        <?php if (!isset($cart)): ?>
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
                <button type="button" title="Checkout" class="button" onclick='window.location = "<?php echo url('checkout/'); ?>"'><span><span>Checkout</span></span></button>
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
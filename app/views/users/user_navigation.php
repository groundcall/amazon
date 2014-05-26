<div class="header-container">
    <div class="header">
        <div class="quick-access">
            <form id="search_mini_form" action="<?php echo url('products/show_products'); ?>" method="get">
                <div class="form-search">
                    <label for="search">Search:</label>
                    <input id="search" type="text" name="title" value="" class="input-text" maxlength="128" />
                    <button type="submit" title="Search" class="button"><span><span>Search</span></span></button>
                </div>
            </form>
            <?php if (!empty($_SESSION['username'])): ?>
                <?php if ($_SESSION['is_admin'] != 1): ?>
                    <p class="welcome-msg"><?php echo 'Welcome, ' . $_SESSION['username']; ?><br /></p>;
                <?php else: ?>
                    <a href="<?php echo url("admin_products"); ?>" class="welcome-msg"><?php echo 'Welcome, ' . $_SESSION['username']; ?><br /></a>
                <?php endif; ?>
            <?php endif; ?>

            <ul class="links">
                <?php if (!empty($_SESSION['id'])): ?>
                    <li class="first" ><a href="dashboard.html" title="My Account" >My Account</a></li>
                    <li ><a href="<?php echo url('cart/show_cart'); ?>" title="My Cart" class="top-link-cart">My Cart</a></li>
                    <li class="last" ><a href="checkout.html" title="Checkout" class="top-link-checkout">Checkout</a></li>
                    <li ><a href="<?php echo url('users/logout'); ?>" title="Log Out" class="top-link-cart">Log Out</a></li>
                <?php else: ?>
                    <li class="first" ><a href="<?php echo url('users/show_login_form'); ?>" title="Log In" >Log In</a></li>
                    <li ><a href="<?php echo url('users/show_user_form'); ?>" title="Register" class="top-link-cart">Register</a></li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</div>

<div class="nav-container">
    <ul id="nav">
        <li >
            <a href="<?php echo url('products/index'); ?>"><span>H</span></a>
        </li>
        <?php $categories = $view->getCategories(); ?>
        <?php foreach ($categories as $category): ?>
            <li class="level0 nav-1 level-top first">
                <a href="<?php echo url('products/show_products', array('category' => $category->getId())) ?>" class="level-top" ><span><?php echo $category->getLabel(); ?></span></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


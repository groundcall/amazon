<div class="header-container">
    <div class="header">
        <div class="quick-access">
            <form id="search_mini_form" action="<?php echo url('products/search'); ?>" method="get">
                <div class="form-search">
                    <label for="search">Search:</label>
                    <input id="search" type="text" name="title" value="" class="input-text" maxlength="128" />
                    <button type="submit" title="Search" class="button"><span><span>Search</span></span></button>
                </div>
            </form>

            <p class="welcome-msg">Welcome </p>

            <ul class="links">
                <li class="first" ><a href="dashboard.html" title="My Account" >My Account</a></li>
                <li ><a href="cart.html" title="My Cart" class="top-link-cart">My Cart</a></li>
                <li class="last" ><a href="checkout.html" title="Checkout" class="top-link-checkout">Checkout</a></li>
            </ul>

        </div>
    </div>
</div>

<div class="nav-container">
    <ul id="nav">
        <?php $categories = $view->getCategories(); ?>
        <?php foreach ($categories as $category): ?>
            <li class="level0 nav-1 level-top first">
                <a href="#" class="level-top" ><span><?php echo $category->getLabel(); ?></span></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="header-container">
    <div class="header">
        <div class="quick-access">
            <form id="search_mini_form" action="product_list.html" method="get">
                <div class="form-search">
                    <label for="search">Search:</label>
                    <input id="search" type="text" name="q" value="" class="input-text" maxlength="128" />
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
        <?php foreach ($view->getCategories() as $category): ?>
            <li class="level0 nav-1 level-top first">
                <a href="<?php echo url('products/category', array('category' => $category->getId()));?>" class="level-top" ><span><?php echo $category->getLabel(); ?></span></a>
            </li>
            <option value="<?php echo $category->getId(); ?>" <?php echo (isset($_GET['category']) && ($_GET['category'] == $category->getId())) ? 'selected="selected"' : ''; ?>><?php echo $category->getLabel(); ?></option>
        <?php endforeach; ?>
    </ul>
</div>
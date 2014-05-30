<?php $view->extend('masterpages/front_masterpage'); ?>
<div class="main-container col3-layout">
    <div class="main">
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="<?php echo url('products/'); ?>" title="Go to Home Page">Home</a>
                    <span>/ </span>
                </li>
                <?php if ($filtering->getCategory_id()): ?>
                    <?php $category = $view->getCategoryLabelById($filtering->getCategory_id()); ?>

                    <li class="category35">
                        <strong><?php echo ($category); ?></strong>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="col-wrapper">
            <div class="col-main">
                <?php if ($_SESSION['add_status'] == 'ok'): ?>
                    <div id="messages_product_view">
                        <ul class="messages">
                            <li class="success-msg">
                                <ul>
                                    <li><span>The item was added to your shopping cart.</span></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php $_SESSION['add_status'] = null; ?>
                <?php endif; ?>
                <?php if (sizeof($products) == 0): ?>
                    <div class="page-title category-title">
                        <h1>No Products Match Your Search Criteria</h1>
                    </div>
                <?php elseif ($filtering->getCategory_id()): ?>
                    <div class="page-title category-title">
                        <h1><?php echo $category ?></h1>
                    </div>
                <?php endif; ?>


                <div class="category-products">
                    <div class="toolbar">
                        <?php if (sizeof($products) > 0): ?>
                            <div class="pager">
                                <p class="amount">
                                    <strong><?php echo $paginator->getCount(); ?>  Item(s)</strong>
                                </p>
                                <?php if ($paginator->getCurrent() > $paginator->getPages()): ?>
                                    <?php $paginator->setCurrent($paginator->getPages()); ?>
                                <?php endif; ?>    
                                <div class="pages">
                                    <strong>Page:</strong>
                                    <ol>
                                        <?php if ($paginator->getCurrent() >= 1): ?>
                                            <?php if ($paginator->getCurrent() > 1): ?>
                                                <li>
                                                    <a class="next i-next" href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>" title="Previous" style="text-decoration: none;">
                                                        <<
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>">
                                                    <?php echo ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : ''; ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <li class="current"><?php echo $paginator->getCurrent(); ?></li>

                                        <?php if ($paginator->getCurrent() <= $paginator->getPages()): ?>
                                            <li>
                                                <a href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>">
                                                    <?php echo ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : ''; ?>
                                                </a>
                                            </li>
                                            <?php if ($paginator->getCurrent() < $paginator->getPages()): ?>
                                                <li>
                                                    <a class="next i-next" href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>" title="Next" style="text-decoration: none;">
                                                        >>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </ol>
                                </div>
                            </div>
                            <div class="sorter">
                                <div class="sort-by">
                                    <form method="get" action="<?php echo url('products/show_products/') ?>">
                                        <label>Sort By</label>
                                        <select name='sort'>
                                            <option value="title" <?php echo ($filtering && $filtering->getSort() == 'title') ? 'selected' : ''; ?>>Name</option>
                                            <option value="price" <?php echo ($filtering && $filtering->getSort() == 'price') ? 'selected' : ''; ?>>Price</option>
                                        </select>
                                        &nbsp;
                                        <label>Direction</label>
                                        <select name='order'>
                                            <option value="ASC" <?php echo ($filtering && $filtering->getOrder() == 'ASC') ? 'selected' : ''; ?>>Asc</option>
                                            <option value="DESC" <?php echo ($filtering && $filtering->getOrder() == 'DESC') ? 'selected' : ''; ?>>Desc</option>
                                        </select>
                                        <input type='hidden' name='title' value='<?php echo ($filtering->getTitle()) ? $filtering->getTitle() : '' ?>' />
                                        <input type='hidden' name='stock' value='<?php echo ($filtering->getStock()) ? $filtering->getStock() : '' ?>' />
                                        <input type='hidden' name='price' value='<?php echo ($filtering->getPrice()) ? $filtering->getPrice() : '' ?>' />
                                        <input type='hidden' name='page' value='<?php echo ($paginator->getCurrent()) ? $paginator->getCurrent() : '1' ?>' />
                                        <input type='hidden' name='category' value='<?php echo ($filtering->getCategory_id()) ? $filtering->getCategory_id() : '' ?>' />
                                        <input type="submit" name="Submit" value='Submit' />
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php for ($k = 0; $k < sizeof($products); $k += 3): ?>
                        <ul class="products-grid">
                            <li class="item first">
                                <a href="<?php echo url('products/show_details', array('product_id' => $products[$k]->getId())); ?>" title="<?php echo $products[$k]->getTitle(); ?>" class="product-image"><img src="<?php echo '../product_images' . $products[$k]->getImage(); ?>" width="135" height="135" alt="<?php echo $products[$k]->getTitle(); ?>" /></a>
                                <h2 class="product-name"><a href="<?php echo url('products/show_details', array('product_id' => $products[$k]->getId())); ?>" title="<?php echo $products[$k]->getTitle(); ?>"><?php echo $products[$k]->getTitle(); ?></a></h2>
                                <div class="price-box">
                                    <span class="regular-price" id="product-price-168">
                                        <span class="price"><?php echo $products[$k]->getPrice(); ?> US$</span>
                                    </span>
                                </div>
                                <?php if ($view->checkQuantity($cart, $products[$k])): ?>
                                    <div class="actions">
                                        <form action="<?php echo url('cart/add_item'); ?>" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $products[$k]->getId(); ?>" />
                                            <button type="submit" title="Add to Cart" class="button btn-cart" >
                                                <span><span>Add to Cart</span></span>
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <div class="actions">
                                        <button class="button btn-cart" >
                                            <span><span>Out of stock</span></span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </li>

                            <li class="item">

                                <?php if (isset($products[$k + 1])): ?>
                                    <a href="<?php echo url('products/show_details', array('product_id' => $products[$k + 1]->getId())); ?>" title="<?php echo $products[$k + 1]->getTitle(); ?>" class="product-image">
                                        <img src="<?php echo '../product_images' . $products[$k + 1]->getImage(); ?>" width="135" height="135" alt="<?php echo $products[$k + 1]->getTitle(); ?>" />
                                    </a>

                                    <h2 class="product-name">
                                        <a href="<?php echo url('products/show_details', array('product_id' => $products[$k + 1]->getId())); ?>" title="<?php echo $products[$k + 1]->getTitle(); ?>"><?php echo $products[$k + 1]->getTitle(); ?></a>
                                    </h2>

                                    <div class="price-box">
                                        <span class="regular-price" id="product-price-170">
                                            <span class="price"><?php echo $products[$k + 1]->getPrice(); ?> US$</span>
                                        </span>
                                    </div>
                                    <?php if ($view->checkQuantity($cart, $products[$k + 1])): ?>

                                        <div class="actions">
                                            <form action="<?php echo url('cart/add_item', array('product_id' => $products[$k + 1]->getId())); ?>" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $products[$k + 1]->getId(); ?>" />
                                                <button type="submit" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <div class="actions">
                                            <button class="button btn-cart" >
                                                <span><span>Out of stock</span></span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </li>


                            <li class="item">
                                <?php if (isset($products[$k + 2])): ?>
                                    <a href="<?php echo url('products/show_details', array('product_id' => $products[$k + 2]->getId())); ?>" title="<?php echo $products[$k + 2]->getTitle(); ?>" class="product-image">
                                        <img src="<?php echo '../product_images' . $products[$k + 2]->getImage(); ?>" width="135" height="135" alt="<?php echo $products[$k + 2]->getTitle(); ?>" />
                                    </a>

                                    <h2 class="product-name">
                                        <a href="<?php echo url('products/show_details', array('product_id' => $products[$k + 2]->getId())); ?>" title="<?php echo $products[$k + 2]->getTitle(); ?>"><?php echo $products[$k + 2]->getTitle(); ?></a>
                                    </h2>

                                    <div class="price-box">
                                        <span class="regular-price" id="product-price-170">
                                            <span class="price"><?php echo $products[$k + 2]->getPrice(); ?> US$</span>
                                        </span>
                                    </div>
                                    <?php if ($view->checkQuantity($cart, $products[$k + 2])): ?>
                                        <div class="actions">
                                            <form action="<?php echo url('cart/add_item', array('product_id' => $products[$k + 2]->getId())); ?>" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $products[$k + 2]->getId(); ?>" />
                                                <button type="submit" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <div class="actions">
                                            <button class="button btn-cart" >
                                                <span><span>Out of stock</span></span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </li>
                        </ul>
                    <?php endfor; ?>

                    <div class="toolbar-bottom">
                        <div class="toolbar">
                            <?php if (sizeof($products) > 0): ?>
                                <div class="pager">
                                    <p class="amount">
                                        <strong><?php echo $paginator->getCount(); ?>  Item(s)</strong>
                                    </p>
                                    <?php if ($paginator->getCurrent() > $paginator->getPages()): ?>
                                        <?php $paginator->setCurrent($paginator->getPages()); ?>
                                    <?php endif; ?>    
                                    <div class="pages">
                                        <strong>Page:</strong>
                                        <ol>
                                            <?php if ($paginator->getCurrent() >= 1): ?>
                                                <?php if ($paginator->getCurrent() > 1): ?>
                                                    <li>
                                                        <a class="next i-next" href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>" title="Previous" style="text-decoration: none;">
                                                            <<
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <a href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>">
                                                        <?php echo ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : ''; ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <li class="current"><?php echo $paginator->getCurrent(); ?></li>

                                            <?php if ($paginator->getCurrent() <= $paginator->getPages()): ?>
                                                <li>
                                                    <a href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>">
                                                        <?php echo ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : ''; ?>
                                                    </a>
                                                </li>
                                                <?php if ($paginator->getCurrent() < $paginator->getPages()): ?>
                                                    <li>
                                                        <a class="next i-next" href="<?php echo url("products/show_products", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'price' => $filtering->getPrice())); ?>" title="Next" style="text-decoration: none;">
                                                            >>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </ol>
                                    </div>
                                </div>

                                <div class="sorter">
                                    <div class="sort-by">
                                        <form method="get" action="<?php echo url('products/show_products/') ?>">
                                            <label>Sort By</label>
                                            <select name='sort'>
                                                <option value="title" <?php echo ($filtering && $filtering->getSort() == 'title') ? 'selected' : ''; ?>>Name</option>
                                                <option value="price" <?php echo ($filtering && $filtering->getSort() == 'price') ? 'selected' : ''; ?>>Price</option>
                                            </select>
                                            &nbsp;
                                            <label>Direction</label>
                                            <select name='order'>
                                                <option value="ASC" <?php echo ($filtering && $filtering->getOrder() == 'ASC') ? 'selected' : ''; ?>>Asc</option>
                                                <option value="DESC" <?php echo ($filtering && $filtering->getOrder() == 'DESC') ? 'selected' : ''; ?>>Desc</option>
                                            </select>
                                            <input type='hidden' name='title' value='<?php echo ($filtering->getTitle()) ? $filtering->getTitle() : '' ?>' />
                                            <input type='hidden' name='stock' value='<?php echo ($filtering->getStock()) ? $filtering->getStock() : '' ?>' />
                                            <input type='hidden' name='price' value='<?php echo ($filtering->getPrice()) ? $filtering->getPrice() : '' ?>' />
                                            <input type='hidden' name='page' value='<?php echo ($paginator->getCurrent()) ? $paginator->getCurrent() : '1' ?>' />
                                            <input type='hidden' name='category' value='<?php echo ($filtering->getCategory_id()) ? $filtering->getCategory_id() : '' ?>' />
                                            <input type="submit" name="Submit" value='Submit' />
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-left sidebar">
                <div class="block block-layered-nav">
                    <div class="block-title">
                        <strong><span>Shop By</span></strong>
                    </div>
                    <div class="block-content">
                        <?php if (($filtering->getPrice() != null || $filtering->getStock() != null) || $filtering->getSort() != null || $filtering->getOrder() != null || ($filtering->getCategory_id() != null) && $filtering->getCategory_id() != 0): ?>
                            <div class="currently">
                                <p class="block-subtitle">Currently Shopping by:</p>
                                <?php if ($filtering->getCategory_id() != null && $filtering->getCategory_id() != 0): ?>
                                    <ol>
                                        <li>
                                            <span class="label">Category:</span> <span class="value"><?php echo $view->getCategoryLabelById(($filtering->getCategory_id())); ?></span><a class="btn-remove" href="<?php echo url('products/show_products', array('sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => 1)) ?>" title="Remove This Item">Remove This Item</a>
                                        </li>
                                    </ol>
                                <?php endif; ?>

                                <?php if ($filtering->getPrice() != null): ?>
                                    <?php if ($filtering->getPrice() == 1): $price_range = '0,00 US$ - 49,99 US$' ?>
                                    <?php elseif ($filtering->getPrice() == 2): $price_range = '49,99 US$ - 99,99 US$' ?>
                                    <?php elseif ($filtering->getPrice() == 3): $price_range = '99,99 US$ and above' ?>
                                    <?php endif; ?>
                                    <ol>
                                        <li>
                                            <span class="label">Price:</span> <span class="value"><?php echo $price_range; ?></span><a class="btn-remove" href="<?php echo url('products/show_products', array('category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>" title="Remove This Item">Remove This Item</a>
                                        </li>
                                    </ol>
                                <?php endif; ?>
                                <?php if ($filtering->getStock() != null): ?>
                                    <ol>
                                        <li>
                                            <span class="label">Stock:</span> <span class="value"><?php echo ($filtering->getStock() == 1) ? 'In Stock' : 'All Products' ?></span><a class="btn-remove" href="<?php echo url('products/show_products', array('category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => 1)) ?>" title="Remove This Item">Remove This Item</a>
                                        </li>
                                    </ol>
                                <?php endif; ?>
                                <?php if ($filtering->getSort() != null): ?>
                                    <ol>
                                        <li>
                                            <span class="label">Sort By: </span> <span class="value"><?php echo ($filtering->getSort() == 'title') ? 'Name' : 'Price' ?></span><a class="btn-remove" href="<?php echo url('products/show_products', array('price' => $filtering->getPrice(), 'stock' => $filtering->getStock(), 'category' => $filtering->getCategory_id(), 'order' => $filtering->getOrder(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => $paginator->getCurrent())) ?>" title="Remove This Item">Remove This Item</a>
                                        </li>
                                    </ol>
                                    <?php
                                endif;
                                ;
                                ?>
                                <?php if ($filtering->getOrder() != null): ?>
                                    <ol>
                                        <li>
                                            <span class="label">Order: </span> <span class="value"><?php echo ($filtering->getOrder() == 'ASC') ? 'Ascending' : 'Descending' ?></span><a class="btn-remove" href="<?php echo url('products/show_products', array('price' => $filtering->getPrice(), 'stock' => $filtering->getStock(), 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => $paginator->getCurrent())) ?>" title="Remove This Item">Remove This Item</a>
                                        </li>
                                    </ol>
                                <?php endif; ?>
                            </div>
                            <div class="actions"><a href="<?php echo url('products/show_products') ?>">Clear All</a></div>
                        <?php endif; ?>
                        <p class="block-subtitle">Shopping Options</p>
                        <dl id="narrow-by-list">
                            <dt>Price</dt>
                            <dd>
                                <ol>
                                    <li><a href="<?php echo url('products/show_products', array('price' => 1, 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>"><span class="price">0,00 US$</span> - <span class="price">49,99 US$</span></a></li>
                                    <li><a href="<?php echo url('products/show_products', array('price' => 2, 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>"><span class="price">50,00 US$</span> - <span class="price">99,99 US$</span></a></li>
                                    <li><a href="<?php echo url('products/show_products', array('price' => 3, 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'stock' => $filtering->getStock(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>"><span class="price">100,00 US$</span> and above</a></li>
                                </ol>
                            </dd>
                            <dt>Stock</dt>
                            <dd>
                                <ol>
                                    <li><a href="<?php echo url('products/show_products', array('stock' => 1, 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>">In Stock</a></li>
                                    <li><a href="<?php echo url('products/show_products', array('stock' => 0, 'category' => $filtering->getCategory_id(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>">All Products</a></li>
                                </ol>
                            </dd>
                            <dt>Categories</dt>
                            <dd>
                                <ol>
                                    <?php $categories = $view->getCategories(); ?>
                                    <?php (isset($_GET['category'])) ? $category_get = $_GET['category'] : $category_get = '' ?>
                                    <?php foreach ($categories as $category): ?>
                                        <?php if ($category->getId() != $category_get): ?>
                                            <li>
                                                <a href="<?php echo url('products/show_products', array('category' => $category->getId(), 'stock' => $filtering->getStock(), 'sort' => $filtering->getSort(), 'order' => $filtering->getOrder(), 'price' => $filtering->getPrice(), 'title' => $filtering->getTitle(), 'page' => '1')) ?>" class="level-top" ><span><?php echo $category->getLabel(); ?> (<?php echo ($view->getNumberOfProductsInCategory($filtering, $category->getId())) ?>)</span></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ol>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'user_cart_sidebar.php'; ?>
    </div>
</div>

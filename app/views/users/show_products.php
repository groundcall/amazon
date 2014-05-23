<?php $view->extend('masterpages/products'); ?>

<div class="col-wrapper">
    <div class="col-main">
        <?php if (isset($category)): ?>
        <div class="page-title category-title">
            <h1><?php echo $category->getLabel(); ?></h1>
        </div>
        <?php endif; ?>

        <div class="category-products">
            <div class="toolbar">
                <div class="pager">
                    <p class="amount">
                        <strong>2 Item(s)</strong>
                    </p>

                    <div class="pages">
                        <strong>Page:</strong>
                        <ol>
                            <li class="current">1</li>
                            <li><a href="#">2</a></li>
                            <li>
                                <a class="next i-next" href="#" title="Next">
                                    <img src="../images/pager_arrow_right.gif" alt="Next" class="v-middle" />
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>


                <div class="sorter">
                    <div class="sort-by">
                        <form method="get" action="<?php echo url('products/show_products', array('category' => $category->getId())) ?>">
                            <label>Sort By</label>
                            <select name='sort'>
                                <option value="title" <?php echo ($filtering && $filtering->getSort() == 'title') ? 'selected' : '' ;?>>Name</option>
                                <option value="price" <?php echo ($filtering && $filtering->getSort() == 'price') ? 'selected' : '' ;?>>Price</option>
                            </select>
                            &nbsp;
                            <label>Direction</label>
                            <select name='order'>
                                <option value="ASC" <?php echo ($filtering && $filtering->getOrder() == 'ASC') ? 'selected' : '' ;?>>Asc</option>
                                <option value="DESC" <?php echo ($filtering && $filtering->getOrder() == 'DESC') ? 'selected' : '' ;?>>Desc</option>
                            </select>
                            <input type='hidden' name='category' value='<?php echo $category->getId() ?>' />
                            <input type="submit" name="Submit" value='Submit' />
                        </form>
                    </div>
                </div>
            </div>

            <?php // $products = $view->getProductsByCategory($category); ?>
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

                        <div class="actions">
                            <button type="button" title="Add to Cart" class="button btn-cart" >
                                <span><span>Add to Cart</span></span>
                            </button>
                        </div>
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
                                    <span class="price"><?php echo $products[$k]->getPrice(); ?> US$</span>
                                </span>
                            </div>

                            <div class="actions">
                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                    <span><span>Add to Cart</span></span>
                                </button>
                            </div>
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
                                    <span class="price"><?php echo $products[$k]->getPrice(); ?> US$</span>
                                </span>
                            </div>

                            <div class="actions">
                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                    <span><span>Add to Cart</span></span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endfor; ?>

            <div class="toolbar-bottom">
                <div class="toolbar">
                    <div class="pager">
                        <p class="amount">
                            <strong>2 Item(s)</strong>
                        </p>

                        <div class="pages">
                            <strong>Page:</strong>
                            <ol>
                                <li class="current">1</li>
                                <li><a href="#">2</a></li>
                                <li>
                                    <a class="next i-next" href="#" title="Next">
                                        <img src="../images/pager_arrow_right.gif" alt="Next" class="v-middle" />
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="sorter">
                        <div class="sort-by">
                            <form>
                                <label>Sort By</label>
                                <select>
                                    <option value="">Name</option>
                                    <option value="">Price</option>
                                </select>
                                &nbsp;
                                <label>Direction</label>
                                <select>
                                    <option value="">Asc</option>
                                    <option value="">Desc</option>
                                </select>
                                <input type="submit" name="submit" value="Go!" />
                            </form>
                        </div>
                    </div>
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
                <div class="currently">
                    <p class="block-subtitle">Currently Shopping by:</p>
                    <ol>
                        <li>
                            <span class="label">Price:</span> <span class="value">0,00 US$ - 49,99 US$</span><!-- <a class="btn-remove" href="#" title="Remove This Item">Remove This Item</a> -->
                        </li>
                    </ol>
                </div>
                <div class="actions"><a href="#">Clear All</a></div>
                <p class="block-subtitle">Shopping Options</p>
                <dl id="narrow-by-list">
                    <dt>Price</dt>
                    <dd>
                        <ol>
                            <li><a href="<?php echo url('products/show_products', array('category' => $category->getId(), 'price' => 1)) ?>"><span class="price">0,00 US$</span> - <span class="price">49,99 US$</span></a></li>
                            <li><a href="<?php echo url('products/show_products', array('category' => $category->getId(), 'price' => 2)) ?>"><span class="price">50,00 US$</span> - <span class="price">99,99 US$</span></a></li>
                            <li><a href="<?php echo url('products/show_products', array('category' => $category->getId(), 'price' => 3)) ?>"><span class="price">100,00 US$</span> and above</a></li>
                        </ol>
                    </dd>
                    <dt>Stock</dt>
                    <dd>
                        <ol>
                            <li><a href="<?php echo url('products/show_products', array('category' => $category->getId(), 'stock' => 1)) ?>">In Stock</a></li>
                            <li><a href="<?php echo url('products/show_products', array('category' => $category->getId(), 'stock' => 0)) ?>">All Products</a></li>
                        </ol>
                    </dd>
                </dl>
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
            <p class="empty">You have no items in your shopping cart.</p>
        </div>
    </div>

</div>

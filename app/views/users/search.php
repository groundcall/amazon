<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>

        <div class="wrapper">
            <div class="page">

                <?php $view->render('users/user_navigation'); ?>
                
                <div class="main-container col3-layout">
                    <div class="main">
                        <div class="breadcrumbs">
                            <ul>
                                <li class="home">
                                    <a href="<?php echo url('products/'); ?>" title="Go to Home Page">Home</a>
                                    <span>/ </span>
                                </li>
                                <li class="category35">
                                    <strong>Search results for '<?php echo $title; ?>'</strong>
                                </li>
                            </ul>
                        </div>

                        <div class="col-wrapper">
                            <div class="col-main">
                                <div class="page-title category-title">
                                    <h1>Search results for '<?php echo $title; ?>'</h1>
                                </div>

                                <div class="category-products">
                                    <div class="toolbar">
                                        <div class="pager">
                                            <p class="amount">
                                                <strong><?php echo $paginator->getCount(); ?> Item(s)</strong>
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
                                                                <a class="next i-next" href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'title' => $_GET['title'])); ?>" title="Previous" style="text-decoration: none;">
                                                                    <<
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <li>
                                                            <a href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'title' => $_GET['title'])); ?>">
                                                                <?php echo ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : ''; ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    
                                                    <li class="current"><?php echo $paginator->getCurrent(); ?></li>
                                                        
                                                    <?php if ($paginator->getCurrent() <= $paginator->getPages()): ?>
                                                        <li>
                                                            <a href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'title' => $_GET['title'])); ?>">
                                                                <?php echo ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : ''; ?>
                                                            </a>
                                                        </li>
                                                        <?php if ($paginator->getCurrent() < $paginator->getPages()): ?>
                                                            <li>
                                                                <a class="next i-next" href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'title' => $_GET['title'])); ?>" title="Next" style="text-decoration: none;">
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
                                                <form action='<?php echo url('products/sort'); ?>' method='get'>
                                                    <label>Sort By</label>
                                                    <select name='by'>
                                                        <option value="title">Name</option>
                                                        <option value="price">Price</option>
                                                    </select>
                                                    &nbsp;
                                                    <label>Direction</label>
                                                    <select name='order'>
                                                        <option value="asc">Asc</option>
                                                        <option value="desc">Desc</option>
                                                    </select>
                                                    <input type="submit" value="Go!" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <?php $k = 0; ?>
                                    <?php for ($i = 0; $i < sizeof($products); $i++): ?>
                                        <?php if ($k % 3 == 0): echo '<ul class="products-grid">'; $k = 0; endif; ?>
                                        <?php $k = $k + 1; ?>
                                        <li class="<?php echo ($i % 3 == 0) ? "item first" : "item"; ?>">
                                            <a href="<?php echo url('products/show_details', array('product_id' => $products[$i]->getId())); ?>" title="<?php echo $products[$i]->getTitle(); ?>" class="product-image">
                                                <img src="<?php echo '../product_images' . $products[$i]->getImage(); ?>" width="135" height="135" alt="<?php echo $products[$i]->getTitle(); ?>" /></a>
                                            <h2 class="product-name">
                                                <a href="<?php echo url('products/show_details', array('product_id' => $products[$i]->getId())); ?>" title="<?php echo $products[$i]->getTitle(); ?>"><?php echo $products[$i]->getTitle(); ?></a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-168">
                                                    <span class="price"><?php echo $products[$i]->getPrice() . ' $'; ?></span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>
                                    
                                        <?php if ($k % 3 == 0 || $i == sizeof($products) - 1): echo '</ul>'; endif; ?>
                                    <?php endfor; ?>

                                    <div class="toolbar-bottom">
                                        <div class="toolbar">
                                            <div class="pager">
                                                <p class="amount">
                                                    <strong><?php echo $paginator->getCount(); ?> Item(s)</strong>
                                                </p>

                                                <div class="pages">
                                                    <strong>Page:</strong>
                                                        <ol>
                                                        <?php if ($paginator->getCurrent() >= 1): ?>
                                                            <?php if ($paginator->getCurrent() > 1): ?>
                                                                <li>
                                                                    <a class="next i-next" href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'title' => $_GET['title'])); ?>" title="Previous" style="text-decoration: none;">
                                                                        <<
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <li>
                                                                <a href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : 1), 'title' => $_GET['title'])); ?>">
                                                                    <?php echo ($paginator->getCurrent() > 1) ? $paginator->getCurrent() - 1 : ''; ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>

                                                        <li class="current"><?php echo $paginator->getCurrent(); ?></li>

                                                        <?php if ($paginator->getCurrent() <= $paginator->getPages()): ?>
                                                            <li>
                                                                <a href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'title' => $_GET['title'])); ?>">
                                                                    <?php echo ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : ''; ?>
                                                                </a>
                                                            </li>
                                                            <?php if ($paginator->getCurrent() < $paginator->getPages()): ?>
                                                                <li>
                                                                    <a class="next i-next" href="<?php echo url("products/search", array("page" => ($current = ($paginator->getCurrent() < $paginator->getPages()) ? $paginator->getCurrent() + 1 : $paginator->getPages()), 'title' => $_GET['title'])); ?>" title="Next" style="text-decoration: none;">
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
                                                    <span class="label">Category:</span> <span class="value">Shoes</span><!-- <a class="btn-remove" href="#" title="Remove This Item">Remove This Item</a> -->
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="actions"><a href="#">Clear All</a></div>
                                        <p class="block-subtitle">Shopping Options</p>
                                        <dl id="narrow-by-list">
                                            <dt>Category</dt>
                                            <dd>
                                                <ol>
                                                    <li><a href="#">Shirts</a></li>
                                                    <li><a href="#">Shoes</a></li>
                                                    <li><a href="#">Hoodies</a></li>
                                                </ol>
                                            </dd>
                                            <dt>Price</dt>
                                            <dd>
                                                <ol>
                                                    <li><a href="#"><span class="price">0,00 US$</span> - <span class="price">49,99 US$</span></a></li>
                                                    <li><a href="#"><span class="price">50,00 US$</span> - <span class="price">99,99 US$</span></a></li>
                                                    <li><a href="#"><span class="price">100,00 US$</span> and above</a></li>
                                                </ol>
                                            </dd>
                                            <dt>Stock</dt>
                                            <dd>
                                                <ol>
                                                    <li><a href="#">Available</a></li>
                                                    <li><a href="#">Soon</a></li>
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
                        
                    </div>
                </div>
                
                <div class="footer-container">
                    <div class="footer">

                        <?php $view->render('users/user_footer'); ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyBooks</title>
        <meta name="description" content="Default Description" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/widgets.css" media="all" />
        <script type="text/javascript" src="js/prototype/prototype.js"></script>
    </head>

    <body>

        <div class="wrapper">
            <div class="page">
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

                            <p class="welcome-msg">Default welcome msg! </p>

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
                        <li class="level0 nav-1 level-top first">
                            <a href="#" class="level-top" ><span>Furniture</span></a>
                        </li>
                        <li class="level0 nav-2 level-top">
                            <a href="#"  class="level-top" ><span>Electronics</span></a>
                        </li>
                        <li class="level0 nav-3 level-top active">
                            <a href="#" class="level-top" ><span>Music</span></a>
                        </li>
                        <li class="level0 nav-4 level-top last">
                            <a href="#"  class="level-top" ><span>Ebooks</span></a>
                        </li>
                    </ul>
                </div>
                <div class="main-container col3-layout">
                    <div class="main">
                        <div class="breadcrumbs">
                            <ul>
                                <li class="home">
                                    <a href="" title="Go to Home Page">Home</a>
                                    <span>/ </span>
                                </li>
                                <li class="category35">
                                    <strong>Search results for '%search term%'</strong>
                                </li>
                            </ul>
                        </div>

                        <div class="col-wrapper">
                            <div class="col-main">
                                <div class="page-title category-title">
                                    <h1>Search results for '%search term%'</h1>
                                </div>

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
                                                            <img src="images/pager_arrow_right.gif" alt="Next" class="v-middle" />
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


                                    <ul class="products-grid">
                                        <li class="item first">
                                            <a href="product_detail.html" title="Nusantara Demo" class="product-image"><img src="images/nusantara.gif" width="135" height="135" alt="Nusantara Demo" /></a>
                                            <h2 class="product-name"><a href="product_detail.html" title="Nusantara Demo">Nusantara Demo</a></h2>
                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-168">
                                                    <span class="price">0,00 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="product_detail.html" title=" Shaimus - Turn The Other Way" class="product-image">
                                                <img src="images/cover.jpg" width="135" height="135" alt=" Shaimus - Turn The Other Way" />
                                            </a>

                                            <h2 class="product-name">
                                                <a href="product_detail.html" title=" Shaimus - Turn The Other Way"> Shaimus - Turn The Other Way</a>
                                            </h2>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-170">
                                                    <span class="price">1,99 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="product_detail.html" title=" Shaimus - Turn The Other Way" class="product-image">
                                                <img src="images/cover.jpg" width="135" height="135" alt=" Shaimus - Turn The Other Way" />
                                            </a>

                                            <h2 class="product-name">
                                                <a href="product_detail.html" title=" Shaimus - Turn The Other Way"> Shaimus - Turn The Other Way</a>
                                            </h2>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-170">
                                                    <span class="price">1,99 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>

                                    <ul class="products-grid">
                                        <li class="item first">
                                            <a href="product_detail.html" title="Nusantara Demo" class="product-image"><img src="images/nusantara.gif" width="135" height="135" alt="Nusantara Demo" /></a>
                                            <h2 class="product-name"><a href="product_detail.html" title="Nusantara Demo">Nusantara Demo</a></h2>
                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-168">
                                                    <span class="price">0,00 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="product_detail.html" title=" Shaimus - Turn The Other Way" class="product-image">
                                                <img src="images/cover.jpg" width="135" height="135" alt=" Shaimus - Turn The Other Way" />
                                            </a>

                                            <h2 class="product-name">
                                                <a href="product_detail.html" title=" Shaimus - Turn The Other Way"> Shaimus - Turn The Other Way</a>
                                            </h2>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-170">
                                                    <span class="price">1,99 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="product_detail.html" title=" Shaimus - Turn The Other Way" class="product-image">
                                                <img src="images/cover.jpg" width="135" height="135" alt=" Shaimus - Turn The Other Way" />
                                            </a>

                                            <h2 class="product-name">
                                                <a href="product_detail.html" title=" Shaimus - Turn The Other Way"> Shaimus - Turn The Other Way</a>
                                            </h2>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-170">
                                                    <span class="price">1,99 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>

                                    <ul class="products-grid">
                                        <li class="item first">
                                            <a href="product_detail.html" title="Nusantara Demo" class="product-image"><img src="images/nusantara.gif" width="135" height="135" alt="Nusantara Demo" /></a>
                                            <h2 class="product-name"><a href="product_detail.html" title="Nusantara Demo">Nusantara Demo</a></h2>
                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-168">
                                                    <span class="price">0,00 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="product_detail.html" title=" Shaimus - Turn The Other Way" class="product-image">
                                                <img src="images/cover.jpg" width="135" height="135" alt=" Shaimus - Turn The Other Way" />
                                            </a>

                                            <h2 class="product-name">
                                                <a href="product_detail.html" title=" Shaimus - Turn The Other Way"> Shaimus - Turn The Other Way</a>
                                            </h2>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-170">
                                                    <span class="price">1,99 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <a href="product_detail.html" title=" Shaimus - Turn The Other Way" class="product-image">
                                                <img src="images/cover.jpg" width="135" height="135" alt=" Shaimus - Turn The Other Way" />
                                            </a>

                                            <h2 class="product-name">
                                                <a href="product_detail.html" title=" Shaimus - Turn The Other Way"> Shaimus - Turn The Other Way</a>
                                            </h2>

                                            <div class="price-box">
                                                <span class="regular-price" id="product-price-170">
                                                    <span class="price">1,99 US$</span>
                                                </span>
                                            </div>

                                            <div class="actions">
                                                <button type="button" title="Add to Cart" class="button btn-cart" >
                                                    <span><span>Add to Cart</span></span>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>


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
                                                                <img src="images/pager_arrow_right.gif" alt="Next" class="v-middle" />
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
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li class="last privacy"><a href="#">Privacy Policy</a></li>
                        </ul>

                        <ul class="links">
                            <li class="first" ><a href="#" title="Site Map" >Site Map</a></li>
                            <li ><a href="#" title="Search Terms" >Search Terms</a></li>
                            <li ><a href="#" title="Orders and Returns" >Orders and Returns</a></li>
                            <li class=" last" ><a href="#" title="Contact Us" >Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

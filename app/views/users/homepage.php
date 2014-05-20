<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyBooks</title>
        <meta name="description" content="Default Description" />
        <link rel="stylesheet" type="text/css" href="../users_css/styles.css" media="all" />
        <link rel="stylesheet" type="text/css" href="../users_css/widgets.css" media="all" />
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
                        <div class="col-wrapper">
                            <div class="col-main">
                                <div class="box best-selling">
                                    <h3>Latest Products</h3>
                                    <table cellspacing="0" border="0">
                                        <tbody>
                                            <?php $i = 0;?>
                                            <?php $products = $view->getLastSixProducts();?>
                                            <?php for ($k = 0; $k < sizeof($products); $k += 2): ?>
                                                <tr class="<?php echo ($i % 2 == 0) ? 'odd' : 'even'; ?>">
                                                    <td>
                                                        <a href="#">
                                                            <img width="95" alt="" src="<?php echo '../product_images' . $products[$k]->getImage(); ?>" class="product-img">
                                                        </a>
                                                        <div class="product-description">
                                                            <p><a href="#"><?php echo $products[$k]->getTitle(); ?></a></p>
                                                            <p>See all <a href="#"><?php echo $products[$k]->getCategory(); ?></a></p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#">
                                                            <img width="95" alt="" src="<?php echo '../product_images/' . $products[$k + 1]->getImage(); ?>" class="product-img">
                                                        </a>
                                                        <div class="product-description">
                                                            <p><a href="#"><?php echo $products[$k + 1]->getTitle(); ?></a></p>
                                                            <p>See all <a href="#"><?php echo $products[$k + 1]->getCategory(); ?></a></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i = $i + 1; ?>
                                            <?php endfor; ?>
<!--										<tr class="even">
                                                    <td>
                                                            <a href="#">
                                                                    <img width="95" alt="" src="images/nusantara.gif" class="product-img">
                                                            </a>
                                                            <div class="product-description">
                                                                    <p><a href="#">Olympus Stylus 750 7.1MP DigitalCamera</a></p>
                                                                    <p>See all <a href="#">Digital Cameras</a></p>
                                                            </div>
                                                    </td>
                                                    <td>
                                                            <a href="#">
                                                                    <img width="95" alt="" src="images/nusantara.gif" class="product-img">
                                                            </a>
                                                            <div class="product-description">
                                                                    <p><a href="#">Acer Ferrari 3200 Notebook Computer PC</a></p>
                                                                    <p>See all <a href="#">Laptops</a></p>
                                                            </div>
                                                    </td>
                                            </tr>
                                            <tr class="odd">
                                                    <td>
                                                            <a href="#">
                                                                    <img width="95" alt="" src="images/nusantara.gif" class="product-img">
                                                            </a>
                                                            <div class="product-description">
                                                                    <p><a href="#">ASICS&reg; Men's GEL-Kayano&reg; XII</a></p>
                                                                    <p>See all <a href="#">Shoes</a></p>
                                                            </div>
                                                    </td>
                                                    <td>
                                                            <a href="#">
                                                                    <img width="95" alt="" src="images/nusantara.gif" class="product-img">
                                                            </a>
                                                            <div class="product-description">
                                                                    <p><a href="#">Coalesce: Functioning On Impatience T-Shirt</a></p>
                                                                    <p>See all <a href="#">Shirts</a></p>
                                                            </div>
                                                    </td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-left sidebar"></div>
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

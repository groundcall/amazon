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
                        <div class="col-wrapper">
                            <div class="col-main">
                                <div class="box best-selling">
                                    <h3>Latest Products</h3>
                                    <table cellspacing="0" border="0">
                                        <tbody>
                                            <?php $i = 0; ?>
                                            <?php $products = $view->getLastSixProducts(); ?>
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
                    <?php $view->render('users/user_footer'); ?>
                </div>
            </div>
        </div>
    </body>
</html>

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
            
            <div class="main-container col1-layout">
                <div class="main">
                    <div class="col-main">
                        <div class="account-login">
                            <div class="page-title">
                                <h1>Login or Create an Account</h1>
                            </div>
                            <form action="#" method="post" id="login-form">
                                <div class="col2-set">
                                    <div class="col-1 new-users">
                                        <div class="content">
                                            <h2>New Customers</h2>
                                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                        </div>
                                    </div>
                                    <div class="col-2 registered-users">
                                        <div class="content">
                                            <h2>Registered Customers</h2>
                                            <p>If you have an account with us, please log in.</p>
                                            <ul class="form-list">
                                                <li>
                                                    <label for="email" class="required"><em>*</em>Email Address</label>
                                                    <div class="input-box">
                                                        <input type="text" name="login[username]" value="" id="email" class="input-text required-entry validate-email" title="Email Address">
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="pass" class="required"><em>*</em>Password</label>
                                                    <div class="input-box">
                                                        <input type="password" name="login[password]" class="input-text required-entry validate-password" id="pass" title="Password">
                                                    </div>
                                                </li>
                                            </ul>
                                            <p class="required">* Required Fields</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2-set">
                                    <div class="col-1 new-users">
                                        <div class="buttons-set">
                                            <button type="button" title="Create an Account" class="button" onclick="window.location='/register.html';"><span><span>Create an Account</span></span></button>
                                        </div>
                                    </div>
                                    <div class="col-2 registered-users">
                                        <div class="buttons-set">
                                            <a href="/forgot_password.html" class="f-left">Forgot Your Password?</a>
                                            <button type="submit" class="button" title="Login" name="send" id="send2"><span><span>Login</span></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
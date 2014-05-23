<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <?php $view->render('users/user_header'); ?>
    </head>

    <body>
        <?php $view->render('users/user_navigation'); ?>

        <div class="main-container col3-layout">
            <div class="main">
                
               <?php echo $content; ?>
            </div>
        </div>
        <div class="footer-container">
            <?php $view->render('users/user_footer'); ?>
        </div>
        </div>
        </div>
    </body>
</html>
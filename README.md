WEE
===

A minimal PHP MVC framework.

# Controllers #

app/Controllers/TestController.php

```php
<?php

namespace Controllers;
class TestController extends \Wee\Controller {
}
```

actions are *public* functions in the controller class

```php
<?php

public function index() {
    $this->render('text/index');
}

public function update() {
    //do some processing
    $this->redirect('test/index');
}
```


- may override **initialize** function to run code before any actions are run in that controller

app/Controllers/ProfileController.php

```php
<?php

namespace Controllers;
class ProfileController extends \Wee\Controller {
    protected function initialize() {
        //handle authentication, etc.
        //will run before edit or index
    }

    public function edit() { /** code  */ }
    public function index() { /** code  */ }
}
```

# Views #

- app/views/controller/file.php
- plain php files that use **echo** to print content
- use $this->render($file) in controller
- use $view->render($file) in view

# Masterpages #

- masterpages can be defined in app/views/masterpages/
- should contain portions of a page that don't change (like the navigation, username, logout link, etc.)
- use $view->extend('masterpages/login')
- take a special variable $content

app/views/masterpages/**profile**.php

```php
<html>
    NAVIGATION
    <?php if $current_user->isLoggedIn(): ?>
      <?php echo $current_user->getUsername(); ?>
    <?php endif ?>

    <body class="<?php echo $bodyClass ?>">
       <?php echo $content ?>
    </body>
</html>
```

app/views/profile/index.php

```php
<?php $view->extend('masterpages/profile', array('bodyClass' => 'edit'))

<p>edit your profile</p>
<form ... >
```

```php
<?php

namespace Controllers;
class ProfileController extends \Wee\Controller {
    public function edit() {
        $this->render('profile/edit', array('user' => '...'));
    }
}
```

# View parameters #

render takes an optional second argument that defines an array of variables to pass to the view.

Calling render('template/action', array('var1' => $value, 'var2' => 'this is a string')) defines $var1 and $var2 in app/views/template/action.php

app/Controllers/UserController.php

```php
public function inactive() {
    $inactiveUsers = \Models\User::findInactiveUsers();
    $this->render('user/inactive', array('users' => $inactiveUsers));
}
```

app/views/user/inactive.php

```php
<?php foreach($users as $user): ?>
    <?php $view->render('user/user', array('user' => $user) ?>
<?php end ?>
```

# Helpers #

ApplicationHelper gets mixed into the view. Functions defined in the helper are available in the views using `$view->method()`

```php
<?php

namespace Helpers;

trait ApplicationHelper {
    public function errorFor($object, $name) {
        if ($object->hasError($name)) {
            return implode(", ", $object->getError($name));
        }
        return '';
    }
}
```

```php
<span><?php echo $view->errorFor($user, 'firstName') ?></span>
```

# Links #

**url**($controllerAction, $parameters = array())

```php
echo url('test');
=> "/test/index"
```

```php
echo url('test/index');
=> "/test/index"
```

```php
echo url('user/edit', array('id' => 1));
=> "/user/edit?id=1"
```

```php
echo url('user/list', array('sort' => 'username', 'direction' => 'up'));
=> "/user/list?sort=username&direction=up"
```

# Handling parameters #

**GET**

```php
echo url('user/list', array('sort' => 'username', 'direction' => 'up'))
=> "/index.php?url=user/list&sort=username&direction=up"
```
app/Controllers/UserController.php

```php
namespace Controllers;
class UserController extends \Wee\Controller {
    public function list() {
        $sort = $_GET['sort'];
        $direction = $_GET['direction'];
    }
}
```

**POST**

app/views/user/edit

```php
<form action="<?php echo url("user/update", array('id' => $user->getId()))?>" >
    <input type="text" name="username" />
    <input type="submit">
</form>
```

app/Controllers/UserController.php

```php
namespace Controllers;
class UserController extends \Wee\Controller {
    public function edit() {
        $id = $_GET['id'];
        $username = $_POST['username'];
    }
}
```

# Models #

Starting with the following database table

```sql
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `created_at` DATETIME
   PRIMARY KEY(`id`)
);
```

app/Models/User.php

```php
<?php

namespace Models;

class User extends \Wee\Model {
    protected $id;
    protected $last_name;
    protected $first_name;
    protected $created_at;
}
```

# Field types #

Just define getters and setters:

```php
<?php

public function getId() {
     return $this->id;
}

public function getLastName() {
     return $this->last_name;
}

public function setLastName($last_name) {
     $this->last_name = $last_name;
}

public function getCreatedAt() {
     return \DateTime::createFromFormat("Y-m-d H:i:s", $this->created_at);
}

public function setCreatedAt($created_at) {
     $this->created_at = $created_at->format("Y-m-d H:i:s");
}
```

# Validation #

## Adding validation ##

`registerValidator(callable)`

See http://php.net/manual/ro/language.types.callable.php

```php
<?php
class User extends \Wee\Model {
  protected $first_name;
  protected $last_name;

  public __construct() {
    $this->registerValidator(function($user){
      //check something
    });
  }
}

```

`$this->registerValidator(array($this, 'check_some_speci_stuff'))`

## Checking if an object is valid ##

`isValid()`

## Defining validators ##

- functions that take one argument (the subject) and use addError("key", "message") to set errors.

```php
<?php
// in some model
$this->registerValidator(function($user){
    if (strlen($user->getFirstName()) < 2) {
        $user->addError("firstName", "At least 2 characters please");
    }
});
```

## Retrieving errors ##

See:
- hasError(key)
- getError(key)

## Database access, DAO

- create dao classes in app/Dao/NameDao.php
- use $this->getConnection() to get a [PDO](http://www.php.net/manual/en/pdo.prepared-statements.php) object

```php
<?php

namespace Dao;

class PostDao extends \Wee\Dao {

  public function findById($id) {
    $sql = 'SELECT * FROM posts WHERE id = ?';

    $stmt = $this->getConnection()->prepare($sql);
    $stmt->execute(array($id));

    return $this->getRow($stmt);
  }
}
```

## DaoFactory

- once you have created the DAO class, you can access it by name using `\Wee\DaoFactory::getDao('post')`

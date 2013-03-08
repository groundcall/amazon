WEE
===

A minimal PHP MVC framework.

# Controllers #

app/Controllers/**Test**Controller.php

```php
namespace Controllers;
class TestController extends \Wee\Controller {
}
```

actions are *public* functions in the controller class

```php
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

- any file many extend another file
- use $view->extend('layout/login')
- take a special variable $content

app/views/layout/**profile**.php

```php
<html>
    <body class="<?php echo $bodyClass ?>">
       <?php echo $content ?>
    </body>
</html>
```

app/views/profile/index.php

```php
<?php $view->extend('layout/profile', array('bodyClass' => 'edit'))

<p>edit your profile</p>
<form ... >
```

```php
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
=> "/index.php?url=test/index"
```

```php
echo url('test/index');
=> "/index.php?url=test/index"
```

```php
echo url('user/edit', array('id' => 1));
=> "/index.php?url=user/edit&id=1"
```

```php
echo url('user/list', array('sort' => 'username', 'direction' => 'up'));
=> "/index.php?url=user/list&sort=username&direction=up"
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

`validate(callable)`

`validate(as, callable)`

See http://php.net/manual/ro/language.types.callable.php

```php
<?php
class User extends \Wee\Model {
  protected $first_name;
  protected $last_name;

  public __construct() {
    $this->validate(function($user){
      //check something
    });
  }
}

```

By default such validators will run every time you call isValid(). It is also possible to control when to run these custom validations by giving an option as the first parameter and callable second.

`$this->validate("admin", array($this, 'check_some_speci_stuff'))`

## Checking if an object is valid ##

`isValid()`

`isValid(as)` - run all default validators + the custom ones.

## Defining validators ##

- functions that take one argument (the subject) and return true if valid, false if not and use addError("key", "message") to set errors.

```php
<?php
// in some model
$this->validate(function($user){
    if (strlen($user->getFirstName()) < 2) {
        $user->addError("firstName", "At least 2 characters please");
        return false;
      }
    return true;
});
```

## Retrieving errors ##

See:
- hasError(key)
- getError(key)


<?php

namespace Wee;

/**
 * \brief
 * Represents a table in the database with the minimum features possible in order to support basic <a href="http://en.wikipedia.org/wiki/Create,_read,_update_and_delete">CRUD</a> operations
 *
 * \section mapping Mapping the database
 *
 * \subsection sql SQL table
 *
 * Suppose we have a the following SQL code:
 *
 * \code{.sql}
 * CREATE TABLE `user` (
 *   `id` int(11) NOT NULL AUTO_INCREMENT,
 *   `last_name` varchar(45) DEFAULT NULL,
 *   `first_name` varchar(45) DEFAULT NULL,
 *   `email` varchar(255) NOT NULL
 *    PRIMARY KEY(`id`)
 * );
 * \endcode
 *
 * \subsection conventions Conventions
 * The following conventions are followed:
 *
 * - 1, the class name must follow the table name
 * - 2, all the fields must have properties
 * - 3, the primary key must be named id
 * - 4, the values are treated as string, you MUST provide our own methods for accessing other types
 *
 * We end up with a class that look like this:
 *
 * \code{.php}
 *  namespace Models;
 *
 *  class User extends \Wee\Model {
 *    protected $id;
 *    protected $last_name;
 *    protected $first_name;
 *    protected $email;
 *  }
 * \endcode
 *
 * \subsection properties Defining basic properties
 *
 * protected properties are not very usefull, in order to be able to access them from other classes we need to define getters and setters.
 *
 * Fortunately Netbeans makes this very easy for us. Follow the link at https://blogs.oracle.com/netbeansphp/entry/generate_constructor_getters_and_setters for a nice tutorial.
 *
 * We end up with something like this:
 * \code{.php}
 *
 * public function getId() {
 *      return $this->id;
 * }
 *
 * public function getLastName() {
 *      return $this->last_name;
 * }
 *
 * public function setLastName($last_name) {
 *      $this->last_name = $last_name;
 * }
 *
 * //the same for first_name and email
 * \endcode
 *
 * One particular note is that we don't want a setter for id. This is because it is not supposed to be set dirrectly.
 *
 * \subsection custom-properties Adding custom properties
 *
 * But what happens if we have a field of some other type:
 *
 * \code{.sql}
 * `created_at` DATETIME
 * \endcode
 *
 * Our current configuration would just return a string like "2012-11-24 11:10:47". How do we turn this into a real date object?
 * This is where the power of the getters come in.
 *
 * \code{.php}
 * public function getCreatedAt() {
 *      return \DateTime::createFromFormat("Y-m-d H:i:s", $this->created_at);
 * }
 * \endcode
 *
 * calling getCreatedAt() will now return a DateTime object http://www.php.net/manual/en/class.datetime.php
 *
 * Similarly we do the same for setting a date:
 *
 * \code{.php}
 * public function setCreatedAt($created_at) {
 *      $this->created_at = $created_at->format("Y-m-d H:i:s");
 * }
 * \endcode
 *
 * \section create-update-operations Creating and updating objects
 *
 * \subsection create-operation
 *
 * \code{.php}
 * // Create a new instance
 * $user = new \Models\User();
 *
 * // Set some properties:
 * $user->setFirstName("John");
 * $user->setLastName("Smith");
 * $user->setCreatedAt(new \DateTime());
 *
 * // Insert the user into the database
 * $user->insert();
 * \endcode
 *
 * Calling insert() on a model will try to run the query:
 *
 * \code{.sql}
 * INSERT INTO user (first_name, last_name, created_at) VALUES ('John', 'Smith', '2012-11-24 11:10:47');
 * \endcode
 *
 * - after the method is executed $user->id will hold the next value from the database.
 *
 * \subsection update-operation
 *
 * Once an object has been saved, it can be updated.
 *
 * \code{.php}
 * $user->setLastName("Duval");
 * $user->update();
 * \endcode
 *
 * This is equivalent to the SQL:
 *
 * \code{.sql}
 * UPDATE user SET last_name = 'Duval' where id = 1;
 * \endcode
 *
 * \subsection retrieving-objects Retrieving objects
 *
 * findById is used to retrieve objects by their primary key
 *
 * \code{.php}
 * $user = User::findById(1);
 * \endcode
 *
 *  - returns a single object of class User with the id=1
 *  - equivalent to writing SELECT * FROM user WHERE id = 1;
 *
 */
class Model {
    use \Wee\Traits\Attributes;
    use \Wee\Traits\Database;
    use \Wee\Traits\ActiveModel;
}

<?php

/*
 * Mock up class of a Database with a simple method to showcase the Singleton Pattern (Ensures there is only one instance of your class)
 */
class Database
{
    private static $instance;

    protected function __construct()
    {
        echo "Creating a new DB connection...</br>";
    }

    /**
     * Cloning and unserialization are not permitted for singletons.
     */
    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function connectToDB()
    {
        // Connect to db
        echo "Connecting to db...</br>";
    }
}

$db = Database::getInstance();
$db2 = Database::getInstance();

$db->connectToDB();
$db2->connectToDB();

// $db = new Database; // Throws an error because of the protected method

/* Output:
Creating a new DB connection...
Connecting to db...
Connecting to db...

We can see how there is only one instance of the DB
*/
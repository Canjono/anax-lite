<?php
namespace Canjono\Query;

/**
 * Class for user
 */

class Query
{
    /**
     * @var object $db Database object to use for connecting to database
     */
    private $db;


    /**
     * Get user from db
     *
     * @param string $user Name of user
     * @return object with data about user
     */
    public function getUser($user)
    {
        $query = "SELECT * FROM anaxlite_users WHERE user = ?";
        return $this->db->executeFetch($query, [$user]);
    }


    /**
     * Search for user
     *
     * @param string $search Search string
     * @return object with data about users
     */
    public function search($search)
    {
        $query = "SELECT COUNT(user) as max FROM anaxlite_users WHERE user LIKE '$search'";
        return $this->db->executeFetchAll($query);
    }


    /**
     * Get username from db
     *
     * @param string $user Name of user
     * @return string Username
     */
    public function getUsername($user)
    {
        $query = "SELECT user FROM anaxlite_users WHERE user = ?";
        return $this->db->executeFetch($query, [$user])->user;
    }

    /**
     * Get hashed password from db
     *
     * @param string $user Name of user to get password from
     * @return string Hashed password
     */
    public function getHash($user)
    {
        $query = "SELECT pass FROM anaxlite_users WHERE user = ?";
        return $this->db->executeFetch($query, [$user])->pass;
    }

    /**
     * Add a new user to db
     *
     * @param array $params Parameters to use
     * @return void
     */
    public function addUser($params)
    {
        $query = "INSERT INTO anaxlite_users"
            . "(user, pass, fname, lname, email, permission, created) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->execute($query, $params);
    }


    /**
     * Remove user from db
     *
     * @param string $user User to remove
     * @return void
     */
    public function removeUser($user)
    {
        $query = "DELETE FROM anaxlite_users WHERE user = ?";
        $this->db->execute($query, [$user]);
    }

    /**
     * Get all users from db
     *
     * @return array With objects of every user
     */
    public function getAllUsers($orderBy, $order, $hits, $offset, $search = null)
    {
        if ($search) {
            $query = "SELECT * FROM anaxlite_users WHERE user LIKE '$search' ORDER BY $orderBy $order "
                . "LIMIT $hits OFFSET $offset";
        } else {
            $query = "SELECT * FROM anaxlite_users ORDER BY $orderBy $order LIMIT $hits OFFSET $offset";
        }
        return $this->db->executeFetchAll($query);
    }

    /**
     * Check if user exists in database
     *
     * @param string $user Username to check
     * @return bool True if user exists, otherwise false
     */
    public function exists($user)
    {
        $query = "SELECT * FROM anaxlite_users WHERE user = ?";
        $res = $this->db->executeFetch($query, [$user]);
        return $res ? true : false;
    }

    /**
     * Inject Database object to make queries from db
     *
     * @param Object $db Database object
     * @return $this for chaining
     */
    public function setDatabase($db)
    {
        $this->db = $db;
        return $this;
    }
}

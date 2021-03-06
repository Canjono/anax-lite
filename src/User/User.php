<?php
namespace Canjono\User;

/**
 * Class for user
 */

class User
{
    /**
     * @var string $username The username
     * @var string $fname Users first name
     * @var string $lname Users last name
     * @var string $email Users email adress
     * @var int $permission Number telling what user is allowed to do
     */
    private $username = null;
    private $fname;
    private $lname;
    private $email;
    private $permission = null;
    private $db;


    /**
     * Set user data
     *
     * @param string $user Name of user
     * @return void
     */
    public function setUser($user)
    {
        $query = "SELECT * FROM anaxlite_users WHERE user = ?";
        $res = $this->db->executeFetchAll($query, [$user])[0];

        $this->username = $res->user;
        $this->fname = $res->fname;
        $this->lname = $res->lname;
        $this->email = $res->email;
        $this->permission = $res->permission;
    }


    /**
     * Get username
     *
     * @return string Username
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Get first name
     *
     * @return string First name
     */
    public function getFname()
    {
        return $this->fname;
    }


    /**
     * Get lname
     *
     * @return string Last name
     */
    public function getLname()
    {
        return $this->lname;
    }


    /**
     * Get email
     *
     * @return string Email adress
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get permission
     *
     * @return int Permission level
     */
    public function getPermission()
    {
        return $this->permission;
    }


    /**
     * Change password
     *
     * @param string $password The new password
     * @return void
     */
    public function changePassword($password)
    {
        $query = "UPDATE anaxlite_users SET pass = ? WHERE user = '$this->username'";
        $this->db->execute($query, [$password]);
    }


    /**
     * Update columns for this user
     *
     * @param array $params Array with parameters
     * @return void
     */
    public function update($params)
    {
        $query = "UPDATE anaxlite_users SET fname = ?, lname = ?, email = ?, permission = ? "
            . "WHERE user = '$this->username'";
        $this->db->execute($query, $params);
    }


    /**
     * Update username
     *
     * @param string $username The new username
     * @return void
     */
    public function changeUsername($username)
    {
        $query = "UPDATE anaxlite_users SET user = ? WHERE user = '$this->username'";
        $this->db->execute($query, [$username]);
        $this->username = $username;
    }

    /**
     * Inject Database object for connection to database
     *
     * @param object $db Database object
     * @return $this for chaining
     */
    public function setDatabase($db)
    {
        $this->db = $db;
        return $this;
    }

    /**
     * Check if a user is logged in
     *
     * @return bool If logged true, otherwise false
     */
    public function isLoggedIn()
    {
        return $this->username ? true : false;
    }

    /**
     * Check if user is admin
     *
     * @return bool If admin then true, otherwise false
     */
    public function isAdmin()
    {
        return $this->permission == 2 ? true : false;
    }
}

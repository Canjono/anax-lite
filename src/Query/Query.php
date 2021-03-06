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
    private $usersTable;
    private $contentTable;


    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->usersTable = "anaxlite_users";
        $this->contentTable = "anaxlite_content";
    }


    /**
     * Get user from db
     *
     * @param string $user Name of user
     * @return object with data about user
     */
    public function getUser($user)
    {
        $query = "SELECT * FROM $this->usersTable WHERE user = ?";
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
        $query = "SELECT COUNT(user) as max FROM $this->usersTable WHERE user LIKE '$search'";
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
        $query = "SELECT user FROM $this->usersTable WHERE user = ?";
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
        $query = "SELECT pass FROM $this->usersTable WHERE user = ?";
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
        $query = "INSERT INTO $this->usersTable"
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
        $query = "DELETE FROM $this->usersTable WHERE user = ?";
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
            $query = "SELECT * FROM $this->usersTable WHERE user LIKE '$search' ORDER BY $orderBy $order "
                . "LIMIT $hits OFFSET $offset";
        } else {
            $query = "SELECT * FROM $this->usersTable ORDER BY $orderBy $order LIMIT $hits OFFSET $offset";
        }
        return $this->db->executeFetchAll($query);
    }


    /**
     * Get all content from db
     *
     * @return array Wtih objects of all content
     */
    public function getAllContent()
    {
        $query = "SELECT * FROM $this->contentTable";
        return $this->db->executeFetchAll($query);
    }


    /**
     * Get all rows in anaxlite_content that match a certain type
     *
     * @param $type string Type of content to get
     * @return array With objects of content
     */
    public function getContentOfType($type)
    {
        $query = "SELECT * FROM $this->contentTable "
            . "WHERE type = ? AND (deleted IS NULL OR deleted > NOW()) AND published <= NOW()";
        if ($type == "post") {
            $query .= " ORDER BY published DESC";
        }
        return $this->db->executeFetchAll($query, [$type]);
    }


    /**
     * Get content that matches path
     *
     * @param $path string The path to match
     * @param $type string Optional type the item should match
     * @return object The items searched for
     */
    public function getContentByPath($path, $type = null)
    {
        $query = "SELECT * FROM $this->contentTable WHERE path = ?";
        if ($type == "page") {
            $query .= " AND type = 'page'";
        } elseif ($type == "post") {
            $query .= " AND type = 'post'";
        }
        return $this->db->executeFetch($query, [$path]);
    }


    /**
     * Get content that matches slug
     *
     * @param $slug string The slug to match
     * @param $type string Optional type the item should match
     * @return object The item searched for
     */
    public function getContentBySlug($slug, $type = null)
    {
        $query = "SELECT * FROM $this->contentTable WHERE slug = ?";
        if ($type == "page") {
            $query .= " AND type = 'page'";
        } elseif ($type == "post") {
            $query .= " AND type = 'post'";
        }
        return $this->db->executeFetch($query, [$slug]);
    }


    /**
     * Get content of a row in anaxlite_content table
     *
     * @param $type string Type of the item
     * @param $pathOrSlug string Path or slug of the item
     * @return object The item searched for
     */
    public function getContentById($id)
    {
        $query = "SELECT * FROM $this->contentTable WHERE id = ?";
        return $this->db->executeFetch($query, [$id]);
    }


    /**
     * Add new content
     *
     * @param $title string Title of new content
     * @return void
     */
    public function addContent($title)
    {
        $query = "INSERT INTO $this->contentTable (title) VALUES (?)";
        $this->db->execute($query, [$title]);
    }


    /**
     * Update content
     *
     * @param $params array Array of parameters
     * @return void
     */
    public function updateContent($params)
    {
        $query = "UPDATE $this->contentTable SET "
            . "title=?, path=?, slug=?, data=?, type=?, filter=?, published=?, updated=NOW() "
            . "WHERE id = ?";
        $this->db->execute($query, $params);
    }


    /**
     * Delete content
     *
     * @param $id int Id of content to remove
     * @return void
     */
    public function deleteContent($id)
    {
        $query = "UPDATE $this->contentTable SET deleted=NOW() WHERE id = ?";
        $this->db->execute($query, [$id]);
    }


    /**
     * Check if user exists in database
     *
     * @param string $user Username to check
     * @return bool True if user exists, otherwise false
     */
    public function exists($user)
    {
        $query = "SELECT * FROM $this->usersTable WHERE user = ?";
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

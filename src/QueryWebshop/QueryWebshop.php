<?php
namespace Canjono\QueryWebshop;

/**
 * Class for user
 */

class QueryWebshop
{
    /**
     * @var object $db Database object to use for connecting to database
     */
    private $db;



    /**
     * Get all products in inventory
     *
     * @return array With objects of products info
     */
    public function getProducts()
    {
        $query = "SELECT * FROM webshop_Vinventory";
        return $this->db->executeFetchAll($query);
    }



    /**
     * Get a product
     *
     * @param $id int Id number of product
     * @return object The product
     */
    public function getProduct($id)
    {
        $query = "SELECT * FROM webshop_Vproduct WHERE id = ?";
        return $this->db->executeFetch($query, [$id]);
    }



    /**
     * Update product
     *
     * @param $params array Parameters
     * @return void
     */
    public function updateProduct($params)
    {
        $query = "CALL updateProd(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->execute($query, $params);
    }



    /**
     * Add new product
     *
     * @param $name string Name of product
     * @param $amount int Amount to add
     * @return int Id of the new product
     */
    public function addProduct($params)
    {
        $query = "CALL addProd(?, ?, ?)";
        return $this->db->executeFetch($query, $params)->id;
    }


    /**
     * Delete product
     *
     * @param $id int Id number of product to delete
     * @return void
     */
    public function deleteProduct($id)
    {
        $query = "CALL deleteProd(?)";
        $this->db->execute($query, [$id]);
    }



    /**
     * Get categories
     *
     * @return array All categories
     */
    public function getCategories()
    {
        $query = "SELECT * FROM webshop_prodCategory";
        return $this->db->executeFetchAll($query);
    }



    /**
     * Get shelfs
     *
     * @return array All shelfs
     */
    public function getShelves()
    {
        $query = "SELECT * FROM webshop_invenShelf";
        return $this->db->executeFetchAll($query);
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

<?php

class Product
{

    private $conn;
    private $name;
    private $description;
    private $price;
    private $created;
    private $category_id;
    private  $modified;

    /**
     * Product constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    private function setModified()
    {
        $date = new DateTime();
        $modified_timestamp = $date->format('Y-m-d H:i:s');

        $this->modified = $modified_timestamp;
    }

    function Add()
    {
        $this->setCreated();

        $sql = "INSERT INTO products(name,price,description,created,category_id)
                VALUES('$this->name', $this->price , '$this->description', '$this->created', $this->category_id)";


        $result = $this->conn->exec($sql);
      //  var_dump($result);
        return $result;
    }
            function  Get()
            {
                $query = $this->conn->prepare("select products.*, categories.name as category from products inner join categories on products.category_id = categories.id");
                $query->execute();

                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }

            function  delete ($id) {

                $sql = "DELETE FROM products WHERE id=$id";

                // use exec() because no results are returned
                $result = $this->conn->exec($sql);
                return $result;
            }

    function updateOne($id)
    {
        $this->setCreated();

        $query = "UPDATE products
                    SET
                        name = '$this->name',
                        description = '$this->description',
                        price = $this->price,
                        category_id = $this->category_id,
                        modified = '$this->modified'
                    WHERE id = $id";

        $result = $this->conn->exec($query);

        return $result;
    }
    function getOne($id)
    {
        $query = $this->conn->prepare("SELECT * FROM products WHERE id = $id");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }
    /**
     * @return mixed
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param mixed $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @throws Exception
     */
    public function setCreated()
    {
        $date = new DateTime();
        $date_time = $date->format('Y-m-d H:i:s');
        $this->created = $date_time;
//        echo $date_time;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

}
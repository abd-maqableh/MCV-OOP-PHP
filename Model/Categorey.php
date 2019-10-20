
<?php

    class Categorey {
        private $conn;
        private $name;
        private $created;

        function  __construct($conn)
        {
            $this->conn=$conn;
        }
        private function setCreated()
        {
            $date = new DateTime();
            $created_datetime = $date->format('Y-m-d H:i:s');

            $this->created = $created_datetime;
        }

        public function  addCategory () {
                        $this->setCreated();
                        $add = "INSERT INTO categories (name, created) VALUES ('$this->name','$this->created')";
                        $category = $this->conn->exec($add);
                        return $category;
        }

        function getCategory()
        {
            $categories = $this->conn->prepare("SELECT id, name, modified, created FROM categories");
            $categories->execute();

            $result = $categories->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        function getAll()
        {
            $query = $this->conn->prepare("SELECT id, name, modified, created FROM categories");
            $query->execute();

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
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
        public function getCreated()
        {
            return $this->created;
        }

        /**
         * @param mixed $created
         */

    }
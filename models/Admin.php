<?php
    namespace models;
    use models\Database;
    use PDO;


    // admin class 
    class admin {
        private $connection;

        // db connection method
        public function db_connection() {
            $database = new Database();
            $this->connection = $database->connect();
            // check for connection
            if ($this->connection === null) {
                throw new \Exception("DB Connection Failed!");
            }
            return $this->connection;
        }
    }

?>
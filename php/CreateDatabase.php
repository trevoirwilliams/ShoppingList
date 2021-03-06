<?php
//MODULE TO CREATE
class CreateDatabase
{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $conn;

         

        //CONSTRUCTOR FOR CLASS
       /* public function __construct(
        $dbname = "heroku_7bb4c93e415ee60",
        $tablename = "producttb",
        $servername = "us-cdbr-east-02.cleardb.com",
        $username = "bc2410c0c6701a",
        $password = "cde9877c"*/
        
        public function __construct(
            /*$dbname = 'sql10383257',
            $tablename = 'producttb',
            $servername = 'sql10.freemysqlhosting.net',
            $username = 'sql10383257',
            $password = 'j9c76VcLkH'*/

            //DEVELOPMENT SETTING
            $dbname = "productdb",
            $tablename = "producttb",
            $servername = "localhost",
            $username = "root",
            $password = ""
         
    )
    {
      $this->dbname = $dbname;
      $this->tablename = $tablename;
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;

        //Function to create connection
        $this->conn = mysqli_connect($servername, $username, $password);

        //Checking connection
        if (!$this->conn){
            die("Connection Failed!! : " . mysqli_connect_error());
        }

        //Query if database exist
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        //Execution of query
        if(mysqli_query($this->conn, $sql)){

            $this->conn = mysqli_connect($servername, $username, $password, $dbname);

            //Creating new table
            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             product_name VARCHAR (100) NOT NULL,
                             product_price FLOAT,
                             product_image VARCHAR (150)
                            );";

            if (!mysqli_query($this->conn, $sql)){
                echo "Error creating table : " . mysqli_error($this->conn);
            }

        }else{

            //Incase something goes wrong
            return false;
        }
    }
            //Fetch product from database
            public function getData(){
                $sql = "SELECT*FROM $this->tablename";

                $result = mysqli_query($this->conn, $sql);
                if(mysqli_num_rows($result)>0){
                    return $result;
                }

            }
}
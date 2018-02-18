<?php
class DeleteClass
{
    // connect to mysql database
    public function __construct($hostname, $username, $password, $database)
    {
        $this->connection = new mysqli($hostname, $username, $password, $database);
        if($this->connection->connect_errno)
            die("Error " . $this->connection->connect_error);
    }
    
    // fetch all the user records from db
    public function select_user()
    {
        $result = $this->connection->query("select * from users");
        return $result->fetch_assoc();
    }
    
    // delete user record for given id
    public function delete_user($id)
    {
        return $this->connection->query("delete from users where id = " . $id);
    }
}
?>
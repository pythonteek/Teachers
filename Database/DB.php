<?php
include("defaults.php");


//set values:
$device_id = 4;//test id
$value = new Defaults();
$value->set_token($device_id);
$value->set_values();

//new Properties:
$token = $value->get_token();
$host = $value->get_host();
$username = $value->get_username();
$password = $value->get_password();
$db_name = $value->get_db_name($token);

class DB{
    //Fixed Properties:
    private $host;
    private $username;
    private $password;
    
    //Dynamic Properties:
    private $db_name;
    
    //Public Properties:
    private $token;
    private $conn;
    
    function set_values($host, $username, $password, $db_name)
    {
        $this->host = $host;
        $this->username =  $username;
        $this->password = $password;
        
        $this->db_name = $db_name;
    }
    
    function set_connection($host, $username, $password, $db_name)
    {
        $servername = 
        $this->conn = new mysqli($servername, $username, $password, $db_name);
        
        if ($this->conn->connect_error) {
            return($this->conn->connect_error);
        }else{
            return($this->conn);
        }
        
    }
    
    function get_host()
    {
        return $this->host;
    }
    function get_username()
    {
        return $this->username;
    }
    function get_password()
    {
        return $this->password;
    }
    function get_db_name()
    {
        //The name of the database is selected according to the device number of the organization.
        return $this->db_name;
    }
}
?>

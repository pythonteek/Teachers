<?php

/*============================
Version 1.1.2
August 2022
sajjadranjbaryazdi@gmail.com
===============================*/

class Defaults{
    /*============================================================================
    In this section, the variables required to connect to the database are defined.
    ==============================================================================*/
    //Fixed Properties:
    private $host;
    private $username;
    private $password;
    
    //Dynamic Properties:
    private $db_name;
    
    //Public Properties:
    private $token;
    
    
    /*=================================================================================
    The default values that can be different for each database are set in this section.
    The token is equal to the device id, which identifies the organization that was sent.
    ===================================================================================*/
    function set_token($token)
    {
        $this->token = $token;
    }
    function set_values()
    {
        $this->host = "localhost";
        $this->username =  "root";
        $this->password = "";
        
        $this->db_name = ["db", "db1", "db2", "db3", "db4", "db5"];
    }
    
    
    function get_token()
    {
        return $this->token;
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
    function get_db_name($index)
    {
        //The name of the database is selected according to the device number of the organization.
        return $this->db_name[$index];
    }
}

/*========================================================
To test this class, you can uncomment the following script.
=========================================================*/

/*
//set values:
$device_id = 5;//test id
$value = new Defaults();
$value->set_token($device_id);
$value->set_values();

//new Properties:
$token = $value->get_token();
$host = $value->get_host();
$username = $value->get_username();
$passwoer = $value->get_password();
$db_name = $value->get_db_name($token);

//echo Properties:
echo $token . "</br>" . "Host: " . $host . " Username: " . $username . " Password: " . $passwoer . "</br>" . " DataBase name: " . $db_name . "</br>";  
*/
?>


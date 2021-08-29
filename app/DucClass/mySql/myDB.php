<?php
namespace shopbanhanglaravel\app\DucClass\mySql;

//  $db = new myDB();

class myDB
{
    public   $host     =     "localhost";
    public   $user     =     "root";
    public   $pass     =     "";
    public   $dbname   =     "laravel_157";
    
    
    public   static     $conn       ;
    
    public   $error;
    
    public   static  $i  =   0;
    
    
    public   function __construct()
    {
        self::$conn     =    new \mysqli($this->host , $this->user , $this->pass , $this->dbname);
        
        self::$conn ->set_charset('utf8');
        
        if (! self::$conn ) {
            
            $this->error     =   "Connection fail" . $this->conn->connect_error;
            
            return false;
        }
        
        else {
            
            static:: $i++;
            
            consolelog2('myDb 37' ,  "Connection website_mvc ok " .static:: $i ) ;
        
            consolelog33('myDb 39' ,   print_r(self::$conn , true));
        }
    }
    
    
    
    public static function executer($query)
    {
        $db = new myDB();        
             
        try {
            
            $result     =    self::$conn->query($query)     or   die ("erreur is p53 : " .self::$conn ->error . __LINE__);
            
        }
        catch (\Exception $e){
            
            consolelog($e->getMessage());
        }
        finally {
            
            consolelog33('62' ,$result );            
        }
        
        consolelog('522');
        
        if ($result) {   
            
            consolelog33('53', $result);
            
            return      $result;        
        }
        
        
        else {    
            
            consolelog('sai rui');
        
            return  false;           
        }
                
    }
    
      
    
    // Select or Read data
    
    public static function select($query)
    {
        $db         =    new myDB();
        
                
        $result     =    self::$conn->query($query)     or   die(self::$conn->error . __LINE__);
        
        
        if ($result->num_rows > 0) {      
            
            consolelog2('so dong : ' , $result->num_rows );
            
            return $result;        
        }
        
        
        else {    
            
            consolelog2('ko co dong nao ca' , $result->num_rows );
            
            return false;           
        }
    }
    
    
    // Insert data
    /*    public function insert($query)
     {
     $insert_row     =    $this->link->query($query)     or die($this->link->error . __LINE__);
     
     
     if ($insert_row) {            return    $insert_row;        }
     
     else             {            return    false;              }
     } */
    
    
    // Update data
    
    public function update($query)
    {
        $update_row     =    $this->conn->query($query) or die($this->conn->error . __LINE__);
        
        
        if ($update_row) {            return     $update_row;        }
        
        
        else {                        return     false;              }
    }
    
    
    // Delete data
    
    public function delete($query)
    {
        $delete_row     =    $this->conn->query($query) or die($this->conn->error . __LINE__);
        
        
        if ($delete_row) {            return       $delete_row;        }
        
        
        else {                        return       false;              }
    }
}


<?php       
   class DataBase
   {
        public static $db_host = "localhost";
        public static $db_Name = "beurgeur_code";
        public static $db_user = "root";
        public static $db_psw="";
        private $db=null;
            public static function connect(){
                try{
                    $db=new PDO("mysql:host=" .self::$db_host. "; dbname=".self::$db_Name,self::$db_user,self::$db_psw);
                    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                return $db;
            }

            public static function Desconexte(){
                $db=null;
            }
        
    }
    // $conect =DataBase::connect();
    // $request = $conect->query('SELECT  name , description , price FROM items ');
    // while ($row = $request->fetch() ){
    //     echo "NOM ". $row['name'] ." ";
    //     echo " DESCRIPTION :" .$row['description']." ";
    //     echo "Prix du produit  ". $row['price']." ";
    //     echo "<br/>";
    // };

   
?>
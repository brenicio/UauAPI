<?php
  Class db{
   var $hostname;
   var $port;
    var $dbname;
   var $username;
   var $pw;
   var $dbh="";

function db(){
  $hostname = "192.168.100.2";
  $port = 1433;
  $dbname = "UAU";
  $username = "consultas";
  $pw = "pro4523";

  $this->hostname = $hostname;
  $this->dbname = $dbname;
  $this->username = $username;
  $this->pw = $pw;
  $this->port = $port;
}

function Conectar(){

  try {
    
    $this->dbh = new PDO ("sqlsrv:server=$this->hostname;Database=$this->dbname","$this->username","$this->pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }

}

function query($query){
  return $this->dbh->query($query);
}

function Executar($consulta){
  try{
     $dbh = $this->dbh;
     $stmt = $dbh->prepare($consulta);
     $stmt->execute();
     if($stmt == false){
         echo "Erro na consulta!!";
      }else{
        return $stmt;
      }     
     }catch(PDOException $e){
        return $e->getMessage();
     }
}

  }

  
  
?>

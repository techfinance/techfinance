<?php
    abstract class Banco {
        public $pdo;
        public $erro = "";

        public function __construct($dbname, $host, $user, $senha){
            try{
                $this->pdo = new PDO("mysql:dbname=$dbname;host=$host", $user, $senha);
            } catch(PDOException $e){
                $this->erro = $e->getMessage();
                exit();
            } catch(Exception $e){
                echo "Erro: ".$e->getMessage();
                exit();
            }
        }
    }

?>

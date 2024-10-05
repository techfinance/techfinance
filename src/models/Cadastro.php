<?php
    Class Cadastro{

        private $pdo;

        public function __construct($dbname, $host, $user, $senha){
            try{
                $this->pdo = new PDO("mysql:dbname=$dbname;host=$host", $user, $senha);

            } catch(PDOException $e){
                echo "Erro conexão com DB: ".$e->getMessage();
                exit();
            } catch(Exception $e){
                echo "Erro: ".$e->getMessage();
                exit();
            }

        }

        public function cadastrar($nome, $email, $senha){
            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            if($sql->rowCount() > 0){
                return false; //já está cadastrado
            } else {
                $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", $senha);
                $sql->execute();
                return true; //cadastrado com sucesso
            }

        }

        public function logar($email, $senha){
            

        }
    }
    


?>
<?php
    class Categoria extends Banco {
        
        public function setCategoriau($nome_categoria, $id_usuario){
            $sql = $this->pdo->prepare("SELECT id_categoriau FROM categoriau WHERE nome_categoriau = :n");
            $sql->bindValue(":n", $nome_categoria);
            $sql->execute();

            if($sql->rowCount() > 0){
                return false;
            } else {
                $sql = $this->pdo->prepare("INSERT INTO categoriau (NOME_CATEGORIAU, Usuario_ID_USUARIO) VALUES (:n, :i)");
                $sql->bindValue(":n", $nome_categoria);
                $sql->bindValue(":i", $id_usuario);
                $sql->execute();
    
                return true;
            }
        }

        public function getAllCategoria($id_usuario){
            $dados = array();
            $sql = $this->pdo->query("SELECT id_categoriau id, nome_categoriau nome, usuario_id_usuario FROM categoriau WHERE usuario_id_usuario = $id_usuario UNION ALL SELECT id_categoria id, nome_categoria nome, null FROM categoria");
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $dados;
        }

        public function getCategoriau($nome_categoria){
            $sql = $this->pdo->prepare("SELECT id_categoriau FROM categoriau WHERE nome_categoriau = :n");
            $sql->bindValue(":n", $nome_categoria);
            $sql->execute();
            $dados = $sql->fetch();

            return $dados;
        }

    }


?>
<?php
    class Categoria extends Banco {
        
        public function setCategoriau($nome_categoria, $id_usuario){
            $sql = $this->pdo->prepare("SELECT id_categoriau FROM categoriau WHERE nome_categoriau = :n AND usuario_id_usuario = :u");
            $sql->bindValue(":n", $nome_categoria);
            $sql->bindValue(":u", $id_usuario);
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

        public function getCategoriau($nome_categoria, $id_usuario){
            $sql = $this->pdo->prepare("SELECT id_categoriau FROM categoriau WHERE nome_categoriau = :n AND usuario_id_usuario = :i");
            $sql->bindValue(":n", $nome_categoria);
            $sql->bindValue(":i", $id_usuario);
            $sql->execute();
            $dados = $sql->fetch();

            return $dados;
        }

        public function getCategoriaName($id_categoria, $id_categoriau, $id_usuario) {
            if(!isset($id_categoria)){
                $sql = $this->pdo->prepare("SELECT nome_categoriau AS nome_categoria FROM categoriau WHERE id_categoriau = :d AND usuario_id_usuario = :i");
                $sql->bindValue(":d", $id_categoriau);
                $sql->bindValue(":i", $id_usuario);
                $sql->execute();

                $dado = $sql->fetch();

                return $dado;

            } else {
                $sql = $this->pdo->prepare("SELECT nome_categoria FROM categoria WHERE id_categoria = :d");
                $sql->bindValue(":d", $id_categoria);
                $sql->execute();

                $dado = $sql->fetch();

                return $dado;
            }
        }

        public function getSomaSaidasPorCategoria($categoria_id, $id_usuario) {
            $sql = $this->pdo->prepare("
                SELECT saida.valor 
                FROM saida 
                LEFT JOIN categoria cp ON saida.categoria_id_categoria = cp.id_categoria
                LEFT JOIN categoriau cu ON saida.categoriau_id_categoriau = cu.id_categoriau
                WHERE (cp.id_categoria = :ic OR cu.id_categoriau = :ic)
                AND saida.Usuario_ID_USUARIO = :iu;
            ");
            $sql->bindValue(":ic", $categoria_id);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();
        
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
        
            $soma = 0;
            foreach ($dados as $linha) {
                $soma += (float) $linha["valor"];
            }
        
            return $soma;
        }

    }

?>
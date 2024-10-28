<?php
    class Sonho extends Carteira {

        public function criarSonho($nome, $valor, $data, $id_usuario){
            $sql = $this->pdo->prepare("INSERT INTO sonhos (sonho_nome, valor, sonho_status, sonho_data, usuario_id_usuario) VALUES (:n, :v, :s, :d, :i)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":s", "progresso");
            $sql->bindValue(":d", $data);
            $sql->bindValue(":i", $id_usuario);
            $sql->execute();

            return true;
        }

        public function buscarSonho($id_usuario) {
            $sql = $this->pdo->query("SELECT * FROM sonhos WHERE usuario_id_usuario = $id_usuario");
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $dados;
        }

        public function setSonhoConcluido($sonho_id, $id_usuario){
            $sql = $this->pdo->prepare("UPDATE sonhos SET sonho_status = 'concluido' WHERE id_sonho = :im AND usuario_id_usuario = :iu");
            $sql->bindValue(":im", $sonho_id);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();
    
            return true;
        }
    }

?>
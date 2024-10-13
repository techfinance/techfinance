<?php
    class Registro extends Banco {

        public function cadastrarDespesa($tipo, $categoria, $valor, $id) {
            $sql = $this->pdo->query("SELECT id_carteira FROM carteira WHERE usuario_id_usuario = $id");
            $id_carteira = $sql->fetch();
            
            $sql = $this->pdo->prepare("INSERT INTO saida (tipo, categoria, valor, usuario_id_usuario, carteira_id_carteira) VALUES (:t, :c, :v, :i, :f)");
            $sql->bindValue(":t", $tipo);
            $sql->bindValue(":c", $categoria);
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":i", $id);
            $sql->bindValue(":f", $id_carteira["id_carteira"]);
            $sql->execute();

            return true;
            
        }

        public function cadastrarEntrada($nome, $valor, $id) {
            $sql = $this->pdo->query("SELECT id_carteira FROM carteira WHERE usuario_id_usuario = $id");
            $id_carteira = $sql->fetch();

            $sql = $this->pdo->prepare("INSERT INTO entrada (nome_entr, valor_entr, usuario_id_usuario, carteira_id_carteira) VALUES (:n, :v, :i, :f)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":i", $id);
            $sql->bindValue(":f", $id_carteira["id_carteira"]);
            $sql->execute();

            return true;
        }

    }

?>
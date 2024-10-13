<?php
    class Carteira extends Banco {

        public function updateCarteira($id, $valor) {
            $sql = $this->pdo->prepare("UPDATE carteira SET saldo = :v WHERE usuario_id_usuario = :i");
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":i", $id);
            $sql->execute();

            return true;
        }

        public function valorCarteira($id) {
            $sql = $this->pdo->query("SELECT saldo FROM carteira WHERE usuario_id_usuario = $id");
            $dados = $sql->fetch();

            return $dados["saldo"];
        }

    }

?>
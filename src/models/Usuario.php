<?php
    class Usuario extends Banco {

        public function cadastrar($nome, $email, $senha){

            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            if($sql->rowCount() > 0){
                return false; //já está cadastrado
            } else {
                $sql = $this->pdo->prepare("INSERT INTO usuario (nome_user, email, senha) VALUES (:n, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();

                //cria carteira ao cadastrar associada ao id criado
                $sql = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
                $sql->bindValue(":e", $email);
                $sql->execute();
                $dados = $sql->fetch();
                $sql = $this->pdo->prepare("INSERT INTO carteira (nome_carteira, saldo, usuario_id_usuario) VALUES (:n, :s, :i)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":s", 0.00);
                $sql->bindValue(":i", $dados["id_usuario"]);
                $sql->execute();

                return true; //cadastrado com sucesso
            }
        }

        public function logar($email, $senha){

            $sql = $this->pdo->prepare("SELECT id_usuario, nome_user FROM usuario WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0){
                //entrar no ambiente (sessão)
                $dados = $sql->fetch();
                session_start();
                $_SESSION["id_usuario"] = $dados["id_usuario"];
                $_SESSION["nome"] = $dados["nome_user"];
                return true;
            } else {
                return false;
            }
        }
    }

?>
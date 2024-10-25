<?php
    class Meta extends Banco {
        
        public function criarMeta($valor_meta, $data_meta, $id_usuario, $descricao, $tipo, $id_categoria){
            
            if($tipo == "padrao"){
                $sql = $this->pdo->prepare("INSERT INTO metas (valor, meta_status, meta_data, usuario_id_usuario, categoria_id_categoria, descricao) VALUES (:v, :s, :d, :i, :ic, :de)");
            } else {
                $sql = $this->pdo->prepare("INSERT INTO metas (valor, meta_status, meta_data, usuario_id_usuario, categoriau_id_categoriau, descricao) VALUES (:v, :s, :d, :i, :ic, :de)");
            }     

            $sql->bindValue("v", $valor_meta);
            $sql->bindValue(":s", "progresso");
            $sql->bindValue(":d", $data_meta);
            $sql->bindValue(":i", $id_usuario);
            $sql->bindValue(":ic", $id_categoria);
            $sql->bindValue(":de", $descricao);
                $sql->execute();
            return true;
        }

        public function getMetas($id_usuario) {
            $sql = $this->pdo->prepare("SELECT * FROM metas WHERE usuario_id_usuario = :i");
            $sql->bindValue(":i", $id_usuario);
            $sql->execute();
            
            $dados = array();
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $dados;

        }

        public function getSomaSaidas($meta_id, $id_usuario){
            $sql = $this->pdo->prepare("SELECT saida.valor 
                                        FROM saida 
                                        JOIN metas m ON (saida.categoriau_id_categoriau = m.categoriau_id_categoriau OR saida.categoria_id_categoria = m.categoria_id_categoria) 
                                        WHERE m.id_meta = :im 
                                        AND m.Usuario_ID_USUARIO = :iu
                                        AND saida.Usuario_ID_USUARIO = :iu
                                        AND saida.SAIDA_DATA >= m.data_criacao;");
            $sql->bindValue(":im", $meta_id);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();

            $dados = array();
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

            $soma = 0;
            foreach($dados as $linha){
                $soma += (float) $linha["valor"];
            }

            return $soma;
        }

        public function setMetaConcluida($meta_id, $id_usuario){
            $sql = $this->pdo->prepare("UPDATE metas SET meta_status = 'concluido' WHERE id_meta = :im AND usuario_id_usuario = :iu");
            $sql->bindValue(":im", $meta_id);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();

            return true;
        }

        public function setMetaNaoConcluida($meta_id, $id_usuario){
            $sql = $this->pdo->prepare("UPDATE metas SET meta_status = 'nao concluido' WHERE id_meta = :im AND usuario_id_usuario = :iu");
            $sql->bindValue(":im", $meta_id);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();

            return true;

        }

    }

?>
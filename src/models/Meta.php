<?php
    class Meta extends Banco {
        
        public function criarMeta($valor_meta, $data_inicio, $data_meta, $id_usuario, $descricao, $tipo, $id_categoria){
            if($valor_meta > 0) {
                if($tipo == "padrao"){
                    $sql = $this->pdo->prepare("INSERT INTO metas (valor, meta_status, meta_data, meta_datacriacao, usuario_id_usuario, categoria_id_categoria, meta_descricao) VALUES (:v, :s, :d, :dc, :i, :ic, :de)");
                } else {
                    $sql = $this->pdo->prepare("INSERT INTO metas (valor, meta_status, meta_data, meta_datacriacao, usuario_id_usuario, categoriau_id_categoriau, meta_descricao) VALUES (:v, :s, :d, :dc, :i, :ic, :de)");
                }     
    
                $sql->bindValue("v", $valor_meta);
                $sql->bindValue(":s", "progresso");
                $sql->bindValue(":d", $data_meta);
                $sql->bindValue(":dc", $data_inicio);
                $sql->bindValue(":i", $id_usuario);
                $sql->bindValue(":ic", $id_categoria);
                $sql->bindValue(":de", $descricao);
                    $sql->execute();
                return true;
            } 
        }

        public function getMetas($id_usuario) {
            $sql = $this->pdo->prepare("SELECT * FROM metas WHERE usuario_id_usuario = :i ORDER BY meta_data");
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
                                        AND saida.SAIDA_DATA >= m.meta_datacriacao;");
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

        public function getMetasEmProgresso($id_usuario){
            $dados = array();
            $sql = $this->pdo->query("SELECT id_meta from metas WHERE usuario_id_usuario = $id_usuario AND meta_status = 'progresso'");
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $dados;
        }

        public function deleteMeta($id_meta, $id_usuario){
            $sql = $this->pdo->prepare("DELETE FROM metas WHERE id_meta = :im AND usuario_id_usuario = :iu");
            $sql->bindValue(":im", $id_meta);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();
            
            return true;
        }

        public function editValorMeta($id_meta, $valor, $id_usuario){
            $sql = $this->pdo->prepare("UPDATE metas SET valor = :v WHERE id_meta = :im AND usuario_id_usuario = :iu");
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":im", $id_meta);
            $sql->bindValue(":iu", $id_usuario);
            $sql->execute();

            return true;
        }

    }

?>
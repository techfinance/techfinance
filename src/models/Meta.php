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
    }

?>
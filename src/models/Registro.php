<?php
    class Registro extends Carteira {

        //cadastra saida
        public function cadastrarDespesa($tipo, $categoria, $valor, $tipoCategoria, $idCategoria, $id) {
            $sql = $this->pdo->query("SELECT id_carteira FROM carteira WHERE usuario_id_usuario = $id");
            $id_carteira = $sql->fetch();
            
            if($tipoCategoria == "padrao"){
                $sql = $this->pdo->prepare("INSERT INTO saida (tipo, categoria, valor, usuario_id_usuario, carteira_id_carteira, categoria_id_categoria) VALUES (:t, :c, :v, :i, :f, :g)");
            } else {
                $sql = $this->pdo->prepare("INSERT INTO saida (tipo, categoria, valor, usuario_id_usuario, carteira_id_carteira, categoriau_id_categoriau) VALUES (:t, :c, :v, :i, :f, :g)");
            }
            
            $sql->bindValue(":t", $tipo);
            $sql->bindValue(":c", $categoria);
            $sql->bindValue(":v", $valor);
            $sql->bindValue(":i", $id);
            $sql->bindValue(":f", $id_carteira["id_carteira"]);
            $sql->bindValue(":g", $idCategoria);
            $sql->execute();
            return true;
        }

        //cadastra entrada
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

        //retorna todas as saidas registradas
        public function getDespesa($id) {
            $dados = array();
            $sql = $this->pdo->query("SELECT tipo, categoria, valor, saida_data FROM saida WHERE usuario_id_usuario = $id");
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }

        //retorna as saídas por mês
        public function getDespesaPorMes($id_usuario) {
            $this->pdo->query("SET lc_time_names = 'pt_BR';");

            $sql = $this->pdo->prepare("
                SELECT 
                    MONTHNAME(saida_data) AS mes_nome, 
                    SUM(valor) AS total 
                FROM 
                    saida 
                WHERE 
                    usuario_id_usuario = :id 
                    AND saida_data >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                GROUP BY 
                    mes_nome 
                ORDER BY 
                    MONTH(saida_data) ASC;  -- Para garantir a ordem correta
            ");
            
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        //retorna todas as entradas registradas
        public function getEntrada($id) {
            $dados = array();
            $sql = $this->pdo->query("SELECT nome_entr, valor_entr, entr_data FROM entrada WHERE usuario_id_usuario = $id");
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }

        public function getEntradaPorMes($id_usuario) {
            $this->pdo->query("SET lc_time_names = 'pt_BR';");

            $sql = $this->pdo->prepare("
                SELECT 
                    MONTHNAME(entr_data) AS mes_nome, 
                    SUM(valor_entr) AS total 
                FROM 
                    entrada 
                WHERE 
                    usuario_id_usuario = :id 
                    AND entr_data >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                GROUP BY 
                    mes_nome 
                ORDER BY 
                    MONTH(entr_data) ASC;  -- Para garantir a ordem correta
            ");
            
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        //retorna todos os registros de entrada e saida ordenados por data
        public function getAllRegistros($id){
            $sql = $this->pdo->query("SELECT id_saida id, 'Saída' tipo_transacao, tipo descricao, categoria, valor valor, saida_data data_transacao FROM saida WHERE usuario_id_usuario = $id UNION ALL SELECT id_entrada id, 'Entrada' tipo_transacao, nome_entr descricao, null, valor_entr valor, entr_data data_transacao FROM entrada WHERE usuario_id_usuario = $id ORDER BY data_transacao DESC");
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $dados;

        }

        public function deleteSaida($id) {
            $this->pdo->query("DELETE FROM saida WHERE id_saida = $id");
            return true;
        }

        public function deleteEntrada($id) {
            $this->pdo->query("DELETE FROM entrada WHERE id_entrada = $id");
            return true;
        }

    }

?>
<?php
    if(!isset($_SESSION)){
        session_start();
    }

      spl_autoload_register(function ($class_name) {
        include '../../src/models/' . $class_name . '.php';
      });

      $registrar = new Registro("tech_finance1", "localhost", "root", "");
      $dados = $registrar->getAllRegistros($_SESSION["id_usuario"]);

      if(count($dados) > 0){
        for($i = 0; $i < count($dados); $i++){
          echo "<tr>";
          echo "<td>". $i+1 ."</td>";
          foreach($dados[$i] as $key => $value){
            if($key == "id"){
              continue;
            }

            if($value == NULL){
              echo "<td>-</td>";
              continue;
            }

            if($key == "valor") {
              echo"<td>R$ ".number_format($value,2,",",".")."</td>";
              continue;
            }
  
            if($key == "data_transacao"){
              $data_edit = DateTime::createFromFormat('Y-m-d', $value);
              echo "<td>".$data_edit->format('d/m/Y')."</td>";
              continue;
            }
  
            echo "<td>$value</td>";
          } if($i == 0) {
              if($dados[$i]["tipo_transacao"] == "Saída"){
                echo "<td><i class='bi bi-trash-fill' onclick='excluirSaida(". $dados[$i]["id"] .",". $dados[$i]["valor"] . ")' style='cursor: pointer; color:var(--primary-red);'></i></td>";
              } else {
                echo "<td><i class='bi bi-trash-fill' onclick='excluirEntrada(". $dados[$i]["id"] ."," . $dados[$i]["valor"] .")' style='cursor: pointer;color:var(--primary-red);'></i></td>";
              }
          } else {
            echo "<td></td>";
          }
          
          echo "</tr>";
        } 
      } else {
        echo "<tr><td colspan='7' class='text-center'>Você ainda não tem registros</td></tr>";
      }

?>
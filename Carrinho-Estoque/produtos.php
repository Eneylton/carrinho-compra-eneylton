<?php
 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, POST, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: text/json; charset=utf-8");


include "Connect/connect.php";

$postjson = json_decode(file_get_contents('php://input'),true);

if($postjson['crud'] == "listar-produtos"){

        $data = array();
        
        $query = mysqli_query($mysqli, "SELECT * FROM produtos as c ORDER BY c.id desc");

        while($row = mysqli_fetch_array($query)){
            $data[] = array(
				'id'           => $row['id'],
				'nome'         => $row['nome'],
				'valor'        => $row['valor'],
				'cont'         => $row['cont'],
				'qtd'          => $row['qtd']
				
            );
        }

        if($query) $result = json_encode(array('success' => true,'result' =>$data));
        else $result = json_encode(array('success'=> false));
        echo $result;

    }

    elseif($postjson['crud'] == "add-item"){
       
        $data = array();
    
        $query   = mysqli_query($mysqli, "INSERT INTO pedidos SET
                   nome           = '$postjson[nome]',
                   valor          = '$postjson[valor]',
                   produtos_id    = '$postjson[produtos_id]',
                   qtd            = '$postjson[qtd]' ");
    
        $idadd = mysqli_insert_id($mysqli);
    
        if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
        else $result = json_encode(array('success'=> false));
        echo $result;
    }

    elseif($postjson['crud'] == "contagem"){

        $data = array();
        
        $query = mysqli_query($mysqli, "SELECT * FROM produtos as c WHERE c.id = $postjson[id] ORDER BY c.id desc");

        while($row = mysqli_fetch_array($query)){
            $data[] = array(
				'id'           => $row['id'],
				'qtd'          => $row['qtd']
				
            );
        }

        if($query) $result = json_encode(array('success' => true,'result' =>$data));
        else $result = json_encode(array('success'=> false));
        echo $result;

    }

    elseif($postjson['crud'] == "listar-produtos-atualizar"){

        $data = array();
        
        $query = mysqli_query($mysqli, "SELECT * FROM produtos as c ORDER BY c.id desc");

        while($row = mysqli_fetch_array($query)){
            $data[] = array(
				'id'           => $row['id'],
				'qtd'          => $row['qtd']
				
            );
        }

        if($query) $result = json_encode(array('success' => true,'result' =>$data));
        else $result = json_encode(array('success'=> false));
        echo $result;

    }

    elseif($postjson['crud'] == "listar-pedidos"){

        $data = array();
        
        $query = mysqli_query($mysqli, "SELECT * FROM pedidos as c ORDER BY c.id ");
    
        while($row = mysqli_fetch_array($query)){
            $data[] = array(
                'id'            => $row['id'],
                'valor'         => $row['valor'],
                'qtd'           => $row['qtd'],
                'nome'          => $row['nome'],
                'produtos_id'   => $row['produtos_id'],
                'data'          => $row['data']
                
            );
        }
    
        if($query) $result = json_encode(array('success' => true,'result' =>$data));
        else $result = json_encode(array('success'=> false));
        echo $result;
    
    }
    

    elseif($postjson['crud'] == "adicionar"){
       
        $data = array();
    
        $query   = mysqli_query($mysqli, "INSERT INTO categoria SET
                   descricao          = '$postjson[descricao]'");
    
        $idadd = mysqli_insert_id($mysqli);
    
        if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
        else $result = json_encode(array('success'=> false));
        echo $result;
    }

    elseif($postjson['crud'] == "atualizar-produtos"){

        $query2   = mysqli_query($mysqli, "UPDATE produtos SET
	           
        qtd          =  '$postjson[qtd]'  WHERE id  = '$postjson[produtos_id]'");
    

        if($query) $result = json_encode(array('success'=>true));
        else $result = json_encode(array('success'=>false));
        echo $result;
    }

    elseif($postjson['crud'] == "atualizar-item"){

        $query   = mysqli_query($mysqli, "UPDATE pedidos SET
	           
               valor        =  '$postjson[valor]',
               qtd          =  '$postjson[qtd]',
               nome         =  '$postjson[nome]',
               produtos_id  =  '$postjson[produtos_id]'  WHERE id  = '$postjson[id]'");
    

        if($query) $result = json_encode(array('success'=>true));
        else $result = json_encode(array('success'=>false));
        echo $result;
    }

    elseif($postjson['crud'] == "deletar"){
  
        $query   = mysqli_query($mysqli, "DELETE FROM categoria WHERE id  = '$postjson[id]'");
      
    
        if($query) $result = json_encode(array('success'=>true));
        else $result = json_encode(array('success'=>false, 'msg'=>'error, Por favor, tente novamente... '));
        echo $result;
    }

?>
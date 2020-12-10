<?php

    $op = '';
    $conn = new mysqli('localhost','root','','web');

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['op'])){
        $op = $_GET['op'];
    }

    if($op == 'read'){

        $result['credito'] = $conn->query("SELECT id, descricao, data, valor, tipo_lancamento 
                                FROM contas 
                                WHERE tipo_lancamento = 1");
                                
        $result['debito'] = $conn->query("SELECT id, descricao, data, valor, tipo_lancamento 
                                FROM contas 
                                WHERE tipo_lancamento = 2");

        if($result['credito'] &&$result['credito']->num_rows>0 || $result['debito'] &&$result['debito']->num_rows>0 ){
            $result['credito'] = $result['credito']->fetch_all(MYSQLI_ASSOC);
            $result['debito']  = $result['debito']->fetch_all(MYSQLI_ASSOC);
            $result['status']  = 'ok';
            $result['message'] = 'Success';
        }else{
            $result['status'] = 'error';
            $result['message'] = 'Sem dados';
        }
        
        echo json_encode($result);
    }
    
    if($op == 'create'){
        
        $sql = "INSERT INTO contas (tipo_lancamento, descricao, valor, data)
        VALUES ('{$_POST['tipo_lancamento']}', '{$_POST['descricao']}', '{$_POST['valor']}', '{$_POST['data']}')"; 
        
        if ($conn->query($sql)) {
            $result['status'] = 'ok';
            $result['message'] = 'Success';
        } else {            
            $result['status'] = 'error';
            $result['message'] = 'Fail';
        }
        
        echo json_encode($result);
    }

    if($op == 'update'){
        
        $sql = "UPDATE contas SET tipo_lancamento='{$_POST['tipo_lancamento']}', descricao='{$_POST['descricao']}', 
                valor='{$_POST['valor']}', data='{$_POST['data']}' WHERE id = '{$_POST['id']}'"; 
        
        if ($conn->query($sql)) {
            $result['status'] = 'ok';
            $result['message'] = 'Success';
        } else {            
            $result['status'] = 'error';
            $result['message'] = 'Fail';
        }
        
        echo json_encode($result);
    }

    if($op == 'delete'){
        
        $sql = "DELETE FROM contas WHERE id = {$_GET['id']}"; 
        
        
        if ($conn->query($sql)) {
            $result['status'] = 'ok';
            $result['message'] = 'Success';
        } else {            
            $result['status'] = 'error';
            $result['message'] = 'Fail';
        }
        
        echo json_encode($result);
    }

    $conn->close();
    
    function dd(...$var):void
    {
        var_dump($var);
        die;
    }

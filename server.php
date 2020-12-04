<?php

// $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
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
            $result['status']  = 200;
            $result['message'] = 'Success';
        }else{
            $result['status'] = 500;
            $result['message'] = 'Fail';
        }
        // dd($result);
        
        echo json_encode($result);
    }
    
    if($op == 'create'){
        
        $sql = "INSERT INTO contas (tipo_lancamento, descricao, valor, data)
        VALUES ('{$_POST['tipo_lancamento']}', '{$_POST['descricao']}', '{$_POST['valor']}', '{$_POST['data']}')"; 
        
        if ($conn->query($sql)) {
            $result['status'] = 200;
            $result['message'] = 'Success';
        } else {            
            $result['status'] = 500;
            $result['message'] = 'Fail2';
        }
        
        echo json_encode($result);
    }

    if($op == 'delete'){
        
        $sql = "DELETE FROM contas WHERE id = {$_GET['id']}"; 
        
        
        if ($conn->query($sql)) {
            $result['status'] = 200;
            $result['message'] = 'Success';
        } else {            
            $result['status'] = 500;
            $result['message'] = 'Fail2';
        }
        
        echo json_encode($result);
    }

    $conn->close();
    
    function dd(...$var):void
    {
        var_dump($var);
        die;
    }

    // SELECT contas.id, contas.descricao, contas.data, contas.valor, tipo_lancamento.descricao 
    // FROM `contas` 
    // INNER JOIN tipo_lancamento ON contas.tipo_lancamento = tipo_lancamento.id


    // try {
    //     $result['lancamentos'] = $conn->query('SELECT id, descricao, data, valor, tipo_lancamento 
    //                             FROM contas')->fetch_all(MYSQLI_ASSOC);
    // //   dd($result);
    //   $result['status'] = 200;
    //   $result['message'] = 'Success';
    // }catch(Exception $e){
    //     $result['status'] = 500;
    //     $result['message'] = 'Fail';
    // }
    // echo json_encode($result);
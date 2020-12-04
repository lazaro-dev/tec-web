<?php

// $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $op = '';
    $conn = new mysqli('localhost','root','','web');

    if($conn->connect_error){
        echo "Erro: {$conn->connect_error}";
        exit();
    }

    if(isset($_GET['op'])){
        $op = $_GET['op'];
    }

    if($op == 'read'){
        $result['credito'] = $conn->query('SELECT id, descricao, data, valor, tipo_lancamento 
                                FROM contas 
                                WHERE tipo_lancamento = 1')->fetch_all();
        $result['debito'] = $conn->query('SELECT id, descricao, data, valor, tipo_lancamento 
                                FROM contas 
                                WHERE tipo_lancamento = 2')->fetch_all();        
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
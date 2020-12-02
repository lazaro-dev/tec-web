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
        $result = $conn->query('select * from users')->fetch_all();
        var_dump($result);
        die;
    }

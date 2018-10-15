<?php
require_once 'global.php';

try{
    $nome = $_POST['nome'];
    $id = $_POST['id'];

    $categoria = new Categoria($id);
    $categoria->nome = $nome;
    $categoria->atualizar();

    header('Location: categorias.php');
}catch(Exception $e){
    Erro::trataErro($e);
}
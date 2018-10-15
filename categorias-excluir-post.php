<?php
require_once 'global.php';

try{
    $id = $_GET['id'];

    $categoria = new Categoria($id);

    $categoria->deletar();

    header('Location: categorias.php');
}catch(Exception $e){
    Erro::trataErro($e);
}
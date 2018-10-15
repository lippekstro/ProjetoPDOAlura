<?php
require_once 'global.php';

try{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria_id'];

    $produto = new Produto($id);
    $produto->nome = $nome;
    $produto->preco = $preco;
    $produto->quantidade = $quantidade;
    $produto->categoria_id = $categoria;

    $produto->atualizar();

    header('Location: produtos.php');
}catch(Exception $e){
    Erro::trataErro($e);
}
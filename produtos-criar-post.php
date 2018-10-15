<?php
require_once 'global.php';

try{
    $produto = new Produto();
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria_id = $_POST['categoria_id'];
    $produto->nome = $nome;
    $produto->preco = $preco;
    $produto->quantidade = $quantidade;
    $produto->categoria_id = $categoria_id;
    $produto->inserir();

    header('Location: produtos.php');
}catch(Exception $e){
    Erro::trataErro($e);
}
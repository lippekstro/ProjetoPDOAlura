<?php
require_once 'classes/Conexao.php';

class Categoria
{

    public $id;
    public $nome;
    public $produtos;

    public function __construct($id = false){
        if($id){
            $this->id = $id;
            $this->carregar();
        }
    }

    public static function listar()
    {
        $query = "SELECT id, nome FROM categorias order by nome";
        $conexao = Conexao::conectar();
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }

    public function inserir(){
        $query = "insert into categorias (nome) values (:nome)";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->execute();
    }

    public function atualizar(){
        $query = "update categorias set nome=:nome where id=:id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":nome", $this->nome);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
    }

    public function carregar(){
        $query = "SELECT id, nome FROM categorias where id=:id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
        $lista = $stmt->fetch();
        $this->nome = $lista['nome'];
    }

    public function deletar(){
        $query = "delete from categorias where id=:id";
        $conexao = Conexao::conectar();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id", $this->id);
        $stmt->execute();
    }

    public function carregarProdutos(){
        $this->produtos = Produto::listarPorCategoria($this->id);
    }
}
<?php 
require_once 'cabecalho.php';
require_once 'global.php';

try{
    $id = $_GET['id'];
    $categoria = new Categoria($id);
    $categoria->carregarProdutos();
    $listaProdutos = $categoria->produtos;
}catch(Exception $e){
    Erro::trataErro($e);
}

?>

<div class="row">
    <div class="col-md-12">
        <h2>Detalhe da Categoria</h2>
    </div>
</div>

<dl>
    <dt>ID</dt>
    <dd><?=$categoria->id?></dd>
    <dt>Nome</dt>
    <dd><?=$categoria->nome?></dd>
    <dt>Produtos</dt>
    <?php if(count($listaProdutos) > 0):?>
        <dd>
            <?php foreach($listaProdutos as $produto): ?>
            <ul>
                <li><a href="/produtos-editar.php?id=<?=$produto['id']?>"><?=$produto['nome']?></a></li>
            </ul>
            <?php endforeach ?>
        </dd>
    <?php else: ?>
        <p>Não há produtos cadastrados nessa categoria</p>
    <?php endif ?>
</dl>
<?php require_once 'rodape.php' ?>

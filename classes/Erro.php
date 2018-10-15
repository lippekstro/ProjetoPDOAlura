<?php

class Erro{
    public static function trataErro(Exception $e){
        if(DEBUG){
            echo '<pre>';
            print_r($e);
            echo '</pre>';
            exit;
        }else{
            echo $e->getMessage();
            exit;
        }
    }

    public static function exibePre($variavel){
        echo '<pre>';
            print_r($variavel);
        echo '</pre>';
    }
}
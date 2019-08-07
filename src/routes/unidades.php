<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtém as unidades
$app->get('/api/unidades/{empobra}/{quadra}/{lote}', function(Request $request, Response $response, array $args){
    $sql = "SELECT Qtde_unid as AREA, (CASE Vendido_Unid WHEN 0 THEN 'Disponivel' ELSE CASE Vendido_unid WHEN 1 THEN 'Vendido' ELSE CASE Vendido_unid WHEN 4 THEN 'Quitado' ELSE CASE Vendido_unid WHEN 8 THEN 'Fora de venda' END END END END) as STATUS, Identificador_unid as IDENTIFICADOR
    FROM UnidadePer WHERE Empresa_unid = 152 and Obra_unid = 'L152' and C1_unid = '01' and C2_unid = '05'";
   
   try{
        $db = new db();
        $db->Conectar();

        $stmt = $db->query($sql);
        $unidades = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($unidades);
    }catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});
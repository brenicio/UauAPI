<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;


//Rota Padrão
$app->get('/', function(Request $request, Response $response, array $args){
    return 'UAU API';
});

//Obtém as unidades
$app->get('/unidades/{empobra}/{quadra}/{lote}', function(Request $request, Response $response, array $args){

    $empobra = $args['empobra'];
    $quadra = $args['quadra'];
    $lote = $args['lote'];

    $sql = "SELECT Qtde_unid as AREA  ,
    (CASE Vendido_Unid WHEN 0 THEN 'Disponivel' ELSE
        CASE Vendido_unid WHEN 1 THEN 'Vendido' ELSE
            CASE Vendido_unid WHEN 4 THEN 'Quitado' ELSE
                CASE Vendido_unid WHEN 8 THEN 'Fora de venda' END END END END) as STATUS,
    Identificador_unid as IDENTIFICADOR
    FROM UnidadePer
    JOIN fn_ListEmpObr('$empobra', ',') ON 
    Empresa_unid = Empresa AND Obra_unid = Obra
     WHERE C1_unid = '$quadra' and C2_unid = '$lote'";

   
   try{
        $db = new db();
        $db->Conectar();

        $stmt = $db->query($sql);
        $unidades = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

       return $response->withStatus(200)->withJson($unidades);

    }catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});
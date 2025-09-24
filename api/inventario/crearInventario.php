<?php
header('Content-Type: application/json; charset=utf-8');

$archivo = '../inventario.json';

$input = json_decode(file_get_contents('php://input'), true);
if(!is_array($input)){
    echo json_encode(['success'=>false,'error'=>'JSON inválido']);
    exit;
}

$datos_existentes = [];
if(file_exists($archivo) && filesize($archivo) > 0){
    $datos_existentes = json_decode(file_get_contents($archivo), true) ?? [];
}

$datos_existentes[] = $input;

if(file_put_contents($archivo, json_encode($datos_existentes, JSON_PRETTY_PRINT))){
    echo json_encode(['success'=>true, 'data'=>$datos_existentes]);
}else{
    echo json_encode(['success'=>false, 'error'=>'No se pudo guardar']);
}

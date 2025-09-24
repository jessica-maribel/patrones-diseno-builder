<?php
// api/vehiculos/list.php
header('Content-Type: application/json; charset=utf-8');

$archivo = '../inventario.json';
$datos = [];

if(file_exists($archivo) && filesize($archivo) > 0){
    $datos = json_decode(file_get_contents($archivo), true) ?? [];
}

echo json_encode(['success'=>true, 'data'=>$datos]);

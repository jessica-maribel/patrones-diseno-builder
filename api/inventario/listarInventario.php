<?php
// api/vehiculos/list.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../src/Controller/ControllerActivoFijo.php';

$ctrl = new ControllerActivoFijo();
$res = $ctrl->listarActivos();
echo json_encode($res);

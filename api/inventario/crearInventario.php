<?php
// api/vehiculos/create.php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../src/Controller/ControllerActivoFijo.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    echo json_encode(['success' => false, 'error' => 'JSON inválido']);
    exit;
}

$ctrl = new ControllerActivoFijo();
$res = $ctrl->crear($input);
echo json_encode($res);
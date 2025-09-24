<?php

require '/../ActivoFijoBuilder.php';

class ControllerActivoFijo{
    $archivo = 'inventario.json';
    $datos_existentes = [];

    public function __construct(){
        
        if (file_exists($archivo) && filesize($archivo) > 0) {
            $contenido = file_get_contents($archivo);
            $datos_existentes = json_decode($contenido, true) ?? [];
        }
    }

    public function crearActivo(array $data): array{
        $required = ['codigo', 'nombre', 'precio'];
        foreach ($required as $f) {
            if (!isset($data[$f]) || trim((string)$data[$f]) === '') {
                return ['success' => false, 'error' => "Campo requerido: $f"];
            }
        }

        $builder = new ActivoFijoBuilder($data['codigo'], $data['nombre'], (float)$data['precio']);

        if (!empty($data['color'])) {
            $builder->conColor($data['color']);
        }
        if (!empty($data['material'])) {
            $builder->conMaterial($data['material']);
        }
        if (!empty($data['fechaCompra'])) {
            $builder->conVidaUtil($data['fechaCompra']);
        }
        if (!empty($data['vida_util'])) {
            $builder->conVidaUtil($data['vida_util']);
        }
        if (!empty($data['proveedor'])) {
            $builder->conVidaUtil($data['proveedor']);
        }

        $nuevo_producto = $builder->build();

        $datos_existentes[] = $nuevo_producto->toArray();
        file_put_contents($archivo, json_encode($datos_existentes, JSON_PRETTY_PRINT));
        return ['success' => true,'data' => $datos_existentes]
    }

    public function listarActivos(){
        return ['success' => true,'data' => $datos_existentes]
    }

}
<?php
require_once 'ActivoFijoBuilder.php';

class ControllerActivoFijo {
    private string $archivo = 'inventario.json';
    private array $datos_existentes = [];

    public function __construct() {
        if (file_exists($this->archivo) && filesize($this->archivo) > 0) {
            $contenido = file_get_contents($this->archivo);
            $this->datos_existentes = json_decode($contenido, true) ?? [];
        }
    }

    public function crearActivo(array $data): array {
        // Campos obligatorios
        $required = ['codigo', 'nombre', 'precio'];
        foreach ($required as $f) {
            if (!isset($data[$f]) || trim((string)$data[$f]) === '') {
                return ['success' => false, 'error' => "Campo requerido: $f"];
            }
        }

        $builder = new ActivoFijoBuilder($data['codigo'], $data['nombre'], (float)$data['precio']);

        if (!empty($data['color'])) $builder->conColor($data['color']);
        if (!empty($data['material'])) $builder->conMaterial($data['material']);
        if (!empty($data['fechaCompra'])) $builder->conFechaCompra($data['fechaCompra']);
        if (!empty($data['vida_util'])) $builder->conVidaUtil($data['vida_util']);
        if (!empty($data['proveedor'])) $builder->conProveedor($data['proveedor']);

        $nuevo_producto = $builder->build();
        $this->datos_existentes[] = $nuevo_producto->toArray();
        file_put_contents($this->archivo, json_encode($this->datos_existentes, JSON_PRETTY_PRINT));

        return ['success' => true, 'data' => $this->datos_existentes];
    }

    public function listarActivos(): array {
        return ['success' => true, 'data' => $this->datos_existentes];
    }
}

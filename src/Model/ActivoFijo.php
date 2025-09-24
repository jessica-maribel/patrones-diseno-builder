<?php
class ActivoFijo {
    private string $codigo;
    private string $nombre;
    private float $precio;
    private string $color;
    private string $material;
    private string $fechaCompra;
    private string $vidaUtil;
    private string $proveedor;

    public function __construct(string $codigo, string $nombre, float $precio) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    //public function getCodigo(): string { return $this->codigo; }

    //public function setCodigo(string $codigo): void { $this->codigo = $codigo; }

    public function setOptionalValues(?string $color, ?string $material, ?string $fechaCompra, ?string $vidaUtil, ?string $proveedor){
        $this->color = $color;
        $this->material = $material;
        $this->fechaCompra = $fechaCompra;
        $this->vidaUtil = $vidaUtil;
        $this->proveedor = $proveedor;
    }


    public function getDatos(): array
    {
        return [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'color' => $this->color,
            'material' => $this->material,
            'vidaUtil' => $this->vidaUtil
        ];
    }
}
<?php
require 'ActivoFijo.php';

class ActivoFijoBuilder {
    private string $codigo;
    private string $nombre;
    private float $precio;
    private ?string $color = '';
    private ?string $material = '';
    private ?string $fechaCompra = '';
    private ?string $vidaUtil = '';
    private ?string $proveedor = '';

    public function __construct(string $codigo, string $nombre, float $precio) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = floatval($precio);
    }

    public function conColor(string $color): self {
        $this->color = $color;
        return $this;
    }

    public function conMaterial(string $material): self {
        $this->material = $material;
        return $this;
    }

    public function conFechaCompra(string $fechaCompra): self {
        $this->fechaCompra = $fechaCompra;
        return $this;
    }

    public function conVidaUtil(string $vidaUtil): self {
        $this->vidaUtil = $vidaUtil;
        return $this;
    }

    public function conProveedor(string $proveedor): self {
        $this->proveedor = $proveedor;
        return $this;
    }

    public function build(): ActivoFijo {
        $activoFijo = new ActivoFijo($this->codigo, $this->nombre, $this->precio);
        $activoFijo->setOptionalValues($this->color, $this $material, $this $fechaCompra, $this $vidaUtil, $this $proveedor);
        return $activoFijo;
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\ProveedoresModel;
use App\Models\DetalleRolesPermisosModel;

class Productos extends BaseController
{
    protected $productos, $categorias, $proveedores, $session,  $detalleRoles;
    protected $reglas, $reglasEditar;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->categorias = new CategoriasModel();
        $this->proveedores = new ProveedoresModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->session = session();

        helper(['form']);

        $this->reglas =
            [
                'codigo' =>
                [
                    'rules' => 'required|is_unique[producto.codigo]',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'is_unique' => 'El campo {field} debe ser unico.'
                    ]
                ],
                'nombre_producto' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'nombre_generico' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'precio_compra' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero'
                    ]
                ],
                'precio_venta' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero'
                    ]
                ],
                'fecha_vencimiento' =>
                [
                    'rules' => 'required|valid_date',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'valid_date' => 'El campo {field} debe contener una fecha con este formato: YYYY-MM-DD'
                    ]
                ],
                'stock' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero'
                    ]
                ],
                'stock_minimo' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero'
                    ]
                ]

            ];
        $this->reglasEditar =
            [
                'codigo' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'nombre_producto' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'nombre_generico' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'precio_compra' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'precio_venta' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'fecha_vencimiento' =>
                [
                    'rules' => 'required|valid_date',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'valid_date' => 'El campo {field} debe contener una fecha con este formato: YYYY-MM-DD'
                    ]
                ],
                'stock' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero'
                    ]
                ],
                'stock_minimo' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]

            ];
    }

    public function index($activo = 1)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //Da permiso a la vista producto
        $permiso = $this->detalleRoles->verificaPermisos($this->session->id_rol, 'ProductoView');

        if (!$permiso) {
            echo 'No tiene permiso';
            exit;
            //echo '<script type = "text/javascript">toastr.success("No tiene permiso") </script>';            
        }

        $productos = $this->productos->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Productos', 'datos' => $productos];

        echo view('encabezado');
        echo view('productos/productos_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $productos = $this->productos->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Productos eliminados', 'datos' => $productos];

        echo view('encabezado');
        echo view('productos/eliminadas_producto_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $proveedores = $this->proveedores->where('activo', 1)->findAll();
        $data = ['titulo' => 'Nuevo producto', 'categorias' => $categorias, 'proveedores' => $proveedores];

        echo view('encabezado');
        echo view('productos/nuevo_producto_view', $data);
        echo view('pie_pagina');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->productos->save([
                'codigo' => $this->request->getPost('codigo'),
                'nombre_producto' => $this->request->getPost('nombre_producto'),
                'presentacion' => $this->request->getPost('presentacion'),
                'nombre_generico' => $this->request->getPost('nombre_generico'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
                'stock' => $this->request->getPost('stock'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_categoria' => $this->request->getPost('id_categoria'),
                'id_proveedor' => $this->request->getPost('id_proveedor')
            ]);

            $id = $this->productos->insertID();
            /*
            $validacion = $this->validate([
                'img_producto' => [
                    'uploaded[img_producto]',
                    'mime_in[img_producto,image/jpg,image/jpeg]',
                    'max_size[img_producto, 4096]'
                ]
            ]);
            //imagenes 35 kb
            if ($validacion) {
                $ruta_img = "images/productos/" . $id . ".jpg";
                if (file_exists($ruta_img)) {
                    unlink($ruta_img);
                }
                $img = $this->request->getFile('img_producto');
                $img->move('./images/productos', $id . '.jpg');
            } else {
                echo 'ERROR: en la validacion';
                exit;
            }
*/
            return redirect()->to(base_url() . '/productos');
        } else {
            $categorias = $this->categorias->where('activo', 1)->findAll();
            $proveedores = $this->proveedores->where('activo', 1)->findAll();
            $data = ['titulo' => 'Agregar producto', 'categorias' => $categorias, 'proveedores' => $proveedores, 'validation' => $this->validator];

            echo view('encabezado');
            echo view('productos/nuevo_producto_view', $data);
            echo view('pie_pagina');
        }
    }

    public function editar($cod_producto, $valid = null)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $proveedores = $this->proveedores->where('activo', 1)->findAll();
        $producto = $this->productos->where('cod_producto', $cod_producto)->first();

        if ($valid !== null) {
            $data = [
                'titulo' => 'Editar producto',
                'categorias' => $categorias,
                'proveedores' => $proveedores,
                'producto' => $producto,
                'validation' => $valid
            ];
        } else {
            $data = [
                'titulo' => 'Editar producto',
                'categorias' => $categorias,
                'proveedores' => $proveedores,
                'producto' => $producto,
                'validation' => $valid
            ];
        }
        //$data = ['titulo' => 'Editar producto', 'categorias' => $categorias, 'proveedores' => $proveedores, 'producto' => $producto, 'validation' => $this->validator];

        echo view('encabezado');
        echo view('productos/editar_producto_view', $data);
        echo view('pie_pagina');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasEditar)) {

            $this->productos->update(
                $this->request->getPost('cod_producto'),
                [
                    'codigo' => $this->request->getPost('codigo'),
                    'nombre_producto' => $this->request->getPost('nombre_producto'),
                    'presentacion' => $this->request->getPost('presentacion'),
                    'nombre_generico' => $this->request->getPost('nombre_generico'),
                    'precio_compra' => $this->request->getPost('precio_compra'),
                    'precio_venta' => $this->request->getPost('precio_venta'),
                    'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
                    'stock' => $this->request->getPost('stock'),
                    'stock_minimo' => $this->request->getPost('stock_minimo'),
                    'inventariable' => $this->request->getPost('inventariable'),
                    'id_categoria' => $this->request->getPost('id_categoria'),
                    'id_proveedor' => $this->request->getPost('id_proveedor')
                ]
            );


            return redirect()->to(base_url() . '/productos');
        } else {
            return $this->editar(
                $this->request->getPost('cod_producto'),
                $this->validator
            );
        }
    }

    public function borrar($cod_producto)
    {
        $this->productos->update($cod_producto, ['activo' => 0]);
        return redirect()->to(base_url() . '/productos');
    }

    public function reingresar($cod_producto)
    {
        $this->productos->update($cod_producto, ['activo' => 1]);
        return redirect()->to(base_url() . '/productos');
    }

    public function buscarPorCodigo($codigo)
    {
        $this->productos->select('*');
        $this->productos->where('codigo', $codigo);
        $this->productos->where('activo', 1);
        $datos = $this->productos->get()->getRow();

        $res['existe'] = false; //false
        $res['datos'] = ''; //''
        $res['error'] = '';

        if ($datos) {
            $res['datos'] = $datos;
            $res['existe'] = true;
        } else {
            $res['error'] = 'No existe el producto';
            $res['existe'] = false;
        }
        echo json_encode($res); //decode json
    }

    public function autocompleteDataCod()
    {
        $returnDataCod = array();

        $valor = $this->request->getGet('term');

        $productos = $this->productos->like('codigo', $valor)->where('activo', 1)->findAll();
        if (!empty($productos)) {
            foreach ($productos as $row) {
                $data['id'] = $row['cod_producto'];
                $data['value'] = $row['codigo'];
                $data['label'] = $row['codigo'] . ' - ' . $row['nombre_producto'];
                
                array_push($returnDataCod, $data);
            }
        }
        echo json_encode($returnDataCod);
    }
    function muestraCodigos()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        echo view('encabezado');
        echo view('productos/ver_codigos');
        echo view('pie_pagina');
    }

    public function generaBarras()
    {
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle(utf8_decode("Códigos de Barras"));

        $productos = $this->productos->where('activo', 1)->findAll();

        foreach ($productos as $producto) {
            $codigo = $producto['codigo'];
            $generaBarcode = new \barcode_genera();
            $generaBarcode->barcode("images/barcode/" . $codigo . ".png", $codigo, "20", "horizontal", "code128", true);

            $pdf->Image("images/barcode/" . $codigo . ".png");
            //unlink("images/barcode/".$codigo.".png"); //Borra las imagenes en la carpeta especifica
        }

        $pdf->Output('Codigo.pdf', 'I');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }

    function muestraMinimos()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        echo view('encabezado');
        echo view('productos/ver_minimos');
        echo view('pie_pagina');
    }

    public function generaMinimosPdf()
    {
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle(utf8_decode("Productos con Stock Mínimo"));
        $pdf->SetFont("Arial", "B", 14);

        $pdf->Image("images/logotipo.png", 10, 10, 40);
        $pdf->Cell(0, 5, utf8_decode("Reporte de producto con stock mínimo"), 0, 1, 'C');

        $pdf->Ln(10);
        $pdf->SetFont("Arial", "B", 10);

        $pdf->Cell(40, 5, utf8_decode("Código"), 1, 0, 'C');
        $pdf->Cell(75, 5, utf8_decode("Nombre"), 1, 0, 'C');
        $pdf->Cell(40, 5, utf8_decode("Existencias"), 1, 0, 'C');
        $pdf->Cell(40, 5, utf8_decode("Stock Minimo"), 1, 1, 'C');

        $datosProductos = $this->productos->getProductosMinimo();

        $pdf->SetFont("Arial", "", 10);
        foreach ($datosProductos as $producto) {
            $pdf->Cell(40, 5, $producto['codigo'], 1, 0, 'C');
            $pdf->Cell(75, 5, utf8_decode($producto['nombre_producto']), 1, 0, 'C');
            $pdf->Cell(40, 5, $producto['stock'], 1, 0, 'C');
            $pdf->Cell(40, 5, $producto['stock_minimo'], 1, 1, 'C');
        }

        $pdf->Output('StockMinimo.pdf', 'I');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }

    function muestraPorVencer()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        echo view('encabezado');
        echo view('productos/por_vencer');
        echo view('pie_pagina');
    }

    public function generaPorVencerPdf()
    {
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle(utf8_decode("Productos vencidos o por vencer"));
        $pdf->SetFont("Arial", "B", 14);

        $pdf->Image("images/logotipo.png", 10, 10, 40);
        $pdf->Cell(0, 5, utf8_decode("Reporte de producto por vencer o caducos"), 0, 1, 'C');

        $pdf->Ln(10);
        $pdf->SetFont("Arial", "B", 10);

        $pdf->Cell(30, 5, utf8_decode("Código"), 1, 0, 'C');
        $pdf->Cell(80, 5, utf8_decode("Nombre del Producto"), 1, 0, 'C');
        $pdf->Cell(30, 5, utf8_decode("Existencias"), 1, 0, 'C');
        $pdf->Cell(50, 5, utf8_decode("Fecha Vencimiento"), 1, 1, 'C');


        $datosProductos = $this->productos->getProductoVencido();

        $pdf->SetFont("Arial", "", 10);
        foreach ($datosProductos as $producto) {
            $pdf->Cell(30, 5, $producto['codigo'], 1, 0, 'C');
            $pdf->Cell(80, 5, utf8_decode($producto['nombre_producto']), 1, 0, 'C');
            $pdf->Cell(30, 5, $producto['stock'], 1, 0, 'C');
            $pdf->Cell(50, 5, $producto['fecha_vencimiento'], 1, 1, 'C');
        }

        $pdf->Output('ProductosCaducos.pdf', 'I');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}

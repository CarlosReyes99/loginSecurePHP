<!DOCTYPE html>
<html lang="en">
<head>
    <title>Formulario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Registro de Producto
                    </div>
                    <div class="card-body">
                        <form id="formProductos">
                            <div id="insertarMessage"></div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="precio" name="precio" required>
                            </div>
                            <div class="mb-3">
                                <label for="existencia" class="form-label">Existencia</label>
                                <input type="number" class="form-control" id="existencia" name="existencia" required>
                            </div>
                            <div class="mb-3">
                                <label for="ext" class="form-label">Ext</label>
                                <input type="number" class="form-control" id="ext" name="ext" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/insertar_producto.js"></script>
</body>
</html>

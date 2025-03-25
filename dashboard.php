<?php
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== "true") {
        header("Location: index.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pruebas UNACH</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Estilos personalizados -->
    <link href="css/cmce-styles.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script src="js/insertar_producto.js"></script>
    <script src="js/editar_producto.js"></script>
    
    <script>
        $(document).ready(function(){
            // Eliminar producto
            $('.delete-product-btn').on('click', function(){
                const productId = $(this).data('product-id');
                const productName = $(this).data('product-name');
                $('#deleteProductName').text(productName);
                $('#confirmDeleteButton').attr('href', 'controller/eliminar.php?idp=' + productId);
            });
            
            // Editar producto (cargar datos en el modal)
            $('.edit-product-btn').on('click', function(){
                const productId = $(this).data('product-id');
                // Aquí iría tu lógica para cargar los datos del producto
            });
        });
    </script>
</head>
<body class="bg-dark text-light">

    <!-- Navbar reorganizado -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container-fluid">
            <!-- Ícono izquierdo -->
            <div class="d-flex align-items-center ms-3">
                <i class="bi bi-person-circle fs-3 text-primary"></i>
            </div>
            
            <!-- Nombre de usuario centrado -->
            <div class="mx-auto">
                <span class="navbar-brand mb-0 h1 text-light">
                    <?php echo $_SESSION['nomusuario']; ?>
                </span>
                <small class="d-block text-center text-muted"><?php echo $_SESSION['nom_completo']; ?></small>
            </div>
            
            <!-- Botón de cerrar sesión derecha -->
            <div class="me-3">
                <a href="cerrar.php" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid mt-4">
        <!-- Barra de búsqueda -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="dashboard.php" method="GET" class="card bg-dark border-secondary">
                    <div class="card-body">
                        <div class="input-group">
                            <input type="number" 
                                   name="pre" 
                                   class="form-control bg-dark text-light border-secondary" 
                                   placeholder="Filtrar por precio mínimo">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="card bg-dark border-secondary">
            <div class="card-header bg-dark border-secondary d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-box-seam"></i> Inventario de Productos</h5>
                <button type="button" 
                        class="btn btn-success" 
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal">
                    <i class="bi bi-plus-circle"></i> Nuevo Producto
                </button>
            </div>
            
            <div class="card-body">
                <?php
                    include('conexion.php');
                    $con = conectaDB();
                    $sql = "SELECT idPro, Nombre, Precio, Existencia FROM tb_productos";
                    $resultado = mysqli_query($con, $sql);
                ?>
                
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Existencia</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($fila = mysqli_fetch_row($resultado)): ?>
                            <tr>
                                <td><?= htmlspecialchars($fila[1]) ?></td>
                                <td>$<?= number_format($fila[2], 2) ?></td>
                                <td><?= $fila[3] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-product-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal"
                                            data-product-id="<?= $fila[0] ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-product-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-product-id="<?= $fila[0] ?>"
                                            data-product-name="<?= htmlspecialchars($fila[1]) ?>">
                                        <i class="bi bi-trash3"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Producto -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Nuevo Producto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formProductos">
                        <div id="insertarMessage"></div>
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" class="form-control bg-dark text-light border-secondary" name="precio" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Existencia</label>
                            <input type="number" class="form-control bg-dark text-light border-secondary" name="existencia" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="formProductos" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Producto -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Editar Producto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditProductos">
                        <div id="editarMessage"></div>
                        <input type="hidden" id="editProductId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" id="editNombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" class="form-control bg-dark text-light border-secondary" id="editPrecio" name="precio" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Existencia</label>
                            <input type="number" class="form-control bg-dark text-light border-secondary" id="editExistencia" name="existencia" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="formEditProductos" class="btn btn-warning">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Producto -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de eliminar el producto "<span id="deleteProductName" class="text-danger"></span>"?
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar Definitivamente</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
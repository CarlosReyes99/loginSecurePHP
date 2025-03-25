$(document).ready(function(){
    $('.edit-product-btn').click(function(){
        var product_id = $(this).data('product-id');
        $.ajax({
            url: 'controller/obtener_producto.php',
            type: 'POST',
            data: {idp: product_id},
            dataType: 'json',
            success: function(response){
                $('#editNombre').val(response.nombre);
                $('#editPrecio').val(response.precio);
                $('#editExistencia').val(response.existencia);
                $('#formEditProductos').data('product-id', product_id);
            }
        });
    });

    $('#formEditProductos').submit(function(e){
        e.preventDefault();
        var product_id = $('#formEditProductos').data('product-id');
        var nombre = $('#editNombre').val();
        var precio = $('#editPrecio').val();
        var existencia = $('#editExistencia').val();

        $.ajax({
            url: 'controller/actualizar_producto.php',
            type: 'POST',
            data: {idp: product_id, nombre: nombre, precio: precio, existencia: existencia},
            success: function(response){
                $('#editarMessage').html(response);
                // Refresh the table after successful update
                $.ajax({
                    url: 'dashboard.php',
                    type: 'GET',
                    success: function(data){
                        // Find the table and replace its content
                        var newTable = $(data).find('table').html();
                        $('table').html(newTable);
                    }
                });
            }
        });
    });
});

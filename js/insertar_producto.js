$(document).ready(function(){
    $('#formProductos').submit(function(e){
        e.preventDefault();

        var nombre = $('#nombre').val();
        var precio = $('#precio').val();
        var existencia = $('#existencia').val();
        var ext = $('#ext').val();

        if(nombre == '' || precio == '' || existencia == ''){
            var msg_alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                              'Todos los campos son obligatorios</div>';
            $('#insertarMessage').html(msg_alerta);
            return false;
        }

        $.ajax({
            url: 'controller/insertar.php',
            method: 'POST',
            data: {
                nombre: nombre,
                precio: precio,
                existencia: existencia,
                ext: ext
            },
            dataType: 'json',
            success: function(data){
                if(data.success == 1){
                    var msg_alerta = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                      data.message + '</div>';
                    $('#insertarMessage').html(msg_alerta);
                    $('#formProductos')[0].reset(); // Limpiar el formulario
                    reloadProductTable(); // Recargar la tabla de productos
                } else {
                    var msg_alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                      data.message + '</div>';
                    $('#insertarMessage').html(msg_alerta);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var msg_alerta = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                  'Error en la petición: ' + textStatus + ' - ' + errorThrown + '</div>';
                $('#insertarMessage').html(msg_alerta);
            }
        });
    });
});

function reloadProductTable(){
    $.ajax({
        url: 'dashboard.php',
        type: 'GET',
        data: { refresh_table: 1 }, // Opcional: Puedes enviar un parámetro para indicar que solo quieres la tabla
        success: function(data){
            // Buscar la tabla dentro de la respuesta y reemplazar el contenido de la tabla actual
            var nuevaTabla = $(data).find('.table').html(); // Asumiendo que la tabla tiene la clase 'table'
            $('.table').html(nuevaTabla);
        },
        error: function(){
            alert('Error al recargar la tabla de productos.');
        }
    });
}

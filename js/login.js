function showAlert(message, type) {
    const alertDiv = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    $('#loginMessage').html(alertDiv);
}

$(document).ready(function() {
    $('#login').on('click', function() {
        const $btn = $(this);
        const username = $('#loginUsername').val().trim();
        const password = $('#loginPassword').val();

        // Validación
        if (!username || !password) {
            showAlert('Por favor, complete todos los campos', 'warning');
            return;
        }

        // Estado de carga
        $btn.prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm" role="status"></span> Iniciando...');

        $.ajax({
            url: 'controller/validar.php',
            method: 'POST',
            dataType: 'json', // jQuery parseará automáticamente
            data: {
                loginUsername: username,
                loginPassword: password
            },
            timeout: 10000,
            success: function(response) {
                if (response.success === 1) {
                    window.location.href = 'dashboard.php';
                } else {
                    showAlert(response.message || 'Error en credenciales', 'danger');
                }
            },
            error: function(xhr, status, error) {
                const errorMsg = status === 'timeout' 
                    ? 'El servidor no responde' 
                    : 'Error de conexión';
                showAlert(errorMsg, 'danger');
            },
            complete: function() {
                $btn.prop('disabled', false)
                    .html('Iniciar Sesión');
            }
        });
    });
});
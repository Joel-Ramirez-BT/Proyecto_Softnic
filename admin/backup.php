<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Backup de Base de Datos</title>
    <!-- Enlace a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="container text-center">
        <div class="card shadow-lg p-4 border-0 rounded-3">
            <h2 class="mb-4 text-primary">Respaldo de Base de Datos</h2>
            <p class="text-muted">Presiona el botón para generar un backup manual de tu base de datos.</p>
            <form action="export_manual.php" method="post">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-download"></i> Generar Backup
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap Icons y Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

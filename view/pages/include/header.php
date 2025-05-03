<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="?c=<?php echo base64_encode('User') ?>">
                        <img src="https://uls.edu.sv/sitioweb/wp-content/uploads/2024/08/logo-ULS.png" alt="Bootstrap" width="50" height="24">
                        </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="?c=<?php echo base64_encode('UserType'); ?>">Tipos de Usuarios</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="?c=<?php echo base64_encode('User'); ?>&a=<?php echo base64_encode('read'); ?>">Usuarios</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['nombrecompleto']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?c=<?php echo base64_encode('User'); ?>&a=<?php echo base64_encode('profile'); ?>">Perfil</a></li>
                            <li><a class="dropdown-item" href="?c=<?php echo base64_encode('User'); ?>&a=<?php echo base64_encode('changePassword'); ?>">Cambiar contraseña</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?c=<?php echo base64_encode("Login"); ?>" onclick="if (!confirm('¿Realmente desea cerrar sesión?')) { return false; }">Salir</a></li>
                        </ul>
                        </li>
                        
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
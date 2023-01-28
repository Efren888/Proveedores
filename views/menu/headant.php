<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="assets/css/404.css" rel="stylesheet">

</head>

<body>
  <div class="conteiner-fluid bg-primary  p-2 mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pieza
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Piezas</a></li>
                <li>
                  <hr>
                </li>
                <li><a class="dropdown-item" href="index.php?accion=crear&tabla=piezas">Añadir Nueva Pieza</a></li>
                <li><a class="dropdown-item" href="index.php?accion=listar&tabla=piezas">Listar Piezas</a></li>
                <li><a class="dropdown-item" href="index.php?accion=buscar&tabla=piezas">Buscar Piezas</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pedido
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Pedido</a></li>
                <li>
                  <hr>
                </li>
                <li><a class="dropdown-item" href="index.php?accion=crear&tabla=pedido">Añadir Nuevo pedido</a></li>
                <li><a class="dropdown-item" href="index.php?accion=listar&tabla=pedido">Listar pedidos</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Vendedor
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Vendedor</a></li>
                <li>
                  <hr>
                </li>
                <li><a class="dropdown-item" href="index.php?accion=listar&tabla=vendedor">Listar vendedores</a></li>
                <li><a class="dropdown-item" href="index.php?accion=listar2&tabla=vendedor">Listar vendedores2</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div class="conteiner-fluid">
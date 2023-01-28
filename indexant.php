<?php
require_once("views/menu/head.php");

$tablasValidas = ["piezas", "pedido", "vendedor"];

if (isset($_REQUEST["tabla"], $_REQUEST["accion"])) {
    $tabla = $_REQUEST["tabla"];
    if (!in_array($tabla, $tablasValidas)) {
        require_once("views/404.php");
    } else {
        switch ($_REQUEST["accion"]) {
            case "crear":
                require_once("views/$tabla/create.php");
                break;
            case "guardar":
                require_once("views/$tabla/store.php");
                break;
            case "ver":
                require_once("views/$tabla/show.php");
                break;
            case "listar":
                require_once("views/$tabla/list.php");
                break;
            case "listar2":
                require_once("views/$tabla/list2.php");
                break;
    
            case "buscar":
                require_once("views/$tabla/search.php");
                break;
            case "borrar":
                require_once("views/$tabla/delete.php");
                break;
            case "editar":
                require_once("views/$tabla/edit.php");
                break;
            default:
                require_once("views/404.php");
                break;
        }
    }
} else if (substr($_SERVER["REQUEST_URI"], -9) == "index.php") { // Vista Por defecto
?>
    BIENVENIDO A LA APLICACION
<?php
} else require_once("views/404.php");

require_once("views/menu/footer.php");

<?php
try {
    $conexion = new PDO('mysql:host=localhost;port=3306;dbname=chillclass;', 'root', ''); 
} catch (PDOException $e) {
    echo "Fallo la conexión ".$e->getMessage();
}

try {
    $vcodigo = filter_var($_GET['code']);

    $delete = $conexion->prepare("DELETE FROM academia WHERE cod_academia = :codigo");
    $delete->bindParam(':codigo', $vcodigo);
    $delete->execute();

    header("location: academia.php");

} catch (PDOException $e) {
    $error = $e->getCode();

    if ($error == 23000) {
        echo '<script>confirmar=confirm("Esta academia no se puede eliminar");
            if (confirmar)
                window.location.href="./academia.php";</script>';
        echo "<a href='./academia.php'>Volver</a>";
    } else {
        echo 'Error ' . $e->getMessage();
        echo 'Error ' . $e->getCode();
        echo "<a href='InsPais4.php'>Volver</a>";
    }
}
?>

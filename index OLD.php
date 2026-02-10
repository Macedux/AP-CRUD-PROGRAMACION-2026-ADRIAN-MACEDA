<?php
require_once "autoload.php";
session_start();
$gestor = new GestorTropas();
$comitatus = $gestor->listar();

$accion = $_GET['accion'] ?? null;
//OPRECIONES DEL CRUD
if ($accion == "reclutar") {//CREAR 
    $identitas = $_POST['identitas'];
    if ($_POST['legio'] != null) {
        $legio = $_POST['legio'];
        $unidades = $_POST['unidades'];
        $vexila = new Comitatense($identitas, $legio, $unidades);
    } else {
        $frontera = $_POST['frontera'];
        $fortificacion = $_POST['fortificacion'];
        $vexila = new Limitanei($identitas, $frontera, $fortificacion);
    }
    $gestor->alistar($vexila);
    header("Location: index.php");
    // var_dump($_SESSION['comitatus']);
    exit();
    // EDITAR COMITATENSE
}
if ($accion == "editarComitatense") {
    $gestor->actualizarComitatense($_POST["identitas"], $_POST["legio"], $_POST["unidades"]);
    header("Location:index.php");
    exit();
}
// ELIMINAR COMITATENSE Y LIMITANEI
if ($accion === "decimar") {
    $gestor->decimar($_GET['identitas']);
    header("Location: index.php");
    exit();
}
// EDITAR LIMITANEI
if ($accion === "editarLimitanei" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $gestor->actualizarLimitanei(
        $_POST['identitas'],
        $_POST['frontera'],
        $_POST['fortificacion']
    );
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD V2 - EJERCITO ROMANO</title>
</head>

<body>
    <h1> Gestor de tropas </h1>
    <!-- FORMULARIO PARA CREAR SOLDADO-->
    <h2> Entrenar ejercito </h2>
    <form method="POST" action="index.php?accion=reclutar">
        IDENTITAS:
        <input type="number" name="identitas" required><br>
        LEGIO:
        <input type="text" name="legio"><br>
        UNIDADES:
        <input type="number" name="unidades"><br>
        FRONTERA:
        <input type="text" name="frontera"><br>
        FORTIFICACION:
        <input type="text" name="fortificacion"><br>
        <button type="submit"> Entrenar </button>
    </form>

    <h3> COMITATENSES</h3><!-- LISTADO DE COMITATENSES -->
    <p>Los comitatenses eran tropas móviles de élite del Imperio romano tardío.
        Formaban parte del ejército de campaña, acompañaban al emperador o a los generales y se desplazaban
        rápidamente para reforzar fronteras o sofocar invasiones.
        A diferencia de las tropas fronterizas, tenían mejor entrenamiento, equipamiento y paga, y se usaban como
        fuerza principal en batallas decisivas.</p>
    <table border="1" cellpadding="10">
        <tr>
            <th>Identitas</th>
            <th>Legio</th>
            <th>Unidades</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($comitatus as $c): ?>
            <?php if (get_class($c) === "Comitatense"): ?>
                <tr>
                    <td> <?= $c->getIdentitas(); ?></td>
                    <td> <?= $c->getLegio(); ?></td>
                    <td> <?= $c->getUnidades(); ?></td>
                    <td>
                        <!-- boton de editar -->
                        <form method="POST" action="index.php?accion=editarComitatense" style="display:inline;">
                            <input type="hidden" name="identitas" value="<?= $c->getIdentitas(); ?>">
                            Legio:
                            <input type="text" name="legio" value="<?= $c->getLegio(); ?>" required>
                            Unidades:
                            <input type="number" name="unidades" value="<?= $c->getUnidades(); ?>" required>
                            <button type="submit">Actualizar</button>
                        </form>
                        <!-- boton de eliminar -->
                        <a href="index.php?accion=decimar&identitas=<?= $c->getIdentitas() ?>">Decimar</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

    </table>
    <h3> LIMITANEI</h3>
    <p>
        Los limitanei eran tropas estacionarias destinadas a la defensa de las fronteras
        del Imperio romano. Vivían cerca del limes, protegían fortificaciones y controlaban
        el territorio frente a incursiones enemigas.
    </p>

    <table border="1" cellpadding="10">
        <tr>
            <th>Identitas</th>
            <th>Frontera</th>
            <th>Fortificación</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($comitatus as $c): ?>
            <?php if (get_class($c) === "Limitanei"): ?>
                <tr>
                    <td><?= $c->getIdentitas(); ?></td>
                    <td><?= $c->getFrontera(); ?></td>
                    <td><?= $c->getFortificacion(); ?></td>
                    <td>
                        <!-- EDITAR LIMITANEI -->
                        <form method="POST" action="index.php?accion=editarLimitanei" style="display:inline;">
                            <input type="hidden" name="identitas" value="<?= $c->getIdentitas(); ?>">
                            Frontera:
                            <input type="text" name="frontera" value="<?= $c->getFrontera(); ?>" required>
                            Fortificación:
                            <input type="text" name="fortificacion" value="<?= $c->getFortificacion(); ?>" required>
                            <button type="submit">Actualizar</button>
                        </form>
                        <!-- ELIMINAR -->
                        <a href="index.php?accion=decimar&identitas=<?= $c->getIdentitas(); ?>">Decimar</a>


                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

    </table>
</body>

</html>


<?php
?>
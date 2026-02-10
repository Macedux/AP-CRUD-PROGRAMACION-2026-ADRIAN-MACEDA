<?php
function aRomano(int $n): string
{
    if ($n <= 0)
        return (string) $n;

    $map = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
    ];

    $res = '';
    foreach ($map as $valor => $rom) {
        while ($n >= $valor) {
            $res .= $rom;
            $n -= $valor;
        }
    }
    return $res;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD V2 - EJERCITO ROMANO</title>
    <link rel="stylesheet" href="Views/styles.css">
</head>

<body>
    <hr>
    <h3> <a href="index.php?accion=reclutar">REALIZAR ENTRENAMIENTO DOMINE!</a></h3>
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
                    <td><?= aRomano((int)$c->getIdentitas()); ?></td>
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
                    <td><?= aRomano((int)$c->getIdentitas()); ?></td>
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
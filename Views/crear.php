   <link rel="stylesheet" href="Views/styles.css">
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
<a href="index.php">Volver</a>
<!DOCTYPE html>
<html>
<head>
    <title>Crea Tu Personaje</title>
    <script src="./public/js/script.js" defer></script>
</head>
<body>
    <h1>Crea Tu Personaje</h1>

    <form id="createForm" method="POST" action="index.php?accion=crear" enctype="multipart/form-data">
        
        ID:<br>
        <input type="text" name="id" required><br><br>

        Nombre:<br>
        <input type="text" name="nombre" required><br><br>
        
        Nivel:<br>
        <input type="number" name="nivel" min="1" max="20" required><br><br>

        Clase:<br>
        <select name="clase" required>
            <option value="Mago">Mago</option>
            <option value="Guerrero">Guerrero</option>
        </select><br><br>

        Foto:<br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <input type="hidden" name="hechizo" id="selectedSpell">

        <button type="button" onclick="showSpellSelection()">¡Elegir Hechizo y Crear!</button>
    </form>

    <br>
    <a href="index.php">Volver</a>
</body>
</html>
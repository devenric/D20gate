<!DOCTYPE html>
<html>
<head>
    <title>Edita Tu Personaje</title>
</head>
<body>
    <h1>Edita Tu Personaje</h1>

    <form method="POST"> <!-- form -->
        Nombre:<br>
        <input type="text" name="nombre" required><br><br>
        
        Nivel:<br>
        <input type="number" step="1" name="nivel" required><br><br>

        <select name="clase" id="opciones">
            <option value="mago" >Mago</option>
            <option value="helloworld">prueba</option>
        </select>
        <button type="submit">¡Crear!</button>
    </form>

    <br>
    <a href="index.php">Volver</a>
</body>
</html>

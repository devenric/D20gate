<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D20gate</title>
    <style>
        /* (Aquí pegas todo el bloque <style> que te pasé en la respuesta anterior) */
        body { background-color: #121619; color: #e0d1b3; font-family: 'Segoe UI', serif; }
        .grid-aventureros { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .card { background: #1c2126; border: 2px solid #4a3f2d; border-radius: 15px; padding: 20px; text-align: center; }
        /* ... resto del CSS ... */
    </style>
</head>
<body>
   <div class="header-panel">
        <h1>⚜ REGISTRO DE AVENTUREROS</h1>
    </div>

    <div class="form-container">
        <form method="POST" action="index.php">
            <input type="text" name="id" placeholder="ID Manual" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="number" name="nivel" placeholder="Nivel" required>
            <button type="submit" name="crear">[ + INSCRIBIR ]</button>
        </form>
    </div>

    <div class="grid-aventureros">
        <?php foreach ($personajes as $m): ?>
            <div class="card">
                <img src="https://api.dicebear.com/7.x/adventurer/svg?seed=<?= $m->getNombre() ?>" width="80">
                <h2><?= $m->getNombre() ?></h2>
                <span class="nivel-badge">Nivel <?= $m->getNivel() ?>
                <div class="hechizo-box">✨ <?= $m->getHechizo() ?></div>
                <a href="index.php?borrar=<?= $m->getId() ?>" class="delete-btn">✖ Eliminar</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
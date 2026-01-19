<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D20gate</title>
</head>
<body>
    <h1>Tus Personajes</h1>
    <a href="index.php?accion=crear">[+ Nuevo Personaje]</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID:</th>
            <th>Nombre</th>
            <th>Nivel</th>
        </tr>
        <?php foreach ($personajes as $p):?>
            <tr>
                <td><?= $p->getId()?></td>
                <td><?= $p->getNombre()?></td>
                <td><?= $p->getNivel()?></td>
            <td>
                <a href="index.php?accion=editar&id=<?= $p->getId() ?>">Editar</a>
                
                <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>">Eliminar</a>
            </td>    
            </tr>
            <?php endforeach;?>
    </table>
</body>
</html>
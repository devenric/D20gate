<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D20gate - Registro de Aventureros</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/listar.css">
    <script src="public/js/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="header-panel">
            <h1>⚜ REGISTRO DE AVENTUREROS ⚜</h1>
            <p>Gremio de Héroes del Reino</p>
        </div>

        <div class="form-container">
            <h2>📜 Inscribir Nuevo Aventurero</h2>
            <form method="POST" action="index.php?accion=crear" enctype="multipart/form-data" id="createForm">
                <input type="text" name="id" placeholder="ID del Aventurero" required>
                <input type="text" name="nombre" placeholder="Nombre del Héroe" required>
                <input type="number" name="nivel" placeholder="Nivel (1-20)" min="1" max="20" required>
                <select name="clase" required>
                    <option value="">-- Seleccionar Clase --</option>
                    <option value="Mago" selected>🔮 Mago</option>
                    <option value="Guerrero">⚔️ Guerrero</option>
                    <option value="Clerigo">✨ Clérigo</option>
                    <option value="Picaro">🗡️ Pícaro</option>
                    <option value="Barbaro">🪓 Bárbaro</option>
                </select>
                <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" title="Foto del personaje (opcional)">
                <input type="hidden" name="hechizo" id="selectedSpell">
                <button type="button" onclick="showSpellSelection()">INSCRIBIR</button>
            </form>
        </div>

        <div class="spell-modal" id="spellModal">
            <div class="spell-container">
                <h2>✨ ELIGE TU HECHIZO ✨</h2>
                <p class="spell-subtitle">El destino te presenta tres hechizos místicos</p>
                
                <div class="spell-slots">
                    <div class="spell-slot" id="slot1" onclick="selectSpell(0)">
                        <div class="spell-icon">🔮</div>
                        <div class="spell-name" id="name1">???</div>
                        <div class="spell-description" id="desc1">Girando...</div>
                        <button class="spell-select-btn" style="display:none;" id="btn1">Seleccionar</button>
                    </div>
                    <div class="spell-slot" id="slot2" onclick="selectSpell(1)">
                        <div class="spell-icon">✨</div>
                        <div class="spell-name" id="name2">???</div>
                        <div class="spell-description" id="desc2">Girando...</div>
                        <button class="spell-select-btn" style="display:none;" id="btn2">Seleccionar</button>
                    </div>
                    <div class="spell-slot" id="slot3" onclick="selectSpell(2)">
                        <div class="spell-icon">⚡</div>
                        <div class="spell-name" id="name3">???</div>
                        <div class="spell-description" id="desc3">Girando...</div>
                        <button class="spell-select-btn" style="display:none;" id="btn3">Seleccionar</button>
                    </div>
                </div>

                <div class="spell-confirm">
                    <button onclick="confirmSpell()" disabled id="confirmBtn">⚔ CONFIRMAR HECHIZO ⚔</button>
                </div>
            </div>
        </div>

        <?php if (empty($personajes)): ?>
            <div class="empty-state">
                <h3>No hay aventureros registrados</h3>
                <p>El gremio aguarda a sus primeros héroes...</p>
            </div>
        <?php else: ?>
            <div class="grid-aventureros">
                <?php foreach ($personajes as $m): ?>
                    <div class="card">
                        <?php 
                        $fotoUrl = (method_exists($m, 'getFoto') && $m->getFoto()) 
    ? 'uploads/personajes/' . htmlspecialchars($m->getFoto()) . '?t=' . time()
    : 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . urlencode($m->getNombre());
                        ?>
                        <img src="<?= $fotoUrl ?>" 
                             alt="Avatar de <?= htmlspecialchars($m->getNombre()) ?>"
                             onerror="this.src='https://api.dicebear.com/7.x/adventurer/svg?seed=<?= urlencode($m->getNombre()) ?>'">
                        
                        <div class="card-info">
                            <h2><?= htmlspecialchars($m->getNombre()) ?></h2>
                            
                            <p class="clase-badge"><?= htmlspecialchars($m->getClase()) ?></p>
                            
                            <span class="nivel-badge">⚔ Nivel <?= htmlspecialchars($m->getNivel()) ?></span>
                            
                            <?php if (method_exists($m, 'getHechizo') && $m->getHechizo()): ?>
                                <div class="hechizo-box">
                                    ✨ <?= htmlspecialchars($m->getHechizo()) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="item-actions">
                            <a href="index.php?accion=editar&id=<?= urlencode($m->getId()) ?>" class="edit-btn">EDITAR</a>
                            <a href="index.php?accion=eliminar&id=<?= urlencode($m->getId()) ?>" 
                               class="delete-btn"
                               onclick="return confirm('¿Estás seguro?')">
                                ELIMINAR
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div> 
</body>
</html>
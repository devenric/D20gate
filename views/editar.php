<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D20gate - Editar Aventurero</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/modificar.css">
    <script src="public/js/script.js" defer></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="edit-container">
            <header class="form-header">
                <h1>⚔️ EDITAR AVENTURERO</h1>
                <p class="subtitle">Modifica las características de tu héroe</p>
            </header>

            <?php if ($personaje): ?>
                <div class="character-preview">
                    <div class="preview-avatar">
                        <?php 
                        $fotoRuta = (method_exists($personaje, 'getFoto') && $personaje->getFoto()) 
                            ? 'uploads/personajes/' . htmlspecialchars($personaje->getFoto()) . '?t=' . time()
                            : 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . urlencode($personaje->getNombre());
                        ?>
                        <img src="<?= $fotoRuta ?>" alt="Avatar">
                    </div>
                    <div class="preview-info">
                        <span class="name"><?= htmlspecialchars($personaje->getNombre()) ?></span>
                        <span class="badge">Nivel <?= htmlspecialchars($personaje->getNivel()) ?></span>
                    </div>
                </div>

                <form method="POST" action="index.php?accion=editar&id=<?= $personaje->getId(); ?>" enctype="multipart/form-data" id="editForm">
                    <input type="hidden" name="foto_actual" value="<?= htmlspecialchars($personaje->getFoto() ?? '') ?>">
                    <input type="hidden" name="hechizo" id="selectedSpell" value="<?= htmlspecialchars($personaje->getHechizo() ?? '') ?>">
                    <input type="hidden" name="previousPhoto" id="previousPhoto" value="<?= htmlspecialchars($personaje->getFoto() ?? '') ?>">

                    <div class="form-grid">
                        <div class="form-column">
                            <div class="form-group">
                                <label for="nombre">📜 Nombre del Héroe</label>
                                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($personaje->getNombre()) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nivel">⚡ Nivel de Poder</label>
                                <input type="number" id="nivel" name="nivel" min="1" max="20" value="<?= htmlspecialchars($personaje->getNivel()) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="clase">🎭 Clase de Alma</label>
                                <select name="clase" id="clase" required>
                                    <option value="Mago" <?= ($personaje->getClase() == 'Mago') ? 'selected' : '' ?>>🔮 Mago</option>
                                    <option value="Guerrero" <?= ($personaje->getClase() == 'Guerrero') ? 'selected' : '' ?>>⚔️ Guerrero</option>
                                    <option value="Clerigo" <?= ($personaje->getClase() == 'Clerigo') ? 'selected' : '' ?>>✨ Clérigo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-column">
                            <div class="form-group spell-section">
                                <label>✨ Hechizo Vinculado</label>
                                <div class="current-spell-box" id="currentSpellDisplay">
                                    <?= htmlspecialchars($personaje->getHechizo() ?? 'Sin hechizo') ?>
                                </div>
                                <button type="button" class="btn-magic" onclick="showSpellSelection('editForm')">CAMBIAR HECHIZO</button>
                            </div>

                            <div class="form-group">
                                <label for="foto">📸 Retrato Nuevo</label>
                                <input type="file" id="foto" name="foto" accept="image/*" onchange="clearPhotoSelection()">
                            </div>
                        </div>
                    </div>

                    <div class="photo-section">
                        <label>🖼️ Galería de Retratos Guardados</label>
                        <div class="photo-gallery">
                            <?php
                            $uploadDir = 'uploads/personajes/';
                            if (is_dir($uploadDir)) {
                                $photos = array_diff(scandir($uploadDir), array('.', '..'));
                                foreach ($photos as $photo) {
                                    $selectedClass = ($photo === $personaje->getFoto()) ? 'selected' : '';
                                    echo '<div class="photo-option ' . $selectedClass . '" onclick="selectPreviousPhoto(event, \'' . htmlspecialchars($photo) . '\')">'; 
                                    echo '<img src="' . $uploadDir . $photo . '" alt="Anterior">';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="button-group">
                        <a href="index.php" class="btn-cancel">CANCELAR</a>
                        <button type="submit" class="btn-success">GUARDAR CAMBIOS</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="spell-modal" id="spellModal">
        <div class="modal-content">
            <h2 class="modal-title">✨ LA RULETA ARCANNA ✨</h2>
            <div class="spell-slots">
                <div class="spell-slot" id="slot1" onclick="selectSpell(0)">
                    <div class="spell-icon">🔮</div>
                    <div class="spell-name" id="name1">???</div>
                    <div class="spell-description" id="desc1">Invocando...</div>
                </div>
                <div class="spell-slot" id="slot2" onclick="selectSpell(1)">
                    <div class="spell-icon">✨</div>
                    <div class="spell-name" id="name2">???</div>
                    <div class="spell-description" id="desc2">Invocando...</div>
                </div>
                <div class="spell-slot" id="slot3" onclick="selectSpell(2)">
                    <div class="spell-icon">⚡</div>
                    <div class="spell-name" id="name3">???</div>
                    <div class="spell-description" id="desc3">Invocando...</div>
                </div>
            </div>
            <button type="button" class="btn-confirm" id="confirmBtn" onclick="confirmSpell()" disabled>VINCULAR HECHIZO</button>
        </div>
    </div>
</body>
</html>
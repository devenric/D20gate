<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D20gate - Editar Aventurero</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #8b0000;
            --primary-dark: #5a0000;
            --primary-light: #b30000;
            --secondary: #d4af37;
            --secondary-dark: #a88b2f;
            --accent: #2c1810;
            --bg-dark: #1a1410;
            --bg-medium: #2a2015;
            --bg-light: #3a3025;
            --text-light: #f5e6d3;
            --text-muted: #c4b5a0;
            --border-gold: #d4af37;
            --success: #4a7c59;
            --danger: #8b0000;
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.5);
            --shadow-glow: 0 0 20px rgba(212, 175, 55, 0.3);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cinzel', 'Georgia', serif;
            background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-medium) 100%);
            color: var(--text-light);
            min-height: 100vh;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.03) 2px,
                rgba(0, 0, 0, 0.03) 4px
            );
            pointer-events: none;
            z-index: 0;
        }

        .edit-container {
            max-width: 600px;
            width: 100%;
            background: linear-gradient(135deg, var(--bg-medium) 0%, var(--bg-light) 100%);
            border: 3px solid var(--border-gold);
            border-radius: 16px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 1;
            animation: fadeIn 0.5s ease-out;
        }

        .edit-container::before {
            content: '⚔️';
            position: absolute;
            top: -40px;
            right: -40px;
            font-size: 10rem;
            opacity: 0.05;
            transform: rotate(-15deg);
        }

        h1 {
            color: var(--secondary);
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            letter-spacing: 0.1em;
        }

        .subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 1rem;
            font-style: italic;
            margin-bottom: 2rem;
            letter-spacing: 0.05em;
        }

        .character-preview {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(212, 175, 55, 0.1);
            border: 2px solid var(--secondary-dark);
            border-radius: 12px;
        }

        .character-preview img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid var(--secondary);
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            background: var(--bg-dark);
            padding: 5px;
        }

        .character-preview .name {
            color: var(--secondary);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .character-preview .current-info {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: 0.05em;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--bg-dark);
            border: 2px solid var(--secondary-dark);
            border-radius: 6px;
            color: var(--text-light);
            font-family: 'Trebuchet MS', sans-serif;
            font-size: 1rem;
            transition: var(--transition);
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        select {
            cursor: pointer;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        button,
        .btn-back {
            flex: 1;
            padding: 0.75rem 2rem;
            border: 2px solid;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.05em;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        button[type="submit"] {
            background: linear-gradient(180deg, var(--success) 0%, #3a5c47 100%);
            color: var(--text-light);
            border-color: #5a8c69;
        }

        button[type="submit"]::before {
            content: '✓ ';
        }

        button[type="submit"]:hover {
            background: linear-gradient(180deg, #5a8c69 0%, var(--success) 100%);
            box-shadow: 0 0 15px rgba(74, 124, 89, 0.4);
            transform: translateY(-2px);
        }

        .btn-back {
            background: linear-gradient(180deg, var(--bg-light) 0%, var(--bg-medium) 100%);
            color: var(--text-light);
            border-color: var(--secondary-dark);
        }

        .btn-back::before {
            content: '← ';
        }

        .btn-back:hover {
            border-color: var(--secondary);
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .edit-container {
                padding: 2rem 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h1>⚔️ EDITAR AVENTURERO</h1>
        <p class="subtitle">Modifica las características de tu héroe</p>

        <?php if ($personaje): ?>
            <div class="character-preview">
                <img src="https://api.dicebear.com/7.x/adventurer/svg?seed=<?= urlencode($personaje->getNombre()) ?>" 
                     alt="Avatar de <?= htmlspecialchars($personaje->getNombre()) ?>">
                <div class="name"><?= htmlspecialchars($personaje->getNombre()) ?></div>
                <div class="current-info">
                    Nivel actual: <?= htmlspecialchars($personaje->getNivel()) ?>
                </div>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nombre">📜 Nombre del Héroe</label>
                <input type="text" 
                       id="nombre" 
                       name="nombre" 
                       value="<?= htmlspecialchars($personaje->getNombre() ?? '') ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="nivel">⚡ Nivel</label>
                <input type="number" 
                       id="nivel" 
                       name="nivel" 
                       min="1" 
                       max="20" 
                       value="<?= htmlspecialchars($personaje->getNivel() ?? 1) ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="clase">🎭 Clase</label>
                <select name="clase" id="clase" required>
                    <option value="Mago">🔮 Mago</option>
                    <option value="Guerrero">⚔️ Guerrero</option>
                    <option value="Clerigo">✨ Clérigo</option>
                    <option value="Picaro">🗡️ Pícaro</option>
                    <option value="Barbaro">🪓 Bárbaro</option>
                </select>
            </div>

            <div class="button-group">
                <a href="index.php" class="btn-back">CANCELAR</a>
                <button type="submit">GUARDAR CAMBIOS</button>
            </div>
        </form>
    </div>
</body>
</html>
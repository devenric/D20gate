<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D20gate - Registro de Aventureros</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===================================
           D20GATE - ESTILOS ÉPICOS D&D
           =================================== */

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
            position: relative;
        }

        /* Textura de pergamino */
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

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Header */
        .header-panel {
            background: linear-gradient(180deg, var(--accent) 0%, var(--bg-medium) 100%);
            border-bottom: 3px solid var(--border-gold);
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            position: relative;
        }

        .header-panel::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--secondary) 50%, transparent 100%);
        }

        .header-panel h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            color: var(--secondary);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8), 0 0 20px rgba(212, 175, 55, 0.4);
            letter-spacing: 0.1em;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-panel p {
            color: var(--text-muted);
            font-size: 1.1rem;
            font-style: italic;
            letter-spacing: 0.05em;
        }

        /* Formulario */
        .form-container {
            background: linear-gradient(135deg, var(--bg-medium) 0%, var(--bg-light) 100%);
            border: 2px solid var(--border-gold);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: var(--shadow-lg);
        }

        .form-container h2 {
            color: var(--secondary);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
            letter-spacing: 0.05em;
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
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

        input::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        button[type="submit"] {
            padding: 0.75rem 2rem;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            border: 2px solid var(--secondary);
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.05em;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        button[type="submit"]::before {
            content: '⚔';
            margin-right: 0.5rem;
        }

        button[type="submit"]:hover {
            background: linear-gradient(180deg, var(--primary-light) 0%, var(--primary) 100%);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Grid de aventureros */
        .grid-aventureros {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background: linear-gradient(135deg, var(--bg-medium) 0%, var(--bg-light) 100%);
            border: 2px solid var(--secondary-dark);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .card::before {
            content: '🎲';
            position: absolute;
            top: -30px;
            right: -30px;
            font-size: 6rem;
            opacity: 0.08;
            transform: rotate(-15deg);
        }

        .card:hover {
            border-color: var(--secondary);
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-glow);
        }

        .card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid var(--secondary);
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            background: var(--bg-dark);
            padding: 5px;
        }

        .card h2 {
            color: var(--secondary);
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            letter-spacing: 0.05em;
        }

        .nivel-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 2px solid var(--secondary);
            margin: 0.5rem 0;
            letter-spacing: 0.05em;
        }

        .hechizo-box {
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid var(--secondary-dark);
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
            color: var(--text-light);
            font-style: italic;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .delete-btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.6rem 1.5rem;
            background: linear-gradient(180deg, var(--danger) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 6px;
            border: 2px solid #a00000;
            font-weight: 600;
            letter-spacing: 0.05em;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .delete-btn::before {
            content: '✖';
            margin-right: 0.5rem;
        }

        .delete-btn:hover {
            background: linear-gradient(180deg, #a00000 0%, var(--danger) 100%);
            box-shadow: 0 0 15px rgba(139, 0, 0, 0.4);
            transform: scale(1.05);
        }

        /* Mensaje cuando no hay personajes */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-state::before {
            content: '🎲';
            font-size: 4rem;
            display: block;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--secondary);
        }

        /* Animaciones */
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

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header-panel {
                padding: 2rem 1rem;
            }

            .header-panel h1 {
                font-size: 1.8rem;
            }

            form {
                grid-template-columns: 1fr;
            }

            .grid-aventureros {
                grid-template-columns: 1fr;
            }
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-dark);
            border-radius: 6px;
            border: 2px solid var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-panel">
            <h1>⚜ REGISTRO DE AVENTUREROS ⚜</h1>
            <p>Gremio de Héroes del Reino</p>
        </div>

        <div class="form-container">
            <h2>📜 Inscribir Nuevo Aventurero</h2>
            <form method="POST" action="index.php?accion=crear">
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
                <button type="submit">INSCRIBIR</button>
            </form>
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
                        <img src="https://api.dicebear.com/7.x/adventurer/svg?seed=<?= urlencode($m->getNombre()) ?>" 
                             alt="Avatar de <?= htmlspecialchars($m->getNombre()) ?>">
                        <h2><?= htmlspecialchars($m->getNombre()) ?></h2>
                        <span class="nivel-badge">⚔ Nivel <?= htmlspecialchars($m->getNivel()) ?></span>
                        <div class="hechizo-box">
                            ✨ <?= htmlspecialchars($m->getHechizo()) ?>
                        </div>
                        <a href="index.php?accion=eliminar&id=<?= urlencode($m->getId()) ?>" 
                           class="delete-btn"
                           onclick="return confirm('¿Estás seguro de expulsar a <?= htmlspecialchars($m->getNombre()) ?> del gremio?')">
                            ELIMINAR
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
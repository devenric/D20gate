/**
 * D20GATE - Script de Gestión de Aventureros
 * Versión Corregida: "Foto y Ruleta Fixed"
 */

const allSpells = [
    { name: "Bola de Fuego", desc: "Lanza una esfera ardiente", icon: "🔥" },
    { name: "Rayo Congelante", desc: "Congela a tus enemigos", icon: "❄️" },
    { name: "Escudo Arcano", desc: "Protección mágica suprema", icon: "🛡️" },
    { name: "Tormenta Eléctrica", desc: "Rayos devastadores", icon: "⚡" },
    { name: "Curación Divina", desc: "Restaura la vitalidad", icon: "✨" },
    { name: "Invocación Oscura", desc: "Convoca criaturas sombrías", icon: "👻" },
    { name: "Telequinesis", desc: "Mueve objetos con la mente", icon: "🌀" },
    { name: "Invisibilidad", desc: "Desaparece de la vista", icon: "👁️" },
    { name: "Meteoro", desc: "Rocas ardientes del cielo", icon: "☄️" },
    { name: "Teletransporte", desc: "Viaja instantáneamente", icon: "🌟" },
    { name: "Resurrección", desc: "Devuelve la vida", icon: "💫" },
    { name: "Transformación", desc: "Cambia tu forma", icon: "🦅" },
    { name: "Veneno Mortal", desc: "Toxinas letales", icon: "☠️" },
    { name: "Terremoto", desc: "Sacude la tierra", icon: "🌋" },
    { name: "Ventisca", desc: "Nieve y hielo mortífero", icon: "🌨️" }
];

let selectedSpells = [];
let selectedIndex = -1;

// --- GESTIÓN DEL MODAL DE HECHIZOS ---

/**
 * Muestra la ruleta de hechizos.
 * El botón 'INSCRIBIR' debe ser type="button" para que esta función lo controle.
 */
function showSpellSelection(formId = null) {
    // Si no le pasamos ID, intentamos buscar el de crear o el de editar
    const form = formId ? document.getElementById(formId) : (document.getElementById('createForm') || document.getElementById('editForm'));
    const modal = document.getElementById('spellModal');

    if (!form || !modal) {
        console.error("No se encuentra el formulario (" + formId + ") o el modal en el HTML");
        alert("Error místico: No se halló el pergamino de inscripción.");
        return;
    }

    // Guardamos el ID del formulario actual en una variable global para el confirmSpell
    window.currentFormTarget = form.id;

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    modal.classList.add('active');
    modal.style.display = 'flex';
    
    // Iniciar ruleta...
    const shuffled = [...allSpells].sort(() => Math.random() - 0.5);
    selectedSpells = shuffled.slice(0, 3);
    selectedSpells.forEach((spell, index) => spinSlot(index, spell));
}

function spinSlot(index, finalSpell) {
    const slotId = `slot${index + 1}`;
    const nameId = `name${index + 1}`;
    const descId = `desc${index + 1}`;
    const slot = document.getElementById(slotId);
    
    if(!slot) return;

    slot.classList.add('spinning');
    
    let iterations = 0;
    const maxIterations = 15 + (index * 5);
    
    const interval = setInterval(() => {
        const randomSpell = allSpells[Math.floor(Math.random() * allSpells.length)];
        document.getElementById(nameId).textContent = randomSpell.name;
        document.getElementById(descId).textContent = randomSpell.desc;
        slot.querySelector('.spell-icon').textContent = randomSpell.icon;
        
        iterations++;
        
        if (iterations >= maxIterations) {
            clearInterval(interval);
            // Fijar el hechizo real obtenido
            document.getElementById(nameId).textContent = finalSpell.name;
            document.getElementById(descId).textContent = finalSpell.desc;
            slot.querySelector('.spell-icon').textContent = finalSpell.icon;
            slot.classList.remove('spinning');
        }
    }, 100);
}

function selectSpell(index) {
    // Limpiar clases de selección en los otros slots
    for (let i = 1; i <= 3; i++) {
        const s = document.getElementById(`slot${i}`);
        if(s) s.classList.remove('selected');
    }
    
    // Marcar el actual
    const currentSlot = document.getElementById(`slot${index + 1}`);
    if(currentSlot) currentSlot.classList.add('selected');
    
    selectedIndex = index;
    
    // Habilitar botón de confirmación
    const confirmBtn = document.getElementById('confirmBtn');
    if (confirmBtn) confirmBtn.disabled = false;
}

function confirmSpell() {
    if (selectedIndex !== -1) {
        const spellName = selectedSpells[selectedIndex].name;
        
        // 1. Guardar en el input hidden
        const hiddenInput = document.getElementById('selectedSpell');
        if (hiddenInput) {
            hiddenInput.value = spellName;
        }

        // 2. Actualizar el texto que ve el usuario
        const display = document.getElementById('currentSpellDisplay');
        if (display) {
            display.textContent = spellName;
        }

        // 3. CERRAR EL MODAL (Esto es lo que te falta)
        const modal = document.getElementById('spellModal');
        if (modal) {
            modal.classList.remove('active');
            modal.style.display = 'none'; // Aseguramos el cierre visual
            document.body.style.overflow = 'auto'; // Devolvemos el scroll a la página
        }

        // 4. Lógica de salida
        const editForm = document.getElementById('editForm');
        const createForm = document.getElementById('createForm');

        if (createForm) {
            // En la lista: enviar ahora mismo
            createForm.submit();
        } else if (editForm) {
            // En edición: solo avisamos, el usuario debe dar a "GUARDAR CAMBIOS"
            console.log("Hechizo listo. Ahora pulsa el botón verde para terminar.");
            // Opcional: puedes hacer que se envíe solo si quieres
            // editForm.submit(); 
        }
    }
}

// --- GESTIÓN DE FOTOS Y GALERÍA (EDICIÓN) ---

function selectPreviousPhoto(event, photoName) {
    const prevInput = document.getElementById('previousPhoto');
    if (prevInput) prevInput.value = photoName;
    
    // Limpiar input de archivo local para que no haya conflicto
    const fileInput = document.getElementById('foto');
    if (fileInput) fileInput.value = "";
    
    // Feedback visual
    const options = document.querySelectorAll('.photo-option');
    options.forEach(opt => opt.classList.remove('selected'));
    
    event.currentTarget.classList.add('selected');

    // Actualizar preview en tiempo real si existe la imagen
    const previewImg = document.querySelector('.character-preview img');
    if (previewImg) {
        previewImg.src = 'uploads/personajes/' + photoName;
    }
}

// --- Cierre de seguridad con tecla ESC ---
document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        const modal = document.getElementById('spellModal');
        if (modal && modal.classList.contains('active')) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
});
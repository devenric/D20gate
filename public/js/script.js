/**
 * D20GATE - Script de Gestión de Aventureros
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

function showSpellSelection() {
    const form = document.getElementById('editForm') || document.getElementById('createForm');
    
    if (!form) {
        console.error("No se encontró el formulario");
        return;
    }

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Mezclar y elegir 3
    const shuffled = [...allSpells].sort(() => Math.random() - 0.5);
    selectedSpells = shuffled.slice(0, 3);
    
    const modal = document.getElementById('spellModal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Bloquea scroll fondo
        selectedSpells.forEach((spell, index) => {
            spinSlot(index, spell);
        });
    }
}

function spinSlot(index, finalSpell) {
    const slotId = `slot${index + 1}`;
    const nameId = `name${index + 1}`;
    const descId = `desc${index + 1}`;
    const slot = document.getElementById(slotId);
    
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
            document.getElementById(nameId).textContent = finalSpell.name;
            document.getElementById(descId).textContent = finalSpell.desc;
            slot.querySelector('.spell-icon').textContent = finalSpell.icon;
            slot.classList.remove('spinning');
        }
    }, 100);
}

function selectSpell(index) {
    for (let i = 0; i < 3; i++) {
        document.getElementById(`slot${i + 1}`).classList.remove('selected');
    }
    document.getElementById(`slot${index + 1}`).classList.add('selected');
    selectedIndex = index;
    document.getElementById('confirmBtn').disabled = false;
}

function confirmSpell() {
    if (selectedIndex === -1) return;
    
    const selectedSpell = selectedSpells[selectedIndex];
    document.getElementById('selectedSpell').value = selectedSpell.name;
    
    // Cerrar y restaurar scroll
    document.getElementById('spellModal').classList.remove('active');
    document.body.style.overflow = 'auto';
    
    submitForm(); // Envía después de elegir
}

// --- GESTIÓN DE FOTOS Y GALERÍA ---

function selectPreviousPhoto(event, photoName) {
    // 1. Guardar en el hidden
    const prevInput = document.getElementById('previousPhoto');
    if (prevInput) prevInput.value = photoName;
    
    // 2. Limpiar input file
    const fileInput = document.getElementById('foto');
    if (fileInput) fileInput.value = "";
    
    // 3. Estética de la galería
    const options = document.querySelectorAll('.photo-option');
    options.forEach(opt => {
        opt.style.border = "2px solid #3d3428";
        opt.style.boxShadow = "none";
        opt.classList.remove('selected');
    });
    
    const selectedElement = event.currentTarget;
    selectedElement.style.border = "3px solid #d4af37";
    selectedElement.style.boxShadow = "0 0 15px rgba(212, 175, 55, 0.6)";
    selectedElement.classList.add('selected');

    // 4. Actualizar Preview Avatar
    const avatarImg = document.querySelector('.preview-avatar img');
    if (avatarImg) {
        avatarImg.src = 'uploads/personajes/' + photoName;
    }
}

function clearPhotoSelection() {
    document.getElementById('previousPhoto').value = "";
    const options = document.querySelectorAll('.photo-option');
    options.forEach(opt => {
        opt.style.border = "2px solid #3d3428";
        opt.style.boxShadow = "none";
        opt.classList.remove('selected');
    });
}

// --- ENVÍO FINAL ---

function submitForm() {
    const form = document.getElementById('editForm') || document.getElementById('createForm');
    
    if (!form) return;

    if (form.checkValidity()) {
        form.submit();
    } else {
        form.reportValidity();
    }
}

// Cerrar modal con la tecla ESC
document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        const modal = document.getElementById('spellModal');
        if (modal && modal.classList.contains('active')) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
});
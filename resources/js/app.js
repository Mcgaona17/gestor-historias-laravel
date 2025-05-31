import './bootstrap';

document.querySelectorAll('.story-card').forEach(card => {
    card.addEventListener('dragstart', dragStart);
});

document.querySelectorAll('.kanban-column').forEach(column => {
    column.addEventListener('dragover', dragOver);
    column.addEventListener('drop', drop);
});

function dragStart(e) {
    e.dataTransfer.setData('text/plain', e.target.dataset.id);
}

async function drop(e) {
    const storyId = e.dataTransfer.getData('text/plain');
    const newEstado = e.target.closest('.kanban-column').id;
    
    try {
        await axios.patch(`/api/historias/${storyId}`, {
            estado: newEstado
        });
        // Actualizar UI
    } catch (error) {
        console.error('Error:', error);
    }
}
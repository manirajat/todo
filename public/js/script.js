
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, newStatus) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    if (!data) return;

    var el = document.getElementById(data);
    if (!el) return;

    // Find the correct column content container
    var targetCol = ev.target.closest('.kanban-column').querySelector('.kanban-tasks');
    targetCol.appendChild(el);

    // Extract ID (format: task-1)
    var taskId = data.split('-')[1];

    // Get CSRF Token
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    // Send AJAX request to update status
    fetch(`/tasks/${taskId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: newStatus })
    }).then(response => {
        if (response.ok) {
            console.log("Status updated successfully");
        } else {
            console.error("Failed to update status");
        }
    }).catch(error => {
        console.error("Error updating status:", error);
    });
}

function openTaskModal(status) {
    const statusInput = document.getElementById('taskStatusInput');
    if (statusInput) statusInput.value = status;
    const modal = document.getElementById('newTaskModal');
    if (modal) modal.classList.add('active');
}

function openEditProjectModal() {
    const modal = document.getElementById('editProjectModal');
    if (modal) modal.classList.add('active');
}

function openEditTaskModal(task) {
    const form = document.getElementById('editTaskForm');
    if (form) form.action = `/tasks/${task.id}`;

    const titleInput = document.getElementById('editTaskTitle');
    if (titleInput) titleInput.value = task.title;

    const descInput = document.getElementById('editTaskDesc');
    if (descInput) descInput.value = task.description || '';

    const dueInput = document.getElementById('editTaskDueDate');
    if (dueInput) dueInput.value = task.due_date || '';

    const modal = document.getElementById('editTaskModal');
    if (modal) modal.classList.add('active');
}

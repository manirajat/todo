@extends('layouts.app')

@section('content')
    <div class="header-section" style="margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items:flex-start;">
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                    <a href="{{ route('projects.index') }}" style="color: var(--text-muted); text-decoration: none;">&larr;
                        Projects</a>
                    <span class="project-type-badge">{{ $project->type }}</span>
                </div>
                <h1 style="font-size: 2rem; font-weight: 800; margin: 0;">{{ $project->name }}</h1>
            </div>
        </div>
        <div>
            <span style="color: var(--text-muted); font-size: 0.9rem; margin-right: 1rem;">
                {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d') : '?' }}
                -
                {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M d') : '?' }}
            </span>
            <button onclick="openEditProjectModal()" class="btn btn-sm"
                style="background-color: var(--bg-surface-secondary); color: var(--text-main); margin-right: 0.5rem; border: 1px solid var(--border-color);">Edit
                Project</button>
            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;"
                onsubmit="return confirm('Delete this project?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm" style="background-color: #fee2e2; color: #ef4444;">Delete
                    Project</button>
            </form>
        </div>
    </div>
    </div>

    <div class="kanban-board">
        <!-- Not Started Column -->
        <div class="kanban-column not_started" ondrop="drop(event, 'not_started')" ondragover="allowDrop(event)">
            <div class="kanban-column-header">
                <span class="column-title">Not Started
                    ({{ $project->tasks->where('status', 'not_started')->count() }})</span>
            </div>
            <div class="kanban-tasks" id="col-not_started">
                @foreach($project->tasks->where('status', 'not_started') as $task)
                    @include('projects.partials.task_card', ['task' => $task])
                @endforeach
            </div>
            <button onclick="openTaskModal('not_started')" class="btn btn-sm add-task-btn">+ Add Task</button>
        </div>

        <!-- In Progress Column -->
        <div class="kanban-column in_progress" ondrop="drop(event, 'in_progress')" ondragover="allowDrop(event)">
            <div class="kanban-column-header">
                <span class="column-title">In Progress
                    ({{ $project->tasks->where('status', 'in_progress')->count() }})</span>
            </div>
            <div class="kanban-tasks" id="col-in_progress">
                @foreach($project->tasks->where('status', 'in_progress') as $task)
                    @include('projects.partials.task_card', ['task' => $task])
                @endforeach
            </div>
            <button onclick="openTaskModal('in_progress')" class="btn btn-sm add-task-btn">+ Add Task</button>
        </div>

        <!-- Completed Column -->
        <div class="kanban-column completed" ondrop="drop(event, 'completed')" ondragover="allowDrop(event)">
            <div class="kanban-column-header">
                <span class="column-title">Completed ({{ $project->tasks->where('status', 'completed')->count() }})</span>
            </div>
            <div class="kanban-tasks" id="col-completed">
                @foreach($project->tasks->where('status', 'completed') as $task)
                    @include('projects.partials.task_card', ['task' => $task])
                @endforeach
            </div>
            <button onclick="openTaskModal('completed')" class="btn btn-sm add-task-btn">+ Add Task</button>
        </div>
    </div>

    <!-- New Task Modal -->
    <div id="newTaskModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Create New Task</h2>
                <button onclick="document.getElementById('newTaskModal').classList.remove('active')"
                    class="close-modal">&times;</button>
            </div>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="status" id="taskStatusInput" value="not_started">

                <div class="form-group">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title" class="form-input" required placeholder="What needs doing?">
                </div>
                <div class="form-group">
                    <label class="form-label">Description (optional)</label>
                    <textarea name="description" class="form-textarea" rows="3"
                        placeholder="Add some details..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-input">
                </div>
                <div style="text-align: right; margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="editProjectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Project</h2>
                <button onclick="document.getElementById('editProjectModal').classList.remove('active')"
                    class="close-modal">&times;</button>
            </div>
            <form action="{{ route('projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Project Name</label>
                    <input type="text" name="name" class="form-input" value="{{ $project->name }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Project Type</label>
                    <input type="text" name="type" class="form-input" value="{{ $project->type }}" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-input" value="{{ $project->start_date }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-input" value="{{ $project->end_date }}">
                    </div>
                </div>
                <div style="text-align: right; margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div id="editTaskModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Task</h2>
                <button onclick="document.getElementById('editTaskModal').classList.remove('active')"
                    class="close-modal">&times;</button>
            </div>
            <form id="editTaskForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title" id="editTaskTitle" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editTaskDesc" class="form-textarea" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="editTaskDueDate" class="form-input">
                </div>
                <div style="text-align: right; margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div>
    </div>


@endsection
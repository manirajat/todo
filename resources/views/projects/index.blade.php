@extends('layouts.app')

@section('content')
    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1
                style="font-size: 2rem; font-weight: 800; margin-bottom: 0.5rem; background: linear-gradient(135deg, var(--text-main), var(--text-muted)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Your Projects</h1>
            <p style="color: var(--text-muted);">Manage your work across different project types</p>
        </div>
        <button onclick="document.getElementById('newProjectModal').classList.add('active')" class="btn btn-primary">
            + New Project
        </button>
    </div>

    <div class="projects-grid">
        @foreach($projects as $project)
            <div onclick="window.location='{{ route('projects.show', $project) }}'" class="project-card"
                style="cursor: pointer; position: relative;">
                <div class="project-header">
                    <div>
                        <h3 class="project-title">{{ $project->name }}</h3>
                        <span class="project-type-badge">{{ $project->type }}</span>
                    </div>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onclick="event.stopPropagation()"
                        onsubmit="return confirm('Are you sure you want to delete this project?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="background: none; border: none; color: #ef4444; font-size: 1.2rem; cursor: pointer; padding: 0;">&times;</button>
                    </form>
                </div>
                <div class="project-date">
                    <span>📅
                        {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d') : 'No start' }}</span>
                    -
                    <span>{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M d') : 'No end' }}</span>
                </div>
                <div style="margin-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                    <span style="font-size: 0.8rem; color: var(--text-muted);">{{ $project->tasks->count() }} Tasks</span>
                    <!-- Progress bar placeholder -->
                    <div
                        style="width: 60px; height: 4px; background: var(--bg-surface-secondary); border-radius: 2px; overflow: hidden;">
                        <div
                            style="width: {{ $project->tasks->count() > 0 ? ($project->tasks->where('status', 'completed')->count() / $project->tasks->count()) * 100 : 0 }}%; height: 100%; background: var(--accent-color);">
                        </div>
                    </div>
                </div>
                </div>
        @endforeach
        </div>

        @if($projects->isEmpty())
            <div style="text-align: center; padding: 4rem 2rem; color: var(--text-muted);">
                <h3>No projects yet</h3>
                <p>Create your first project to get started!</p>
            </div>
        @endif

        <!-- New Project Modal -->
        <div id="newProjectModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Create New Project</h2>
                    <button onclick="document.getElementById('newProjectModal').classList.remove('active')"
                        class="close-modal">&times;</button>
                </div>
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-input" required placeholder="e.g. Website Redesign">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Project Type</label>
                        <input type="text" name="type" class="form-input" required placeholder="e.g. Development">
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-input">
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
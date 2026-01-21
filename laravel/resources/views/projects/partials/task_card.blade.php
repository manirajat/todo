<div class="task-card" id="task-{{ $task->id }}" draggable="true" ondragstart="drag(event)">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
        <div class="task-title" style="margin-bottom: 0;">{{ $task->title }}</div>
        <div style="display: flex; gap: 0.5rem;">
            <button onclick='openEditTaskModal(@json($task))'
                style="background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0; font-size: 1rem;">✎</button>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete task?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    style="background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0; font-size: 1.1rem; line-height: 1;">&times;</button>
            </form>
        </div>
    </div>
    @if($task->description)
        <div class="task-desc">{{ Str::limit($task->description, 60) }}</div>
    @endif
    <div class="task-meta">
        @if($task->due_date)
            <span>🕒 {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}</span>
        @else
            <span></span>
        @endif
        <span
            style="font-size: 0.7rem; background: var(--bg-surface-secondary); padding: 2px 6px; border-radius: 4px;">#{{ $task->id }}</span>
    </div>
</div>
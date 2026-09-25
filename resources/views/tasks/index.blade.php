<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #333; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; margin-right: 5px; border: none; cursor: pointer; }
        .btn-add { background: #28a745; }
        .btn-edit { background: #007bff; }
        .btn-delete { background: #dc3545; }
        .btn-status { background: #ffc107; color: black; }
        .success { color: green; margin-top: 10px; }
        .status-pending { color: orange; font-weight: bold; }
        .status-completed { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Personal Task Manager</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-add">+ Add New Task</a>

    <table>
        <tr>
            <th>Task Name</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @forelse($tasks as $task)
        <tr>
            <td>{{ $task->task_name }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->due_date }}</td>
            <td class="status-{{ strtolower($task->status) }}">{{ $task->status }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-edit">Edit</a>

                <form action="{{ route('tasks.status', $task) }}" method="POST" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-status">Toggle Status</button>
                </form>

                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this task?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No tasks yet. Add one!</td>
        </tr>
        @endforelse
    </table>
</body>
</html>
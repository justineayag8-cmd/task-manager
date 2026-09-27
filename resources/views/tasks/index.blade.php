<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            padding: 40px;
            background-color: #050a14;
            background-image:
                repeating-linear-gradient(60deg, rgba(0,200,255,0.04) 0, rgba(0,200,255,0.04) 1px, transparent 1px, transparent 60px),
                repeating-linear-gradient(-60deg, rgba(0,200,255,0.04) 0, rgba(0,200,255,0.04) 1px, transparent 1px, transparent 60px),
                repeating-linear-gradient(0deg, rgba(0,200,255,0.04) 0, rgba(0,200,255,0.04) 1px, transparent 1px, transparent 60px);
            color: #d6f6ff;
        }
        h1 {
            color: #00e5ff;
            text-shadow: 0 0 8px #00e5ff, 0 0 20px rgba(0,229,255,0.5);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(10, 20, 35, 0.85);
            border: 1px solid #00e5ff44;
            box-shadow: 0 0 25px rgba(0, 229, 255, 0.15);
        }
        th, td {
            border: 1px solid #0f2a3d;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #04182b;
            color: #00e5ff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
        }
        tr:hover td { background: rgba(0, 229, 255, 0.05); }
        .btn {
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 4px;
            color: #05121e;
            margin-right: 5px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-add { background: #00e5ff; box-shadow: 0 0 10px #00e5ff; }
        .btn-edit { background: #ffb300; box-shadow: 0 0 10px #ffb300; }
        .btn-delete { background: #ff3b5c; box-shadow: 0 0 10px #ff3b5c; }
        .btn-status { background: #7dff8a; box-shadow: 0 0 10px #7dff8a; }
        .success {
            color: #7dff8a;
            margin-top: 10px;
            text-shadow: 0 0 6px #7dff8a;
        }
        .status-pending { color: #ffb300; font-weight: bold; text-shadow: 0 0 6px #ffb300; }
        .status-completed { color: #7dff8a; font-weight: bold; text-shadow: 0 0 6px #7dff8a; }
    </style>
</head>
<body>
    <h1>⚡ Personal Task Manager</h1>

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
                    <button type="submit" class="btn btn-status">Toggle</button>
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
<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f4f4; }
        h1 { margin-bottom: 10px; font-size: 24px; }
        form { background: white; padding: 15px; border-radius: 8px; max-width: 500px; }
        label { display: block; margin-top: 10px; font-weight: bold; font-size: 14px; }
        input, textarea, select { width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box; }
        textarea { height: 60px; }
        .btn { padding: 8px 16px; margin-top: 12px; border: none; border-radius: 4px; cursor: pointer; color: white; text-decoration: none; display: inline-block; }
        .btn-save { background: #28a745; }
        .btn-back { background: #6c757d; margin-left: 10px; }
        .error { color: red; font-size: 0.85em; }
    </style>
</head>
<body>
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Task Name</label>
        <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}">
        @error('task_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <label>Description</label>
        <textarea name="description">{{ old('description', $task->description) }}</textarea>

        <label>Due Date</label>
        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}">

        <label>Status</label>
        <select name="status">
            <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit" class="btn btn-save">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-back">Cancel</a>
    </form>
</body>
</html>
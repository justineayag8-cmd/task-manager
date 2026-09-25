<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .btn { padding: 8px 16px; margin-top: 15px; border: none; border-radius: 4px; cursor: pointer; color: white; text-decoration: none; display: inline-block; }
        .btn-save { background: #28a745; }
        .btn-back { background: #6c757d; margin-left: 10px; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Add New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <label>Task Name</label>
        <input type="text" name="task_name" value="{{ old('task_name') }}">
        @error('task_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <label>Description</label>
        <textarea name="description" rows="4">{{ old('description') }}</textarea>

        <label>Due Date</label>
        <input type="date" name="due_date" value="{{ old('due_date') }}">

        <button type="submit" class="btn btn-save">Save Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-back">Cancel</a>
    </form>
</body>
</html>
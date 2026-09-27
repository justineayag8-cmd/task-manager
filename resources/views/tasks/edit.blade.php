<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
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
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        form {
            background: rgba(10, 20, 35, 0.85);
            border: 1px solid #00e5ff44;
            box-shadow: 0 0 25px rgba(0, 229, 255, 0.15);
            padding: 25px;
            border-radius: 8px;
            max-width: 500px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #00e5ff;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            background: #04182b;
            border: 1px solid #0f2a3d;
            color: #d6f6ff;
            border-radius: 4px;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #00e5ff;
            box-shadow: 0 0 8px rgba(0,229,255,0.4);
        }
        .btn {
            padding: 10px 18px;
            margin-top: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .btn-save { background: #00e5ff; color: #05121e; box-shadow: 0 0 10px #00e5ff; }
        .btn-back { background: #2a3b4d; color: #d6f6ff; margin-left: 10px; }
        .error { color: #ff3b5c; font-size: 0.9em; text-shadow: 0 0 6px #ff3b5c; }
    </style>
</head>
<body>
    <h1>✏️ Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Task Name</label>
        <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}">
        @error('task_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <label>Description</label>
        <textarea name="description" rows="4">{{ old('description', $task->description) }}</textarea>

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
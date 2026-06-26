<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            margin:0;
            padding:40px;
        }

        .container{
            width:600px;
            margin:auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        h2{
            text-align:center;
            color:#333;
        }

        label{
            display:block;
            margin-top:15px;
            font-weight:bold;
        }

        input, textarea, select{
            width:100%;
            padding:10px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        textarea{
            height:120px;
            resize:vertical;
        }

        button{
            margin-top:20px;
            width:100%;
            padding:12px;
            background:#0d6efd;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
            font-size:16px;
        }

        button:hover{
            background:#0b5ed7;
        }

        .success{
            background:#d1e7dd;
            color:#0f5132;
            padding:10px;
            border-radius:5px;
            margin-bottom:15px;
        }

        .error{
            color:red;
            margin-top:5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Create IT Support Ticket</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/tickets" method="POST">

        @csrf

        <label>Ticket Title</label>

        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
        >

        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>

        <textarea
            name="description"
        >{{ old('description') }}</textarea>

        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Priority</label>

        <select name="priority">

            <option value="">-- Select Priority --</option>

            <option value="Low">Low</option>

            <option value="Medium">Medium</option>

            <option value="High">High</option>

            <option value="Critical">Critical</option>

        </select>

        @error('priority')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">
            Submit Ticket
        </button>

    </form>

</div>

</body>
</html>
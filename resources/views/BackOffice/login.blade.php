
<html>
<head>
    <style>
        form {
            width: 400px;
            margin: auto;
            text-align: center;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<form action="">
    @csrf

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Enviar">
</form>
</body>
</html>

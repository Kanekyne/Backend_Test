<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Actions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .message {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Actions</h2>
        <div class="btn-container">
            <a href="{{ route('products.index') }}" class="btn">List Product</a>
            <a href="{{ route('categories.index') }}" class="btn">List Categories</a>
            <p class="message">Esta es solamente una vista inicial y como tal solo sirve para redirigirte a la lista de elementos que están dentro de la DB con la que se conecta la API. Si quiere editar o alterar de alguna forma la DB, esta no es la forma adecuada de hacerlo.</p>
        </div>
    </div>
</body>
</html>

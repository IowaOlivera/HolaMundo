<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Productos</title>
</head>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-title">
        <h1>Productos</h1>
    </div>
    <div class="panel-body">

        @foreach ($products as $product)
            <p>Id:  {{ $product->id }}</p>
            <p>Nombre:  {{ $product->name }}</p>
            <p>Precio:  {{ $product->price }}</p>
            <p>--------------------------------</p>
        @endforeach

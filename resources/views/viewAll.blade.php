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

        Crear producto nuevo
        <form action="{{url('/api/products/')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('POST')}}
            <div class="form-group">
                <label for="name" class="control-label">Nombre: </label>
                <input type="text" name="name" value="" id="Nombre" class="form-control">
            </div>
            <div class="form-group">
                <label for="price" class="control-label">Precio</label>
                <input type="text" name="price" value="" id="Price" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-check"></i> Aceptar
                </button>
            </div>
        </form>

        Lista de productos
        @foreach ($products as $product)
            <p>Id:  {{ $product->id }}</p>
            <p>Nombre:  {{ $product->name }}</p>
            <p>Precio:  {{ $product->price }}</p>
            <form class="form-group" action="{{'products/'.$product->id}}" method="post">
                {{ method_field('DELETE') }}
                <button type="submit">Eliminar </button>
            </form>

            <form class="form-group" action="{{'products/edit/'.$product->id}}" method="get">
                {{ method_field('get') }}
                <button type="submit">Editar </button>
            </form>

            <form class="form-group" action="{{'products/'.$product->id}}" method="get">
                {{ method_field('get') }}
                <button type="submit">Mostrar producto </button>
            </form>
            <p>--------------------------------</p>
        @endforeach

        <!--<form class="form-group" action="{{'products/create/'}}" method="get">
                {{ method_field('get') }}
                <button type="submit">Crear nuevo registro </button>
            </form>-->

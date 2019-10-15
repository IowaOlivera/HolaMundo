<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Editor de productos</title>
</head>
 <div class="col-sm-offset-3 col-sm-6">
        <div class="panel-title">
            <h1>Producto</h1>
        </div>
        <div class="panel-body">


            <form action={{"http://localhost/HolaMundo/public/api/products/".$product->id}} method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <input type="hidden" value="{{$product->id}}" name="id">
                <div class="form-group">
                    <label for="id" class="control-label">ID</label>
                    <input type="text" name="id" value="{{$product->id}}" id="Id" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Nombre</label>
                    <input type="text" name="name" value="{{$product->name}}" id="Nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price" class="control-label">Precio</label>
                    <input type="text" name="price" value="{{$product->price}}" id="Price" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-check"></i> Aceptar
                    </button>
                </div>
            </form>

        </div>
    </div>

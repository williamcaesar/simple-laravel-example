<html>
<body>
<br>
<p>Name : {{$product->name}}</p>
<p>Quantity : {{$product->quantity}}</p>
<p>Value : {{$product->value}}</p>
<p>Category : {{$categoryName}}</p>

@can('update', \App\Product::class)
    <div>
        <br>
        <form action="/products/update/{{$product->id}}" method="post" id="update_form">
            @csrf
            @method('PUT')
            Product Name: <input type="text" name="name"><br>
            Quantity: <input type="number" name="quantity"><br>
            Value: <input type="number" name="value"><br>

            Category: <select name="category_id" form="update_form">
                @foreach($categories as $key => $value)

                    <option value={{$value->id}}>{{ $value->name }}</option>

                @endforeach
            </select>
            <br><br>
            UPDATE
            <input type="submit">
        </form>
    </div>
@endcan

@can('delete', \App\Product::class)
    <form action="/products/destroy/{{$product->id}}" method="post">
        @csrf
        @method('DELETE')
        DELETE
        <input type="submit">
    </form>
@endcan

</body>
</html>

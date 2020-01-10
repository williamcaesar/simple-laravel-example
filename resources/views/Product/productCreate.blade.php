<html>
<body>

<form action="/products/store" method="post" id="store_form">
    @csrf
    Product Name: <input type="text" name="name"><br>
    Quantity: <input type="number" name="quantity"><br>
    Value: <input type="number" name="value"><br>

    Category: <select name="category_id" form="store_form">
        @foreach($categories as $key => $value)

            <option value={{$value->id}}>{{ $value->name }}</option>

        @endforeach
    </select>
    <br>
    <input type="submit">
</form>

</body>
</html>

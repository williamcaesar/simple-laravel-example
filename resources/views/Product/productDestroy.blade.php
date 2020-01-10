<html>
<body>
<p>Name : {{$product->name}}</p>
<form action="/products/update/{{$product->id}}" method="post">
    @csrf
    @method('DELETE')
    <input type="submit">
</form>
</body>
</html>

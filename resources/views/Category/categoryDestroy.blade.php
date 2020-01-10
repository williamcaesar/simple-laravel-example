<html>
<body>
<p>Name : {{$category->name}}</p>
<form action="/categories/update/{{$category->id}}" method="post">
    @csrf
    @method('DELETE')
    <input type="submit">
</form>
</body>
</html>

<html>
<body>
<p>Name : {{$category->name}}</p>
<form action="/categories/update/{{$category->id}}" method="post">
    @csrf
    @method('PUT')
    Category Name: <input type="text" name="name"><br>

    UPDATE
    <input type="submit">
</form>

<form action="/categories/destroy/{{$category->id}}" method="post">
    @csrf
    @method('DELETE')
    DELETE
    <input type="submit">
</form>

<div>

</div>

</body>
</html>

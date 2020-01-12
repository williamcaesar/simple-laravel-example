<html>
<body>
<p>Name : {{$category->name}}</p>
@can('update', \App\Category::class)
    <form action="/categories/update/{{$category->id}}" method="post">
        @csrf
        @method('PUT')
        Category Name: <input type="text" name="name"><br>

        UPDATE
        <input type="submit">
    </form>
@endcan

@can('delete', \App\Category::class)
    <form action="/categories/destroy/{{$category->id}}" method="post">
        @csrf
        @method('DELETE')
        DELETE
        <input type="submit">
    </form>
@endcan

</body>
</html>

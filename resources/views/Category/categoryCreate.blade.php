<html>
<body>

<form action="/categories/store" method="post">
    @csrf
    Category Name: <input type="text" name="name"><br>
    <input type="submit">
</form>

</body>
</html>

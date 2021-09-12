<html>
<head>
    <title>Test</title>
</head>
<body>
    <form method="post" action="{{ route('test.store') }}">
        @csrf
        <input type="text" name="testText1" value="testText1">
        <input type="text" name="testText2" value="testText2">
        <input type="submit" name="submit">
    </form>
    <a href="{{ route('test.show', 2) }}">Show</a>
    <form action="{{ route('test.show', 2) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- other inputs... -->
    </form>
    <form action="{{  route('test.show', 2) }}" method="delete">
        <button type="submit">delete</button>
    </form>
    <a href="{{ route('test.destroy', 2) }}">Delete</a>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div>
        @if (!empty($landing))
        <form action="{{ url('/update-example') }}" method="post">
            {{ csrf_field() }}
            @foreach ($landing as $item)
            <label for="{{ $item->name }}">{{ $item->name }}</label>
            <input id="{{ $item->name }}" type="text" name="{{ $item->name }}" value="{{ $item->value }}"><br/>
            @endforeach
            <button type="submit">Simpan Perubahan</button>
        </form>
        @endif
    </div>

</body>

</html>

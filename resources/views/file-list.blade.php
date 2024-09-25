<!DOCTYPE html>
<html>
<head>
    <title>List of Files</title>
</head>
<body>
    <h1>List of Files in the Public Folder</h1>
    <ul>
        @foreach($files as $file)
            <li>{{ $file }}</li>
        @endforeach
    </ul>
</body>
</html>

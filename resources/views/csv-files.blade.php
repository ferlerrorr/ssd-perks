<!DOCTYPE html>
<html>

<head>
    <title>CSV Files</title>
</head>

<body>
    <h1>List of CSV Files for Download</h1>
    <ul>
        @foreach($fileList as $fileName => $fileUrl)
        <li>
            <a href="{{ $fileUrl }}" download="{{ $fileName }}">{{ $fileName }}</a>
        </li>
        @endforeach
    </ul>
</body>

</html>
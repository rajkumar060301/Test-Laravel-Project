<!-- resources/views/show-session.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Session Values</title>
</head>
<body>
    <h1>Session Values</h1>

    <ul>
        @php
            echo "<pre>";
             print_r($sessionValues);   
            echo "</pre>";
        @endphp
    </ul>
</body>
</html>

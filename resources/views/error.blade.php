<!-- resources/views/error.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <h2>Oops! Something went wrong.</h2>
    <p>{{ $message ?? 'An error occurred.' }}</p>
</body>
</html>

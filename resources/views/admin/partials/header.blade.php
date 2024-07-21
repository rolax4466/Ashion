<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="/Admin/css/fontawesome.min.css">
    <link rel="stylesheet" href="/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Admin/css/templatemo-style.css">
</head>
<body>
    <!-- Display flash messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <script src="/Admin/js/jquery-3.3.1.min.js"></script>
    <script src="/Admin/js/bootstrap.min.js"></script>
    <script src="{{ asset('/Admin/js/main.js') }}"></script>
</body>
</html>

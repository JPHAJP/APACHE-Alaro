<?php
session_start();

// Inicializar el contador de clics si no existe
if (!isset($_SESSION['click_count'])) {
    $_SESSION['click_count'] = 0;
}

// Incrementar el contador de clics si se recibe una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['load'])) {
        $_SESSION['click_count']++;
    }
    echo $_SESSION['click_count'];
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Welcome to My Landing Page</h1>
        <p>Click the button below to count the clicks!</p>
        <button id="clickButton" class="btn btn-primary">Click Me!</button>
        <p id="clickCount" class="mt-3">Total Clicks: <span id="totalClicks"></span></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clickButton').click(function() {
                $.post('index.php', function(data) {
                    $('#totalClicks').text(data);
                });
            });

            // Cargar el conteo inicial
            $.post('index.php', {load: true}, function(data) {
                $('#totalClicks').text(data);
            });
        });
    </script>
</body>
</html>
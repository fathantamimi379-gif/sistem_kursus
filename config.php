<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_kursus");
session_start();

// Template Header UI
function header_web($title) {
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$title.'</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background-color: #f8f9fa; }
            .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .btn-primary { border-radius: 8px; padding: 10px 20px; }
        </style>
    </head>
    <body>
    <div class="container mt-5">';
}

// Template Footer UI
function footer_web() {
    echo '</div></body></html>';
}
?>
<!-- resources/views/spa.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>

    <!-- Meta tags SEO -->
    <meta name="description" content="Portfolio de développement web full-stack">
    <meta name="keywords" content="développeur, full-stack, portfolio, web, react, laravel">
    <meta name="author" content="Votre Nom">

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div id="app"></div>
</body>

</html>

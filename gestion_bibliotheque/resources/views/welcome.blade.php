<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1 class="mb-4">Bienvenue sur votre système</h1>

        <a href="{{ route('login') }}" class="btn btn-primary mb-2 w-100">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-success w-100">S’inscrire</a>
    </div>
</body>
</html>
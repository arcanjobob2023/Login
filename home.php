<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Qualidade de Software - Início</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="stylehome.css">
</head>
<body class="japanese-theme">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Trabalho Junho</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="applications.php">Aplicações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link text-white-50">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center text-white d-flex align-items-center justify-content-center">
        <div class="container">
            <h1 class="display-3">Bem-vindo ao Nosso Espaço Japonês</h1>
            <p class="lead">Explore a cultura e nossas aplicações inovadoras.</p>
            <a href="applications.php" class="btn btn-primary btn-lg mt-3">Ver Aplicações</a>
        </div>
    </header>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2026 Trabalho Sistemas Inteligentes. Todos os direitos reservados.</p>
    </footer>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <script src="scripthome.js"></script>
</body>
</html>

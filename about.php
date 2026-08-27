<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Qualidade - Sobre Nós</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="stylehome.css">
</head>
<body class="japanese-theme">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Trabalho Qualidade</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="applications.php">Aplicações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="about.php">Sobre Nós</a>
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
  
    <main class="container my-5">
        <h1 class="text-center mb-4">Sobre a Equipe</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card p-4">
                    <h2 class="card-title text-center mb-4">Integrantes do Grupo</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5><a href="https://github.com/arcanjobob2023" target="_blank" rel="noopener noreferrer">Robert Firmino Ribeiro</a>  </h5>
                            <p>Desenvolvedor Full Stack</p>
                        </li>

                        <li class="list-group-item">
                            <h5><a href="https://github.com/littlesoulkkj" target="_blank" rel="noopener noreferrer">Giovanna Dominguês</a></h5>
                            <p>Desenvolvedora fullstack</p>
                        </li>

                        <li class="list-group-item">
                            <h5><a href="https://github.com/Teupa1" target="_blank" rel="noopener noreferrer">João Victor Dos Santos Lima Ferreira
                            </a></h5>
                            <p>Desenvolvedor fullstack</p>
                        </li>

                        <li class="list-group-item">
                            <h5><a href="https://github.com/italoluiz22" target="_blank" rel="noopener noreferrer">Italo Luiz</a></h5>
                            <p>Desenvolvedor fullstack</p>
                        </li>

                        <li class="list-group-item">
                            <h5><a href="https://github.com/jorybyknockouts" target="_blank" rel="noopener noreferrer">Nicolas</a></h5>
                            <p>Desenvolvedor fullstack</p>
                        </li>

                    </ul>
                    <p class="mt-4 text-center">Este projeto foi desenvolvido como parte de um trabalho para a disciplina Qualidade de Software <a href="https://github.com/Dri-Ferreira" target="_blank" rel="noopener noreferrer">Professor Adriano</a>.</p>
                </div>
            </div>
        </div>
    </main>
   
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2026 Trabalho Qualidade de Software. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="scripthome.js"></script>
</body>
</html>

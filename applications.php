<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Junho - Aplicações</title>
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
                        <a class="nav-link active" aria-current="page" href="applications.php">Aplicações</a>
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

   

    <main class="container my-5">
        <h1 class="text-center mb-5">Nossas Aplicações</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">



           
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Chatbot Interativo</h5>
                        <p class="card-text">Converse com nosso chatbot sobre o site e obtenha informações.</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Digite sua mensagem..." aria-label="Mensagem do Chatbot" id="chatbotInput">
                            <button class="btn btn-primary" type="button" id="chatbotSend">Enviar</button>
                        </div>
                        <div class="card bg-light p-3 mt-3" id="chatbotResponse">
                            <p>Chatbot: Olá! Como posso ajudar você hoje?</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Galeria de Imagens</h5>
                        <p class="card-text">Explore nossa bela galeria de imagens.</p>
                        <div id="imageGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="galleryInner">
                           
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageGalleryCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageGalleryCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Espaço Publicitário</h5>
                        <p class="card-text">Este espaço está disponível para divulgação.</p>
                        <div id="weatherDisplay">
                            <p>Seu app pode aparecer aqui! Anuncie conosco.</p>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Contador de Cliques</h5>
                        <p class="card-text">Veja quantas vezes cada página do site foi visitada.</p>
                        <div id="clickCounterDisplay">
                            <p>Cliques na página atual: <span id="currentPageClicks">0</span></p>
                            <p>Cliques totais (Início): <span id="indexPageClicks">0</span></p>
                            <p>Cliques totais (Aplicações): <span id="applicationsPageClicks">0</span></p>
                            <p>Cliques totais (Sobre Nós): <span id="aboutPageClicks">0</span></p>
                        </div>
                    </div>
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

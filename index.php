<?php
session_start();
require_once __DIR__ . '/config.php';

$erro = '';
$emailDigitado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailDigitado = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!filter_var($emailDigitado, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um e-mail em um formato válido (ex: nome@dominio.com).';
    } elseif ($senha === '') {
        $erro = 'Informe a senha.';
    } else {
        $stmt = $pdo->prepare('SELECT id, nome, senha_hash FROM usuarios WHERE email = :email');
        $stmt->execute(['email' => $emailDigitado]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header('Location: home.php');
            exit;
        }

        $erro = 'E-mail ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid auth-container">
        <div class="row h-100 gx-3">
           
            <div class="col-lg-6 left-panel">
                <img id="animeImage" class="anime-image" src="" alt="Imagem de Anime">
            </div>

         
            <div class="col-lg-6 right-panel">
                <div class="auth-box">
                    <h2 class="mb-4">Login</h2>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger py-2" role="alert">
                            <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['cadastrado'])): ?>
                        <div class="alert alert-success py-2" role="alert">
                            Cadastro realizado com sucesso! Faça login.
                        </div>
                    <?php endif; ?>

                    <form method="post" action="index.php" novalidate>
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="seuemail@exemplo.com"
                                value="<?= htmlspecialchars($emailDigitado) ?>"
                                required
                            >
                            <div class="invalid-feedback">
                                Informe um e-mail válido.
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="senha" class="form-label">Senha</label>
                            <input
                                type="password"
                                class="form-control"
                                id="senha"
                                name="senha"
                                placeholder="Sua senha"
                                required
                            >
                            <div class="invalid-feedback">
                                Informe a senha.
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" id="btn1" class="btn btn-danger rounded-pill px-4">Entrar</button>
                            <a href="cadastro.php" id="btn2" class="btn btn-outline-secondary rounded-pill px-4">Cadastro</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
       
        (() => {
            const forms = document.querySelectorAll('form');
            forms.forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        })();
    </script>
</body>
</html>

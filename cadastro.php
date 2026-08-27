<?php
require_once __DIR__ . '/config.php';

$erro = '';
$nomeDigitado = '';
$emailDigitado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeDigitado = trim($_POST['nome'] ?? '');
    $emailDigitado = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    if ($nomeDigitado === '') {
        $erro = 'Informe o nome.';
    } elseif (!filter_var($emailDigitado, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um e-mail em um formato válido (ex: nome@dominio.com).';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter no mínimo 6 caracteres.';
    } elseif ($senha !== $confirmarSenha) {
        $erro = 'As senhas não coincidem.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email');
        $stmt->execute(['email' => $emailDigitado]);

        if ($stmt->fetch()) {
            $erro = 'Já existe um usuário cadastrado com esse e-mail.';
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)');
            $stmt->execute([
                'nome' => $nomeDigitado,
                'email' => $emailDigitado,
                'senha_hash' => $senhaHash,
            ]);

            header('Location: index.php?cadastrado=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
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
                    <h2 class="mb-4">Cadastro</h2>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger py-2" role="alert">
                            <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="cadastro.php" novalidate>
                        <div class="mb-3 text-start">
                            <label for="nome" class="form-label">Nome</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nome"
                                name="nome"
                                placeholder="Seu nome"
                                value="<?= htmlspecialchars($nomeDigitado) ?>"
                                required
                            >
                            <div class="invalid-feedback">
                                Informe o nome.
                            </div>
                        </div>
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
                                placeholder="Mínimo 6 caracteres"
                                minlength="6"
                                required
                            >
                            <div class="invalid-feedback">
                                A senha deve ter no mínimo 6 caracteres.
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="confirmar_senha" class="form-label">Confirmar senha</label>
                            <input
                                type="password"
                                class="form-control"
                                id="confirmar_senha"
                                name="confirmar_senha"
                                placeholder="Repita a senha"
                                minlength="6"
                                required
                            >
                            <div class="invalid-feedback">
                                Confirme a senha.
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn btn-danger rounded-pill px-4">Cadastrar</button>
                            <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">Voltar ao login</a>
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

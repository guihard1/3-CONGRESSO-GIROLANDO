<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "meuhost";
$username = "seu_usuario";
$password = "sua_senha";
$database = "sua_database";

$result = null;
$conexao_erro = null;
$filtro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['busca'])) {
        $filtro = htmlspecialchars(trim($_POST['busca']));
    }

    $connect = new mysqli($servername, $username, $password, $database);
    $connect->set_charset("utf8mb4");

    if ($connect->connect_error) {
        $conexao_erro = "Erro de Conexão: " . $connect->connect_error;
    } else {
        $sql = "SELECT nome, email, curso, caminho_arquivo_pdf FROM formulario_congresso 
                WHERE nome LIKE '%$filtro%' OR email LIKE '%$filtro%'
                ORDER BY nome ASC";

        // Prepared Statements é melhor em projeto real pra evitar dor de cabeça.
        $result = $connect->query($sql);
        $connect->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./styles/header.css">
    <link rel="stylesheet" href="./styles/body.css">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/table.css">
</head>
<body>
<header>
    <div class="container">
        <img src="./logo/LOGO%20GIROLANDO%20ATUALIZADA_INSTITUCIONAL%20BRANCA.png" alt="logoGirolando" class="logo">
    </div>
</header>
<main>
    <form method="POST" class="allItems" action="">
        <div>
            <h1 class="title">Verificação de inscritos</h1>

            <div class="containerMain">
                <input type="text" name="busca" placeholder="Digite o nome ou e-mail do participante" value="<?= htmlspecialchars($filtro) ?>">
            </div>

            <div class="containerMain">
                <button type="submit">
                    <svg height="3rem" width="3rem" version="1.1" id="图层_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path fill="currentColor" stroke="currentColor" stroke-width="1" d="M18.5,24c-3,0-5.5-2.5-5.5-5.5s2.5-5.5,5.5-5.5s5.5,2.5,5.5,5.5S21.5,24,18.5,24z M18.5,14 C16,14,14,16,14,18.5s2,4.5,4.5,4.5s4.5-2,4.5-4.5S21,14,18.5,14z"></path> </g> <g> <path fill="currentColor" stroke="currentColor" stroke-width="1" d="M22.5,21.8l4.4,4.4c0.2,0.2,0.2,0.5,0,0.7C26.8,27,26.6,27,26.5,27s-0.3,0-0.4-0.1l-4.4-4.4L22.5,21.8z"></path></g> </g> </g> </g></svg>
                    Consultar
                </button>
            </div>
        </div>
    </form>
    <div class="resultado-container">
        <?php if (isset($conexao_erro)): ?>
            <p style="color: red; font-weight: bold;">Erro: <?= $conexao_erro ?></p>
        <?php endif; ?>

        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Link</th>
            </tr>
            </thead>

            <tbody>
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST" && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $row["nome"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["curso"] ?></td>
                        <td>
                            <a href="<?= $row["caminho_arquivo_pdf"] ?>" target="_blank">
                                <svg width="2rem" height="2rem" viewBox="0 0 15.00 15.00"
                                     xmlns="http://www.w3.org/2000/svg" stroke="#4c80f7"
                                     transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)"
                                     stroke-width="0.00015000000000000001">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                       stroke="#CCCCCC" stroke-width="0.5700000000000001"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path stroke-width="0.00015000000000000001" fill="#4c80f7" fill-rule="evenodd"
                                              clip-rule="evenodd"
                                              d="M3 2C2.44772 2 2 2.44772 2 3V12C2 12.5523 2.44772 13 3 13H12C12.5523 13 13 12.5523 13 12V8.5C13 8.22386 12.7761 8 12.5 8C12.2239 8 12 8.22386 12 8.5V12H3V3L6.5 3C6.77614 3 7 2.77614 7 2.5C7 2.22386 6.77614 2 6.5 2H3ZM12.8536 2.14645C12.9015 2.19439 12.9377 2.24964 12.9621 2.30861C12.9861 2.36669 12.9996 2.4303 13 2.497L13 2.5V2.50049V5.5C13 5.77614 12.7761 6 12.5 6C12.2239 6 12 5.77614 12 5.5V3.70711L6.85355 8.85355C6.65829 9.04882 6.34171 9.04882 6.14645 8.85355C5.95118 8.65829 5.95118 8.34171 6.14645 8.14645L11.2929 3H9.5C9.22386 3 9 2.77614 9 2.5C9 2.22386 9.22386 2 9.5 2H12.4999H12.5C12.5678 2 12.6324 2.01349 12.6914 2.03794C12.7504 2.06234 12.8056 2.09851 12.8536 2.14645Z"></path>
                                    </g>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($conexao_erro)) {
                // Mensagem só aparece se o botão foi clicado, mas não houve resultados.
                echo "<tr class='content-td'><td colspan='4'>Nenhum registro encontrado com o termo de busca: " . htmlspecialchars($filtro) . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
    <footer>
        
    </footer>
</body>
</html>
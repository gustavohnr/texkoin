<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirecionar para a página de login, se não estiver autenticado
    exit();
}

// Dados de conexão do banco de dados
$dbServer = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "tk_users";

// Conexão ao banco de dados
$conn = new mysqli($dbServer, $dbUser, $dbPass, $dbName);

// Verificar se houve algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter informações do usuário a partir do banco de dados
$usuario = $_SESSION['usuario'];
$selectQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $userRow = $result->fetch_assoc();
    $nome = $userRow['nome'];
    $texkoins = $userRow['texkoins'];
    $real = $texkoins * 100;

    // Atualizar informações na sessão
    $_SESSION['nome'] = $nome;
    $_SESSION['texkoins'] = $texkoins;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/dashboard.css" rel="stylesheet" />
    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-title">
            <i class="fa fa-money currency-icon"></i> TEXKOINS
        </div>
        <div class="sidebar-divider"></div>
        <div class="sidebar-item">
            <a href="#">Home</a>
        </div>
        <div class="sidebar-item">
            <a href="#">Scoreboard</a>
        </div>
        <div class="sidebar-item">
            <a href="#">Conta</a>
        </div>
    </div>
    <div class="content">
        <div class="text">
            <h2> Olá, <?php echo $nome ?>!</h2>
            <h2> Você possui <?php echo $texkoins ?> TEXKOINS, o que equivale a <?php echo $real?> reais!</h2>
        </div>
    </div>
</body>

</html>
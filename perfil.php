<!--?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirecionar para a página de login, se não estiver autenticado
    exit();
}

// Dados de conexão do banco de dados
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "tk_users";

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
$options = [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $primeiroNome = $_POST['primeiro-nome'];
    $segundoNome = $_POST['segundo-nome'];
    $setor = $_POST['setor'];
    $cargo = $_POST['cargo'];

    if (!empty($primeiroNome) && !empty($segundoNome)) {
        $conn = new mysqli('localhost', 'root', '', 'tk_users');
        if ($conn->connect_error) {
            die('Falha na conexão com o banco de dados: ' . $conn->connect_error);
        }

        $usuario = $_SESSION['usuario'];

        $sql = "UPDATE usuarios SET primeiro_nome = '$primeiroNome', segundo_nome = '$segundoNome', setor = '$setor', cargo = '$cargo' WHERE usuario = '$usuario'";

        if ($conn->query($sql) === FALSE) {
            echo "Erro ao atualizar o registro: " . $conn->error;
        }
    }
}



try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
    $usuario = $_SESSION['usuario'];
    $selectQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $pdo->query($selectQuery);

    if ($result->rowCount() > 0) {
        $userRow = $result->fetch(PDO::FETCH_ASSOC);
        $primeiro_nome = $userRow['primeiro_nome'];
        $segundo_nome = $userRow['segundo_nome'];
        $setor = $userRow['setor'];
        $cargo = $userRow['cargo'];
        $texkoins = $userRow['texkoins'];
        $imagem = $userRow['imagem'];
        $real = $texkoins * 100;

        $_SESSION['primeiro_nome'] = $primeiro_nome;
        $_SESSION['segundo_nome'] = $segundo_nome;
        $_SESSION['texkoins'] = $texkoins;
        $_SESSION['setor'] = $setor;
    }

    // Consulta para obter a classificação geral dos usuários
    $leaderboardQuery = "SELECT rank, nome, texkoins, setor, imagem
    FROM ranking_usuarios
    ORDER BY rank
    LIMIT 10";
    $result = $pdo->query($leaderboardQuery);


    // Consulta para obter a classificação por setor
    $leaderboardSetorQuery = "SELECT setor, total_texkoins, dense_rank
    FROM (
        SELECT setor, total_texkoins, DENSE_RANK() OVER (ORDER BY total_texkoins DESC) AS dense_rank
        FROM leaderboard_setor_view
    ) AS subquery
    WHERE setor = :setor";
    $stmt = $pdo->prepare($leaderboardSetorQuery);
    $stmt->bindParam(':setor', $setor);
    $stmt->execute();
    $resultSetor = $stmt->fetch(PDO::FETCH_ASSOC);

    $totalTexkoins = $resultSetor['total_texkoins'];
    $rank = $resultSetor['dense_rank'];





    $pdo = null;
} catch (PDOException $e) {
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    exit();
}
?-->
<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        TEXKOINS
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .setor-t {
            padding-left: 20px;
        }

        .info {
            padding-bottom: 0px !important;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="position-absolute w-100 min-height-300 top-0"
        style="background-image: url('tltx-padrao.png'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" target="_blank">
                <img src="assets/images/tltx-logo-roxo-t.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">TEXKOINS</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-spaceship text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Início</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../pages/tables.html">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-line-chart text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ranking</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../pages/tables.html">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user-circle text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Conta</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
        </div>
    </aside>
    <div class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav
            class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2 mt-n11">
            <div class="container-fluid py-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="text-white opacity-5"
                                href="javascript:;">Início</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Conta</li>
                    </ol>
                    <h6 class="text-white font-weight-bolder ms-2">
                        <?php echo $usuario ?>
                    </h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="card shadow-lg mx-4 card-profile-bottom">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="uploads/<?php echo $imagem ?>" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?php echo $primeiro_nome . ' ' . $segundo_nome ?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <?php echo $setor ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                        data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                        <i class="ni ni-settings-gear-65"></i>
                                        <span class="ms-2">Alterar foto</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="info card-body">
                            <form method="POST" action="">
                                <p class="text-uppercase text-sm">Informações Pessoais</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">nome de
                                                usuário</label>
                                            <input class="form-control" readonly type="text"
                                                value="<?php echo $usuario ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">e-mail</label>
                                            <input class="form-control" readonly type="email"
                                                value="<?php echo $usuario ?>@teletex.com.br">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">primeiro
                                                nome</label>
                                            <input id="primeiro-nome" name="primeiro-nome" class="form-control"
                                                type="text" value="<?php echo $primeiro_nome ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">segundo
                                                nome</label>
                                            <input class="form-control" id="segundo-nome" name="segundo-nome"
                                                type="text" value="<?php echo $segundo_nome ?>">
                                        </div>
                                    </div>
                                </div>
                                <p class="text-uppercase text-sm">Informações profissionais</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">cargo</label>
                                            <input class="form-control" id="cargo" name="cargo" type="text"
                                                value="<?php echo $cargo ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">setor</label>
                                            <select id="setor" name="setor" class="form-control">
                                                <option value="<?php echo $setor ?>" selected>
                                                    selecione...
                                                </option>
                                                <option>Engenharia</option>
                                                <option>Marketing</option>
                                                <option>Compliance</option>
                                                <option>Recursos Humanos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputState">terminou?</label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm ms-auto">salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div>
                            <img src="assets/images/team.jpg" alt="Image placeholder" class="card-img-top">
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center mt-4">
                                <h6>
                                    <span class="font-weight-normal">Você é do setor... </span>
                                    <?php echo $setor ?>!
                                </h6>
                                
                                <table class="mx-auto">
                                    <tr>
                                        <td class="text-left h6 font-weight-300">RANKING</td>
                                        <td class="setor-t text-center font-weight-normal">
                                            <?php echo $rank ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left h6 font-weight-300">TEXKOINS</td>
                                        <td class="setor-t text-center font-weight-normal">
                                            <?php echo $totalTexkoins ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
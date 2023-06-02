<?php
$pag_id = 'inicio';
session_start();
require_once "php/funcoes.php";
require_once "php/conecta_db.php";
requireLogin();

$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $primeiroNome = $_POST['primeiro_nome'];
    $segundoNome = $_POST['segundo_nome'];
    $setor = $_POST['setor'];
    $cargo = $_POST['cargo'];

    if (!empty($primeiroNome) && !empty($segundoNome)) {
        $updateQuery = "UPDATE usuarios SET primeiro_nome = '$primeiroNome', segundo_nome = '$segundoNome', cargo = '$cargo', setor = '$setor' WHERE usuario = '$usuario'";
        mysqli_stmt_execute(mysqli_prepare($connection, $updateQuery));

        // if ($_POST['img'] === 'personalizada') {
        //     $imagem = $_FILES['imagem'];
        //     if ($imagem['error'] === UPLOAD_ERR_OK) {
        //         $nomeArquivo = uniqid() . '_' . $imagem['name'];
        //         $caminhoDestino = 'uploads/' . $nomeArquivo;

        //         if (!move_uploaded_file($imagem['tmp_name'], $caminhoDestino)) {
        //             $loginError = "Erro ao fazer o upload da imagem.";
        //             exit();
        //         }

        //     } else {
        //         $loginError = "Erro no carregamento da imagem: " . $imagem['error'];
        //     }
        //     $query = "UPDATE usuarios SET imagem = '$nomeArquivo' WHERE usuario = '$usuario'";
        // } else {
        //     $imagem = 'ghost/' . $_POST['img'] . '.png';
        //     $query = "UPDATE usuarios SET imagem = '$imagem' WHERE usuario = '$usuario'";
        // }
        // mysqli_stmt_execute(mysqli_prepare($connection, $query));

    } else {
        $loginError = "Por favor, preencha todos os campos.";
        exit();
    }
}



try {
    $usuario = $_SESSION['usuario'];
    $selectQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($connection, $selectQuery);

    if (mysqli_num_rows($result) > 0) {
        $userRow = mysqli_fetch_assoc($result);
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
        $_SESSION['cargo'] = $cargo;
    }

    // Consulta usuários
    $leaderboardQuery = "SELECT * FROM usuarios ORDER BY texkoins DESC LIMIT 10";
    $resultLeaderboard = mysqli_query($connection, $leaderboardQuery);

    // Consulta para obter o total de texkoins do setor do usuário logado
    $setorQuery = "SELECT total_texkoins
            FROM ranking_setores
            WHERE setor = '$setor'";
    $resultSetor = mysqli_query($connection, $setorQuery);

    if ($resultSetor && mysqli_num_rows($resultSetor) > 0) {
        $row = mysqli_fetch_assoc($resultSetor);
        $tkSetor = $row['total_texkoins'];
    } else {
        $tkSetor = 0;
    }

    // Consulta tabela setor
    $leaderboardSetorQuery = "SELECT setor, SUM(texkoins) AS total_texkoins
           FROM usuarios
           GROUP BY setor
           ORDER BY total_texkoins DESC";
    $resultSetor = mysqli_query($connection, $leaderboardSetorQuery);

} catch (Exception $e) {
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    exit();
}
?>


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
        body {
            background-color: #f5f5f5;
            background-image: url("data:image/svg+xml,%3Csvg width='180' height='180' viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M81.28 88H68.413l19.298 19.298L81.28 88zm2.107 0h13.226L90 107.838 83.387 88zm15.334 0h12.866l-19.298 19.298L98.72 88zm-32.927-2.207L73.586 78h32.827l.5.5 7.294 7.293L115.414 87l-24.707 24.707-.707.707L64.586 87l1.207-1.207zm2.62.207L74 80.414 79.586 86H68.414zm16 0L90 80.414 95.586 86H84.414zm16 0L106 80.414 111.586 86h-11.172zm-8-6h11.173L98 85.586 92.414 80zM82 85.586L87.586 80H76.414L82 85.586zM17.414 0L.707 16.707 0 17.414V0h17.414zM4.28 0L0 12.838V0h4.28zm10.306 0L2.288 12.298 6.388 0h8.198zM180 17.414L162.586 0H180v17.414zM165.414 0l12.298 12.298L173.612 0h-8.198zM180 12.838L175.72 0H180v12.838zM0 163h16.413l.5.5 7.294 7.293L25.414 172l-8 8H0v-17zm0 10h6.613l-2.334 7H0v-7zm14.586 7l7-7H8.72l-2.333 7h8.2zM0 165.414L5.586 171H0v-5.586zM10.414 171L16 165.414 21.586 171H10.414zm-8-6h11.172L8 170.586 2.414 165zM180 163h-16.413l-7.794 7.793-1.207 1.207 8 8H180v-17zm-14.586 17l-7-7h12.865l2.333 7h-8.2zM180 173h-6.613l2.334 7H180v-7zm-21.586-2l5.586-5.586 5.586 5.586h-11.172zM180 165.414L174.414 171H180v-5.586zm-8 5.172l5.586-5.586h-11.172l5.586 5.586zM152.933 25.653l1.414 1.414-33.94 33.942-1.416-1.416 33.943-33.94zm1.414 127.28l-1.414 1.414-33.942-33.94 1.416-1.416 33.94 33.943zm-127.28 1.414l-1.414-1.414 33.94-33.942 1.416 1.416-33.943 33.94zm-1.414-127.28l1.414-1.414 33.942 33.94-1.416 1.416-33.94-33.943zM0 85c2.21 0 4 1.79 4 4s-1.79 4-4 4v-8zm180 0c-2.21 0-4 1.79-4 4s1.79 4 4 4v-8zM94 0c0 2.21-1.79 4-4 4s-4-1.79-4-4h8zm0 180c0-2.21-1.79-4-4-4s-4 1.79-4 4h8z' fill='%231d1924' fill-opacity='0.06' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .setor-t {
            padding-left: 20px;
        }

        .info {
            padding-bottom: 0px !important;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="position-absolute w-100 min-height-100 top-0"
        style="background-image: url('fundo-pattern.png'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    <?php include 'php/aside.php' ?>
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
                                            <input id="primeiro_nome" name="primeiro_nome" class="form-control"
                                                type="text" value="<?php echo $primeiro_nome ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">segundo
                                                nome</label>
                                            <input class="form-control" id="segundo_nome" name="segundo_nome"
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
                                                <option>Alianças</option>
                                                <option>Administrativo</option>
                                                <option>Comercial</option>
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
                                            <?php echo $tkSetor ?>
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
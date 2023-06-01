<!-- php
$pag_id = 'inicio';
session_start();
require_once "php/funcoes.php";
require_once "php/conecta_db.php";
requireLogin();

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
    }

    // Consulta users
    $leaderboardQuery = "SELECT rank, nome, texkoins, setor, imagem
    FROM ranking_usuarios
    ORDER BY rank
    LIMIT 10";
    $result = mysqli_query($connection, $leaderboardQuery);

    // Consulta tabela setor
    $leaderboardSetorQuery = "SELECT *, RANK() OVER (ORDER BY total_texkoins DESC) AS rank FROM leaderboard_setor_view";
    $resultSetor = mysqli_query($connection, $leaderboardSetorQuery);

    $setorQuery = "SELECT total_texkoins FROM leaderboard_setor_view WHERE setor = ?";
    $stmt = mysqli_prepare($connection, $setorQuery);
    mysqli_stmt_bind_param($stmt, 's', $setor);
    mysqli_stmt_execute($stmt);
    $setorResult = mysqli_stmt_get_result($stmt);
    $setorRow = mysqli_fetch_assoc($setorResult);
    $totalTexkoins = $setorRow['total_texkoins'];

} catch (Exception $e) {
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    exit();
}
-->

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
    <script src="assets/css/fa.js"> </script>
    <script src="assets/js/aside.js"> </script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

    <style>
        .ouro {
            font-size: 30px;
        }

        .prata {
            font-size: 26px;
        }

        .bronze {
            font-size: 23px;
        }

        @media (max-width: 767px) {
            .pad-mob {
                padding: 0px !important;
            }
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <?php include 'php/aside.php' ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php include 'php/navbar.php' ?>
        <div class="container-fluid py-0 px-0">
            <div class="row justify-content-center px-3">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">TEXKOINS</p>
                                        <h5 class="font-weight-bolder">
                                            <?php echo $texkoins ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-spaceship text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">REAIS</p>
                                        <h5 class="font-weight-bolder">
                                            R$
                                            <?php echo $real ?>,00
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Seu setor</p>
                                        <h5 class="font-weight-bolder">
                                            <?php echo $totalTexkoins ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-building text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">em circulação</p>
                                        <h5 class="font-weight-bolder">
                                            2.35
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--TABELA-->

            <div class="container mx-0 mt-4 px-3">
                <div class="row px-0">
                    <div class="col-12 col-sm-7 px-0">
                        <div class="row mx-auto table-responsive px-0">
                            <div class="col table-responsive pad-mob">
                                <div class="card table-responsive mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Classificação pessoal</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Rank
                                                        </th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Nome</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Texkoins
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $medalhas = array("<span class='ouro'>🥇</span>", "<span class='prata'>🥈</span>", "<span class='bronze'>🥉</span>");
                                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <?php
                                                                $rank = $row['rank'];
                                                                if ($rank <= 3) {
                                                                    echo $medalhas[$rank - 1]; // Subtrai 1 do rank para obter o índice correto no array
                                                                } else {
                                                                    echo $rank;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div>
                                                                        <?php
                                                                        $imagem = $row['imagem'];
                                                                        if (!empty($imagem) && file_exists("uploads/" . $imagem)) {
                                                                            echo '<img class="avatar avatar-sm me-3" src="uploads/' . $imagem . '">';
                                                                        } else {
                                                                            echo '<img class="avatar avatar-sm me-3" src="uploads/"">';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">
                                                                            <?php echo $row['nome']; ?>
                                                                        </h6>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <?php echo $row['setor']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="text-secondary text-xl font-weight-bold">
                                                                    <?php echo $row['texkoins']; ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0">
                        <div class="row mx-auto">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Classificação por setor</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Rank
                                                        </th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Setor</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Texkoins
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $medalhas = array("<span class='ouro'>🥇</span>", "<span class='prata'>🥈</span>", "<span class='bronze'>🥉</span>");
                                                    while ($row = mysqli_fetch_assoc($resultSetor)) { ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <?php
                                                                $rank = $row['rank'];
                                                                if ($rank <= 3) {
                                                                    echo $medalhas[$rank - 1]; // Subtrai 1 do rank para obter o índice correto no array
                                                                } else {
                                                                    echo $rank;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">
                                                                            <?php echo $row['setor']; ?>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold">
                                                                    <?php echo $row['total_texkoins']; ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elemento = document.querySelector('.nav-link.b-<?php echo $pag_id ?>');
            if (elemento) {
                elemento.classList.add('active');
            }
        });</script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
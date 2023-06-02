<?php
$pag_id = 'inicio';
session_start();
require_once "php/funcoes.php";
require_once "php/conecta_db.php";
# requireLogin();

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
        $tkSetor = 0; // Valor padrão caso não haja resultados
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
    <script src="https://kit.fontawesome.com/4619b7f556.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

    <style>
        body {
            background-color: #f5f5f5;
            background-image: url("data:image/svg+xml,%3Csvg width='180' height='180' viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M81.28 88H68.413l19.298 19.298L81.28 88zm2.107 0h13.226L90 107.838 83.387 88zm15.334 0h12.866l-19.298 19.298L98.72 88zm-32.927-2.207L73.586 78h32.827l.5.5 7.294 7.293L115.414 87l-24.707 24.707-.707.707L64.586 87l1.207-1.207zm2.62.207L74 80.414 79.586 86H68.414zm16 0L90 80.414 95.586 86H84.414zm16 0L106 80.414 111.586 86h-11.172zm-8-6h11.173L98 85.586 92.414 80zM82 85.586L87.586 80H76.414L82 85.586zM17.414 0L.707 16.707 0 17.414V0h17.414zM4.28 0L0 12.838V0h4.28zm10.306 0L2.288 12.298 6.388 0h8.198zM180 17.414L162.586 0H180v17.414zM165.414 0l12.298 12.298L173.612 0h-8.198zM180 12.838L175.72 0H180v12.838zM0 163h16.413l.5.5 7.294 7.293L25.414 172l-8 8H0v-17zm0 10h6.613l-2.334 7H0v-7zm14.586 7l7-7H8.72l-2.333 7h8.2zM0 165.414L5.586 171H0v-5.586zM10.414 171L16 165.414 21.586 171H10.414zm-8-6h11.172L8 170.586 2.414 165zM180 163h-16.413l-7.794 7.793-1.207 1.207 8 8H180v-17zm-14.586 17l-7-7h12.865l2.333 7h-8.2zM180 173h-6.613l2.334 7H180v-7zm-21.586-2l5.586-5.586 5.586 5.586h-11.172zM180 165.414L174.414 171H180v-5.586zm-8 5.172l5.586-5.586h-11.172l5.586 5.586zM152.933 25.653l1.414 1.414-33.94 33.942-1.416-1.416 33.943-33.94zm1.414 127.28l-1.414 1.414-33.942-33.94 1.416-1.416 33.94 33.943zm-127.28 1.414l-1.414-1.414 33.94-33.942 1.416 1.416-33.943 33.94zm-1.414-127.28l1.414-1.414 33.942 33.94-1.416 1.416-33.94-33.943zM0 85c2.21 0 4 1.79 4 4s-1.79 4-4 4v-8zm180 0c-2.21 0-4 1.79-4 4s1.79 4 4 4v-8zM94 0c0 2.21-1.79 4-4 4s-4-1.79-4-4h8zm0 180c0-2.21-1.79-4-4-4s-4 1.79-4 4h8z' fill='%231d1924' fill-opacity='0.06' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

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
    <div class="min-height-300 bg-primary position-absolute w-100"
        style="background-image: url('fundo-pattern.png'); background-position-y: 50%;"></div>
    <?php include 'php/aside.php' ?>
    <main class="main-content position-relative border-radius-lg ">
        <?php include 'php/navbar.php' ?>
        <div class="container-fluid py-0">
            <div class="row justify-content-center px-">
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
                                            <?php echo $tkSetor ?>
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
                                        class="icon icon-shape bg-gradient-warning shadow-success text-center rounded-circle">
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
                                                    $rank = 1;

                                                    while ($row = mysqli_fetch_assoc($resultLeaderboard)) {
                                                        echo '<tr>';
                                                        echo '<td class="text-center">';
                                                        if ($rank <= 3) {
                                                            echo $medalhas[$rank - 1];
                                                        } else {
                                                            echo $rank;
                                                        }
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo '<div class="d-flex px-2 py-1">';
                                                        echo '<div>';

                                                        $imagem = $row['imagem'];
                                                        if (!empty($imagem) && file_exists("uploads/" . $imagem)) {
                                                            echo '<img class="avatar avatar-sm me-3" src="uploads/' . $imagem . '">';
                                                        } else {
                                                            echo '<img class="avatar avatar-sm me-3" src="uploads/placeholder.png">';
                                                        }

                                                        echo '</div>';
                                                        echo '<div class="d-flex flex-column justify-content-center">';
                                                        echo '<h6 class="mb-0 text-sm">' . $row['primeiro_nome'] . ' ' . $row['segundo_nome'] . '</h6>';
                                                        echo '<p class="text-xs text-secondary mb-0">' . $row['setor'] . '</p>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</td>';
                                                        echo '<td class="align-middle text-center">';
                                                        echo '<span class="text-secondary text-xl font-weight-bold">' . $row['texkoins'] . '</span>';
                                                        echo '</td>';
                                                        echo '</tr>';

                                                        $rank++;
                                                    }
                                                    ?>
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
                                                            Rank</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Setor</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Texkoins</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $medalhas = array("<span class='ouro'>🥇</span>", "<span class='prata'>🥈</span>", "<span class='bronze'>🥉</span>");
                                                    $rank = 1;

                                                    while ($row = mysqli_fetch_assoc($resultSetor)) {
                                                        echo '<tr>';
                                                        echo '<td class="text-center">';
                                                        if ($rank <= 3) {
                                                            echo $medalhas[$rank - 1];
                                                        } else {
                                                            echo $rank;
                                                        }
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo '<div class="d-flex px-2 py-1">';
                                                        echo '<div class="d-flex flex-column justify-content-center">';
                                                        echo '<h6 class="mb-0 text-sm">' . $row['setor'] . '</h6>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</td>';
                                                        echo '<td class="align-middle text-center">';
                                                        echo '<span class="text-secondary text-xs font-weight-bold">' . $row['total_texkoins'] . '</span>';
                                                        echo '</td>';
                                                        echo '</tr>';

                                                        $rank++;
                                                    }
                                                    ?>
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
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>
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
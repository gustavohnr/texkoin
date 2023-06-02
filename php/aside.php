<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-footer mx-3 my-3">
        <div class="d-flex px-2 py-1">
            <div>
                <img class="avatar avatar-sm me-3" src="uploads/<?php echo $imagem ?>">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm"><?php echo $primeiro_nome?>
                </h6>
                <p class="text-xs text-secondary mb-0 underline">
                    <a href='perfil.php'><u>meu perfil</u><a>
                </p>
            </div>
        </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link b-inicio" href="dashboard.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-spaceship text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Início</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link b-ranking" href="dashboard.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-line-chart text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ranking</span>
                </a>
            </li>
            <hr class="horizontal dark mt-0">
            <li class="nav-item">
                <a class="nav-link b-loja" href="perfil.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Loja</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link b-comousar" href="perfil.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-question-circle text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Como usar</span>
                </a>
            </li>
            <hr class="horizontal dark mt-1 mb-1">
            <li class="nav-item">
                <a class="nav-link b-transferencia" href="perfil.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-exchange text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transferência</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link b-extrato" href="perfil.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-calendar text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Extrato</span>
                </a>
            </li>
        </ul>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="sidenav-header d-flex position-absolute pb-0 px-3 mx-auto w-100 justify-content-center text-align-center" style="bottom: 0;">
        <div class="my-auto">
        <i class="fas fa-times cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="px-3 " target="_blank">
            <img src="assets/images/tltx-logo-roxo-t.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"></span>
        </a>
        </div>
    </div>
</aside>
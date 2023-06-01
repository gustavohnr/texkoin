<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ldapServer = "ldap://cta-dc2.teletex.com.br";
    $ldapUser = $_POST['usuario'];
    $ldapPass = $_POST['senha'];

    $ldapConn = ldap_connect($ldapServer);
    ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
    
    if (ldap_bind($ldapConn, $ldapUser.'@teletex.com.br', $ldapPass)) {
        // Autenticação bem-sucedida
        $_SESSION['usuario'] = $_POST['usuario'];
        echo "Autenticação no AD -> OK<br>";

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

        // Preparar os dados para inserção na tabela
        $usuario = $_POST['usuario'];

        // Verificar se o usuário já existe na tabela
        $checkUserQuery = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $checkUserResult = $conn->query($checkUserQuery);

        if ($checkUserResult->num_rows > 0) {
            echo "Usuário já existe na tabela<br>";
            $userRow = $checkUserResult->fetch_assoc();
            $nome = $userRow['nome'];

            if ($nome == '') {
                header("Location: registro.php");
                exit();
            } else {
                header("Location: home.php");
                exit();
            }
        } else {
            $insertQuery = "INSERT INTO usuarios (usuario, nome, texkoins) VALUES ('$usuario', '', 0)";
            if ($conn->query($insertQuery) === TRUE) {
                header("Location: registro.php");
                exit();
            } else {
                echo "Erro ao registrar o usuário: " . $conn->error;
            }
        }
        $conn->close();
    } else {
        echo "Autenticação no AD -> ERRO<br>";
    }
    ldap_close($ldapConn);
}
?>

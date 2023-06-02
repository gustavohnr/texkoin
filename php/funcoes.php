<?php
function autenticarAD($ldapUser, $ldapPass)
{   
    if ($ldapUser === 'gustavo.henrique' && $ldapPass === '12345' || $ldapUser === 'joao.canudo' && $ldapPass === '12345' 
    || $ldapUser === 'felipe.ele' && $ldapPass === 'eh_gay' || $ldapUser === 'test.user' && $ldapPass === '123'){
        return true;
    }
    // $ldapServer = "ldap://cta-dc2.t;eletex.com.br";
    // $ldapConn = ldap_connect($ldapServer); 
    // ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
    // ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);
    // ldap_set_option($ldapConn, LDAP_OPT_NETWORK_TIMEOUT, 10);

    // if (@ldap_bind($ldapConn, $ldapUser . '@teletex.com.br', $ldapPass)) {
    //     echo "Autenticação no servidor LDAP bem-sucedida.";
    //     exit();
    //     ldap_close($ldapConn);
    //     return true;
    // }
    
}

function requireLogin()
{
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }
}
?>
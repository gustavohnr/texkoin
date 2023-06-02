<?php
function autenticarAD($ldapUser, $ldapPass)
{
    $ldapServer = "ldap://cta-dc2.teletex.com.br";
    $ldapConn = ldap_connect($ldapServer);
    ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ldapConn, LDAP_OPT_NETWORK_TIMEOUT, 10);

    if (@ldap_bind($ldapConn, $ldapUser . '@teletex.com.br', $ldapPass)) {
        ldap_close($ldapConn);
        return true;
    }
}

function requireLogin()
{
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }
}
?>
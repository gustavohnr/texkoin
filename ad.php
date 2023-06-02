<?php
$ldapServer = "ldap://cta-dc2.teletex.com.br";
$ldapConn = ldap_connect($ldapServer);
echo '1';
exit();
if ($ldapConn) {
    echo "Conexão com o servidor LDAP estabelecida com sucesso.";
    exit();
} else {
    echo "Erro ao conectar ao servidor LDAP: " . ldap_error($ldapConn);
    exit();
}   
echo '2';
exit();

$ldapUser = 'gustavo.henrique@teletex.com.br'; 
$ldapPass = 'Br0k3n4rr0ws';

echo 'c';
exit();

ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ldapConn, LDAP_OPT_NETWORK_TIMEOUT, 10);

if (@ldap_bind($ldapConn, $ldapUser . '@teletex.com.br', $ldapPass)) {
    echo "Autenticação no servidor LDAP bem-sucedida.";
    exit();
    ldap_close($ldapConn);
    return true;
} else {
    echo "Erro ao autenticar no servidor LDAP: " . ldap_error($ldapConn);
    exit();
}
?>
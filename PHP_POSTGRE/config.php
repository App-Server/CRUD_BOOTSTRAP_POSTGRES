<?php

$host = '';
$port = ''; // Porta padrão do PostgreSQL
$dbname = '';
$user = '';
$password = '';

// Estabelecer conexão
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    // Definir para que o PDO lance exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida";
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}

?>
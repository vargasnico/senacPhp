<?php
// Os dados de acesso vêm de variáveis de ambiente (definidas no docker-compose.yml),
// com os padrões do XAMPP como alternativa para rodar localmente.
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASSWORD') ?: '';
$banco = getenv('DB_NAME') ?: 'site_senac';

// Faz o mysqli lançar exceções em vez de falhar silenciosamente.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
	$conn = new mysqli($host, $user, $senha, $banco);
	$conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
	// O detalhe do erro vai para o log do servidor, nunca para a página.
	error_log('Falha na conexão com o banco: ' . $e->getMessage());
	http_response_code(500);
	die('Serviço indisponível no momento. Tente novamente mais tarde.');
}

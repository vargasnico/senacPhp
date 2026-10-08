<?php
include('conexao.php');

if (!isset($_POST['entrar'])) {
	header('Location: login.php');
	exit;
}

$nome = $_POST['nome'] ?? '';
$senha = $_POST['senha'] ?? '';

// Prepared statement: o valor digitado nunca é interpretado como SQL.
$stmt = $conn->prepare('SELECT nome, senha FROM cadastro WHERE nome = ?');
$stmt->bind_param('s', $nome);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if ($usuario === null || !password_verify($senha, $usuario['senha'])) {
	echo "<script>
	alert('Usuário ou senha incorretos!');
	window.location.href='login.php';
	</script>";
	exit;
}

session_start();
// Gera um novo ID de sessão no login para evitar fixação de sessão.
session_regenerate_id(true);
$_SESSION['nome_usu_sessao'] = $usuario['nome'];
header('Location: ../index.php');
exit;

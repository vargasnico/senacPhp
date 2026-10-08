<?php
include('conexao.php');

$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$estado = $_POST['estado'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$email = $_POST['email'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? '';

// password_hash gera um hash com salt (bcrypt), ao contrário do MD5.
$hash = password_hash($senha, PASSWORD_DEFAULT);

try {
	$stmt = $conn->prepare(
		'INSERT INTO cadastro (nome, email, telefone, cidade, cpf, estado, senha)
		VALUES (?, ?, ?, ?, ?, ?, ?)'
	);
	$stmt->bind_param('sssssss', $nome, $email, $telefone, $cidade, $cpf, $estado, $hash);
	$stmt->execute();
	$stmt->close();
	$mensagem = 'Cadastro realizado com sucesso!';
} catch (mysqli_sql_exception $e) {
	error_log('Erro ao cadastrar: ' . $e->getMessage());
	// 1062 = violação de chave única (nome, e-mail ou CPF já cadastrado).
	$mensagem = $e->getCode() === 1062
		? 'Já existe um cadastro com esse nome, e-mail ou CPF.'
		: 'Não foi possível realizar o cadastro.';
}
$conn->close();

echo "<script>
alert(" . json_encode($mensagem) . ");
window.location.href='cadastro.php';
</script>";

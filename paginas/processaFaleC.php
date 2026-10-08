<?php
include('conexao.php');
include('pessoa.class.php');

$nome = $_POST['nome'] ?? '';
$estado = $_POST['estado'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$email = $_POST['email'] ?? '';
$confirmaemail = $_POST['confirmaemail'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$modalidade = $_POST['modalidade'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$assunto = $_POST['assunto'] ?? '';
$msg = trim($_POST['msg'] ?? '');

if ($email !== $confirmaemail) {
	echo "<script>
	alert('Os e-mails informados não conferem.');
	history.back();
	</script>";
	exit;
}

$a = new Pessoa();
$a->setnome($nome);
$a->setemail($email);
$a->setconfirmaemail($confirmaemail);
$a->settelefone($telefone);
$a->setcidade($cidade);
$a->setestado($estado);
$a->setmodalidade($modalidade);
$a->setcpf($cpf);
$a->setmsg($msg);
$a->setassunto($assunto);

$campos = [
	$a->getnome(),
	$a->getestado(),
	$a->getcidade(),
	$a->getemail(),
	$a->getconfirmaemail(),
	$a->gettelefone(),
	$a->getmodalidade(),
	$a->getcpf(),
	$a->getmsg(),
	$a->getassunto(),
];

try {
	$stmt = $conn->prepare(
		'INSERT INTO faleconosco
		(nome, estado, cidade, email, confirmaemail, telefone, modalidade, cpf, mensagem, assunto)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
	);
	$stmt->bind_param('ssssssssss', ...$campos);
	$stmt->execute();
	$stmt->close();
	$mensagem = 'Mensagem enviada com sucesso!';
} catch (mysqli_sql_exception $e) {
	error_log('Erro ao salvar fale conosco: ' . $e->getMessage());
	$mensagem = 'Não foi possível enviar a mensagem.';
}
$conn->close();

echo "<script>
alert(" . json_encode($mensagem) . ");
window.location.href='../index.php';
</script>";

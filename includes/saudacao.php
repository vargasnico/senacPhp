<?php
// Saudação do cabeçalho, compartilhada por todas as páginas.
// Espera $raiz com o caminho da página até a raiz do site ('./' ou '../').
if (isset($_SESSION['nome_usu_sessao'])) {
	// Escapa o nome para que um cadastro com HTML/JS no nome não seja executado (XSS).
	$nomeUsuario = htmlspecialchars($_SESSION['nome_usu_sessao'], ENT_QUOTES, 'UTF-8');
	echo "Olá $nomeUsuario, tudo certo? Seja bem-vindo! <a href='{$raiz}paginas/logout.php'>Sair</a>";
} else {
	echo "<a href='{$raiz}paginas/login.php'>Logar</a>";
}

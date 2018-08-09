<?php 

require_once("Autoload.php");

$count = rand(0, 1000);

/**
 * Inserção
 */
$user = new User("abn-$count", "pwd-$count");
$userDAO = new UserDAO();

$id = -1;

try {
	$id = $userDAO->insert($user);
	echo "Sucesso na criação de um usuário - ID: $id";
} catch(Exception $e) {
	$message = $e->getMessage();
	echo "$message";
}

echo "<hr />";

/**
 * Autenticação
 */
try {
	$user = $userDAO->getByUsernamePassword("abn-$count", "pwd-$count");
	$id = $user->getId();
	echo "Sucesso na autenticação de um usuário - ID: $id";
} catch(Exception $e) {
	$message = $e->getMessage();
	echo "$message";
}

echo "<hr />";

/**
 * Atualização
 */
$userToUpdate = new User("abn-modified-$count", "pwd-modified-$count"); 

try {
	$id = $userDAO->update($id, $userToUpdate);
	echo "Sucesso na atualização de um usuário - ID: $id";
} catch(Exception $e) {
	$message = $e->getMessage();
	echo "$message";
}

echo "<hr />";

/**
 * Remoção
 */
try {
	$id = $userDAO->delete($id);
	echo "Sucesso na remoção de um usuário - ID: $id";
} catch(Exception $e) {
	$message = $e->getMessage();
	echo "$message";
}
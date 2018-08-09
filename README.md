Esse projeto foi criado com objetivo de implementar um CRUD simples com PHP 7 e MySQL.
O guia abaixo apresenta os pré-requisitos bem como a sequência de passos para visualização dos outputs da implementação.


# Pre-requisitos
	Instalação e inicialização
	  - Servidor local
	  - MySQL

# Clonando o repositório
	Abra o terminal
	  - git clone https://github.com/alexandreBN/php7-crud.git
	  - cp php7-crud /path/local/server -r && cd /path/local/server/php7-crud

# Criando o schema
	CREATE SCHEMA `abnphp` ;

# Criando a tabela principal
	use abnphp;

	CREATE TABLE tb_users (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(64) NOT NULL UNIQUE,
		passwd VARCHAR(128) NOT NULL,
		dt_register TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
	);

# Acessando o projeto
	Abra o browser e acesse
	  localhost/php7-crud

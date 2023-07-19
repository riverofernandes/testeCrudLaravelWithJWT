Este arquivo contém instruções para executar e usar um aplicativo que utiliza autenticação JWT e permite a criação, recuperação, atualização e exclusão de produtos.

Configuração
Certifique-se de ter o PHP instalado em seu sistema.
Clone o repositório do projeto.
 
dentro do repositório rode contem arquivo para o docker use o seguinte comando
./vendor/bin/sail up
ou 
sail up

No diretório do projeto, execute o seguinte comando para gerar uma chave secreta para o JWT funcionar:

php artisan jwt:secret

Criação de Usuário
No diretório do projeto, execute o seguinte comando para iniciar o Tinker:

php artisan tinker
Para criar um novo usuário de exemplo, execute o seguinte comando dentro do Tinker:

User::factory()->create();
Exemplo de resposta:

{
    "name": "Charlotte Bahringer",
    "email": "srippin@example.com",
    "email_verified_at": "2023-07-19 16:55:19",
    "updated_at": "2023-07-19 16:55:19",
    "created_at": "2023-07-19 16:55:19",
    "id": 2
}
Por padrão, a senha do usuário é 'password'. Para fazer login, use as seguintes credenciais:

Email: "srippin@example.com"
Senha: "password"
Rotas
Login
Endpoint: POST localhost/api/login

Envie as credenciais do usuário (email e senha) para autenticar e obter o token JWT necessário para as outras operações.

Obter todos os produtos
Endpoint: GET localhost/api/products

Este endpoint retorna todos os produtos criados.

Criar um novo produto
Endpoint: POST localhost/api/products

Para criar um novo produto, envie uma solicitação POST com os seguintes campos obrigatórios:

name: (string) Nome do produto.
description: (string) Descrição do produto.
Obter um produto específico
Endpoint: GET localhost/api/products/{id do produto}

Este endpoint retorna as informações de um produto específico com base no ID fornecido.

Exemplo de resultado:

{
    "id": 1,
    "name": "teste",
    "description": "description teste",
    "created_at": "2023-07-19T16:14:38.000000Z",
    "updated_at": "2023-07-19T16:14:38.000000Z"
}
Atualizar um produto
Endpoint: PUT localhost/api/products/{id do produto}

Para atualizar um produto existente, envie uma solicitação PUT com o ID do produto e os campos que deseja atualizar. Exemplo:

{
    "name": "teste1",
    "description": "teste1"
}
Excluir um produto
Endpoint: DELETE localhost/api/products/{id do produto}

Este endpoint exclui o produto com o ID fornecido.

Certifique-se de substituir {id do produto} pelo ID real do produto que você deseja acessar, atualizar ou excluir.

Observação: Todos os endpoints acima requerem autenticação com o token JWT obtido no endpoint de login. Certifique-se de incluir o token nos cabeçalhos das solicitações.
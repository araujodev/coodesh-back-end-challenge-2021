## Coodesh Back-end Challenge 2021 - Leandro Araujo

Projeto destinado ao desafio back-end do portal Coodesh utilizndo Laravel 8.

Repositório Referência: [LAB COODESH - Public Challenge 2021](https://lab.coodesh.com/public-challenges/back-end-challenge-2021).

## Especificações

- Laravel 8
- MySQL

## Instalação

1. Fazer uma cópia do arquivo `.env.example` e renomear para `.env`.
2. Gerar a chave da aplicação para garantir uma segurança adicional, para isso execute: `php artisan key:generate`.
3. Edite as variáveis de ambiente respectivas a conexão do banco dados para executar as migrations.
4. Como optamos por utilizar o `QUEUE_CONNECTION` como `database`, precisamos criar as devidas tabelas. Para isso rode os comandos: `php artisan queue:table` e `php artisan migrate`.
5. Rodar o projeto com `php artisan serve --port=8000`.
6. Para criar uma API KEY valida execute `php artisan apikey:generate`. Essa chave deve ser utilizada para realizar a autentiacação nos endpoints REST.
7. Importar os usuários com o comando `php artisan user:import`.
8. Consumir os endpoints especificados em `routes/resources/users.php`.
9. (opcional) Rodar a suite de testes de `Feature` e `Unit`.

## Funcionamento

Para que seja possível editar, remover ou listar os usuários anteriormente você deve rodar o 
comando para importar os usuários da API: Random User. 

O banco foi separado em 3 entidades (User, Location e Access), onde:
- User: Corresponde a entidade com os dados relativos ao usuario como nome, sobrenome.
- Location: Entidade para armazenar os dados de localização e endereço do usuário. 
- Access: Entidade responsável por relacionar os dados de login, username, uuid e demais informações de acesso.

## Informações sobre o Desenvolvedor

Nome: Leandro de Souza Araujo

Email: leandro.souara.web@gmail.com

Telefone: +55 67 99160-4334

**Challenge by coodesh**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Coodesh Back-end Challenge 2021 - Leandro Araujo

Projeto destinado ao desafio back-end do portal Coodesh utilizndo Laravel 8.

Repositório Referência: [LAB COODESH - Public Challenge 2021](https://lab.coodesh.com/public-challenges/back-end-challenge-2021).

## Especificações

- Laravel 8
- MySQL

## Instalação

0. Clonar o projeto e rodar `composer install`.
1. Fazer uma cópia do arquivo `.env.example` e renomear para `.env`.
2. Gerar a chave da aplicação para garantir uma segurança adicional, para isso execute: `php artisan key:generate`.
3. Edite as variáveis de ambiente respectivas a conexão do banco dados para executar as migrations.
4. Como optamos por utilizar o `QUEUE_CONNECTION` como `database`, precisamos rodar o comando `php artisan migrate` para criar as tabelas de jobs e das entidades do nosso software.
5. Rodar o projeto com `php artisan serve --port=8000`.
6. Para criar uma API KEY valida execute `php artisan apikey:generate`. Essa chave deve ser utilizada para realizar a autentiacação nos endpoints REST.
7. Importar os usuários com o comando `php artisan user:import`, caso necessário: `php artisan queue:work`.
8. Consumir os endpoints especificados em `routes/resources/users.php`.
9. (opcional) Rodar a suite de testes de `Feature` e `Unit`.

## Funcionamento

Para que seja possível editar, remover ou listar os usuários anteriormente você deve rodar o 
comando para importar os usuários da API: Random User. 

O banco foi separado em 3 entidades (User, Location e Access), onde:
- User: Corresponde a entidade com os dados relativos ao usuario como nome, sobrenome.
- Location: Entidade para armazenar os dados de localização e endereço do usuário. 
- Access: Entidade responsável por relacionar os dados de login, username, uuid e demais informações de acesso.

### Documentação Insomnia App (v4) - JSON
```JSON
{"_type":"export","__export_format":4,"__export_date":"2021-07-26T19:20:17.687Z","__export_source":"insomnia.desktop.app:v2021.4.1","resources":[{"_id":"req_a929d3cfb31d43049fb0244b69023c3d","parentId":"fld_467b95250db04679b6e0ad99906e857d","modified":1627060621803,"created":1627050914156,"url":"{{ _.base_uri }}/users/20","name":"Update User","description":"","method":"PUT","body":{"mimeType":"application/json","text":"{\n\t\n\t\"title_name\": \"Sr.\",\n\t\"gender\": \"female\",\n\t\"status\": \"published\"\n\t\n}"},"parameters":[],"headers":[{"id":"pair_ecfcec2872bf4cafbbc73fc8d292a7dc","name":"{{ _.api_key }}","value":"{{ _.api_key_value }}","description":""},{"name":"Content-Type","value":"application/json","id":"pair_03d92c0826d84f61a3dafd851bfc06e1"},{"id":"pair_6320d20986e946c4b6d32d32539ada15","name":"Accept","value":"application/json","description":""}],"authentication":{},"metaSortKey":-1627050914157,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"fld_467b95250db04679b6e0ad99906e857d","parentId":"wrk_b09c8425e00743899bd6df56790a4a2d","modified":1627050899730,"created":1627050899730,"name":"Users","description":"","environment":{},"environmentPropertyOrder":null,"metaSortKey":-1627050899730,"_type":"request_group"},{"_id":"wrk_b09c8425e00743899bd6df56790a4a2d","parentId":null,"modified":1627050255516,"created":1627050255516,"name":"Coodesh Challenge 2021","description":"","scope":"collection","_type":"workspace"},{"_id":"req_5cf6d1e3ed484f31a608969d9ef93d38","parentId":"fld_467b95250db04679b6e0ad99906e857d","modified":1627061023520,"created":1627051075380,"url":"{{ _.base_uri }}/users/1","name":"Delete User","description":"","method":"DELETE","body":{},"parameters":[],"headers":[{"id":"pair_ecfcec2872bf4cafbbc73fc8d292a7dc","name":"{{ _.api_key }}","value":"{{ _.api_key_value }}","description":""}],"authentication":{},"metaSortKey":-1627050766774,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_fd6cfc3e0ba64cb19cff6aab98eb4406","parentId":"fld_467b95250db04679b6e0ad99906e857d","modified":1627061034996,"created":1627051099615,"url":"{{ _.base_uri }}/users/10","name":"Get One User","description":"","method":"GET","body":{},"parameters":[],"headers":[{"id":"pair_ecfcec2872bf4cafbbc73fc8d292a7dc","name":"{{ _.api_key }}","value":"{{ _.api_key_value }}","description":""}],"authentication":{},"metaSortKey":-1627050693082.5,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_aaff44504a954be9ab8b24fae7437bb6","parentId":"fld_467b95250db04679b6e0ad99906e857d","modified":1627326963777,"created":1627051115955,"url":"{{ _.base_uri }}/users","name":"Get All Users","description":"","method":"GET","body":{},"parameters":[{"id":"pair_1e62dbba44e84d0c9d9e0038380c6c5f","name":"page","value":"1","description":""},{"id":"pair_b1606be62a644eeda1b31ea67b354499","name":"nat","value":"BR","description":"","disabled":true}],"headers":[{"id":"pair_ecfcec2872bf4cafbbc73fc8d292a7dc","name":"{{ _.api_key }}","value":"{{ _.api_key_value }}","description":"","disabled":false},{"id":"pair_ee0f4565a09445358c4f85fb9d33d3a4","name":"","value":"","description":""}],"authentication":{},"metaSortKey":-1627050656236.75,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"req_56af675972e84e7aa57063de6eb45c51","parentId":"wrk_b09c8425e00743899bd6df56790a4a2d","modified":1627051680009,"created":1627050619391,"url":"{{ _.base_uri }}/","name":"Check if is running","description":"","method":"GET","body":{},"parameters":[],"headers":[],"authentication":{},"metaSortKey":-1627050619391,"isPrivate":false,"settingStoreCookies":true,"settingSendCookies":true,"settingDisableRenderRequestBody":false,"settingEncodeUrl":true,"settingRebuildPath":true,"settingFollowRedirects":"global","_type":"request"},{"_id":"env_911f9d62bce6df1e6c21aece72b6f71a3d7a06e5","parentId":"wrk_b09c8425e00743899bd6df56790a4a2d","modified":1627050545392,"created":1627050255628,"name":"Base Environment","data":{},"dataPropertyOrder":{},"color":null,"isPrivate":false,"metaSortKey":1627050255628,"_type":"environment"},{"_id":"jar_911f9d62bce6df1e6c21aece72b6f71a3d7a06e5","parentId":"wrk_b09c8425e00743899bd6df56790a4a2d","modified":1627059056236,"created":1627050255640,"name":"Default Jar","cookies":[{"key":"XSRF-TOKEN","value":"eyJpdiI6IkVUN2t5U3g3QnBKdXN1dGVXZTVrRXc9PSIsInZhbHVlIjoiYk9rRjQwWGYwMm11V1o1c0NkT1dLaDlzZHYyb3duUGdSQ1lYOUhFMEVNT3ZqdmJIZmJWbHZnWCthdWI0NlltME1WTjg0Y1lKcEpKV2RXcS92RVlhMlc0MVF4QWZ6UmtLTE9vZXk5dFdIeHc0SUt3RVZjSXA4YTh2bUVWNUYyYWYiLCJtYWMiOiI2ZTRmODFmNTkzZmE5NWE1NDQxZGNiMDA0MGYxZTAyNTgwMjRlMjAyYTU2ZTI1NDdkM2U4M2E4ODY0MGE0MDZkIn0%3D","expires":"2021-07-23T18:50:56.000Z","maxAge":7200,"domain":"localhost","path":"/","extensions":["samesite=lax"],"hostOnly":true,"creation":"2021-07-23T16:50:56.234Z","lastAccessed":"2021-07-23T16:50:56.234Z","id":"8025637704228983"},{"key":"pharmainc_session","value":"eyJpdiI6Im1FODd2MmFuMnJ3ZWRMNEtrM2FJMXc9PSIsInZhbHVlIjoiSVlONTJkMkhScC9OVGkwcTUyWElyL1NjZEJ6a0F4YWp3UTY0aG5EUDdrL1NNSStSTndjS3BmUEdmcVBkSDczblhZT2cxTU5FVDR6bVZmaXJrUndXZlZMSVE1SHB3OW0rVVN2MURQVlYyU3A2d2dYdDg4clR4WkY0OWdzaThYQkIiLCJtYWMiOiJlM2VjZDU2ZGM1MDk0ZTc5NjU3YzAxODNmZDExMzE1MTAwNjYwOTA0YTgwNTYwNjA5YjQ0MjVmYjZlNjU1ZTMxIn0%3D","expires":"2021-07-23T18:50:56.000Z","maxAge":7200,"domain":"localhost","path":"/","httpOnly":true,"extensions":["samesite=lax"],"hostOnly":true,"creation":"2021-07-23T16:50:56.235Z","lastAccessed":"2021-07-23T16:50:56.235Z","id":"46931726144410235"}],"_type":"cookie_jar"},{"_id":"spc_514b3021646e4d53811a63eaae6f56b9","parentId":"wrk_b09c8425e00743899bd6df56790a4a2d","modified":1627050255524,"created":1627050255524,"fileName":"Coodesh Challenge 2021","contents":"","contentType":"yaml","_type":"api_spec"},{"_id":"env_29710f9c09414c1b8ce3f6a61a798df1","parentId":"env_911f9d62bce6df1e6c21aece72b6f71a3d7a06e5","modified":1627326976301,"created":1627050534557,"name":"Local","data":{"environment_name":"local","base_uri":"http://localhost:8000/api","api_key":"integrator","api_key_value":"721405eb67f6f7e0a316a6b69a27d03c91803224"},"dataPropertyOrder":{"&":["environment_name","base_uri","api_key","api_key_value"]},"color":"#00ffb3","isPrivate":false,"metaSortKey":1627050534557,"_type":"environment"}]}
```

## Informações sobre o Desenvolvedor

Nome: Leandro de Souza Araujo

Email: leandro.souara.web@gmail.com

Telefone: +55 67 99160-4334

**Challenge by coodesh**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

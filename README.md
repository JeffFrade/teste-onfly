# Teste Onfly
---

Para o desenvolvimento desse teste foi utilizado o framework `Laravel` em sua versão 11 e o projeto inteiro foi desenvolvido sobre o `Docker`.

O projeto contempla os seguintes containers:

- `PHP`: Utilizando o php-fpm em sua versão `8.4`.
- `MySQL`: Utilizando sua versão `8`.
- `nginx`: Utilizando sua versão `1.25`.

O projeto também possui suporte a suíte de testes. (Ver o tópico de testes).

### Executar o Projeto
---

Para executar o projeto, basta executar o comando `sh config.sh`, pois ele já tem todos os passos necessários para colocar a aplicação de pé, incluindo massa de dados para teste. (A aplicação está configurada para rodar em `localhost:8000`).

### Login na API
---

Para logar na API, as credenciais são `admin@mail.com` (E-mail), `123` (Senha) e os dados de `client_id` e `client_secret` (Estão na tabela `users`).

Ou caso prefira, na raiz do projeto há um arquivo `Onfly.postman_collection.json` que contém todos os endpoints que a `API` possui e como efetuar o login na mesma.

### Testes
---

Para executar a bateria de testes que vem com o coverage, basta executar `sh coverage.sh` e será gerado arquivos dentro de `coverage`, há um arquivo `index.html` dentro dessa pasta, basta o abrir em qualquer navegador e haverá o coverage do projeto.

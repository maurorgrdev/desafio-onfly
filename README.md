<p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://i.imgur.com/6wj0hh6.jpg" alt="Project logo"></a>
</p>

<h3 align="center">Desafio Onfly - Despesas</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()

</div>

---

<p align="center"> Projeto desenvolvido para o desafio da Onfly que consiste no cadastro, edição, visualização e exclusão de despesas.
    <br> 
</p>

## 📝 Índice

- [Getting Started](#getting_started)
- [Authors](#authors)


## 🏁 Getting Started <a name = "getting_started"></a>

Instruções para ter uma cópia do repositório.

### Pré-requisitos

-   **PHP - Supported Versions:** >= 7.3 <= 8.0
-   **Laravel - 8
-   **Run-time environment:**:  Composer, Laravel Framework, npm & Quasar Framework

### Instalação

- Clone

O repositório onde se encontra o código fonte da aplicação está na branch **master**. Logo:

```bash
$ git clone https://github.com/maurorgrdev/desafio-onfly.git
$ cd desafio-onfly
$ git checkout master
```

-   **Back-end**

Estas ações devem ser realizadas dentro da pasta /back-end .

- Configuração

Faça uma cópia do arquivo env.example e o renomeie para .env <br>
Em seguida altere as variáveis de acesso ao banco de dados com as credênciais abaixo

```bash
APP_NAME=Onfly

DB_URL=mysql://juiv64zg0104yewb:vrq2or3hj5ombouu@jbb8y3dri1ywovy2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/pxwhqc5at35pvezs
DB_CONNECTION=mysql
DB_HOST=jbb8y3dri1ywovy2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com
DB_PORT=3306
DB_DATABASE=pxwhqc5at35pvezs
DB_USERNAME=juiv64zg0104yewb
DB_PASSWORD=vrq2or3hj5ombouu
```

- Mailtrap
Crie uma conta no mailtrap, pegue as credências para integrar com Laravel 7 e 8, e então cole nas configuracões do arquivo .env:
```bash
$ MAIL_MAILER=smtp
$ MAIL_HOST=sandbox.smtp.mailtrap.io
$ MAIL_PORT=
$ MAIL_USERNAME=
$ MAIL_PASSWORD=
$ MAIL_ENCRYPTION=tls
```

Instale as dependências via composer e gere sua chave: 

```bash
$ composer install
$ php artisan key:generate
```

Para gerar as tabelas no banco de dados e povoalo, execute os seguintes comandos:
```bash
$ php artisan migrate
$ php artisan db:seed
```

Será gerado um usuário com as seguintes credênciais:

E por fim inicie a API:
```bash
$ php artisan serve --port=8000
```

Em um outro terminal deixe executando o comando abaixo para que os usuários recebam a notificação de despesas por e-mail:
```bash
$ php artisan queue:work
```


Pronto! A API já está funcionando na porta indicada.

-   **Front-end**

Estas ações devem ser realizadas dentro da pasta /fron-end.

- Configuração

Instale todas as depedências:

```bash
$ npm install
```

- Iniciar app em modo de desenvolvimento

```bash
$ quasar dev
```

A Lista de Tarefas deverá aparecer no seu navegador.

This is a challenge by Coodesh

## ✍️ Authors <a name = "authors"></a>

- [@maurorgrdev](https://github.com/maurorgrdev) - Developer - mauroroger2020@gmail.com

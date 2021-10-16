# Sistema de upload de imagens
Sistema de upload de imagens utilizando o padrão de arquitetura de software MVC em php.

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

Consulte **Instalação** para saber como implantar o projeto.

### 📋 Pré-requisitos

Ter um servidor **PHP** (apache) instalado Xampp ou Wampserver no **Windows** ou Lamp no **Linux** com **PHP** 7.3.2 ou superior e um banco de dados **Mysql**.

```
Servidor Local 
Windows: Xampp ou Wampserver.
Linux: Lamp.
```

### 🔧 Instalação (local)

Importa as tabelas do banco de dados **sistemaimagens.sql** para o Mysql.

Defina as credenciais de acesso ao banco de dados.
<br>
No arquivo config/**database.php**

```
  define('HOST', 'localhost');
  define('USER', 'root');
  define('PASSWORD', '');
  define('DBNAME', 'sistemaimagens');
```

Acesse o arquivo **config.php** e altere a variavel global URL_PROJECT para a url onde seu projeto está instalado.

```
    $GLOBALS['URL_PROJECT'] = "http://seudominio.com/nomedapastadoprojeto/";
```

Pronto agora e só acessar a url do sistema e começar a usar.

## 📦 Desenvolvimento

Sistema desenvolvido no padrão MVC em php, utilizando Mysql como base de dados.
Frontend feito em html, css e javascript utilizando css flexbox.

- HTML5
- CSS3
- PHP 7
- JAVASCRIPT

## 🎁 Detalhes

Sistem feito com o intuito de demonstrar conhecimentos em **PHP** e no padrão MVC Model-View-Controller.
HTML5, CSS3 com flexbox e JavaScript.

---

⌨️ Feito por [Bruno Lopes Silva](https://github.com/brunosilvabrn) 

# Projeto de Envio de E-mails com PHPMailer

Este é um projeto simples que demonstra como enviar e-mails utilizando a biblioteca PHPMailer em PHP. Ele permite enviar e-mails HTML através de um servidor SMTP, neste caso, usando o Gmail como exemplo.

## Pré-requisitos

- Servidor web local (como Apache ou Nginx) com PHP instalado
- Conta de e-mail Gmail (ou outro provedor com suporte a SMTP)
- Composer instalado para instalar as dependências do PHPMailer

## Instalação

1. **Clone ou faça o download deste repositório para o seu ambiente de desenvolvimento.**

    ```bash
    git clone https://github.com/Lucas-D-A-Barcellos/AppSendEmail.git
    ```

2. **Navegue até o diretório do projeto.**

    ```bash
    cd AppSendEmail
    ```

3. **Execute `composer install` para instalar as dependências do PHPMailer.**

    ```bash
    composer install
    ```

## Configuração

Antes de usar o projeto, você precisa configurar as credenciais do servidor SMTP e a conta de e-mail de origem. Abra o arquivo `processa_envio.php` e edite as seguintes linhas:

```php

    define('SMTP_HOST', 'smtp.gmail.com');  //defina o host do seu provedor smtp
    define('SMTP_USERNAME', 'SeuEmail@gmail.com'); // Insira seu endereço de e-mail
    define('SMTP_PASSWORD', 'SuaSenha​'); // Insira sua senha de e-mail
    define('FROM_EMAIL', 'SeuEmail@gmail.com'); // Insira seu endereço de e-mail e nome
    define('FROM_NAME', 'SeuNome');  


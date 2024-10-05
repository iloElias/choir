# PHP HTTP Request Handler Template with Nginx

Este repositório do GitHub fornece uma configuração abrangente do servidor Nginx otimizada para aplicações PHP, especificamente voltada para a implantação de APIs web. Inclui um template pronto para uso, projetado para simplificar o processo de desenvolvimento e implantação nas plataformas Railway. Esta configuração é ideal para desenvolvedores que desejam lançar rapidamente APIs baseadas em PHP com Nginx, garantindo compatibilidade e desempenho nas implantações Railway.

## Dependências

Este template possui algumas dependências que precisam ser instaladas no seu ambiente de trabalho atual:

- **Docker**: Principalmente usado para testes locais
- **PHP 8.0**: A versão mínima da linguagem de programação utilizada
- **Composer**: Gerenciador de pacotes PHP

## 1º Passo: Nome de domínio

Na sua máquina local, adicione as seguintes linhas ao seu arquivo `/etc/hosts` para encontrar a aplicação.

```hosts
127.0.0.1   choir.api.com
```

## 2º Passo: Preparando o ambiente

Construa sua imagem Docker personalizada executando `./docker/build.sh`

Exceções:

- Caso você tenha problemas de permissão, use `sudo` para executar os seguintes arquivos

## 3º Passo: Executando o Docker

`docker-compose up`: Versão standalone

`docker-compose up -d`: Versão daemon

Exceções:

- Se o daemon não permitir que você use a porta `0.0.0.0:80`, altere o arquivo `docker-compose.yml` para expor a porta 81:

```yml
  expose:
    - 3000
    - 81
  ports:
    - 3000:3000
    - 81:81
```

## 4º Passo: Verifique seu navegador

Abra <http://choir.api.com/> e verifique os headers nas suas ferramentas de desenvolvedor, e você deverá ver esta entrada `ping: "pong"`.

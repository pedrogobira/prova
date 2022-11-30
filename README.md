# Back-end: Campeonato de Futebol da Org

API de gerência de um campeonato de futebol de salão criado seguindo o barema que pode ser encontrado [aqui](./docs/BAREMA.md).

A documentação da API foi gerada com o auxílio da ferramenta Postman. Clique [aqui](https://documenter.getpostman.com/view/23534156/2s84LF1v8g) para ir para a documentação.

Diagrama entidade relacional utilizado para o projeto (tabelas referentes a usuários e autenticação não inclusas, pois são providas pelo Laravel como framework):

* mwb: [./docs/modelo-entidade-relacionamento.mwb](./docs/modelo-entidade-relacionamento.mwb);
* png: [./docs/modelo-entidade-relacionamento.png](./docs/modelo-entidade-relacionamento.png);
* pdf: [./docs/modelo-entidade-relacionamento.png](./docs/modelo-entidade-relacionamento.pdf).

Versão utilizada do PHP: 8.1.

## Configuração

O projeto foi feito com docker (docker compose), então será necessário alterar o arquivo `docker-compose.yml`, `Dockerfile` caso deseje mudar algo. Recomendo vistoriar o arquivo antes de tentar instanciar os containers.

Containers:

* nginx: web server;
* php: app containers;
* mysql: banco de dados.

Em `Dockerfile`, o argumento "user" deve ser o nome do seu usuário (a nível de sistema operacional, preferencialmente) para evitar problemas com permissões.

No arquivo `.env`, novas variáveis de ambiente foram adicionadas:

```env
ADMIN_NAME=pedro
ADMIN_EMAIL=pedro@email.com
ADMIN_PASSWORD=123
```

Essas variáveis de ambiente são usadas na migration que popula a tabela `users` para criar um usuário para acesso (nunca se esqueça de migrar :smile:).

## Estrutura

O projeto em si foi arquiteturado com base no Domain-driven Design e Clean Architecture. Você encontrará no projeto a camada UserInterface (Controllers, Resources e FormRequests) - abstrata, pois o Laravel já provê a mesma -, a camada Application (Services e DTOs), Domain (Entities, Actions e interfaces de repositories) e Infrastructure (Repositories e Models).

Fluxo básico até as regras de negócio (pressupõe o uso da camada de persistência - Repositories): Request (estendido de FormRequest, onde estará as regras de validação) > Controller (onde será validado e os atributos enviados para o Application Service referente) > Service (responsável por orquestrar a execução das actions e da camada de persistência) > Action (onde será executado os processos que tangem as regras de negócio).

Fluxo básico de retorno de informações (independente de execução de Actions): Repository (realiza a consulta e mapeia os registros para as entidades do domínio) > Service (mapeia as entidades para data transfer objects - DTOs) > Controller (mapeia o DTO recebido para um Resource que será retornado como resposta).

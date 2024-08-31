
## dominio-app
Este projeto consiste em um aplicativo web desenvolvido em Laravel. Utiliza MySQL como sistema de banco de dados, com Docker e Docker Compose para simplificar a configuração e a execução do ambiente de desenvolvimento.

## Requisitos

- Docker
- Docker Compose

## Configuração do Ambiente

### Clonando o Repositório

```bash
git clone https://github.com/Deividdasilva/dominio-app.git
cd dominio-app
```

### Iniciando os Containers

Utilize o Docker Compose para iniciar os containers:

```bash
docker-compose up -d
```

### Acessando a Aplicação

- **Acessar para criar uma conta**:[http://localhost:8989/register](http://localhost:8989/register)
- **Acessar Login para entrar na aplicação**: [http://localhost:8989](http://localhost:8989)
- **Banco de dados**: [http://localhost:8080](http://localhost:8080)


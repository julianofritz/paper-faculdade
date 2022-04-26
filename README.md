# paper-faculdade
PAPER FACULDADE 2022-01

## quick start

### Aplicação
1. é necessário ter o docker instalado na máquina
2. após intalar o docker rodar o comando abaixo na raiz do projeto
   * docker-compose up --build
3. acessar o container da aplicação com o comando
   * docker exec -it xdebug-app-faculdade bash
4. dentro do container gerar uma chave para larvel com o comando
   * php artisan key:generate

### Banco de dados
- MySQL
- Usuário: root
- Senha: root
- banco: database

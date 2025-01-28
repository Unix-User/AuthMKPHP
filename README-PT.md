<p align="center"><a href="https://github.com/Unix-User/AuthMKPHP" target="_blank"><img src="https://user-images.githubusercontent.com/38821945/192930836-6be0ee28-7206-4651-a18c-da7e8ab99a11.svg" width="400" alt="Logotipo AuthMKPHP"></a></p>

<p align="center">
  
  [Español](README-ES.md) | [English](README.md)
  
</p>

## Sobre AuthMKPHP

AuthMKPHP é uma aplicação web construída com Laravel e Vue.js, projetada para otimizar o gerenciamento de usuários e perfis em servidores PPPoE de dispositivos Mikrotik. Ela fornece uma interface amigável para gerenciar usuários e seus dispositivos associados, aumentando a eficiência e centralizando a administração.

## Instalação e Configuração

Esta seção orienta você na configuração do AuthMKPHP em seu sistema.

### Pré-requisitos

Antes de começar, certifique-se de ter o seguinte instalado e configurado em seu sistema:

* **PHP:** Versão 8.2 ou superior. Além disso, certifique-se de que as seguintes extensões do PHP estejam habilitadas: BCrypt, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML e sockets. O arquivo `composer.json` especifica `^8.2.0`, portanto, certifique-se de ter pelo menos o PHP 8.2 instalado.
* **Composer:** O Composer é o gerenciador de dependências do PHP, necessário para instalar as dependências do projeto. Você pode baixá-lo em [https://getcomposer.org/](https://getcomposer.org/).
* **Node.js e npm:** Node.js e npm são necessários para gerenciar as dependências de JavaScript e compilar os ativos do frontend. Baixe-os em [https://nodejs.org/](https://nodejs.org/).


### Configuração para Desenvolvimento

Estas etapas configurarão o AuthMKPHP para desenvolvimento local.

1. **Clone o repositório:** Clone o repositório AuthMKPHP para sua máquina local usando o Git:
   ```bash
   git clone https://github.com/Unix-User/AuthMKPHP.git
   cd AuthMKPHP
   ```

2. **Instale as dependências:** Instale as dependências PHP e JavaScript necessárias usando o Composer e npm:
   ```bash
   composer install
   npm install
   ```

3. **Configure as variáveis de ambiente:** Crie um arquivo `.env` copiando o arquivo `.env.example`. Este arquivo contém várias configurações para sua aplicação. Você precisará configurar o seguinte:

    * **Credenciais do Banco de Dados:** Especifique os detalhes de conexão do seu banco de dados, incluindo o hostname, nome do banco de dados, nome de usuário e senha. Para desenvolvimento local, você pode usar SQLite para simplificar.
    * **Chaves de API:** Se a aplicação usar alguma API externa (por exemplo, gateways de pagamento, serviços de mensagens), você precisará fornecer as chaves de API necessárias aqui.
    * **Outras Configurações:** Outras configurações podem incluir URLs da aplicação, configurações de e-mail e outros parâmetros específicos da aplicação. Consulte o arquivo `.env.example` para obter uma lista completa de variáveis e suas descrições.

4. **Vincule o diretório de armazenamento:** Crie o link simbólico para o diretório de armazenamento para tornar os arquivos enviados acessíveis a partir da web:
   ```bash
   php artisan storage:link
   ```

5. **Gere a chave da aplicação:** Gere uma chave de aplicação única para segurança:
   ```bash
   php artisan key:generate
   ```

6. **Execute as migrações do banco de dados:** Aplique as migrações do banco de dados para criar as tabelas necessárias:
   ```bash
   php artisan migrate
   ```

7. **Inicie o servidor de desenvolvimento:** Inicie o servidor de desenvolvimento para executar a aplicação:
   ```bash
   npm run dev
   ```

### Configuração para Produção

Para implantar o AuthMKPHP em um ambiente de produção, siga estas etapas:

1. **Siga os passos 1-3 da seção Configuração para Desenvolvimento.**

2. **Execute as migrações do banco de dados com seeding:** Execute as migrações do banco de dados e preencha o banco de dados com dados iniciais (se necessário):
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

3. **Compile os assets para produção:** Compile os assets frontend para desempenho otimizado em produção:
   ```bash
   npm run build
   ```

4. **Implante:** Implante a aplicação em seu servidor web escolhido. O processo de implantação irá variar dependendo do seu provedor de hospedagem e infraestrutura. Consulte a documentação do seu provedor de hospedagem para obter instruções específicas.


## Funcionalidades

AuthMKPHP oferece as seguintes funcionalidades (algumas ainda em desenvolvimento):

- [x] **Implantação Automatizada:** A implantação automatizada está configurada usando o GitHub Actions.
- [ ] **Documentação Abrangente:** Documentação detalhada está planejada para lançamentos futuros.
- [x] **Operações CRUD Básicas:** Fornece funcionalidades básicas de Criar, Ler, Atualizar e Deletar (CRUD) para gerenciar usuários e dispositivos.
- [ ] **Integração com Chat do Telegram:** A integração com o Telegram para notificações e comunicação está planejada.
- [ ] **Integração com a API PagSeguro:** A integração com o gateway de pagamento PagSeguro está planejada.
- [ ] **Integração com a API Mercado Pago:** A integração com o gateway de pagamento Mercado Pago está planejada.
- [x] **Integração com a API Mikrotik:** Integração robusta com a API Mikrotik para gerenciamento de dispositivos.


## Patrocinadores

Estamos buscando ativamente patrocinadores para apoiar o desenvolvimento contínuo e a melhoria do AuthMKPHP. Sua contribuição nos ajudará a entregar uma aplicação mais robusta e rica em funcionalidades.

### Parceiros

Agradecemos parcerias para colaborar no desenvolvimento e expansão do AuthMKPHP. Se você estiver interessado em se tornar um parceiro, visite [udianix.com.br](udianix.com.br).


## Contribuindo

Encorajamos contribuições para o AuthMKPHP! Por favor, revise nossas diretrizes de contribuição antes de enviar um pull request.


## Vulnerabilidades de Segurança

Se você descobrir uma vulnerabilidade de segurança, por favor, reporte-a de forma responsável criando uma issue.

<div align="center">

# VSHelp

### Sistema de gerenciamento de chamados e ocorrências internas

<p>
  <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-blue" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/MySQL-Database-orange" alt="MySQL">
  <img src="https://img.shields.io/badge/Status-Em%20desenvolvimento-yellow" alt="Status">
</p>

</div>

---

## 📋 Sobre o VSHelp

O **VSHelp** é um sistema desenvolvido para auxiliar no gerenciamento de chamados, ocorrências e demandas internas da empresa, proporcionando maior organização, rastreabilidade e visibilidade sobre o trabalho realizado entre os setores.

Inicialmente, o sistema será utilizado pelos setores de **Qualidade, Pré-Montagem e Montagem**, com possibilidade de expansão para outras áreas conforme a evolução e as necessidades da empresa.

A proposta do VSHelp é transformar problemas, solicitações e retrabalhos que anteriormente poderiam ficar registrados apenas em conversas ou controles individuais em **informações organizadas, rastreáveis e mensuráveis**.

---

## 🔄 Como funciona

O fluxo do VSHelp foi desenvolvido para acompanhar uma ocorrência desde sua identificação até sua resolução, mantendo o histórico da demanda e permitindo analisar o impacto gerado no processo.

### Exemplo prático

> 💡 **Situação:** durante a inspeção de um totem, a equipe de Qualidade identifica que o touch screen apresenta uma falha e precisa ser substituído.

| Etapa | Descrição |
|---|---|
| 🔎 Identificação | A Qualidade identifica a ocorrência durante a inspeção. |
| 📝 Abertura | O problema é registrado no VSHelp. |
| 👷 Encaminhamento | A demanda é direcionada ao setor responsável. |
| 🔧 Atendimento | O setor realiza a correção necessária. |
| ✅ Conclusão | Após a resolução, o chamado é finalizado. |
| 📊 Análise | As informações ficam registradas para acompanhamento e geração de métricas. |

### Fluxo

**Identificação** → **Abertura** → **Encaminhamento** → **Atendimento** → **Conclusão** → **Análise**

---

## 🛠️ Tecnologias utilizadas

O VSHelp foi desenvolvido utilizando tecnologias voltadas para aplicações web, buscando manter uma estrutura organizada, segura e de fácil manutenção.

| Tecnologia | Utilização |
|---|---|
| **Laravel 12** | Framework principal utilizado no desenvolvimento do sistema. |
| **PHP 8.2+** | Linguagem de programação utilizada no backend da aplicação. |
| **MySQL** | Banco de dados responsável pelo armazenamento das informações do sistema. |
| **Blade** | Engine de templates utilizada na construção das interfaces da aplicação. |
| **Git** | Sistema de controle de versão utilizado para acompanhar as alterações do projeto. |
| **GitHub** | Plataforma utilizada para hospedagem do código e colaboração no desenvolvimento. |

## Instalação

Após clonar o repositório, certifique-se de que o ambiente possui todos os requisitos necessários. Em seguida, siga os passos abaixo.

### Dependências e configuração

1. Instalar as dependências do projeto:

```bash
composer install
```

2. Criar o arquivo `.env` com base no arquivo `.env.example`:

```bash
copy .env.example .env
```

3. Configurar no arquivo `.env` as informações de conexão com o banco de dados MySQL.

4. Gerar a chave da aplicação:

```bash
php artisan key:generate
```

5. Executar as migrations do banco de dados:

```bash
php artisan migrate
```

6. Executar o seeder para inserir os dados iniciais:

```bash
php artisan db:seed
```

7. Instalar as dependências do front-end:

```bash
npm install
```

### Execução em ambiente de desenvolvimento

Para iniciar o sistema em ambiente de desenvolvimento:

1. Executar o servidor Laravel:

```bash
php artisan serve
```

2. Em outro terminal, executar o front-end:

```bash
npm run dev
```

3. Acessar o sistema pelo endereço:

```text
http://localhost:8000
```

### Configuração do `.env`

No arquivo `.env`, configure principalmente os dados de conexão com o banco de dados MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

Substitua os valores de `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD` de acordo com a configuração do ambiente.

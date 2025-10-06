# 🚀 Verificação de Inscritos - Evento Congresso

Este projeto é um sistema de controle interno para verificar o cadastro de participantes no evento **"Congresso"**. Ele permite que administradores ou a equipe de suporte busquem rapidamente por participantes utilizando o **nome** ou **e-mail** e visualizem os detalhes do cadastro, incluindo o link para um arquivo PDF associado (provavelmente um certificado ou comprovante de inscrição).

## 🛠️ Tecnologias Utilizadas

O projeto utiliza a seguinte stack tecnológica:

  * **Backend:** **PHP** (com a extensão `mysqli` para conexão com o banco de dados).
  * **Frontend:** **HTML5** e **CSS3** (com um design responsivo e moderno).
  * **Banco de Dados:** **MySQL** (ou compatível).

## ✨ Funcionalidades Principais

  * **Busca Dinâmica:** Pesquisa de participantes em tempo real por **Nome** ou **E-mail**.
  * **Visualização de Resultados:** Apresentação dos dados em uma tabela clara e organizada.
  * **Acesso Rápido ao Documento:** Link direto para o arquivo PDF (`caminho_arquivo_pdf`) do participante.
  * **Tratamento de Erros:** Exibição de mensagem de erro em caso de falha na conexão com o banco de dados.

## 🗄️ Estrutura do Banco de Dados

A aplicação espera uma tabela com os dados dos inscritos. A query PHP sugere a seguinte estrutura para a tabela principal (`formulario_congresso`):

| Coluna | Tipo | Descrição |
| :--- | :--- | :--- |
| `nome` | `VARCHAR` | Nome completo do participante. |
| `email` | `VARCHAR` | E-mail de contato do participante. |
| `curso` | `VARCHAR` | Curso ou palestra no qual se inscreveu. |
| `caminho_arquivo_pdf` | `VARCHAR` | O caminho ou URL para o PDF (certificado, comprovante, etc.). |

### 🔑 Configuração do Banco de Dados

As credenciais de conexão estão definidas no arquivo `index.php`. **Lembre-se de substituí-las pelos seus dados reais.**

```php
$servername = "meuhost"; // Seu host
$username = "seu_usuario"; // Seu usuário do BD
$password = "sua_senha"; // Sua senha do BD
$database = "sua_database"; // Nome do seu banco de dados
```

## ⚙️ Configuração e Instalação

### Pré-requisitos

Você precisará de um ambiente de desenvolvimento web com suporte a PHP e MySQL, como:

  * **XAMPP**
  * **WAMP**
  * **MAMP**
  * **Servidor Web com PHP/MySQL**

### Passos de Instalação

1.  **Clone o Repositório:**

    ```bash
    git clone [URL_DO_SEU_REPOSITORIO]
    ```

2.  **Configuração do Servidor:**

      * Mova os arquivos clonados para a pasta raiz do seu servidor web (por exemplo, `htdocs` no XAMPP).
      * Crie o banco de dados e a tabela `formulario_congresso` com a estrutura mencionada acima.

3.  **Atualize as Credenciais:**

      * Abra o arquivo `index.php` e atualize as variáveis `$servername`, `$username`, `$password` e `$database` com suas credenciais de acesso.

4.  **Acesso:**

      * Acesse o projeto pelo seu navegador (ex: `http://localhost/nome-da-pasta`).

## 🖼️ Estrutura de Arquivos e CSS

| Arquivo/Pasta | Descrição |
| :--- | :--- |
| `index.php` | O coração da aplicação. Contém a lógica de conexão com o BD, a query de busca e todo o HTML/PHP do frontend. |
| `styles/` | Pasta contendo todos os arquivos CSS para estilização. |
| `styles/global.css` | Reset de CSS e definição de variáveis globais e fontes. |
| `styles/header.css` | Estilização específica para o cabeçalho e logo. |
| `styles/body.css` | Estilização do corpo principal, formulário, input e botão de busca. |
| `styles/table.css` | Estilização da tabela de resultados, garantindo um layout limpo e responsivo. |
| `logo/` | Pasta para armazenar o logo do evento/empresa. |
| `logo/LOGO GIROLANDO ATUALIZADA_INSTITUCIONAL BRANCA.png` | O logo utilizado no cabeçalho. |

## ⚠️ Nota de Segurança

O código PHP utiliza a concatenação de strings para construir a query SQL:

```php
$sql = "SELECT nome, email, curso, caminho_arquivo_pdf FROM formulario_congresso 
        WHERE nome LIKE '%$filtro%' OR email LIKE '%$filtro%'
        ORDER BY nome ASC";
// ...
// Prepared Statements é melhor em projeto real pra evitar dor de cabeça.
$result = $connect->query($sql);
```

Embora o dado `$filtro` seja sanitizado com `htmlspecialchars(trim($_POST['busca']))`, **esta prática ainda é vulnerável a ataques de injeção SQL**.

Para um projeto em produção, o correto seria utilizar **Prepared Statements** (consultas preparadas) com `mysqli` ou PDO, conforme a própria anotação no código sugere:

> `// Prepared Statements é melhor em projeto real pra evitar dor de cabeça.`

3.  Commit suas mudanças (`git commit -m 'feat: Adiciona nova feature'`).
4.  Push para a branch (`git push origin feature/minha-feature`).
5.  Abra um **Pull Request**.

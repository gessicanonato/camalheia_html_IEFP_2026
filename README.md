# 🌍 Camalheia

Aplicação web desenvolvida em **PHP** para gestão de cidades, com sistema de autenticação de utilizadores, CRUD completo e gestão de fotografias.

---

## 📋 Funcionalidades

- **Listagem de cidades** — página inicial com todas as cidades registadas na base de dados
- **Detalhes da cidade** — visualização de informações detalhadas e fotografias associadas
- **Adicionar cidade** — formulário para inserir novas cidades
- **Atualizar cidade** — edição dos dados de uma cidade existente
- **Eliminar cidade** — remoção de cidades com confirmação
- **Gestão de fotografias** — upload e eliminação de imagens por cidade
- **Autenticação** — login/logout com sessões PHP e passwords encriptadas (`password_hash`)

---

## 🗂️ Estrutura de Ficheiros

```
/
├── index.php           # Página principal — listagem de cidades e login
├── adicionar.php       # Formulário para adicionar cidade
├── atualizar.php       # Formulário para editar cidade
├── eliminar.php        # Página para eliminar cidade
├── detalhes.php        # Detalhes e fotos de uma cidade
├── ad_fotos.php        # Upload de fotografias
├── el_fotos.php        # Eliminação de fotografias
├── logout.php          # Encerramento de sessão
├── template.php        # Template base para novas páginas
├── imgs/
│   └── cidades/        # Imagens das cidades
└── includes/
    ├── funcoes.php         # Funções auxiliares (ex: criar_conexao)
    ├── head.php            # <head> HTML partilhado
    ├── header.php          # Cabeçalho partilhado
    ├── footer.php          # Rodapé partilhado
    ├── pesquisa_e_nav.php  # Barra de pesquisa e navegação
    └── janela_avisos.php   # Modal de alertas
```

---

## 🗄️ Base de Dados

A aplicação utiliza duas tabelas principais:

### `cidades`
| Campo | Tipo | Descrição |
|---|---|---|
| `id_c` | INT | Identificador único |
| `nome_c` | VARCHAR | Nome da cidade |
| `pais_c` | VARCHAR | País |
| `habitantes_c` | INT | Número de habitantes |
| `dataf_c` | INT | Ano de fundação (negativo = a.C.) |
| `desc_c` | TEXT | Descrição |

### `fotos`
| Campo | Tipo | Descrição |
|---|---|---|
| `id_f` | INT | Identificador único |
| `img_f` | VARCHAR | Nome do ficheiro de imagem |
| `desc_f` | TEXT | Descrição da foto |
| `cidade_f` | INT | FK → `cidades.id_c` |

### `utilizadores`
| Campo | Tipo | Descrição |
|---|---|---|
| `id_u` | INT | Identificador único |
| `nome_u` | VARCHAR | Nome de utilizador |
| `pass_u` | VARCHAR | Password encriptada (`PASSWORD_DEFAULT`) |
| `nivel_u` | INT | Nível de acesso |


## 🔒 Segurança

- Queries preparadas com **PDO** em todos os acessos à base de dados (proteção contra SQL Injection)
- Passwords armazenadas com `password_hash()` e verificadas com `password_verify()`
- Sessões PHP para controlo de autenticação

---

## 🛠️ Tecnologias

- PHP 8+
- MySQL / MariaDB
- PDO
- HTML5 / CSS3
- JavaScript (confirmação de ações)

---

## 📄 Licença

Este projeto foi desenvolvido no âmbito do curso CET em Aplicações de Informática de Gestão, na unidade curricular UC0606- Desenvolver Programas em Linguagem Estruturada.

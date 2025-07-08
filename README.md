# 📦 Entregável Parcial 1 (EP1) — Integração Contínua com GitHub Actions  
**Disciplina:** Projeto Integrado IV (ADS0039)  
**Curso:** Análise e Desenvolvimento de Sistemas — UFCA  

---

## 🎯 Objetivo do Projeto

O propósito deste projeto é automatizar a verificação de alterações no código por meio de um processo básico de **Integração Contínua (CI)** utilizando o **GitHub Actions**. A cada `push` ou `pull request` na branch `main`, o pipeline é executado automaticamente para garantir **qualidade, agilidade e confiança** no desenvolvimento.

---

## ⚙️ Estrutura da Integração Contínua

A configuração principal está no arquivo:

```
.github/workflows/ci.yml
```

Esse arquivo define o workflow do GitHub Actions que executa:

- Verificação automática da sintaxe dos arquivos PHP (`php -l`)
- Execução da pipeline em eventos de `push` ou `pull request` no ramo `main`

---

## 🗂️ Estrutura do Repositório

```
Odontoagenda/
├── Cadastro-Pacientes/
├── Dashboard/
├── Login/
├── Registro/
├── menu/
├── odotoagenda/
├── .github/
│   └── workflows/
│       └── ci.yml
├── LICENSE
└── README.md
```

---

## 🛠️ O que está automatizado

- ✅ Lint automático de todos os arquivos `.php` usando `php -l`
- ✅ Execução automatizada em `push` e `pull_request` na branch `main`
- ✅ Ambiente de execução com PHP 8.2 no Ubuntu Linux

---

## 🧪 Como testar localmente

Você pode executar a verificação de sintaxe dos arquivos `.php` localmente com o seguinte comando no terminal:

```bash
find . -type f -name "*.php" -exec php -l {} \;
```

Isso ajuda a encontrar erros antes de fazer o commit para o GitHub.

---

## 📘 [Componente Extensionista] - O que é Integração Contínua?

**Integração Contínua (CI)** é uma prática que automatiza testes e verificações de código sempre que alterações são feitas. Essa prática é muito usada por empresas de tecnologia para garantir qualidade e evitar erros durante o desenvolvimento.

Na UFCA, utilizar CI em projetos acadêmicos permite que os estudantes:

- Aprendam desde cedo a aplicar boas práticas de desenvolvimento profissional;
- Entreguem projetos mais estáveis e seguros;
- Trabalhem de forma colaborativa sem comprometer o funcionamento do sistema;
- Detectem falhas automaticamente antes que cheguem em produção.

---

## 👥 Equipe

- **Rafael Antônio Vieira Rodrigues** – Criação do Figma, organização da equipe, integração do protótipo  
- **Adão Eduardo Gomes de Oliveira** – Documentação, fluxograma, telas, ajustes no projeto

---

## 🔗 Link do Repositório

[https://github.com/LabIsDu/ep1-integracao-continua](https://github.com/LabIsDu/ep1-integracao-continua)

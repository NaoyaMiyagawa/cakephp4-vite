# CakePHP4 MPA integrated Vite

This is a sample app to implement Vite-integrated MPA (Multiple-Page Application) with CakePHP4.<br>
With this app, you can use these tech stacks.

- [CakePHP4](https://book.cakephp.org/4/en/index.html)
- [Vite](https://ja.vitejs.dev/)
- [TypeScript](https://www.typescriptlang.org/)
- [Scss](https://sass-lang.com/)
- [Vue3](https://vuejs.org/)

More detailed is here:<br>
[CakePHPのMPAにViteを導入して開発を加速させる⚡️ - Fusic Tech Blog](https://tech.fusic.co.jp/posts/2022-03-03-cakephp-vite-mpa/)

## Installation

```bash
# Install php dependencies
composer install
# Install node dependencies
pnpm i
```

## Dev

```bash
# Run CakePHP build-in webserver
bin/cake server -p 8765

# Run vite server
pnpm dev
```

Visit `http://localhost:8765`

## Prod

CakePHP env file needs to be `DEBUG="false"`. Modify `config/.env` first.

```bash
# Rerun CakePHP build-in webserver
bin/cake server -p 8765

# Run vite server
pnpm build
```

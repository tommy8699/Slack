# Slack Chat System – Backend (OctoberCMS)
<p align="center">
    <img src="https://github.com/octobercms/october/blob/develop/themes/demo/assets/images/favicon.png?raw=true" alt="October" width="25%" height="25%" />
</p>

Projekt backendovej časti aplikácie typu Slack pre OctoberCMS, pozostávajúci z API a CMS rozhrania.
[October](https://octobercms.com) is a Content Management System (CMS) and web platform whose sole purpose is to make your development workflow simple again. It was born out of frustration with existing systems. We feel building websites has become a convoluted and confusing process that leaves developers unsatisfied. We want to turn you around to the simpler side and get back to basics.

---
October's mission is to show the world that web development is not rocket science.

## Pluginy
[![Build Status](https://github.com/octobercms/library/actions/workflows/tests.yml/badge.svg)](https://octobercms.com/)
[![Downloads](https://img.shields.io/packagist/dt/october/rain)](https://docs.octobercms.com/)
[![Version](https://img.shields.io/packagist/v/october/october)](https://octobercms.com/changelog)
[![License](https://poser.pugx.org/october/october/license.svg)](./LICENSE.md)

- **AppChat.Chat** – Chaty, správy, reakcie, emoji
- **AppUser.User** – Registrácia, prihlásenie, odhlásenie, autentifikácia
> *Please note*: October is open source but it is not free software. A license with a small fee is required for each website you build with October CMS.

---
## Installing October

## Autentifikácia
Instructions on how to install October can be found at the [installation guide](https://docs.octobercms.com/3.x/setup/installation.html).

- Registrácia: `POST /api/v1/user/register`
- Prihlásenie: `POST /api/v1/user/login`
- Odhlásenie: `POST /api/v1/user/logout` *(vyžaduje `Bearer Token`)*
### Quick Start Installation

**Token-based Auth**
Po prihlásení dostane používateľ `token` (30 znakov), ktorý posiela v `Authorization` hlavičke ako `Bearer <token>`.
If you have composer installed, run this in your terminal to install October CMS from command line. This will place the files in a directory named **myoctober**.

Middleware `AppUser\User\Middleware\AuthMiddleware` zabezpečuje API prístup len pre prihlásených používateľov.
composer create-project october/october myoctober

---
If you plan on using a database, run this command inside the application directory.

## API Endpointy
    php artisan october:install

**URL Prefix:** `/api/v1`
## Learning October

### Chaty (chránene middleware-om)
The best place to learn October CMS is by [reading the documentation](https://docs.octobercms.com) or [following some tutorials](https://octobercms.com/support/articles/tutorials).

| Metóda | URL                              | Akcia                |
|--------|----------------------------------|-----------------------|
| GET    | `/chats`                         | Zoznam chatov        |
| POST   | `/chats`                         | Vytvoriť nový chat   |
| PUT    | `/chats/{id}/rename`            | Premenovať chat      |
| POST   | `/chats/{id}/invite`            | Pozvať používateľa   |
| POST   | `/chats/{id}/leave`             | Odísť z chatu        |
You may also watch this [introductory video](https://www.youtube.com/watch?v=yLZTOeOS7wI). Make sure to check out our [official YouTube channel](https://www.youtube.com/c/OctoberCMSOfficial). There is also the excellent video series by [Watch & Learn](https://watch-learn.com/series/making-websites-with-october-cms).

### Správy (chránene middleware-om)
For code examples of building with October CMS, visit the [RainLab Plugin Suite](https://github.com/rainlab) or the [October Demos Repo](https://github.com/octoberdemos).

| Metóda | URL                                 | Akcia                        |
|--------|-------------------------------------|-------------------------------|
| GET    | `/chats/{id}/messages`             | Zoznam správ v chate         |
| POST   | `/chats/{id}/messages`             | Poslať správu / súbor        |
| POST   | `/messages/{id}/react`             | Pridať reakciu na správu     |
## Coding Standards

### Emoji (verejné)
Please follow the following guides and code standards:

| Metóda | URL           | Akcia                      |
|--------|---------------|-----------------------------|
| GET    | `/emojis`     | Získať zoznam emoji         |
* [PSR 4 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
* [PSR 2 Coding Style Guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [PSR 1 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)

---
## Security Vulnerabilities

## 🛠 CMS Backend
Please review [our security policy](https://github.com/octobercms/october/security/policy) on how to report security vulnerabilities.

- Administrátor môže spravovať:
    - dostupné emoji v sekcii **Settings**
    - správy, reakcie a chaty cez CMS formuláre a zoznamy
- V CMS sú zakázané polia ako `id`, `created_at`, `updated_at` v editačných formulároch
## Development Team

---
October CMS was created by [Alexey Bobkov](https://www.linkedin.com/in/alexey-bobkov-232ba02b/) and [Samuel Georges](https://www.linkedin.com/in/samuel-georges-0a964131/), who both continue to develop the platform.

##  Funkcionalita
## Foundation library

- Registrácia a login používateľov
- Každý používateľ môže:
    - začať nový chat s iným používateľom
    - posielať správy a súbory
    - pridávať reakcie (emoji) na správy
    - odpovedať na správy (replies)
    - opustiť alebo premenovať konverzáciu
- Default názov konverzácie sa generuje automaticky
- Správy podporujú súbory (príloha cez [attachments](https://docs.octobercms.com/3.x/extend/database/attachments.html))
  The CMS uses [Laravel](https://laravel.com) as a foundation PHP framework.

---
## Contact

##  Bezpečnosť
For announcements and updates:

- Neautentifikovaný používateľ nemôže pristupovať k AppChat endpointom
- Používateľ nemá prístup k správam mimo svojich konverzácií
- Heslá sú hashované cez OCMS Hashable trait alebo Hash service
* [Contact Us Page](http://octoberdev.test/contact)
* [Follow us on Twitter](https://twitter.com/octobercms)
* [Like us on Facebook](https://facebook.com/octobercms)

---
To chat or hang out:

##  Technické detaily
* [Join us on Slack](https://join.slack.com/t/octobercms/shared_invite/zt-2f19m689c-VCrBPc2P1dmqAJ_86Y8e_Q)
* [Join us on Discord](https://discord.gg/gEKgwSZ)
* [Join us on Telegram](https://t.me/octoberchat)

- Backend je postavený na **OctoberCMS 3.x**
- API využíva Laravel `Controller` + `Request` + `JsonResource`
- Validácia na strane API aj CMS
- Oddeľovanie logiky cez Services a Middleware

---

##  Testovanie

- Testuj cez Postmana:
    - Pridaj `Authorization: Bearer <token>` hlavičku pre všetky chránené API požiadavky
- Over všetky akcie v CMS backend rozhraní

---

##  Struktúra Routingu

```php
// api/v1/user
POST   /user/register   // register
POST   /user/login      // login
POST   /user/logout     // logout (auth required)

// api/v1/chats
GET    /chats           // list chats
POST   /chats           // create chat
PUT    /chats/{id}/rename
POST   /chats/{id}/inviteAdd commentMore actions
POST   /chats/{id}/leave

// api/v1/chats/{id}/messages
GET    /chats/{id}/messages
POST   /chats/{id}/messages

// api/v1/messages/{id}/react
POST   /messages/{id}/react

// api/v1/emojis
GET    /emojis

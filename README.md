# Slack Chat System – Backend (OctoberCMS)

Projekt backendovej časti aplikácie typu Slack pre OctoberCMS, pozostávajúci z API a CMS rozhrania.

---

## 🧩 Pluginy

- **AppChat.Chat** – Chaty, správy, reakcie, emoji
- **AppUser.User** – Registrácia, prihlásenie, odhlásenie, autentifikácia

---

## 🔐 Autentifikácia

- Registrácia: `POST /api/v1/user/register`
- Prihlásenie: `POST /api/v1/user/login`
- Odhlásenie: `POST /api/v1/user/logout` *(vyžaduje `Bearer Token`)*

**Token-based Auth**
Po prihlásení dostane používateľ `token` (30 znakov), ktorý posiela v `Authorization` hlavičke ako `Bearer <token>`.

Middleware `AppUser\User\Middleware\AuthMiddleware` zabezpečuje API prístup len pre prihlásených používateľov.

---

## 📡 API Endpointy

**URL Prefix:** `/api/v1`

### 🧑‍🤝‍🧑 Chaty (chránene middleware-om)

| Metóda | URL                              | Akcia                |
|--------|----------------------------------|-----------------------|
| GET    | `/chats`                         | Zoznam chatov        |
| POST   | `/chats`                         | Vytvoriť nový chat   |
| PUT    | `/chats/{id}/rename`            | Premenovať chat      |
| POST   | `/chats/{id}/invite`            | Pozvať používateľa   |
| POST   | `/chats/{id}/leave`             | Odísť z chatu        |

### 💬 Správy (chránene middleware-om)

| Metóda | URL                                 | Akcia                        |
|--------|-------------------------------------|-------------------------------|
| GET    | `/chats/{id}/messages`             | Zoznam správ v chate         |
| POST   | `/chats/{id}/messages`             | Poslať správu / súbor        |
| POST   | `/messages/{id}/react`             | Pridať reakciu na správu     |

### 😀 Emoji (verejné)

| Metóda | URL           | Akcia                      |
|--------|---------------|-----------------------------|
| GET    | `/emojis`     | Získať zoznam emoji         |

---

## 🛠 CMS Backend

- Administrátor môže spravovať:
    - dostupné emoji v sekcii **Settings**
    - správy, reakcie a chaty cez CMS formuláre a zoznamy
- V CMS sú zakázané polia ako `id`, `created_at`, `updated_at` v editačných formulároch

---

## 💾 Funkcionalita

- Registrácia a login používateľov
- Každý používateľ môže:
    - začať nový chat s iným používateľom
    - posielať správy a súbory
    - pridávať reakcie (emoji) na správy
    - odpovedať na správy (replies)
    - opustiť alebo premenovať konverzáciu
- Default názov konverzácie sa generuje automaticky
- Správy podporujú súbory (príloha cez [attachments](https://docs.octobercms.com/3.x/extend/database/attachments.html))

---

## ✅ Bezpečnosť

- Neautentifikovaný používateľ nemôže pristupovať k AppChat endpointom
- Používateľ nemá prístup k správam mimo svojich konverzácií
- Heslá sú hashované cez OCMS Hashable trait alebo Hash service

---

## 🧱 Technické detaily

- Backend je postavený na **OctoberCMS 3.x**
- API využíva Laravel `Controller` + `Request` + `JsonResource`
- Validácia na strane API aj CMS
- Oddeľovanie logiky cez Services a Middleware

---

## 📬 Testovanie

- Testuj cez Postmana:
    - Pridaj `Authorization: Bearer <token>` hlavičku pre všetky chránené API požiadavky
- Over všetky akcie v CMS backend rozhraní

---

## 📂 Struktúra Routingu

```php
// api/v1/user
POST   /user/register   // register
POST   /user/login      // login
POST   /user/logout     // logout (auth required)

// api/v1/chats
GET    /chats           // list chats
POST   /chats           // create chat
PUT    /chats/{id}/rename
POST   /chats/{id}/invite
POST   /chats/{id}/leave

// api/v1/chats/{id}/messages
GET    /chats/{id}/messages
POST   /chats/{id}/messages

// api/v1/messages/{id}/react
POST   /messages/{id}/react

// api/v1/emojis
GET    /emojis


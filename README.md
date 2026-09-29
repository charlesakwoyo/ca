# Investment Membership Dashboard

A membership dashboard for an investment group: members, their wallets and wallet transactions. It has a **Laravel API** back end and a lightweight HTML/CSS/JavaScript front end.

## Features

- Register members and view member profiles.
- Open **wallets** for members.
- Record **transactions** against a wallet and view wallet balances and history.
- Membership dashboard front end that talks to the API.

## Tech stack

| Part | Technology |
|---|---|
| API (`backend/`) | PHP, Laravel 12, MySQL |
| Front end (root) | HTML, CSS, vanilla JavaScript |

## API

| Method | Endpoint | Purpose |
|---|---|---|
| POST | `/users` | Create a member |
| GET | `/users/{user}/profile` | Member profile |
| POST | `/users/{user}/wallets` | Open a wallet |
| GET | `/wallets/{wallet}` | Wallet details and balance |
| POST | `/wallets/{wallet}/transactions` | Record a transaction |

## Getting started

```bash
git clone https://github.com/charlesakwoyo/ca.git
cd ca/backend
composer install
cp .env.example .env
php artisan key:generate
# set your database in .env, then:
php artisan migrate
php artisan serve
```

Then open `index.html` in the project root in your browser.

## Author

**Charles Akwoyo** · [GitHub](https://github.com/charlesakwoyo) · [Portfolio](https://akwoyo.netlify.app)

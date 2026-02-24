# Money Tracker API (Laravel)

Backend-only API for a money tracker system where users can own multiple wallets and record income/expense transactions.

## Features

- Create a user account (no authentication flow required)
- Create one or more wallets for a user
- Add wallet transactions (`income` or `expense`)
- View user profile summary:
  - all wallets
  - each wallet balance
  - total balance across wallets
- View single wallet details:
  - wallet balance
  - all wallet transactions

## Tech Notes

- Framework: Laravel 12
- Database: SQLite (`database/database.sqlite`)
- Validation included for required fields, positive amount, and valid transaction type

## Run Locally

```bash
composer install --no-dev --prefer-source
php artisan key:generate
php artisan migrate
php artisan serve
```

Server default:

```text
http://127.0.0.1:8000
```

## API Endpoints

### 1. Create User

`POST /api/users`

Body:

```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password123"
}
```

### 2. Create Wallet

`POST /api/users/{user}/wallets`

Body:

```json
{
  "name": "Business Wallet"
}
```

### 3. Add Transaction

`POST /api/wallets/{wallet}/transactions`

Body:

```json
{
  "type": "income",
  "amount": 250.50,
  "description": "Client payment"
}
```

`type` must be `income` or `expense` and `amount` must be greater than `0`.

### 4. View User Profile Summary

`GET /api/users/{user}/profile`

Returns user info, wallets with balances, and `total_balance`.

### 5. View Single Wallet

`GET /api/wallets/{wallet}`

Returns wallet info, wallet balance, and all transactions.

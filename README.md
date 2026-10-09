# Senac Website — PHP

Website for a technical school, with course pages, user registration and login, and a contact form. It was built in 2024 during the Information Technology technical course at Senac Tech, using PHP, HTML, CSS and MySQL.

## Features

- Pages presenting the school, its technical courses and location
- User registration and session-based login
- "Fale Conosco" (contact us) form with messages saved to the database

## 2026 review

Now a Software Engineering undergraduate, I revisited the project and fixed issues I wasn't aware of when I first wrote it:

| Issue | Fix |
| --- | --- |
| **SQL injection:** form values concatenated directly into queries | Prepared statements in every query |
| **MD5 passwords**, a fast, unsalted hash | `password_hash` / `password_verify` (bcrypt) |
| **XSS:** logged-in user's name printed without escaping | `htmlspecialchars` in the greeting |
| Database errors displayed the SQL query on the page | Details go to the server log |
| Contact form message was never saved (field never read from the form) | Field read and validated, and email confirmation checked |
| Logout failed: redirect sent after the HTML had already been output | Dedicated `logout.php` |
| Session block copied across 11 pages | A single include in `includes/saudacao.php` |
| `.html` pages duplicating the `.php` ones, and no database script | Duplicates removed and `database/schema.sql` added |

Each fix is in a separate commit, to keep the history easy to follow.

## Running

With [Docker](https://www.docker.com/):

```sh
docker compose up --build
```

The site runs at http://localhost:8080, and the database is created automatically from `database/schema.sql`.

It also works with XAMPP: copy the folder into `htdocs` and import `database/schema.sql` in phpMyAdmin.

## Structure

| Path | Contents |
| --- | --- |
| `index.php` | Home page |
| `paginas/` | Site pages, forms, and the scripts that handle registration, login and contact |
| `cursos/` | Technical course detail pages |
| `includes/` | Snippets shared across pages |
| `database/schema.sql` | Database and table creation |
| `css/`, `imagens/` | Styles and images |

The site content and code are in Portuguese.

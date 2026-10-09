# Student Information System Frontend

React + Vite frontend for the Laravel REST API.

## Setup

```bash
npm install
copy .env.example .env
npm run dev
```

`VITE_API_BASE_URL` must point to the Laravel API, for example `http://127.0.0.1:8000/api/v1`. The frontend does not connect to MySQL and must not contain backend credentials or tokens.

## Commands

```bash
npm run dev
npm run build
```

Phase 2 provides the shell, route placeholders, Tailwind setup, and centralized Axios client. Authentication and data modules are intentionally deferred.

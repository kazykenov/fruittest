GETTINGS STARTED
-------------------
1. `cp .env.example .env`
2. `docker compose up -d frontend`
3. `docker compose run console yii migrate/up --interactive=0`
4. `docker compose run console yii fruits/fetch`
5. Open http://localhost:20000

Didn't implement:
* email sending after fruits fetch
* filter fruits in index/favorites page by "name" and "family"
* tests
* better validation logic in services/repositories
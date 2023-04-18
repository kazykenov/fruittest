GETTINGS STARTED
-------------------
1. `cp .env.example .env`
2. `docker compose run api composer install`
3. `docker compose run console init`
4. `docker compose up -d frontend`
5. `docker compose run console yii migrate/up --interactive=0`
6. `docker compose run console yii fruits/fetch`
7. Open http://localhost:20000

Didn't implement:
* email sending after fruits fetch
* filter fruits in index/favorites page by "name" and "family"
* tests
* better validation logic in services/repositories
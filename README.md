GETTINGS STARTED
-------------------
1. Copy example configurations to run the application stack locally:
    1. `cp .env.example .env`
    2. You can also customize frontend/backend urls, ports, db credentials, etc in `.etc` file. Make sure to recreate containers after config change
2. Run the services:
    1. `docker compose up -d api console frontend`
3. Apply schema changes to the database:
    1. `docker compose run console yii migrate/up --interactive=0`
4. Fetch fruits data
    1. `docker compose run console yii fruits/fetch`
5. Open http://localhost:20000

Didn't implement:
* email sending after fruits fetch
* filter fruits in index/favorites page by "name" and "family"
* tests
* better validation logic in services/repositories

TODO:
1. rework `setCookieValidationKey`. Make it generate from outside
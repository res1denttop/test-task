# Test Service

## Installation
```shell
git clone git@github.com:res1denttop/test-task.git
```
```shell
# Create local env file and set DATABASE_URL
cp .env .env.local 
```

---
## Starting
```shell
# Build containers
docker compose up -d

# Exec
docker exec -it "$(basename $(pwd))"-php /bin/sh
```

### Install dependencies
```shell
composer install
```

### Database

```shell
# Make sure that you have latest db structure
php bin/console doctrine:migrations:migrate
```
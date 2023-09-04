## Установка

**Requirements**
- Laravel
- Composer
- Vite
- Docker


**Для запуска проекта необходимо:**
- Перейти в директорию в которой, планируется работа
- Склонировать проект
```
git clone https://github.com/andrewvalentovich/one_team.git
```

**Нужно сконфигурировать файл .env**

```
APP_URL=http://localhost:8879/
APP_DOMAIN=localhost

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=название_базы_данных
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database

SESSION_DOMAIN="dev.localhost"
```

**Запустить Docker**

Нужно запустить десктопную версию, в случае если работа производится на ОС Windows, далее прописать:

```
docker compose up -d
```

**Установить зависимости**

Если у вас не установлен NodeJs, то его необходимо установить

```
composer install
npm install
npm run dev
```

**Установить права для директории**

Если работа производится в ОС Linux
```
sudo chmod -R 755 storage/logs
```

**Далее необходимо настроить фреймворк**

Если работаете с использованием docker - нужно перейти в командную строку 
и из корневой директории прописать следующую команду:
```
docker exec -it test_app bash
```
После чего выполнить миграции командой
```
php artisan key:generate
php artisan migrate
php artisan storage:link
```
## Готово

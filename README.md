# Hotel 
## Требования

Перед запуском проекта убедитесь, что у вас установлены следующие компоненты:

- PHP
- Composer
- Node.js и npm

## Установка

1. Клонируйте репозиторий проекта:

```bash
git clone https://github.com/ArseniyZenzerya/hotel-test.git
```

2. Перейдите в директорию проекта:
```bash
cd hotel-test
```
3. Установите зависимости PHP через Composer:
```bash
composer install
```
4. Скопируйте файл .env.example и переименуйте его в .env. Настройте соответствующие переменные окружения, такие как подключение к базе данных.
5. Генерируйте ключ приложения Laravel:
```bash
php artisan key:generate
```
6. Выполните миграции базы данных:
```bash
php artisan migrate
```
7. Запустите фабрики 
```bash
php artisan db:seed
```
8. Установите фронтенд-зависимости через npm:
```bash
npm install
``` 
9. Скомпилируйте фронтенд-ресурсы:
```bash
npm run dev
```

## Запуск
После успешной установки и настройки проекта, вы можете запустить его на локальном сервере:
```bash
php artisan serve
```

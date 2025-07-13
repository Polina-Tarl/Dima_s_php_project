# 📝 Blog API

RESTful API для блога на Laravel. Поддерживает CRUD для постов и комментариев, аутентификацию, авторизацию, очереди, отправку email и тесты.

## 🚀 Стек технологий

- PHP 8.3+
- Laravel 10+
- Laravel Sanctum
- MySQL / Redis
- Eloquent ORM
- Horizon (опционально)
- PHPUnit (feature-тесты)

## ⚙️ Установка

1. Клонируйте репозиторий:
   ```bash
   git clone https://github.com/your-username/blog-api.git
   cd blog-api
   ```

2. Установите зависимости:
   ```bash
   composer install
   ```

3. Скопируйте `.env`:
   ```bash
   cp .env.example .env
   ```

4. Сгенерируйте ключ:
   ```bash
   php artisan key:generate
   ```

5. Установите базу данных (MySQL) и настройте подключение в `.env`:
   ```
   DB_DATABASE=blog_api
   DB_USERNAME=your_user
   DB_PASSWORD=your_password
   ```

6. Выполните миграции и сиды:
   ```bash
   php artisan migrate --seed
   ```

7. Настройте очередь:
   - Убедитесь, что `QUEUE_CONNECTION=redis` в `.env`
   - Запустите Redis
   - Запустите воркер:
     ```bash
     php artisan queue:work redis
     ```

8. Готово. Можно запускать API.

## 🔐 Аутентификация

Используется Laravel Sanctum.

- Регистрация: `POST /api/register`
- Логин: `POST /api/login`
- Выход: `POST /api/logout` (с токеном авторизации)

## 📚 API эндпоинты

### Посты `/api/posts`

| Метод | URI                  | Описание                                      | Доступ |
|-------|----------------------|-----------------------------------------------|--------|
| GET   | /api/posts           | Список постов (пагинация по 10)              | Публично |
| GET   | /api/posts/{id}      | Детали поста с комментариями                 | Публично |
| POST  | /api/posts           | Создание поста                               | Авторизация |
| PUT   | /api/posts/{id}      | Обновление поста (только автор или админ)    | Авторизация |
| DELETE| /api/posts/{id}      | Мягкое удаление поста                        | Авторизация |

### Комментарии `/api/comments`

| Метод | URI                              | Описание                             | Доступ |
|-------|----------------------------------|--------------------------------------|--------|
| POST  | /api/posts/{id}/comments         | Добавить комментарий к посту         | Авторизация |
| DELETE| /api/comments/{id}               | Удалить комментарий (автор или админ)| Авторизация |

## 📨 Email уведомления

- При создании поста отправляется письмо админу через очередь.
- Админ определяется по полю `is_admin = true`.

## 🧪 Тесты

```bash
php artisan test
```

Покрытие:
- Регистрация, логин, логаут
- Создание/удаление постов
- Добавление/удаление комментариев
- Проверка прав доступа (403)

## ✅ Особенности реализации

- Полная архитектура MVC
- Валидация входных данных
- Политики доступа через Laravel Policy
- Очереди с использованием Redis
- Eloquent отношения: `hasMany`, `belongsTo`
- SoftDeletes для постов и комментариев
- Документация и тесты включены

## 📎 Автор

Dmitriy — Junior Laravel Developer  
Email: dmitriy@example.com  
GitHub: [github.com/your-username](https://github.com/your-username)

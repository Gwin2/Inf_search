# Inf Search Labs

Единый WebUI для сдачи лабораторных работ по MySQL и PHP. В проекте собраны готовые ответы, PHP-скрипты, формы, обработчики, база данных для демонстрации и Docker Compose окружение.

## Быстрый Запуск

```powershell
docker compose up -d --build
```

После запуска открыть:

```text
http://127.0.0.1:8080/index.html
```

Остановка:

```powershell
docker compose down
```

## Что Внутри

| Раздел | Файлы | Содержание |
|---|---|---|
| Лабораторная N 1 | `z1-1.txt` | SQL-запросы MySQL |
| Лабораторная N 2 | `z2-1.php`, `z2-5.php`, `z3-*.php` | основы PHP, условия, циклы, функции, массивы |
| Лабораторная N 3 | `z4-*.php`, `z4-*.htm` | обработка форм, GET-параметры, тест, redirect |
| Лабораторная N 4 | `z10-*`, `ex*.php` | MySQL через PHP, таблицы `study` и `sample.notebook` |

## WebUI

Главная страница:

```text
index.html
```

Возможности:

- просмотр всех лабораторных из одной панели;
- запуск PHP-скриптов прямо в iframe;
- кнопка `Открыть код`;
- редактирование исходного кода;
- живой предпросмотр результата после сохранения;
- аккуратное оформление для демонстрации преподавателю.

## Docker Compose

Проект состоит из двух контейнеров:

| Сервис | Назначение | Порт |
|---|---|---|
| `app` | PHP 8.2 + Apache | `8080 -> 80` |
| `db` | MySQL 8.0 | `3307 -> 3306` |

Файлы Docker:

```text
docker-compose.yml
Dockerfile
docker/entrypoint.sh
.dockerignore
```

При старте контейнера `app` автоматически выполняется:

```text
setup-demo-db.php
```

Он создаёт и заполняет базы:

- `study`
- `sample`

## Базы Данных

Подключение внутри Docker:

```text
host: db
user: root
password: пусто
```

Подключение с хоста:

```text
host: 127.0.0.1
port: 3307
user: root
password: пусто
```

Таблицы для лабораторной N 4:

```text
study.sal
study.cust
study.ord
sample.notebook
```

## Локальный Запуск Без Docker

Если установлен XAMPP/OpenServer или PHP в PATH:

```powershell
.\start-ui.bat
```

Скрипт:

- ищет PHP;
- запускает MySQL из XAMPP, если доступен;
- создаёт демо-базы;
- открывает WebUI.

## Полезные Команды

Проверить контейнеры:

```powershell
docker compose ps
```

Посмотреть логи:

```powershell
docker compose logs -f
```

Пересобрать проект:

```powershell
docker compose up -d --build
```

Очистить контейнеры:

```powershell
docker compose down
```

Очистить контейнеры вместе с данными MySQL:

```powershell
docker compose down -v
```

## Проверка Работы

После запуска должны открываться:

```text
http://127.0.0.1:8080/index.html
http://127.0.0.1:8080/z2-1.php
http://127.0.0.1:8080/z10-2.php?structure%5B%5D=sal&content%5B%5D=sal
http://127.0.0.1:8080/ex3.php
```

Проверить БД:

```powershell
docker compose exec db mysql -uroot -e "SELECT COUNT(*) FROM study.sal; SELECT COUNT(*) FROM sample.notebook;"
```

Ожидаемо:

- `study.sal` содержит 5 записей;
- `sample.notebook` содержит 3 записи.

## Структура

```text
.
├── index.html
├── code-viewer.php
├── save-code.php
├── setup-demo-db.php
├── docker-compose.yml
├── Dockerfile
├── docker/
│   └── entrypoint.sh
├── z1-1.txt
├── z2-1.php
├── z2-5.php
├── z3-*.php
├── z4-*.php
├── z4-*.htm
├── z10-*.inc
├── z10-*.php
└── ex*.php
```

## Примечание

Проект рассчитан на локальную демонстрацию. Встроенный редактор кода сохраняет изменения прямо в файлы проекта, поэтому перед экспериментами удобно держать копию или использовать Git.

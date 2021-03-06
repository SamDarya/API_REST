<p align="center">
    <h2>Тестовое задание "Разработка API"</h2>
</p>

СТРУКТУРА ПРИЛОЖЕНИЯ

-------------------

      controller/         содержит классы контроллеров
      core/               содержит файлы ядра приложения и настройки
      db/                 содержит файлы для создания базы данных (удалить после запуска приложения!)
      model/              содержит классы моделей
      vendor/             содержит зависимые сторонние пакеты


ТРЕБОВАНИЯ
------------

Минимальная версия PHP, которую должен поддерживать сервер: 5.6

Приложение корректно работает из корневой директории веб-сервера либо через виртуальный-хост


УСТАНОВКА
------------

### Установка через Composer

Установить приложение можно, используя следующую комманду:

~~~
php composer.phar create-project --stability=dev samdarya/api_rest .
~~~

После установки необходимо развернуть базу данных из файлов, расположенных в каталоге db, а затем внести настройки подключения в файл core/config.php 

Если приложение установлено в корневую директорию веб-сервера, то доступность можно проверить, вызвав в браузере:
~~~
http://localhost/user/generatepassword/?password=<любой пароль>
~~~

Данный метод вернет хэш пароля. Если метод сработал, но нужно завести в бд пользователя, подставив ему в качестве пароля хэш.

Если приложение установлено не в корневую директорию веб-сервера, то нужно завести виртуальный хост, например rest.local, а затм проверить доступность:
~~~
http://rest.local/user/generatepassword/?password=<любой пароль>
~~~

На этом установка и настрока завершены.

### Установка через архив

Скачайте архив проекта из данного репозитория и разархивируйте в рабочий каталог проекта.

После установки необходимо развернуть базу данных из файлов, расположенных в каталоге db, а затем внести настройки подключения в файл core/config.php 

Если приложение установлено в корневую директорию веб-сервера, то доступность можно проверить, вызвав в браузере:
~~~
http://localhost/user/generatepassword/?password=<любой пароль>
~~~

Данный метод вернет хэш пароля. Если метод сработал, но нужно завести в бд пользователя, подставив ему в качестве пароля хэш.

Если приложение установлено не в корневую директорию веб-сервера, то нужно завести виртуальный хост, например rest.local, а затм проверить доступность:
~~~
http://rest.local/user/generatepassword/?password=<любой пароль>
~~~

На этом установка и настрока завершены.


НАСТРОЙКИ
-------------

### База данных
Отредактируйте файл `core/config.php`, например:

```php
return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=rest;charset=utf8',
        'user' => 'root',
        'password' => 'qwerty',
    ]
];
```

**ЗАМЕЧАНИЯ:**
- Приложение не создает БД автоматически. Это нужно сделать вручную, используя скрипты из каталога db.
## О проекте

mini CRM project example 

## Фунционал
- Модели описаны в app/Models/
- Авторизация Laravel Breeze Роли admin, user(manager)



## Модели

- Contacts - Каждый менеджер может работать только со своими клиентами, CRUD функционал а так же ограничениие доступа к чужим клиента через Policy.
- Deals - Основная сущность CRM. Каждая сделка привязана к конкретному клиенту CRUD функционал, и управление статусом.
- Activities - История общения/действий по сделке.CRUD, привязка к сделку пользователя


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

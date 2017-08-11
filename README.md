**protocol** - Протокол по которому пользователи заходят на ваш сайт(http или https)
**domain** - Домен вашего сайта
**port** - Порт вашего сайта, если ваш сайт находится на 80 порте, т.е. в адресной строке после домена через двоеточие не указано число, то данный параметры указывать не прийдётся!
**protocol://domain:port/** - Может быть как `https://example.com/` так и `https://example.com:80/`


Установка

1. На сервере в каталоге **/bitrix/modules/** создаём каталог **mandarinbank.pay**
2. Распаковываем папку репозитория **.last_version**, копируем две папки (**install** и **lang**) на сервер в каталог **/bitrix/modules/mandarinbank.pay/**
3. Авторизуемся по адресу **/bitrix/admin/**
4. В административной части сайта, переходим в раздел `Marketplace` > `Установленные решения`
5. Находим строку `mandarinbank.pay` > `Установить`
6. В административной части сайта, переходим в раздел `Магазин` > `Настройки` > `Платежные системы`
7. Нажимаем `Добавить платежную систему`
8. В поле обработчик выбираем: Раздел - `пользовательские`, платёжная система - `mandarinbank_hosted`
9. Заполняем заголовок, описание и логотип(по желанию, находится в папке с модулем), Тип оплаты - `безналичный`
10. Спускаемся ниже, выбираем вкладку - `По умолчанию`, заполняем поля:

- Сумма к оплате: `Заказ` : `Стоимость заказа`
- Номер заказа: `Заказ` : `Код заказа(ID)``
- Email покупателя: `Пользователь` : `Электронный адрес`
- Секретный ключ: `Значение` : `Ваш секретный ключ тут вводим`
- ID кошелька: `Значение` : `Здесь вводим свой id`

11. Сохраняем
12. В системе MandarinPay указываем
- callbackURL **protocol://domain:port/payment/mandarinbank_pay/st.php**
- returnURL **protocol://domain:port/payment/mandarinbank_pay/state.php**
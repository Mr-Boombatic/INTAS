# deploy
run 'make install'.

Будьте осторожны! При запуске команды выполняется загрузка фейковых данных в базу данных контейнера с id 'db'.

# Видео работы
https://drive.google.com/file/d/1EWBwkdUQgITrjtxGQ9oU5fnQX-Xr4StO/view

# Задание на разработку веб-приложения  

## Описание задания  
Из Москвы в регионы отправляются с центрального склада курьеры с товаром. Время в пути известно. Количество поездок в регион не ограничено.  

## Задание  
Вывести расписание поездок в регионы за выбранную дату в календаре.  

1. **Рабочая форма для внесения данных в расписание с полями**  
   * Регион  
   * Дата выезда из Москвы  
   * ФИО курьера  
   * Информационное поле: Дата прибытия в регион (рассчитывается на основе данных по региону)  

   **Требования к форме:**  
   1. Одновременно курьер может быть только в одной поездке в регион.  
   2. Длительность поездки (туда/обратно) задается в таблице БД регионов.  

2. Заполнить данные по поездкам за три месяца (скрипт заполнения прислать с остальными скриптами веб-приложения).  

3. Форма вывода поездок курьеров в регионы с фильтрацией по дате.  

## Требования к веб-приложению  
1. **Веб-сервер:** Apache или Nginx  
2. **Язык:** PHP версии 7.0 или выше  
3. **БД:** MSSQL или MySQL или PostgreSQL  
4. **Фронт:** Ajax-запросы в форме внесения поездки в регион  
5. **Docker:** по желанию
6. Не использовать фрейморк

## Информация  
### Регионы:  
1. Санкт-Петербург  
2. Уфа  
3. Нижний Новгород  
4. Владимир  
5. Кострома  
6. Екатеринбург  
7. Ковров  
8. Воронеж  
9. Самара  
10. Астрахань  

**Длительность нахождения в пути:** любое число дней  
**Курьеры:** произвольно не менее 10 человек  

## Прислать:  
1. Полностью веб-приложение (скрипты PHP, JS, docker (если есть) и т.д.)  
2. БД (MSSQL или MySQL или PostgreSQL) – 3 таблицы:  
   a. Таблица с курьерами  
   b. Таблица с регионами  
   c. Таблица расписания поездок в регионы  
3. Если веб-приложение развернуто с использованием специфичных настроек сервера Apache или Nginx, то прислать конфиг веб-сервера и php.  

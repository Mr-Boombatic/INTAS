DELETE FROM courier_route;
DELETE FROM routes;
DELETE FROM regions;
DELETE FROM couriers;

-- Добавляем курьеров
INSERT INTO couriers (name) VALUES
('Oliver'),
('Peter'),
('Svetlana'),
('Alex'),
('Maria'),
('Julia'),
('Andrew'),
('Olga'),
('Ivan'),
('Dobryak');

-- Добавляем регионы
INSERT INTO regions (regionName, duration) VALUES
('Belgorod', 1),
('Beslan', 2),
('Vladivostok', 3),
('Grozny', 4),
('Yekaterinburg', 5),
('Kotlas', 6),
('Lyubertsy', 7);

-- Генерация маршрутов с датами за последние 3 месяца
SET @start_date = NOW() - INTERVAL 3 MONTH;

-- Вставка маршрутов
SET @row_num = 0;
INSERT INTO routes (departure, region_id)
SELECT DATE_ADD(@start_date, INTERVAL @row_num := @row_num + 1 DAY),
       FLOOR(1 + RAND() * 7)
FROM (SELECT 1 FROM information_schema.tables LIMIT 90) d;

-- Вставка связей между курьерами и маршрутами
SET @route_count = (SELECT COUNT(*) FROM routes);
SET @courier_count = -1;

INSERT INTO courier_route (courier_id, route_id)
SELECT
    1 + MOD(@courier_count := @courier_count + 1, 10) as courier_id,
    1 + (@route_count := @route_count - 1) as route_id
FROM (SELECT 1 as dsa) AS r
         CROSS JOIN (SELECT 1 FROM information_schema.tables LIMIT 90) as row_count;
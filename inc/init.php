<?php

/**
 *
 * @version $Id$
 * @copyright 2012
 */

mysql_query('CREATE DATABASE `scbase` CHARACTER SET utf8 COLLATE utf8_general_ci');
mysql_select_db('scbase', $db);
mysql_query('create table `orders` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
num INT UNSIGNED,
date_get DATETIME,
date_plan DATE,
date_real DATETIME,
client INT UNSIGNED,
sum INT,
workers TEXT,
status TEXT,
comment TEXT)');
#mysql_query('create table `orders_employee` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, oid INT UNSIGNED, eid INT UNSIGNED)');
mysql_query('create table `orders_item` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, oid INT UNSIGNED, itid INT UNSIGNED, item TEXT)');
mysql_query('create table `orders_works` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, oid INT UNSIGNED, wid INT UNSIGNED)');
mysql_query('create table `employee` (id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name TEXT,
lastname TEXT,
surname TEXT,
phone TEXT(13),
birth DATE,
rate SMALLINT UNSIGNED,
username TEXT,
password TEXT,
position TEXT,
admin BOOL)');
mysql_query('create table `works` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, caption TEXT, description TEXT, cost INT, category INT UNSIGNED)');
mysql_query('create table `works_categories` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, caption TEXT, description TEXT, parent INT UNSIGNED)');
mysql_query('create table `client` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name TEXT, lastname TEXT, surname TEXT, phone1 TEXT (13), phone2 TEXT (13), addres TEXT, email TEXT, category TINYINT UNSIGNED, type TEXT)');
mysql_query('create table `client_categories` (id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, caption TEXT, description TEXT, discount TINYINT, parent INT UNSIGNED)');
mysql_query('create table `item_type` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, caption TEXT, description TEXT)');
mysql_query('create table `item_options` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, caption TEXT, link INT UNSIGNED)');

mysql_query('create table `jobs` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `order` INT UNSIGNED, description TEXT, date DATETIME, date_end DATETIME, status TEXT)');

mysql_query('insert into `orders` values (0,1000,"2012-08-07","2012-08-10",0,2,0,"1,2","Принято","")');
mysql_query('insert into `orders` values (0,1001,"2012-08-06","2012-08-09",0,1,0,"1","Принято","Важный клиент")');
mysql_query('insert into `orders` values (0,1002,"2012-08-01","2012-08-01",0,1,0,"2","Принято","Клиент - идиот")');
mysql_query('insert into `orders` values (0,1002,"2012-07-01","2012-07-01",0,2,0,"3","Принято","")');

mysql_query('insert into `orders_employee` values (0,1,1)');
mysql_query('insert into `orders_employee` values (0,1,2)');
mysql_query('insert into `orders_employee` values (0,2,1)');
mysql_query('insert into `orders_item` values (0,1,1,"Компьютер P4 2.8GHz")');
mysql_query('insert into `orders_item` values (0,3,1,"Компьютер P4 2.8GHz")');
mysql_query('insert into `orders_item` values (0,2,4,"Xbox 360 черный")');
mysql_query('insert into `orders_item` values (0,4,4,"Xbox 360 черный")');

mysql_query('insert into `employee` values (0,"Илья","Сараев", "Михайлович", "+420720202151", "1988-08-12", "100", "elitdie", "04083f0a7432815530d5083f8450b04a24", "Менеджер", 1)');
mysql_query('insert into `employee` values (0,"Григорий","Прадедов", "Владимирович", "+79501469751", "1989-02-23", "100", "madman", "04083f0a7432815530d5083f8450b04a24", "Директор", 1)');
mysql_query('insert into `employee` values (0,"Анна","Мотошкина", "", "+420720202151", "1988-05-12", "100", "manager", "04083f0a7432815530d5083f8450b04a24", "Менеджер", 0)');

mysql_query('insert into `works_categories` values (0,"Аппаратный ремонт","дескр аппаратный ремонт", 0)');
mysql_query('insert into `works_categories` values (0,"Программный ремонт","дескр программный ремонт", 0)');
mysql_query('insert into `works_categories` values (0,"Сборка","дескр Сборка", 1)');
mysql_query('insert into `works_categories` values (0,"Установка","дескр установка", 2)');
mysql_query('insert into `works` values (0, "Установка ОС", "описание установки ос", 800, 4)');
mysql_query('insert into `works` values (0, "Установка ПО", "описание установки ПО", 300, 4)');
mysql_query('insert into `works` values (0, "Чистка компьютера", "описание чистки компьютера", 500, 3)');

mysql_query('insert into `client_categories` values (0,"Стандарт", "Стандартный клиент без скидок", 0, 0)');
mysql_query('insert into `client_categories` values (0,"VIP", "VIP, скидка 15%", 15, 0)');
mysql_query('insert into `client` values (0, "Аркадий", "Укупник", "Александрович", "+79501344444", "34-97-42", "ул.Маяковского 147-91", "ukupnik@gmail.com", 1, "физ.лицо")');
mysql_query('insert into `client` values (0, "Анна", "Пажис", "Валерьевна", "+79501111111", "", "ул.Мира 100-70", "hermit-j@seznam.cz", 2, "физ.лицо")');

mysql_query('insert into `item_options` values (0, "Клавиатура", "1")');
mysql_query('insert into `item_options` values (0, "Блок питания", "1")');
mysql_query('insert into `item_options` values (0, "Блок питания", "3")');
mysql_query('insert into `item_options` values (0, "Блок питания", "4")');
mysql_query('insert into `item_options` values (0, "Материнская плата", "1")');
mysql_query('insert into `item_options` values (0, "Жесткий диск", "1")');
mysql_query('insert into `item_options` values (0, "Жесткий диск", "4")');
mysql_query('insert into `item_type` values (0, "Компьютер в сборе", "Компьютер в сборе монитор клава мышь")');
mysql_query('insert into `item_type` values (0, "Монитор", "Монитор ЖК/ЭЛТ")');
mysql_query('insert into `item_type` values (0, "Принтер", "Струйный/лазерный/матричный принтер")');
mysql_query('insert into `item_type` values (0, "Игровая приставка", "Игровая приставка с периферией")');
$debug .= '<p>Таблицы созданы и заполнены</p>';
?>
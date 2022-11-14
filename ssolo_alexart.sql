-- MariaDB dump 10.19  Distrib 10.6.7-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ssolo_alexart
-- ------------------------------------------------------
-- Server version	10.6.7-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_seo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_mod` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'index','<!-- <section> -->\n<article>\n    <img width=\"250\" height=\"179\" class=\"resp_img polygon1\" src=\"/img/main_img/web2.jpg\" alt=\"веб дизайн\" title=\"веб дизайн\">\n    <h2 class=\"header_shadow\">Алекс-арт21 — создание только эффективных сайтов</h2>\n    <p>\n        У нас сформирован профессиональный коллектив из дизайнеров, web-разработчиков, <abbr\n                title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n        специалистов.\n        Каждый из нас отлично знает свое дело, будь то\n        разработка дизайн-макета сайта-визитки или проектирование базы данных интернет магазина. Все вместе мы\n        уже команда способная решить поставленные задачи в установленные сроки.\n    </p>\n    <p><strong class=\"mark\">Мы не просто делаем сайты \"под ключ\", но и предоставляем комплексные и эффективные решения\n            для современного бизнеса.</strong>\n    </p>\n    <p class=\"strong_text\">\n        Разрабатываем только современные сайты и добиваемся роста посещаемости и конверсии.\n        <br/>\n        Применяем только бизнес подход ориентированный не на \"креативность\", а на результат.\n        <br/>\n        Предлагаем только свежие решения.\n        <br/>\n    </p>\n    <h3 class=\"h_2 punkt no_border\">Предоставляемые услуги:</h3>\n    <div id=\"uslugi_outer\" class=\"list_block\">\n        <ul id=\"uslugi\">\n            <li>\n                <span class=\"fa fa-check\"></span><strong><a title=\"создание сайтов\" class=\"list_link link-anim portf-call\"\n                                                            href=\"/sozdanie\">создание сайтов</a></strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span><strong><a title=\"создание сайтов\" class=\"list_link link-anim portf-call\"\n                                                    href=\"/sozdanie\">создание сайтов</a></strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong title=\"редизайн сайтов\">редизайн существующих сайтов</strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong title=\"модернизация сайтов\">модернизация сайтов под стандарты <abbr\n                            title=\"англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины\">HTML5</abbr>\n                    и <abbr\n                            title=\"англ. Cascading Style Sheets, version 3 — каскадные таблицы стилей\">CSS3</abbr></strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong>\n                    <a title=\"адаптивная верстка\" class=\"list_link link-anim\" href=\"/sozdanie#response\">адаптивная\n                        верстка</a>\n                </strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong title=\"постановка статичных html сайтов на движок\">постановка статичных html сайтов на\n                    \"движок\"</strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong title=\"разработка системы управления сайтом\">разработка индивидуальной <abbr\n                            title=\"англ. Content Management System (система управления содержимым) — информационная система или компьютерная программа для обеспечения и организации совместного процесса создания, редактирования и управления контентом\">CMS</abbr></strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong>\n                    <abbr\n                            title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO </abbr><a\n                            title=\"продвижение сайтов\" class=\"list_link link-anim portf-call\" href=\"/prodvijenie\">продвижение\n                        сайтов</a>\n                </strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong>\n                    <a title=\"контекстная реклама\" class=\"list_link link-anim\" href=\"/prodvijenie#context\">контекстная\n                        реклама</a>\n                    на Яндекс и Google</strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong title=\"рерайт копирайт\">наполнение оригинальным контентом (рерайт, копирайт)</strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span> <strong>консультации, обучение персонала</strong>\n            </li>\n            <li>\n                <span class=\"fa fa-check\"></span>\n                <strong title=\"техническая и информационная поддержка веб-ресурсов\">техническая и информационная\n                    поддержка веб-ресурсов</strong>\n            </li>\n        </ul>\n    </div>\n    <br/>\n    <br/>\n    <div id=\"site\">\n        <div id=\"s1\">\n            <div class=\"site_block\">\n                <a href=\"/sozdanie#sait_vizitka\" class=\"portf-call\" title=\"сайт визитка\">\n                    <h2 class=\"h_2 punkt link-anim\">Сайт визитка</h2>\n                </a>\n                <p>\n                    Идеальный вариант для старта в интернете.\n                    <br>\n                    В дальнейшем можно улучшать и развивать\n                    <br>\n                    возможности сайта и его наполнение.\n                    <br/>\n                </p>\n                <ul>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        до 5 страниц информации\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        размещение прайс листов\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        форма обратной связи\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        срок исполнения от 7 дней\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        цена от\n                        <span class=\"red\">7&#8202;000</span>\n                        <span class=\"fa fa-ruble-sign\"></span>\n                    </li>\n                </ul>\n                <a href=\"/#contacts\" title=\"заказать сайт визитку\" class=\"zayavka link-anim\"><span class=\"fab fa-telegram-plane no-sh\"></span> заказать сайт визитку</a>\n            </div>\n        </div>\n        <div id=\"s2\">\n            <div class=\"site_block\">\n                <a href=\"/sozdanie#korporativniy_sait\" class=\"portf-call\" title=\"корпоративный сайт\">\n                    <h2 class=\"h_2 punkt link-anim\">Корпоративный сайт</h2>\n                </a>\n                <p>\n                    Многофункциональный портал для компании\n                    <br>\n                    и важный маркетинговый инструмент для\n                    <br>\n                    продвижения ваших товаров и(или) услуг.\n                    <br>\n                </p>\n                <ul>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        каталог товаров и услуг\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        система управления сайтом\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        базовая <abbr\n                                title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n                        оптимизация\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        срок исполнения от 21 дня\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        цена от\n                        <span class=\"red\">12&#8202;000</span>\n                        <span class=\"fa fa-ruble-sign\"></span>\n                    </li>\n                </ul>\n                <a href=\"/#contacts\" title=\"заказать корпоративный сайт\" class=\"zayavka link-anim\"><span class=\"fab fa-telegram-plane no-sh\"></span> заказать корпоративный сайт</a>\n            </div>\n        </div>\n        <div id=\"s3\">\n            <div class=\"site_block\">\n                <a href=\"/sozdanie#internet_magazin\" class=\"portf-call\" title=\"интернет магазин\">\n                    <h2 class=\"h_2 punkt link-anim\">Интернет магазин</h2>\n                </a>\n                <p>\n                    Оптимально для увеличения продаж.\n                    <br/>\n                    Обязательно включает системы для добавления\n                    товара и оформления заказа.\n                    <br/>\n                </p>\n                <ul>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        полноценный интернет магазин\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        система управления сайтом\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        система добавления/удаления товаров\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        срок исполнения от 21 дня\n                    </li>\n                    <li>\n                        <span class=\"fa fa-check\"></span>\n                        цена от\n                        <span class=\"red\">20&#8202;000</span>\n                        <span class=\"fa fa-ruble-sign\"></span>\n                    </li>\n                </ul>\n                <a href=\"/#contacts\" title=\"заказать интернет магазин\" class=\"zayavka link-anim\"><span class=\"fab fa-telegram-plane no-sh\"></span> заказать интернет магазин</a>\n            </div>\n        </div>\n    </div>\n    <div id=\"bonus\">\n        <h2 class=\"header_shadow\">Для всех сайтов :</h2>\n        <ul>\n            <li>\n                <span class=\"fa fa-asterisk logo\"></span>\n                Индивидуальный дизайн\n            </li>\n            <li>\n                <span class=\"fa fa-asterisk logo\"></span>\n                Форма обратной связи(заявки)\n            </li>\n            <li>\n                <span class=\"fa fa-asterisk logo\"></span>\n                Регистрация домена и размещение на выбранном хостинге\n            </li>\n            <li>\n                <span class=\"fa fa-asterisk logo\"></span>\n                Регистрация в поисковых системах Яндекс и Google\n            </li>\n            <li>\n                <span class=\"fa fa-asterisk logo\"></span>\n                Счетчик посетителей (по желанию заказчика)\n            </li>\n        </ul>\n    </div>\n    <h2 class=\"h_2 header_shadow\">Процесс работы над сайтом и контакты с заказчиком</h2>\n    <p>\n        Взаимодействие с заказчиком идет на всем процессе создания сайта от первого телефонного звонка.\n        На всю свою работу даем бессрочную гарантию. Обучим Ваш персонал если необходимо.\n    </p>\n    <p>\n        Конечно же как и всякий уважающий себя коллектив мы беремся не за все заказы. Если встает выбор взяться\n        за заказ или отклонить его то тут у нас действует нехитрое правило которое мы условно называем\n        \"правилом двух плюсов\". Если из трех критериев а именно <b>проект</b>\n        ,\n        <b>гонорар</b>\n        и\n        <b>заказчик</b>\n        нас устраивают минимум два, то мы беремся за заказ. За интересный проект можно взяться и при низкой\n        оплате. Другой вариант — проект интересный, гонорар отличный, а заказчик невероятный зануда.\n        Конечно же беремся (кто же откажется от денег :) ).\n    </p>\n    <div id=\"etap\">\n        <h2>Этапы создания сайта можно условно разделить на:</h2>\n        <br/>\n        <ul>\n            <li class=\"link-anim\" data-n=\"0\">постановку целей</li>\n            <li class=\"link-anim\" data-n=\"1\">дизайн</li>\n            <li class=\"link-anim\" data-n=\"2\">верстку</li>\n            <li class=\"link-anim\" data-n=\"3\">программирование</li>\n            <li class=\"link-anim\" data-n=\"4\">наполнение</li>\n            <li class=\"link-anim\" data-n=\"5\">тестирование</li>\n            <li class=\"link-anim\" data-n=\"6\">запуск</li>\n        </ul>\n    </div>\n    <output id=\"etap_target\"></output>\n    <br/>\n</article>\n<div>\n    <strong class=\"h2\">Мы используем <abbr title=\"Content Management System (система управления содержимым) — информационная система или компьютерная программа для обеспечения и организации совместного процесса создания, редактирования и управления контентом.\">CMS</abbr> и <abbr title=\"Фре́ймворк (неологизм от framework — остов, каркас, структура) — программная платформа, определяющая структуру программной системы; программное обеспечение, облегчающее разработку и объединение разных компонентов большого программного проекта.\">фреймворки</abbr> :</strong>\n    <br>\n    <br>\n    <table class=\"ftab\">\n        <tbody>\n        <tr>\n            <td><img alt=\"joomla\" src=\"data:image/png;base64,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\"></td>\n            <td><span class=\"fab fa-wordpress cms\" style=\"color: #0079B1\"></span></td>\n            <td><span class=\"fab fa-drupal cms\" style=\"color: #0079B1;margin-left: -5px\"></span></td>\n            <td><img width=\"40\" height=\"40\" alt=\"Yii\" src=\"data:image/png;base64,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\"></td>\n            <td><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"50\" height=\"40\" viewBox=\"0 0 84.1 57.6\"><title>laravel</title><path fill=\"#fb503b\" d=\"M83.8 26.9c-.6-.6-8.3-10.3-9.6-11.9-1.4-1.6-2-1.3-2.9-1.2s-10.6 1.8-11.7 1.9c-1.1.2-1.8.6-1.1 1.6.6.9 7 9.9 8.4 12l-25.5 6.1L21.2 1.5c-.8-1.2-1-1.6-2.8-1.5C16.6.1 2.5 1.3 1.5 1.3c-1 .1-2.1.5-1.1 2.9S17.4 41 17.8 42c.4 1 1.6 2.6 4.3 2 2.8-.7 12.4-3.2 17.7-4.6 2.8 5 8.4 15.2 9.5 16.7 1.4 2 2.4 1.6 4.5 1 1.7-.5 26.2-9.3 27.3-9.8 1.1-.5 1.8-.8 1-1.9-.6-.8-7-9.5-10.4-14 2.3-.6 10.6-2.8 11.5-3.1 1-.3 1.2-.8.6-1.4zm-46.3 9.5c-.3.1-14.6 3.5-15.3 3.7-.8.2-.8.1-.8-.2-.2-.3-17-35.1-17.3-35.5-.2-.4-.2-.8 0-.8S17.6 2.4 18 2.4c.5 0 .4.1.6.4 0 0 18.7 32.3 19 32.8.4.5.2.7-.1.8zm40.2 7.5c.2.4.5.6-.3.8-.7.3-24.1 8.2-24.6 8.4-.5.2-.8.3-1.4-.6s-8.2-14-8.2-14L68.1 32c.6-.2.8-.3 1.2.3.4.7 8.2 11.3 8.4 11.6zm1.6-17.6c-.6.1-9.7 2.4-9.7 2.4l-7.5-10.2c-.2-.3-.4-.6.1-.7.5-.1 9-1.6 9.4-1.7.4-.1.7-.2 1.2.5.5.6 6.9 8.8 7.2 9.1.3.3-.1.5-.7.6z\"/></svg></td>\n            <td><span class=\"fab fa-react\" style=\"font-size: 40px;color: #37a4ff;margin-left: -5px\"></span></td>\n            <td><svg width=\"40px\" height=\"40px\" viewBox=\"0 0 256 221\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" preserveAspectRatio=\"xMidYMid\"><g><path d=\"M204.8,0 L256,0 L128,220.8 L0,0 L50.56,0 L97.92,0 L128,51.2 L157.44,0 L204.8,0 Z\" fill=\"#41B883\"></path><path d=\"M0,0 L128,220.8 L256,0 L204.8,0 L128,132.48 L50.56,0 L0,0 Z\" fill=\"#41B883\"></path><path d=\"M50.56,0 L128,133.12 L204.8,0 L157.44,0 L128,51.2 L97.92,0 L50.56,0 Z\" fill=\"#35495E\"></path></g></svg></td>\n        </tr>\n        <tr>\n            <th>Joomla</th>\n            <th>Wordpress</th>\n            <th>Drupal</th>\n            <th>Yii2</th>\n            <th>Laravel</th>\n            <th>React</th>\n            <th>Vue</th>\n        </tr>\n        </tbody>\n    </table>\n</div>\n<!-- </section> -->a','Создание и продвижение сайтов в Чебоксарах','Создание сайтов под ключ в Чебоксарах','Создание сайтов под ключ в Чебоксарах','Mon, 14 Nov 2022 06:29:10 GMT','2022-11-04 13:39:15','2022-11-14 06:32:45',NULL),(2,'sozdanie','\n<figure class=\"position-relative\">\n    <img width=\"250\" height=\"167\" class=\"resp_img no_shadow no_border align-left img-outs1\"\n         src=\"/img/main_img/sozdanie.png\" alt=\"создание сайтов\" title=\"создание сайтов\">\n<span class=\"fab fa-html5\"></span>\n<span class=\"fab fa-css3\"></span>\n<span class=\"fab fa-js\"></span>\n</figure>\n<article>\n    <h2 class=\"header_shadow\">Создание сайтов для бизнеса и не только</h2>\n    <p>\n        Интернет — основная медиа среда сегодняшнего времени.<br>\n        <strong>Сайт</strong> сегодня — один из приоритетных инструментов для развития бизнеса.\n        Большинство предпринимателей стараются завести в сети интернет свою площадку для привлечения новых клиентов\n        и развития своей деятельности.\n        Иными словами, отсутствие своего сайта у компании ощутимый минус для неё.\n        <br>\n        Наша группа готова предложить\n        Вам услуги по созданию сайтов любой тематики и направленности и для любого региона. Только\n        сделанный профессионально информационно насыщенный сайт сможет дать Вам поток потенциальных клиентов.\n        <br>\n    </p>\n    <p>\n        Если говорить о <b>сайтах для бизнеса</b> то их весьма условно можно разделить на 3 основные категории.<br>\n    </p>\n    <b>Итак:</b><br>\n    <h2 id=\"sait_vizitka\" class=\"header_shadow anchors\">Сайт визитка</h2>\n    <p>\n        <img width=\"250\" height=\"171\" class=\"resp_img no_shadow no_border align-left img-outs2\"\n             src=\"/img/main_img/vizitka.png\" alt=\"сайт визитка\" title=\"сайт визитка\">\n        Идеальный вариант для старта в интернете. В дальнейшем можно улучшать и развивать возможности сайта и его\n        наполнение.<br>\n        <strong>Сайт визитка</strong> — веб-ресурс, основное предназначение которого быстро и в яркой,\n        запоминающейся форме представить Вашу компанию в сети интернет.<br>\n        Обычно сайт визитка состоит из 5 разделов: <em>Главная страница, О компании, Услуги, Прайс лист, Контакты.</em>\n        Несмотря на небольшие размеры такой сайт - основной инструмент для деятельности предпринимателей\n        в сети интернет и содержит все необходимое для бизнеса.<br>\n    </p>\n    <h3>Заказав у нас сайт визитку вы получите:</h3>\n    <ul class=\"list list_block\">\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;5-7 страниц информации на сайте</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Размещение прайс листов</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Форму обратной связи и(или) заявки на сайте</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Схему проезда до вашей организации</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Регистрацию и покупку домена</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Регистрацию в поисковых системах Яндекс и Google</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Валидный <abbr\n                    title=\"англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины\">HTML</abbr>\n            код\n        </li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Оптимизированную для <abbr\n                    title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            структуру страниц\n        </li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Установку счетчика посещений</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>\n    </ul>\n    <p></p>\n    <p>\n        Создание сайтов этой категории обычно занимает 5-7 дней после написания брифа\n        и утверждения структуры, дизайна.<br>\n        <strong>Цена для сайта визитки</strong> от <span class=\"red\">7&#8202;000</span><span\n                class=\"fa fa-ruble-sign\"></span><br>\n        <a href=\"/#contacts\" title=\"заказать сайт визитку\" class=\"zayavka link-anim\"><span\n                    class=\"fab fa-telegram-plane no-sh\"></span> сделать заявку на сайт визитку</a>\n    </p>\n    <div class=\"hr\"></div>\n    <h2 id=\"korporativniy_sait\" class=\"header_shadow anchors\">Корпоративный сайт</h2>\n    <p>\n        <img width=\"250\" height=\"136\" class=\"resp_img no_border no_shadow align-left img-outs3\"\n             src=\"/img/main_img/corp.png\" alt=\"корпоративный сайт\" title=\"корпоративный сайт\">\n        Веб-ресурс с множеством задач от повышения престижа организации до\n        продвижения товаров.\n        Создании сайтов этой категории требует индивидуального подхода и по цене ощутимо выше чем для простых сайтов.\n        В первую очередь из за большего объема работ, количества размещаемой информации, более тщательной\n        проработки дизайна и других факторов. Работы выполняются после анализа рынка и сайтов конкурирующих\n        компаний. По желанию заказчика пишутся положительные отзывы о компании.\n    </p>\n    <p>\n        На <strong>создание корпоративного сайта</strong> как правило\n        уходит от трех недель. Корпоративный сайт отличается от сайта визитки в первую очередь\n        наличием системы управления контентом (CMS), каталога товаров с возможностью оперативного\n        добавления(удаления) или изменения их описания. Возможно как написание индивидуальной CMS, учитывающей\n        все потребности Вашего сайта так и вариант с готовыми CMS (Joomla, Wordpress, DLE). Следует сказать\n        что \"универсальные\" cms достаточно сложны в использовании для неподготовленного человека и поэтому\n        мы готовы написать для Вас систему управления контентом под Ваш конкретный сайт где внесение изменений\n        будет не сложнее, чем например поменять фото в соцсетях :).<br>\n        <strong>Цена для корпоративного сайта</strong> от <span class=\"red\">12&#8202;000</span><span\n                class=\"fa fa-ruble-sign\"></span><br>\n    </p>\n    <h3>В цену включены:</h3>\n    <ul class=\"list list_block\">\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;До 50 страниц информации</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Базовая <abbr\n                    title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            оптимизация всех страниц\n        </li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Каталог товаров и услуг</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Микроразметка для товаров и контактов</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Форма обратной связи(заявки)</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Система управления контентом</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Новости или блог</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Регистрация в поисковых системах</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Счетчик посетителей</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Настройка систем Яндекс метрика и Google analitics</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Cопровождение после сдачи в течении 3 месяцев</li>\n    </ul>\n    <br>\n    <a href=\"/#contacts\" title=\"заказать корпоративный сайт\" class=\"zayavka link-anim\"><span\n                class=\"fab fa-telegram-plane no-sh\"></span> сделать заявку на корпоративный сайт</a>\n    <div class=\"hr\"></div>\n    <h2 id=\"internet_magazin\" class=\"header_shadow anchors\">Интернет магазин</h2>\n    <p>\n        <img width=\"250\" height=\"209\" class=\"resp_img no_border no_shadow align-left\" src=\"/img/main_img/market.jpg\"\n             alt=\"интернет иагазин\" title=\"интернет магазин\">\n        <strong>Интернет магазин</strong> — наиболее перспективный и развивающийся вид бизнеса в интернете.\n        Создание сайтов такого уровня имеет свои особенности. Это обязательное наличие системы для\n        добавления и удаления товара, каталога товаров, корзины покупателя, быстрого поиска товаров, удобной формы для\n        заказа товара. Конечно же обязательно наличие базы данных для клиентов.\n    </p>\n    <p>\n        Онлайн магазин наиболее удобный способ для осуществления продаж не требующий затрат на аренду и\n        оптимален для их увеличения. Так же минимизированы затраты на персонал в торговом зале. Стоимость\n        создания интернет магазина зависит от таких факторов: объема каталога товаров, интеграции с\n        платежными системами, интеграции сайта с системой 1С, наличия авторизации пользователей и др.\n        Сроки исполнения для <strong>интернет магазина</strong> от трех недель.\n        <strong>Цена для интернет магазина</strong> от <span class=\"red\">20&#8202;000</span><span\n                class=\"fa fa-ruble-sign\"></span><br>\n    </p>\n    <h3>Цена включает:</h3>\n    <ul class=\"list list_block\">\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Внутреннюю оптимизацию всех страниц</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Наполнение сайта содержимым</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Поиск по товарам</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Систему для добавления/удаления товара</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Корзину покупателя</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Удобную форму для заказа товара покупателем</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Продающие <abbr\n                    title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            тексты\n        </li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Счетчик посещений</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Настройку целей в Яндекс метрике</li>\n        <li><span class=\"fa fa-check logo\"></span>&nbsp;&nbsp;Техническое сопровождение сайта в течении 3 месяцев</li>\n    </ul>\n    <br>\n    <a href=\"/#contacts\" title=\"заказать разработку интернет магазина\" class=\"zayavka link-anim\"><span\n                class=\"fab fa-telegram-plane no-sh\"></span> заказать разработку интернет магазина</a>\n    <div class=\"hr\"></div>\n    <p>\n        На практике получить привлекательный по дизайну (или как минимум не вызывающий отторжения)\n        и удобный для посетителя сайт не такая тривиальная задача, как видится\n        на первый взгляд. Для создания приятного и простого в использовании сайта, красиво\n        представляющего контент, хорошо читаемого и без ненужных излишеств, требуется приложить некоторые усилия.\n        Как правило, большинство вебмастеров часто пренебрегают фактором юзабилити(англ. usability — дословно\n        «возможность использования», «способность быть использованным», «полезность») сайтов, что немного прискорбно.\n        Поэтому создание сайтов нужно доверять слаженной команде специалистов, способных выполнить эту\n        многоступенчатую работу в заранее оговоренные сроки.\n    </p>\n    <div>\n        <img width=\"250\" height=\"208\" class=\"resp_img no_border no_shadow align-left img-outs4\" src=\"/img/main_img/response.png\"\n             alt=\"адаптивная верстка\" title=\"адаптивная верстка\">\n        <h2 id=\"response\" class=\"header_shadow\">Создание сайтов с адаптивным дизайном</h2>\n        <p>\n            <strong>Адаптивная верстка</strong> или <strong>адаптивный дизайн</strong> (респонсивный дизайн, отзывчивый\n            дизайн, responsive web design, RWD)—\n            направление в веб дизайне, когда ресурс должен быть одинаково удобным для просмотра и без потери функционала\n            читаем на\n            любых устройствах вне зависимости от ширины экрана. Будь то смартфон, планшет, ноутбук, настольный\n            компьютер, проектор или даже устройство, которого еще нет, но появится в будущем.\n        </p>\n        <p>\n            Сайт, который Вы сейчас видите разработан с учетом минимальной ширины экрана 340 пикселей без\n            горизонтального скролла. Вы можете попробовать уменьшить окно вашего браузера и нажав кнопку \"обновить\"\n            или клавишу F5 увидите, как изменилась страница. При определенной ширине экрана левое меню исчезнет\n            и вместо него появиться знакомый многим \"гамбургер\", верхнее меню уменьшится в размерах\n            или сложиться \"в два\" или \"в три этажа\", уменьшатся в размерах некоторые изображения и часть шрифтов.\n            Это лишь один из возможных способов добиться адаптивного дизайна.\n        </p>\n        <p>\n            <strong>Создание сайтов с адаптивным дизайном</strong> сегодня является правилом хорошего тона при\n            веб разработке. Мы готовы предоставить услуги как по созданию адаптивных сайтов,\n            так и по редизайну существующих сайтов с учетом адаптивности.\n        </p>\n    </div>\n</article>','Создание сайтов в Чебоксарах','Создание сайтов любой сложности и назначения В Чебоксарах','','Mon, 14 Nov 2022 06:28:43 GMT','2022-11-04 13:39:15','2022-11-14 06:32:45',NULL),(3,'prodvijenie','<article>\n    <img width=\"250\" height=\"144\" class=\"resp_img\" src=\"/img/main_img/seo.jpg\" alt=\"продвижение сайтов\" title=\"продвижение сайтов\">\n    <h2 id=\"base_seo\" class=\"header_shadow\">Продвижение сайта, необходимый минимум и с чего начинается раскрутка\n        сайта</h2>\n    <h3>Продвижение сайта и базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr><sup class=\"prim\">*</sup> оптимизация</h3>\n    <p>\n        Обычно вопрос нужно ли продвижение сайта возникает вскоре после того, как Ваш сайт появился в сети интернет.\n        Мы профессионально занимаемся оказанием услуг физическим и юридическим лицам, планирующим активную\n        маркетинговую деятельность в сети.\n    </p>\n    <p>\n        <mark><strong>Раскрутка сайта</strong> <b>малоэффективна</b></mark>\n        ,(или даже бессмысленна) если внутренняя структура страниц не подчиняется\n        определенным правилам.\n        Что бы добиться структурной и семантической правильности страниц и проводится\n        <mark><strong>базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n                оптимизация.</strong></mark>\n        <br>\n        Базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n        оптимизация начинается с написания правильных мета тегов таких как <code>description</code> и наличия\n        ключевых слов в теге <code><b>title</b></code>.\n        Положительное влияние на продвижение сайта так же оказывает наличие заголовков H1 и далее, их\n        правильная структура и наличие ключевых фраз в них, оптимизация изображений и тега <code><b>alt</b></code>,\n        написание привлекательного для посетителей сниппета. На этом этапе, который идет в процессе верстки мы\n        добиваемся корректности внутренней структуры страниц с точки зрения поисковых машин и соответствия\n        стандартам консорциума <abbr title=\"англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины\">W3C.</abbr><sup class=\"prim\">**</sup>\n    </p>\n    <p>\n        Благоприятное действие на продвижение сайта оказывает так же их корректное\n        отображение на мобильных устройствах.\n        Ну и конечно правильная орфография всех текстов Вашего сайта. (Даже если у вас красный диплом филолога\n        и вы уверены в правописании необходимо будет проверить текст в специальных сервисах поисковых систем,\n        ведь Яндекс может считать по другому).\n    </p>\n    <p>\n        Сразу же после выкладки на выбранный хостинг мы регистрируем Ваш\n        сайт в поисковых системах Яндекс и Google и(по желанию заказчика) устанавливаем счетчики посещений.\n        Настраивается правильная отдача сервером заголовков <code><b>LastModified</b></code>, проводиться склейка\n        зеркал.\n        Создаются файлы <code><b>sitemap.xml</b></code> и <code><b>robots.txt</b></code>. Возможно сделать\n        автоматическую генерацию файла <code><b>sitemap.xml</b></code>.\n    </p>\n    <p>\n        <b class=\"underline\">Примечания:</b><br>\n        <em>\n            <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\"><b>SEO</b></abbr>\n            (search engine optimization) — оптимизация для поисковых машин, в народном фольклоре\n            продвижение или раскрутка сайта.<br>\n            <abbr title=\"англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины\"><b>W3C</b></abbr>\n            (World Wide Web Consortium) — всемирный консорциум по интернету.\n        </em>\n    </p>\n</article>\n<div class=\"hr\"></div>\n<article>\n    <h2 id=\"key_seo\" class=\"header_shadow anchors\">Продвижение сайта (раскрутка сайта) по ключевым фразам</h2>\n    <p>\n        В первую очередь необходимо ответить на несколько важных вопросов:<br>\n        Для чего вам нужен сайт ?<br>\n        Для чего сайт нужен вашим пользователям ?<br>\n        Чем он лучше/хуже других похожих сайтов ?<br>\n        Какая целевая аудитория Вашего сайта ?<br>\n        Ведь вполне может быть что именно для Вашего сайта эффективней окажется не <strong><abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            продвижение</strong> а например,&nbsp;<b><a href=\"#reklama\" class=\"list_link\">контекстная реклама</a></b>.\n    </p>\n    <p>\n        Следует сразу сказать что поисковые машины не <i>индексируют сайты,</i> они <strong>индексируют\n            страницы!</strong><br>\n        И тут самая частая ошибка горе seo-оптимизаторов это приземление всех запросов на главную страницу сайта.\n        Но раз термин <strong>продвижение сайта</strong> уже давно закрепился то и мы будем использовать его.<br>\n        На этапе продвижения по ключевым словам проводиться анализ конкурентов, составление семантического ядра сайта и\n        выбор приземляющих страниц(\n        <b>ключевая страница</b>, <b>приземляющая страница</b>, <b>jump page</b>, <b>landing page</b>, <b>точка\n            входа</b>) однозначно отвечающих на запрос пользователя\n        (запросы семантического ядра), привязка запросов к страницам сайта, внутренняя перелинковка и другая\n        оказывающая важное влияние на продвижение сайта работа.<br>\n        Обязательно проверяется текст на удобочитаемость, уникальность, плотность ключевых слов, заспамленность и\n        рекламный шум.\n        При необходимости пишутся и размещаются положительные отзывы о компании.\n\n    </p>\n    <p>\n        После того как работа над внутренней структурой сайта закончена начинается продвижение сайта\n        с учетом внешних факторов.Это в первую очередь наращивание ссылочной массы за счет регистрации в\n        \"белых\" каталогах, покупки \"вечных\" ссылок, использования сервис агрегаторов а так же блоговое и\n        статейное продвижение сайта. Проводиться настройка целей в системах Яндекс метрика и Google analitics.<br>\n        Мы используем <b>только легальные способы продвижения</b>. \"Черная\" SEO оптимизация не наш профиль!\n    </p>\n    <div id=\"seo_list\">\n        <h3 class=\"header_shadow\">SEO продвижение сайта, основные требования к ресурсу:</h3>\n        <ul>\n            <li>Все доступы и права принадлежат владельцу сайта</li>\n            <li>Возраст ресурса превышает 1 год</li>\n            <li>Сайт находиться в работоспособном состоянии</li>\n            <li>Хостинг соответствует заявленным требованиям скорости/нагрузки</li>\n            <li>Сайт не аффилирован и не имеет однотипного поддомена</li>\n            <li>Сайт является основным зеркалом</li>\n            <li>Сбалансированное семантическое ядро</li>\n            <li>Контент</li>\n            <li>Сайт не содержит запрещенных законом материалов</li>\n            <li>На сайте информативная входная страница</li>\n        </ul>\n    </div>\n    <br>\n    <p>\n        Стоимость на продвижение сайта по ключевым фразам зависит от многих факторов: <br>\n        коммерческой популярности запроса, возраста сайта и др.\n    </p>\n    <a href=\"/#contacts\" title=\"продвижение сайта стоимость\" class=\"zayavka link-anim\"><span class=\"fab fa-telegram-plane no-sh\"></span> узнать стоимость продвижения для Вашего сайта</a><br>\n    <br>\n</article>\n<div class=\"hr\"></div>\n<article>\n    <h2 id=\"context\" class=\"header_shadow anchors\">Контекстная реклама</h2>\n    <!-- <h3 class=\"header_shadow\">Контекстная реклама. Что это?</h3> -->\n    <p>\n        SEO продвижение сайта в топ 10 яндекса может занять от 3 до 6 месяцев в зависимости от ряда\n        факторов. Да и стоит это ощутимых денег. Совсем нередко стоимость SEO продвижения сайта превышает стоимость\n        разработки самого сайта.Что же делать если коммерческая отдача нужна незамедлительно?\n    </p>\n    <p>\n        Выход есть! Вам на помощь придет <strong>контекстная реклама</strong>.<br>\n    </p>\n    <p>Пользователи ежедневно заходят на разные тематические сайты раздраженно выключая всевозможные\n        рекламные баннеры и игнорируя назойливые объявления. Совсем другой случай когда пользователь при\n        посещении Яндекса видит текстовый блок по интересующей его тематике. Вкратце это и есть контекстная\n        реклама. При этом информация о Вашем сайте попадает в топ выдачи Яндекса независимо от того на\n        какой позиции он реально находиться.\n    </p>\n    <p>\n        Если вы обращали внимание на надпись \"реклама\" в поисковой выдаче Яндекса или Google то это оно и есть.<br>\n        Пользователь заходит на поисковик, вводит свой запрос и видит примерно\n        следующее:\n    </p>\n    <figure class=\"kontext_img\">\n        <img width=\"400\" height=\"382\" class=\"resp_img\" src=\"/img/main_img/yandex.jpg\" alt=\"контекстная реклама на Яндекс\" title=\"контекстная реклама на Яндекс\">\n        <figcaption class=\"strong_text\">Так может выглядеть реклама на Яндекс</figcaption>\n    </figure>\n    <figure class=\"kontext_img\">\n        <img width=\"400\" height=\"382\" class=\"resp_img\" src=\"/img/main_img/google.jpg\" alt=\"контекстная реклама на Google\" title=\"контекстная реклама на Google\">\n        <figcaption class=\"strong_text\">Контекстная реклама на Google Adwords</figcaption>\n    </figure>\n    <p class=\"clear\">\n        То, что выделено на фото красной рамкой и есть контекстная реклама. Туда можете попасть\n        и Вы.\n        Для этого нужно составить грамотный список ключевых фраз наиболее релевантных\n        роду деятельности Вашей фирмы и уже на их основании написать привлекательные для потенциальных клиентов\n        объявления с\n        заголовками.\n    </p>\n    <p>\n        К плюсам контекстной рекламы относиться также то, что Вы платите лишь за непосредственный переход\n        на Ваш сайт и сами устанавливаете цену за клик. Чем выше Вы заявили стоимость перехода,\n        тем выше будет Ваша позиция на странице выдачи поисковика (действует аукционный принцип). Можно также настроить\n        выдачу в зависимости\n        от времени суток или от географической привязки. Например, объявление \"доставка пиццы\" показывать\n        с 11<sup>00</sup> до 14<sup>00</sup>(т.е. в обеденное время) в регионе Чебоксары.\n    </p>\n    <h3 class=\"header_shadow\">Настройка контекстной рекламы</h3>\n    <p>\n        Мы готовы профессионально провести рекламную компанию Вашей фирмы в Яндекс и Google\n        по современным маркетинговым техникам. Составим объявления, подберем популярные ключевые слова, соответствующие\n        роду деятельности Вашей организации.\n    </p>\n    <p>\n    </p><ul>\n        <li><strong>Настройка рекламы на Яндекс</strong> <span class=\"red\">3&#8202;000</span> <span class=\"fa fa-ruble-sign\"></span></li>\n        <li><strong>Настройка рекламы на Google</strong> <span class=\"red\">3&#8202;000</span> <span class=\"fa fa-ruble-sign\"></span></li>\n        <li><strong>Настройка рекламы на Яндекс Директ и Google Adwords</strong> <span class=\"red\">4&#8202;500</span> <span class=\"fa fa-ruble-sign\"></span> (единоразово)\n        </li>\n    </ul>\n    <strong>Профессиональное ведение рекламной кампании</strong> от <span class=\"red\">3&#8202;000</span> <span class=\"fa fa-ruble-sign\"></span>/месяц<br>\n    <span class=\"strong_text\">При заказе сайта от <span class=\"red\">40&#8202;000</span> <span class=\"fa fa-ruble-sign\"></span> настройку проведем <b class=\"underline\">БЕСПЛАТНО.</b></span>\n    <p></p>\n    <h2>Продвижение сайта методами <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n        или контекстная реклама, что выбрать?</h2>\n    <p>\n        Следует сказать, что контекстная реклама абсолютно не влияет на позицию сайта в поисковой выдаче.\n        Поэтому большинство компаний используют оба инструмента (и <b>контекстную рекламу</b> и <b>SEO продвижение</b>)\n        для наибольшей эффективности. Еще отметим что результат от контекстной рекламы очень скор, но и пропадет сразу\n        как закончатся Ваши деньги на счету того же яндекса т.е. платить придется\n        постоянно (впрочем, как и в любой другой рекламе). Для продвижения сайта ситуация другая —\n        результата приходится ждать обычно до 3 месяцев (иногда более) но и результат долгосрочный. При грамотном\n        продвижении\n        сайта подвинуть его из топа будет не так просто (мы не занимаемся \"черным\" продвижением когда сайт\n        за 2 недели попадает в топ а затем вылетает в бан). В нашей практике были случаи когда сайт уже после\n        прекращения <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr> продвижения висел в топе еще 2 года.<br> Поэтому наша рекомендация — применяйте\n        и <b>продвижение сайта</b> и <b>контекстную рекламу!</b>\n    </p>\n</article>','Продвижение сайтов в Чебоксарах','Продвижение в поисковых системах и раскрутка в сети в Чебоксарах','','Mon, 14 Nov 2022 06:30:24 GMT','2022-11-04 13:39:15','2022-11-14 06:32:45',NULL),(4,'portfolio','<div class=\"h2 header_shadow text-center\">Наши работы</div><br/>\n<div id=\"portf\" class=\"min_height\">\n\n                <div class=\"atv-outer\">\n            <div class=\"portf-title\">сайт фирмы <a href=\"http://houme21.ru\"> HOUME21</a></div>\n            <a href=\"http://houme21.ru\" target=\"_blank\">\n                <figure class=\"a-image atvImg\">\n                    <div class=\"atvImg-shadow\"></div>\n                    <img class=\"atvImg-layer\" data-img=\"/img/main_img/portfolio/img1.jpg\"\n                         title=\"Сайт фирмы HOUME21\"\n                         alt=\"Сайт фирмы HOUME21\">\n                    <!-- <div class=\"atvImg-layer\" data-img=\"/img/main_img/solo_smal.jpg\"></div> -->\n                </figure>\n            </a>\n        </div>\n                    <div class=\"atv-outer\">\n            <div class=\"portf-title\">сайт фирмы <a href=\"http://s-solo.ru\"> Соло мебель</a></div>\n            <a href=\"http://s-solo.ru\" target=\"_blank\">\n                <figure class=\"a-image atvImg\">\n                    <div class=\"atvImg-shadow\"></div>\n                    <img class=\"atvImg-layer\" data-img=\"/img/main_img/portfolio/img2.jpg\"\n                         title=\"Сайт фирмы Соло мебель\"\n                         alt=\"Сайт фирмы Соло мебель\">\n                    <!-- <div class=\"atvImg-layer\" data-img=\"/img/main_img/solo_smal.jpg\"></div> -->\n                </figure>\n            </a>\n        </div>\n            </div>\n<script>\n    function atvImg() {\n        function e(e, t, a, r, s, o) {\n            var i = n.scrollTop || l.scrollTop, d = n.scrollLeft, c = t ? e.touches[0].pageX : e.pageX, m = t ? e.touches[0].pageY : e.pageY, v = a.getBoundingClientRect(), f = a.clientWidth || a.offsetWidth || a.scrollWidth, g = a.clientHeight || a.offsetHeight || a.scrollHeight, h = 320 / f, u = .52 - (c - v.left - d) / f, p = .52 - (m - v.top - i) / g, y = m - v.top - i - g / 2, E = c - v.left - d - f / 2, C = .07 * (u - E) * h, I = .1 * (y - p) * h, N = \"rotateX(\" + I + \"deg) rotateY(\" + C + \"deg)\", x = Math.atan2(y, E), b = 180 * x / Math.PI - 90;\n            0 > b && (b += 360), -1 != a.firstChild.className.indexOf(\" over\") && (N += \" scale3d(1.07,1.07,1.07)\"), a.firstChild.style.transform = N, o.style.background = \"linear-gradient(\" + b + \"deg, rgba(255,255,255,\" + (m - v.top - i) / g * .4 + \") 0%,rgba(255,255,255,0) 80%)\", o.style.transform = \"translateX(\" + u * s - .1 + \"px) translateY(\" + p * s - .1 + \"px)\";\n            for (var L = s, S = 0; s > S; S++)r[S].style.transform = \"translateX(\" + u * L * (2.5 * S / h) + \"px) translateY(\" + p * s * (2.5 * S / h) + \"px)\", L--\n        }\n\n        function t(e, t) {\n            t.firstChild.className += \" over\"\n        }\n\n        function a(e, t, a, r, n) {\n            var l = t.firstChild;\n            l.className = l.className.replace(\" over\", \"\"), l.style.transform = \"\", n.style.cssText = \"\";\n            for (var s = 0; r > s; s++)a[s].style.transform = \"\"\n        }\n\n        var r = document, n = (r.documentElement, r.getElementsByTagName(\"body\")[0]), l = r.getElementsByTagName(\"html\")[0], s = window, o = r.querySelectorAll(\".atvImg\"), i = o.length, d = \"ontouchstart\" in s || navigator.msMaxTouchPoints;\n        if (!(0 >= i))for (var c = 0; i > c; c++) {\n            var m = o[c], v = m.querySelectorAll(\".atvImg-layer\"), f = v.length;\n            if (!(0 >= f)) {\n                for (; m.firstChild;)m.removeChild(m.firstChild);\n                var g = r.createElement(\"div\"), h = r.createElement(\"div\"), u = r.createElement(\"div\"), p = r.createElement(\"div\"), y = [];\n                m.id = \"atvImg__\" + c, g.className = \"atvImg-container\", h.className = \"atvImg-shine\", u.className = \"atvImg-shadow\", p.className = \"atvImg-layers\";\n                for (var E = 0; f > E; E++) {\n                    var C = r.createElement(\"div\"), I = v[E].getAttribute(\"data-img\");\n                    C.className = \"atvImg-rendered-layer\", C.setAttribute(\"data-layer\", E), C.style.backgroundImage = \"url(\" + I + \")\", p.appendChild(C), y.push(C)\n                }\n                g.appendChild(u), g.appendChild(p), g.appendChild(h), m.appendChild(g);\n                var N = m.clientWidth || m.offsetWidth || m.scrollWidth;\n                m.style.transform = \"perspective(\" + 3 * N + \"px)\", d ? (s.preventScroll = !1, function (r, n, l, o) {\n                    m.addEventListener(\"touchmove\", function (t) {\n                        s.preventScroll && t.preventDefault(), e(t, !0, r, n, l, o)\n                    }), m.addEventListener(\"touchstart\", function (e) {\n                        s.preventScroll = !0, t(e, r)\n                    }), m.addEventListener(\"touchend\", function (e) {\n                        s.preventScroll = !1, a(e, r, n, l, o)\n                    })\n                }(m, y, f, h)) : !function (r, n, l, s) {\n                    m.addEventListener(\"mousemove\", function (t) {\n                        e(t, !1, r, n, l, s)\n                    }), m.addEventListener(\"mouseenter\", function (e) {\n                        t(e, r)\n                    }), m.addEventListener(\"mouseleave\", function (e) {\n                        a(e, r, n, l, s)\n                    })\n                }(m, y, f, h)\n            }\n        }\n    }\n    atvImg();\n</script>\n\n\n                        ','Создание и продвижение сайтов от Alex-art21','Создание и продвижение сайтов в Чебоксарах',NULL,'Mon, 14 Nov 2022 06:30:39 GMT','2022-11-04 13:39:15','2022-11-14 06:32:45',NULL),(5,'parsing','<img width=\"250\" height=\"167\" class=\"resp_img\" src=\"/img/main_img/parsing.jpg\" alt=\"парсинг сайтов\" title=\"парсинг сайтов\">\r\n<article>\r\n    <h2 class=\"header_shadow\">Парсинг сайтов</h2>\r\n    <p>\r\n        <span class=\"mark\">Создали сайт и не знаете чем его наполнить ?</span><br/>\r\n        Подобная проблема совсем не редкость.Где же взять контент?\r\n        Конечно же в интернете.\r\n    </p>\r\n    <p>\r\n        Другая ситуация - Вам необходим постоянный мониторинг сайтов например конкурентов.И в этом случае\r\n        Вам на помощь придут программы парсеры.\r\n    </p>\r\n    <h3 class=\"header_shadow\">Что же такое парсинг сайтов и кому это может понадобится</h3>\r\n    <p>\r\n        Говоря по простому парсинг сайтов это получение любых необходимых структурированных\r\n        данных из сети интернет.Т.е. добывание нужной информации как то статьи,картинки,\r\n        видео или любой другой контент.Конечно все это можно сделать и вручную. <b>Но !</b><br/>\r\n        Если вам нужно найти и скачать несколько фотографий или статей то конечно яндекс с\r\n        гуглом вам в помощь.<br/>\r\n        При больших же объемах информации делать это вручную весьма утомительно.\r\n        Этот процесс можно автоматизировать.Тут Вам на помощь придут программы парсеры.\r\n    </p>\r\n    <p>\r\n        <strong>Достоинства парсинга:</strong>\r\n    <ul>\r\n        <li><span class=\"fa fa-check logo\"></span>\r\n            Программа парсер быстро и и безошибочно отделит служебную и техническую информацию\r\n            от нужной.\r\n        </li>\r\n        <li><span class=\"fa fa-check logo\"></span>\r\n            Парсер легко справляется с большими объемами информации.\r\n        </li>\r\n        <li><span class=\"fa fa-check logo\"></span>\r\n            Минимальное участие человека.Практически весь процесс автоматизирован.\r\n        </li>\r\n    </ul>\r\n    <br/>\r\n    <strong>Недостатки:</strong>\r\n    <br/>\r\n    <p>\r\n        Недостаток пожалуй единственный но достаточно серьезный. Это <b>Копипаст!</b><br/>\r\n        Копипаст первейший враг поисковых машин!<br/>\r\n        Поэтому всегда старайтесь использовать уникальный контент.\r\n\r\n    </p>\r\n    <p>\r\n        Стоимость парсинга сайта начинается от <span class=\"red\">1&#8202;500</span><span class=\"fa fa-ruble-sign\"></span>\r\n    </p>\r\n    <p>\r\n        Если Вам нужен парсинг сайта свяжитесь с нами любым удобным для Вас способом.Мы осуществим\r\n        парсинг любых сайтов в том числе и сайтов с авторизацией и соцсетей.<br>\r\n        Полученные данные предоставим в любом удобном для Вас формате(CSV,XLS,или дамп базы данных).\r\n    </p>\r\n</article>','Парсинг сайтов в Чебоксарах','Парсинг сайтов в Чебоксарах','parsing','Mon, 14 Nov 2022 06:28:19 GMT','2022-11-04 13:39:15','2022-11-14 06:32:45',NULL),(10,'bla','<h1>NEW PAGE-BLA</h1>\r\n\r\n<p><img alt=\"\" src=\"https://alexart.laravel/storage/uploads/no-image_1667817655.png\" style=\"float:right; height:249px; width:268px\" /></p>','New page',NULL,NULL,'Mon, 14 Nov 2022 06:48:01 GMT','2022-11-06 06:08:34','2022-11-14 06:56:42',NULL);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (24,'2019_12_14_000001_create_personal_access_tokens_table',1),(25,'2022_10_30_161449_create_oauth_table',1),(26,'2022_08_10_220847_create_roles_table',2),(27,'2022_08_10_221542_create_role_user_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth`
--

DROP TABLE IF EXISTS `oauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_user_id_foreign` (`user_id`),
  CONSTRAINT `oauth_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth`
--

LOCK TABLES `oauth` WRITE;
/*!40000 ALTER TABLE `oauth` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('Mihalych21@mail.ru','$2y$10$57dTTb6AZirIAR8Bt8ZlFu0qW4dm1uGAht8TOjRDCo.YjRP9Ku6nK','2022-10-18 13:29:34');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,NULL,NULL,1,1),(3,NULL,NULL,2,1),(4,NULL,NULL,2,2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'2022-11-13 10:41:51','2022-11-13 10:41:51','admin','Главный по сайту'),(2,'2022-11-13 10:41:51','2022-11-13 10:41:51','manager','Менеджер- Надсмотрщик за писателями');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('HooBc0AhQIf2scOAfFGCojG506RGMRlZamUpO9ep',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3FrR05hYk9wTTAwS3R5RWx1OTh5MGFMWENNR2NBRTBmSjNPRU1wVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9hbGV4YXJ0LmxhcmF2ZWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1666243782),('rt1eI7pglkcQAPY2HioEqmSG18SjibzlHCaxxyOD',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVEdFQ1JIWkhLdmVUM2htVTVZR0dONlUxYk9nQWVXQmNnM0tJMGpxRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9hbGV4YXJ0LmxhcmF2ZWwvYXV0aC9nb29nbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6InN0YXRlIjtzOjQwOiJrOEhDTTBRVDJYMGZmdXpUQ2V4ZWp3WGZIVzE4T1V1U216TmJJYmNEIjt9',1666199504);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','aa@aa.aa',10,NULL,NULL,'profile-photos/1ARLjUaa1IjNThktXgPp3gZfF8aBT4vS6L6qORJ9.png','2022-11-01 15:36:13','$2y$10$UMekB1NmBJUWhbqDAPfJuuKZ6kVe68.1io26k/UwRnUL0WRT8OR06',NULL,NULL,NULL,NULL,'2022-11-10 10:35:11','2022-11-11 08:21:13'),(2,'vasya','vasya@mail.ru',0,NULL,NULL,'profile-photos/Eu42fLy4m7hzMLDqmTXOhkBJDSGuQKij7lArujUk.jpg','2022-11-01 11:46:21','$2y$10$S1JXuc8ct9V72UrafoT4t.L9GROx3OvkkY1WBqFfkzoAphYoJJHCm',NULL,NULL,NULL,NULL,'2022-11-11 08:50:07','2022-11-11 10:36:15'),(184,'petya','petya@mail.ru',0,NULL,NULL,'profile-photos/GlqykNtZ2XYFzLa9inIgUkHiex9KQlIh4rc08Afx.jpg','2022-11-01 15:12:24','$2y$10$VEYDzoqcoEILAeqQPidgmOLUjAcBT5dqR8.CvvK/ydaG.keT.DVqe',NULL,NULL,NULL,NULL,'2022-11-13 15:12:09','2022-11-13 15:15:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ssolo_alexart'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-14 10:01:50

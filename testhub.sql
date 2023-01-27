-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 27 2023 г., 20:14
-- Версия сервера: 8.0.26
-- Версия PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testhub`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_23_162709_create_projects_table', 2),
(6, '2022_10_25_174723_create_tasks_table', 3),
(7, '2022_10_28_193902_create_steps_table', 4),
(8, '2022_12_23_183648_create_runs_table', 5),
(9, '2023_01_26_163840_create_run_results_table', 6),
(10, '2023_01_26_164010_create_run_statuses_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `Project_id` bigint UNSIGNED NOT NULL,
  `Project_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Project_isCommon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Project_About` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`Project_id`, `Project_Name`, `Project_isCommon`, `Project_About`, `created_at`, `updated_at`) VALUES
(1, 'Стационар', NULL, 'Проект Стационар - тестовая документация направления \"Стационар\"', NULL, NULL),
(2, 'Поликлиника', NULL, NULL, NULL, NULL),
(3, 'ЛИС', NULL, 'тестовая документация команды ЛИС', NULL, '2022-10-23 13:36:31'),
(4, 'Autotest', NULL, 'oaphpv oighre[oi oaphpv oighre[oioaphpv oighre[oioaphpv oighre[oi oaphpv oighre[oioaphpv oighre[oioaphpv oighre[oi oaphpv oighre[oioaphpv oighre[oioaphpv', NULL, NULL),
(5, 'testAPI', 'true', 'описание', '2022-10-23 12:35:08', NULL),
(6, 'testAPI2', 'true', 'описание', '2022-10-23 12:35:33', NULL),
(7, 'Миграция', NULL, NULL, NULL, NULL),
(9, 'Регресс общий', '1', 'проект регресса, содержит ТК всех модулей промеда', '2022-10-23 12:46:05', NULL),
(10, '123', '1', '2343', '2022-10-23 12:46:44', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `runs`
--

CREATE TABLE `runs` (
  `Run_id` bigint UNSIGNED NOT NULL,
  `Project_id` int NOT NULL,
  `Run_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Run_Type` int NOT NULL,
  `Run_Status` int NOT NULL,
  `Run_Desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Run_EndDt` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `runs`
--

INSERT INTO `runs` (`Run_id`, `Project_id`, `Run_Name`, `Run_Type`, `Run_Status`, `Run_Desc`, `Run_EndDt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Спринт 22-30', 0, 0, NULL, '2022-12-31', '2022-12-23 18:50:08', '2023-01-27 14:34:28'),
(2, 1, 'релиз 7.9.9', 1, 0, 'для релиза', NULL, '2023-01-26 14:55:28', '2023-01-27 14:34:29'),
(3, 1, 'Пермь Миграция на PG', 2, 1, 'тест-ран для тестирования миграции Перми на PG', '2022-02-02', '2023-01-27 14:38:07', '2023-01-27 14:39:39');

-- --------------------------------------------------------

--
-- Структура таблицы `run_results`
--

CREATE TABLE `run_results` (
  `id` bigint UNSIGNED NOT NULL,
  `Task_id` int NOT NULL,
  `RunStatus_id` int DEFAULT NULL,
  `RunResult_Comment` text COLLATE utf8mb4_unicode_ci,
  `RunResult_TimeSpent` int DEFAULT NULL,
  `User_id` int DEFAULT NULL,
  `RunResult_SectionId` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `run_statuses`
--

CREATE TABLE `run_statuses` (
  `RunStatus_id` bigint UNSIGNED NOT NULL,
  `RunStatus_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `run_statuses`
--

INSERT INTO `run_statuses` (`RunStatus_id`, `RunStatus_Name`, `created_at`, `updated_at`) VALUES
(1, 'Положительный', '2023-01-26 16:54:53', NULL),
(2, 'Пропущен', '2023-01-26 16:55:21', NULL),
(3, 'Блокируется', '2023-01-26 16:55:38', NULL),
(4, 'Отрицательный', '2023-01-26 16:56:28', NULL),
(5, 'Не тестировалось', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `steps`
--

CREATE TABLE `steps` (
  `Step_id` bigint UNSIGNED NOT NULL,
  `Step_Number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_id` int NOT NULL,
  `Step_Action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Step_Result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `steps`
--

INSERT INTO `steps` (`Step_id`, `Step_Number`, `Task_id`, `Step_Action`, `Step_Result`, `created_at`, `updated_at`) VALUES
(10, '1', 26, '\"<ul><li>\\u041e\\u0442\\u043a\\u0440\\u044b\\u0442\\u044c \\u041a\\u0412\\u0421<\\/li><li>\\u0414\\u043e\\u0431\\u0430\\u0432\\u0438\\u0442\\u044c \\u0434\\u0438\\u0430\\u0433\\u043d\\u043e\\u0437<\\/li><li>\\u0417\\u0430\\u043a\\u0440\\u044b\\u0442\\u044c \\u041a\\u0412\\u0421<\\/li><\\/ul><p><br><\\/p><p><strong>\\u041f\\u043e\\u0441\\u043c\\u043e\\u0442\\u0440\\u0435\\u0442\\u044c \\u043e\\u0442\\u0441\\u0443\\u0442\\u0441\\u0442\\u0432\\u0438\\u0435 \\u043e\\u0448\\u0438\\u0431\\u043e\\u043a \\u043f\\u0440\\u0438 \\u0440\\u0435\\u0434\\u0430\\u043a\\u0442\\u0438\\u0440\\u043e\\u0432\\u0430\\u043d\\u0438\\u0438 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u0430<\\/strong><\\/p><p><strong><span class=\\\"ql-cursor\\\">\\ufeff<\\/span><\\/strong><img src=\\\"data:image\\/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD0AAAA\\/CAYAAABTqsDiAAADkElEQVRoQ+1aT0gUURj\\/2aWg8rJEJMmyh7oldNGKvawI\\/TlEbBTEhnWJEpKgLfKQS+x20MogDDTyUAtLkCTRwRKivUil0MVDgYZmhWJBhygqKGzmzbzZ+fNmffNGl5n1zWmZ971vvt+f970H+2oWlQer7KmRoFeJ4lLpVSI0pNJS6SpmQNq7isW1QJNKS6WrmAFp7yoWVzYyaW9Rew93JJEdt87ec2kIN\\/eKZlzZef6UnrqH5OknwJEeDLXFSpWO5JCcPm59t7I4PGX3AbqI8829QIAVdWNCGPRkXxtaR5uQL5zEdpfsJGZwwTna2I7XXQlAd8ocjdhyUM+nEfrSMXMzUpebULw6hsSdPrRvMwUo7trVDWRedOIAeW3PoczV5wiCnkFvKo1i3GZrV5OpBTxEzFbocEcO6KJFajkL9Tohei5C3OxRjSTysL9N+gqsZJqX3WRfDiMtnYQoX6BnWnmbFRu0nSOWe5yglVmqqvl6k8us+S0EMITwBdqv0mo9js5vWFyrlgmaWNfkHAsJmhPKCSIIWi+W2mnJ3slQmq5nur4pQFufYIPWvj8Q1ZaX+vt5grpuBUETi3XPGc2hPG4naFcrc4ImTfCK0hIKUfQ3j6LFaGBLCyKstGE9pTs7DiKOfZqhtL3bUuW57E0b2jUgXofCbNzU6JQxxvlhGRqZSVf7tkOGdpq2Drp9sLq36SSngM3Ex5DlVZouh0Gw3ea6HQp37yUXcUUCeM4KrEJ82bsiyFw\\/4vWsUEoUXtCOExi\\/BCEETY+XpWMlP1wtMoSgvUJ0xkvQ\\/jkMRwapdDh08l+lVNo\\/h+HIIJUOh07+q5RKe+Hw1+8\\/WPjyDd9\\/\\/PQyLRCxQkqrgKemP6Gudj0i+AeE7KalEOgPH+exYQ0QWfwbCOW8FiEEeuLte+yoXRc6hSk54qA3rvVKcGDiJWheKYi9pdK8dAUjTtqbVwdpb16mAhQn7c0rhrQ3L1MBiqusvWcf43BmAolsBmejdhbGkT7xDDHm2PIyJkHz8im8pqXSPPZWLV8oXa3alED+xiGYb1JZsoz2Y\\/fdd6ZXEaSM5fIZty9cR+Gr4H9ZlVFaA4xTt9AT13A87TmH7HwZ4AS0cpfs\\/hnst7Chk9eQwqt0o9gfeP5AF2FclnOsp5IyUw+yaJ3bR4o0nrLLQ4lyAU1yvWkwXBLYRkZUnWB1GbNlbeMuoNVcA3UX8ejYVjLhP4jCBWDMLkRsAAAAAElFTkSuQmCC\\\"><\\/p>\"', '\"<p>\\u041e\\u0448\\u0438\\u0431\\u043a\\u0438 \\u043d\\u0435 \\u043f\\u043e\\u044f\\u0432\\u043b\\u044f\\u044e\\u0442\\u0441\\u044f<\\/p>\"', NULL, NULL),
(11, '1', 27, '\"<ul><li><strong>543<\\/strong><\\/li><\\/ul>\"', '\"<p>5434<\\/p>\"', NULL, NULL),
(12, '2', 27, '\"<ul><li>243234\\u043c\\u0443\\u0435\\u043a<\\/li><\\/ul><p>\\u043c\\u0443\\u043a<\\/p><p><br><\\/p><p>\\u043c\\u0435\\u043a\\u0443<\\/p>\"', '\"<p>\\u043e\\u0436\\u0438\\u0434\\u0430\\u0435\\u043c 2<\\/p>\"', NULL, NULL),
(13, '1', 27, '\"<ul><li><strong>543<\\/strong><\\/li><\\/ul>\"', '\"<p>5434<\\/p>\"', NULL, NULL),
(14, '2', 27, '\"<ul><li>243234\\u043c\\u0443\\u0435\\u043a<\\/li><\\/ul><p>\\u043c\\u0443\\u043a<\\/p><p><br><\\/p><p>\\u043c\\u0435\\u043a\\u0443<\\/p>\"', '\"<p>\\u043e\\u0436\\u0438\\u0434\\u0430\\u0435\\u043c 2<\\/p>\"', NULL, NULL),
(15, '3', 27, 'null', 'null', NULL, NULL),
(65, '1', 28, '\"<p>123432<\\/p><ol><li>432<\\/li><li>334<\\/li><li>432<\\/li><li>432<\\/li><li>34<\\/li><\\/ol>\"', '\"<p><strong>43243<\\/strong><\\/p><p><strong>rr<\\/strong><\\/p><p><strong>wce<\\/strong><\\/p><p><br><\\/p><p><strong>ewcr<\\/strong><\\/p>\"', NULL, NULL),
(66, '2', 28, '\"<p>qe rt qter<\\/p>\"', '\"<p><strong> qetrq etrqtre <\\/strong><\\/p>\"', NULL, NULL),
(67, '3', 28, '\"<p><span class=\\\"ql-size-large\\\">c\\tcre<\\/span><em class=\\\"ql-size-large\\\">w\\terw\\tcrewrcew\\t<\\/em><\\/p>\"', '\"<p>2wcerr\\twece<em>wr\\tce\\twrcre\\tw\\tcerw<\\/em>creer<\\/p>\"', NULL, NULL),
(69, '1', 1, '\"<p>1<\\/p>\"', '\"<p>1<\\/p>\"', NULL, NULL),
(70, '1', 7, '\"<p>1<\\/p>\"', '\"<p>2<\\/p>\"', NULL, NULL),
(75, '1', 3, '\"<p>et<\\/p>\"', '\"<p>rqe terq<\\/p>\"', NULL, NULL),
(78, '1', 30, '\"<p> eeg<\\/p>\"', '\"<p>qr ger<\\/p>\"', NULL, NULL),
(79, '2', 30, '\"<p>eq<\\/p>\"', '\"<p>greq gerq ger<\\/p>\"', NULL, NULL),
(80, '1', 31, '\"<p>\\u041e\\u0430\\u043e\\u043f\\u0430\\u043e\\u0430\\u043f <\\/p>\"', '\"<p>\\u0412\\u0441\\u0435 \\u0445\\u043e\\u0440\\u043e\\u0448\\u043e<\\/p>\"', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `Task_id` bigint UNSIGNED NOT NULL,
  `Task_Project` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_JiraProject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_Number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_Priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_Stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_isActual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Task_Folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`Task_id`, `Task_Project`, `Task_JiraProject`, `Task_Number`, `Task_Name`, `Task_Priority`, `Task_Stage`, `Task_isActual`, `Task_Folder`, `created_at`, `updated_at`) VALUES
(1, '1', 'PROMEDWEB', '213432', 'Доработки СЭМД \"Выписной эпикриз из роддома\"', '1', '1', NULL, NULL, '2022-10-25 19:45:07', '2022-11-06 14:30:39'),
(2, '1', 'PROMEDWEB', '137845', 'МСЭ и ВК. Добавление нового поля', '2', '1', NULL, NULL, '2022-10-27 12:56:42', NULL),
(3, '1', 'PROMEDWEB', '49898', 'МСЭ и ВК. Добавление исследований', '0', '2', NULL, NULL, '2022-10-27 13:01:13', '2022-12-23 13:26:51'),
(4, '1', 'PROMEDWEB', '84842', 'СЭМД Роддом - Отправка в РЭМД ЕГИСЗ по требованию заказчика (Екатеринбург прод ошибка) INC 4324323423222222222222223432423432 (SLA) Срок передачи в релиз - 39.432.321', '0', '2', NULL, NULL, '2022-10-27 13:04:20', '2022-11-03 16:48:36'),
(5, '1', 'PROMEDWEB', '64565', 'Старая задача', '1', '0', NULL, NULL, '2022-10-27 13:11:17', NULL),
(6, '2', 'PROMEDWEB', '41512', 'Задача полки', '2', '1', NULL, NULL, '2022-10-27 13:13:17', NULL),
(7, '1', 'MOBILEDEV', '77784', 'Блокер срочный', '3', '1', NULL, NULL, '2022-10-27 13:31:02', '2022-11-06 14:34:03'),
(8, '1', 'PROMEDWEB', '65412', '65н МСЭ', '1', '0', NULL, NULL, '2022-11-02 16:29:53', '2022-11-06 14:19:12'),
(9, '1', 'PROMEDWEB', '43243', '1', '1', '0', NULL, NULL, '2022-11-02 16:44:12', '2022-11-06 15:06:35'),
(10, '1', 'PROMEDWEB', '534512', 'Задачазадача1', '1', '0', NULL, NULL, '2022-11-03 12:18:55', '2022-11-06 14:22:51'),
(28, '1', 'PROMEDWEB', '1234567', '121237 задача на создание МСЭ', '1', '0', NULL, NULL, '2022-11-03 16:06:31', '2022-11-06 14:22:46'),
(29, '1', 'PROMEDWEB', '12343', '423v6524', '1', '0', NULL, NULL, '2022-11-03 16:37:13', '2022-12-23 13:16:36'),
(30, '1', 'PROMEDWEB', '1111', '11111', '1', '0', NULL, NULL, '2022-12-23 12:47:12', '2022-12-23 13:31:14'),
(31, '1', 'PROMEDWEB', '543', 'ERQT', '1', '0', NULL, NULL, '2022-12-23 13:22:50', '2023-01-26 08:53:54');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_Role` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `User_Role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$ykx.rzMfeAr1UeB7XFCE0OqrbPhNTMaUVS02v.xTCF2AEG2bRj0YG', 10, 'wUjWXgiFCjninAp5pA5DWoODlAuUQX3mC15yk2z634yyXwIcFbVwOPbJrigG', '2022-10-17 17:51:13', NULL),
(94, 'teamStac', '$2y$10$ycxBg8ckVHCpCkP8m2CCpe7o5vd0cKNzhPzCZwSAtPvmdGpSO9zMG', 3, 'coVSXsi5IpoFw6dvRGrifHg1qAlKOzHWSx2sc4dhnP4PGqjNTRj7pxNC84dE', '2022-10-22 15:30:08', '2022-10-22 15:50:25'),
(95, 'teamPolka', '$2y$10$TghVGpjWC4/vLAuUFzl7d.h.dzQoKreAvr0bZQaRIsHyBvjmwMoma', 3, 'LnFjeIspyt', '2022-10-22 15:30:28', '2022-10-22 16:05:19'),
(96, 'lexxvel', '$2y$10$5eJss9PT.NRWs5XLBew6mex4G9wate.rVFh0G4gfeLcqIroGkM4L.', 99, '2JkekBxUkz2JIqgK3vI3DPOYQLRoBNGE4DmQ2vZz10WaqFuDpAqcS1V8hpI3', '2022-10-22 15:30:47', '2022-10-22 15:30:47'),
(102, 'testAPI4', '$2y$10$BMh31G7zieTglSdqb1azBO5GeU1.lP3GSijaWQvAQvwfIraTKVJxu', 1, NULL, NULL, '2022-10-28 14:17:28');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`Project_id`);

--
-- Индексы таблицы `runs`
--
ALTER TABLE `runs`
  ADD PRIMARY KEY (`Run_id`);

--
-- Индексы таблицы `run_results`
--
ALTER TABLE `run_results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `run_statuses`
--
ALTER TABLE `run_statuses`
  ADD PRIMARY KEY (`RunStatus_id`);

--
-- Индексы таблицы `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`Step_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `Project_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `runs`
--
ALTER TABLE `runs`
  MODIFY `Run_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `run_results`
--
ALTER TABLE `run_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `run_statuses`
--
ALTER TABLE `run_statuses`
  MODIFY `RunStatus_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `steps`
--
ALTER TABLE `steps`
  MODIFY `Step_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `Task_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

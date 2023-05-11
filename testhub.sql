-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 11 2023 г., 22:47
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

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
-- Структура таблицы `case_versions`
--

CREATE TABLE `case_versions` (
  `id` bigint UNSIGNED NOT NULL,
  `Task_id` int NOT NULL,
  `version` int NOT NULL,
  `steps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `case_versions`
--

INSERT INTO `case_versions` (`id`, `Task_id`, `version`, `steps`, `User_id`, `created_at`, `updated_at`) VALUES
(9, 46, 1, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>\\u041e\\u0420 \\u0412\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-12 17:54:20', NULL),
(10, 46, 2, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044e<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>\\u041e\\u0420 \\u0412\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-12 18:07:57', NULL),
(11, 46, 3, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044ev<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>\\u041e\\u0420 \\u0412\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-12 18:18:36', NULL),
(12, 46, 4, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044evvfvf<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>\\u041e\\u0420 \\u0412\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-12 18:18:44', NULL),
(13, 46, 5, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044evvfvfqdd<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>\\u041e\\u0420 \\u0412\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-13 19:03:41', NULL),
(14, 46, 6, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044evvfvf<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>\\u041e\\u0420 \\u0412\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-13 20:12:37', NULL),
(15, 46, 7, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044evvfvfgr eqge r<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>12321 er ewr\\u041e\\u0420 \\u0412 qgere r\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', 96, '2023-02-14 17:38:40', NULL),
(16, 47, 1, '[{\"Step_Action\":\"<p>\\u0428\\u0430\\u0436\\u043e\\u043a 1<\\/p>\",\"Step_Result\":\"<p>\\u0420\\u0435\\u0437\\u0443\\u043b\\u0442 1<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0428\\u0430\\u0433\\u0438<\\/em><\\/p>\",\"Step_Result\":\"<ol><li>\\u0420\\u0435\\u0437\\u0443\\u043b\\u044c\\u0442\\u0430\\u0442\\u044b<\\/li><\\/ol>\",\"Step_Number\":2}]', 96, '2023-02-16 18:03:41', NULL),
(17, 48, 1, '[{\"Step_Action\":\"<p><strong>\\u041f\\u0440\\u0435\\u0434\\u0443\\u0441\\u043b\\u043e\\u0432\\u0438\\u0435 2:<\\/strong><\\/p><p>\\u0421\\u043e\\u0437\\u0434\\u0430\\u043d \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442 X<\\/p>\",\"Step_Result\":\"<p><br><\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><strong>\\u041f\\u0440\\u0435\\u0434\\u0443\\u0441\\u043b\\u043e\\u0432\\u0438\\u0435 1:<\\/strong><\\/p><p>\\u041e\\u0442\\u043a\\u0440\\u044b\\u0442\\u044c \\u0410\\u0420\\u041c \\u0432\\u0440\\u0430\\u0447\\u0430 \\u0441\\u0442\\u0430\\u0446\\u0438\\u043e\\u043d\\u0430\\u0440\\u0430<\\/p>\",\"Step_Result\":null,\"Step_Number\":2},{\"Step_Action\":\"<p>\\u0412 \\u0441\\u043f\\u0438\\u0441\\u043a\\u0435 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432 \\u043f\\u043e\\u0441\\u043c\\u043e\\u0442\\u0440\\u0435\\u0442\\u044c \\u043e\\u0442\\u043e\\u0431\\u0440\\u0430\\u0436\\u0435\\u043d\\u0438\\u0435 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u0430 X<\\/p>\",\"Step_Result\":\"<p>\\u041f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442 X \\u043e\\u0442\\u043e\\u0431\\u0440\\u0430\\u0436\\u0430\\u0435\\u0442\\u0441\\u044f \\u0432 \\u0441\\u043f\\u0438\\u0441\\u043a\\u0435 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432<\\/p>\",\"Step_Number\":3}]', 96, '2023-02-18 13:49:35', NULL),
(18, 49, 1, '[{\"Step_Action\":\"<p>\\u041f\\u0440\\u0435\\u0434\\u0443\\u0441\\u043b\\u043e\\u0432\\u0438\\u0435<\\/p><p>\\u0421\\u043e\\u0437\\u0434\\u0430\\u043d \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442:<\\/p><p>\\u0421\\u043d\\u0438\\u043b\\u0441<\\/p><p>\\u041f\\u043e\\u043b\\u0438\\u0441<\\/p><p>\\u041f\\u0430\\u0441\\u043f\\u043e\\u0440\\u0442<\\/p>\",\"Step_Result\":\"<p>\\u0443\\u043a\\u0439\\u043f\\u0449\\u0443\\u0442\\u0439\\u043a<\\/p><p>\\u0439\\u0443\\u043a\\u043f<\\/p><p>\\u043f\\u043a\\u0443\\u0439<\\/p><p>\\u043f\\u043a\\u0443<\\/p><p>\\u043f\\u043a\\u0443<\\/p><p><br><\\/p><p>\\u0439\\u043f\\u043a\\u0443<\\/p><p>\\u043f\\u043a\\u0443<\\/p><p>\\u043a\\u0443<\\/p><p>\\u043f\\u0443\\u043a\\u0439<\\/p><p><br><\\/p><p>\\u043a\\u043f\\u0443<\\/p><p>\\u0443\\u0439<\\/p>\",\"Step_Number\":1}]', 96, '2023-02-18 17:27:12', NULL),
(19, 50, 1, '[{\"Step_Action\":\"<p>4<\\/p>\",\"Step_Result\":\"<p>4<\\/p>\",\"Step_Number\":1}]', 96, '2023-03-12 17:52:06', NULL),
(20, 51, 1, '[{\"Step_Action\":\"<p>w<\\/p>\",\"Step_Result\":\"<p>ww<\\/p>\",\"Step_Number\":1}]', 96, '2023-05-10 21:23:26', NULL),
(21, 52, 1, '[{\"Step_Action\":\"<p>\\u0448\\u0430\\u0436\\u043e\\u043a \\u0432 \\u0431\\u0435\\u0441\\u043a\\u043e\\u043d\\u0435\\u0447\\u043d\\u043e\\u0441\\u0442\\u044c<\\/p>\",\"Step_Result\":null,\"Step_Number\":1}]', 96, '2023-05-11 11:26:26', NULL),
(22, 53, 1, '[]', 96, '2023-05-11 18:48:26', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(10, '2023_01_26_164010_create_run_statuses_table', 6),
(11, '2023_02_12_141148_create_case_versions_table', 7),
(12, '2023_03_04_000938_create_run_case_result_versions_table', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `Project_Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Project_isCommon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Project_About` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Project_CasesTree` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`Project_id`, `Project_Name`, `Project_isCommon`, `Project_About`, `Project_CasesTree`, `created_at`, `updated_at`) VALUES
(1, 'Стационар', NULL, 'Проект Стационар - тестовая документация направления \"Стационар\"', '{\"id\":0,\"name\":\"Проект\",\"id_counter\":15,\"root\":true,\"children\":[{\"id\":1,\"name\":\"Текучка\",\"root\":true,\"children\":[]},{\"id\":2,\"name\":\"Архив\",\"root\":true,\"children\":[{\"id\":13,\"name\":\"апапа\"},{\"id\":14,\"name\":\"Новая папка 14\"}]},{\"id\":3,\"name\":\"Регресс\",\"root\":true,\"children\":[]}]}', NULL, NULL),
(2, 'Поликлиника', NULL, NULL, '', NULL, NULL),
(3, 'ЛИС', NULL, 'тестовая документация команды ЛИС', '', NULL, '2022-10-23 13:36:31'),
(4, 'Autotest', NULL, 'oaphpv oighre[oi oaphpv oighre[oioaphpv oighre[oioaphpv oighre[oi oaphpv oighre[oioaphpv oighre[oioaphpv oighre[oi oaphpv oighre[oioaphpv oighre[oioaphpv', '', NULL, NULL),
(5, 'testAPI', 'true', 'описание', '', '2022-10-23 12:35:08', NULL),
(6, 'testAPI2', 'true', 'описание', '', '2022-10-23 12:35:33', NULL),
(7, 'Миграция', NULL, NULL, '', NULL, NULL),
(9, 'Регресс общий', '1', 'проект регресса, содержит ТК всех модулей промеда', '', '2022-10-23 12:46:05', NULL),
(10, '123', '1', '2343', '', '2022-10-23 12:46:44', NULL),
(12, 'Регресс SP', '0', 'проект для регресса SP', '{id: 0,name: \'Проект\',id_counter: 4,root: true,children:\n            [{ id: 1, name: \'Текучка\', root: true, },{ id: 2, name: \'Архив\', root: true, },\n            { id: 3, name: \'Регресс\', root: true, }]}', '2023-02-16 19:38:01', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `runs`
--

CREATE TABLE `runs` (
  `Run_id` bigint UNSIGNED NOT NULL,
  `Project_id` int NOT NULL,
  `Run_Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Run_Type` int NOT NULL,
  `Run_Status` int NOT NULL,
  `Run_Desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Run_EndDt` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `runs`
--

INSERT INTO `runs` (`Run_id`, `Project_id`, `Run_Name`, `Run_Type`, `Run_Status`, `Run_Desc`, `Run_EndDt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Спринт 22-30', 0, 1, NULL, '2022-12-31', '2022-12-23 18:50:08', '2023-01-28 12:33:30'),
(2, 1, 'релиз 7.9.9', 1, 2, 'для релиза', NULL, '2023-01-26 14:55:28', '2023-05-08 19:31:41'),
(3, 1, 'Пермь Миграция на PG', 2, 1, 'тест-ран для тестирования миграции Перми на PG', '2022-02-02', '2023-01-27 14:38:07', '2023-01-28 12:45:09');

-- --------------------------------------------------------

--
-- Структура таблицы `run_case_result_versions`
--

CREATE TABLE `run_case_result_versions` (
  `id` bigint UNSIGNED NOT NULL,
  `RunResult_id` int NOT NULL,
  `RunStatus_id` int NOT NULL,
  `RunResult_Comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `RunResult_TimeSpent` int DEFAULT NULL,
  `User_id` int NOT NULL,
  `version` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `run_case_result_versions`
--

INSERT INTO `run_case_result_versions` (`id`, `RunResult_id`, `RunStatus_id`, `RunResult_Comment`, `RunResult_TimeSpent`, `User_id`, `version`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 'комментарий', 230, 1, 1, '2023-03-03 19:34:02', NULL),
(2, 8, 1, 'комментарий', 230, 1, 2, '2023-03-03 19:34:45', NULL),
(3, 6, 4, 'все не гучи', 82, 96, 1, '2023-03-09 18:17:48', NULL),
(6, 5, 2, NULL, 0, 96, 1, '2023-03-09 18:26:26', NULL),
(7, 8, 4, 'теперь не очень :(', 243, 96, 3, '2023-03-12 09:41:39', NULL),
(8, 5, 1, 'теперь ок', 1, 96, 2, '2023-03-12 16:46:21', NULL),
(9, 5, 2, '3232', 71, 96, 3, '2023-03-12 16:46:32', NULL),
(10, 6, 1, 'теперь все ок', 1172, 96, 2, '2023-03-12 17:50:21', NULL),
(11, 8, 1, 'теперь все ок', 305, 96, 4, '2023-05-08 19:30:36', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `run_results`
--

CREATE TABLE `run_results` (
  `id` bigint UNSIGNED NOT NULL,
  `Run_id` int NOT NULL,
  `Task_id` int NOT NULL,
  `steps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `User_id` int DEFAULT NULL,
  `RunResult_SectionId` int DEFAULT NULL,
  `Task_Version` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `run_results`
--

INSERT INTO `run_results` (`id`, `Run_id`, `Task_id`, `steps`, `User_id`, `RunResult_SectionId`, `Task_Version`, `created_at`, `updated_at`) VALUES
(5, 3, 47, '[{\"Step_Action\":\"<p>\\u0428\\u0430\\u0436\\u043e\\u043a 1<\\/p>\",\"Step_Result\":\"<p>\\u0420\\u0435\\u0437\\u0443\\u043b\\u0442 1<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0428\\u0430\\u0433\\u0438<\\/em><\\/p>\",\"Step_Result\":\"<ol><li>\\u0420\\u0435\\u0437\\u0443\\u043b\\u044c\\u0442\\u0430\\u0442\\u044b<\\/li><\\/ol>\",\"Step_Number\":2}]', NULL, 1, 1, '2023-02-16 19:20:52', NULL),
(6, 3, 46, '[{\"Step_Action\":\"<p>\\u041f\\u0435\\u0440\\u0432\\u044b\\u0439 \\u0448\\u0430\\u0433\\t<\\/p>\",\"Step_Result\":\"<p>\\u041e\\u0420 \\u043f\\u0435\\u0440\\u0432\\u043e\\u0433\\u043e \\u0449\\u0430\\u0433\\u0430<\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><em>\\u0412\\u0422\\u041e\\u0420\\u041e\\u0419 \\u0420\\u0415\\u0417\\u0423\\u041b\\u042c\\u0422\\u0410\\u0422 \\u044evvfvfgr eqge r<\\/em><\\/p>\",\"Step_Result\":\"<p class=\\\"ql-align-right\\\"><strong><em><u>12321 er ewr\\u041e\\u0420 \\u0412 qgere r\\u0422\\u041e\\u0420\\u041e\\u0413\\u041e \\u0429\\u0410\\u0413\\u0410<\\/u><\\/em><\\/strong><\\/p>\",\"Step_Number\":2}]', NULL, 1, 7, '2023-02-16 19:21:06', NULL),
(7, 3, 48, '[{\"Step_Action\":\"<p><strong>\\u041f\\u0440\\u0435\\u0434\\u0443\\u0441\\u043b\\u043e\\u0432\\u0438\\u0435 2:<\\/strong><\\/p><p>\\u0421\\u043e\\u0437\\u0434\\u0430\\u043d \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442 X<\\/p>\",\"Step_Result\":\"<p><br><\\/p>\",\"Step_Number\":1},{\"Step_Action\":\"<p><strong>\\u041f\\u0440\\u0435\\u0434\\u0443\\u0441\\u043b\\u043e\\u0432\\u0438\\u0435 1:<\\/strong><\\/p><p>\\u041e\\u0442\\u043a\\u0440\\u044b\\u0442\\u044c \\u0410\\u0420\\u041c \\u0432\\u0440\\u0430\\u0447\\u0430 \\u0441\\u0442\\u0430\\u0446\\u0438\\u043e\\u043d\\u0430\\u0440\\u0430<\\/p>\",\"Step_Result\":null,\"Step_Number\":2},{\"Step_Action\":\"<p>\\u0412 \\u0441\\u043f\\u0438\\u0441\\u043a\\u0435 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432 \\u043f\\u043e\\u0441\\u043c\\u043e\\u0442\\u0440\\u0435\\u0442\\u044c \\u043e\\u0442\\u043e\\u0431\\u0440\\u0430\\u0436\\u0435\\u043d\\u0438\\u0435 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u0430 X<\\/p>\",\"Step_Result\":\"<p>\\u041f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442 X \\u043e\\u0442\\u043e\\u0431\\u0440\\u0430\\u0436\\u0430\\u0435\\u0442\\u0441\\u044f \\u0432 \\u0441\\u043f\\u0438\\u0441\\u043a\\u0435 \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432<\\/p>\",\"Step_Number\":3}]', NULL, 2, 1, '2023-02-18 13:50:14', NULL),
(8, 3, 49, '[{\"Step_Action\":\"<p>\\u041f\\u0440\\u0435\\u0434\\u0443\\u0441\\u043b\\u043e\\u0432\\u0438\\u0435<\\/p><p>\\u0421\\u043e\\u0437\\u0434\\u0430\\u043d \\u043f\\u0430\\u0446\\u0438\\u0435\\u043d\\u0442:<\\/p><p>\\u0421\\u043d\\u0438\\u043b\\u0441<\\/p><p>\\u041f\\u043e\\u043b\\u0438\\u0441<\\/p><p>\\u041f\\u0430\\u0441\\u043f\\u043e\\u0440\\u0442<\\/p>\",\"Step_Result\":\"<p>\\u0443\\u043a\\u0439\\u043f\\u0449\\u0443\\u0442\\u0439\\u043a<\\/p><p>\\u0439\\u0443\\u043a\\u043f<\\/p><p>\\u043f\\u043a\\u0443\\u0439<\\/p><p>\\u043f\\u043a\\u0443<\\/p><p>\\u043f\\u043a\\u0443<\\/p><p><br><\\/p><p>\\u0439\\u043f\\u043a\\u0443<\\/p><p>\\u043f\\u043a\\u0443<\\/p><p>\\u043a\\u0443<\\/p><p>\\u043f\\u0443\\u043a\\u0439<\\/p><p><br><\\/p><p>\\u043a\\u043f\\u0443<\\/p><p>\\u0443\\u0439<\\/p>\",\"Step_Number\":1}]', NULL, 2, 1, '2023-02-18 17:38:21', NULL),
(9, 3, 50, '[{\"Step_Action\":\"<p>4<\\/p>\",\"Step_Result\":\"<p>4<\\/p>\",\"Step_Number\":1}]', NULL, 1, 1, '2023-03-12 17:52:18', NULL),
(10, 3, 51, '[{\"Step_Action\":\"<p>w<\\/p>\",\"Step_Result\":\"<p>ww<\\/p>\",\"Step_Number\":1}]', NULL, 1, 1, '2023-05-10 21:23:49', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `run_statuses`
--

CREATE TABLE `run_statuses` (
  `RunStatus_id` bigint UNSIGNED NOT NULL,
  `RunStatus_Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `Step_Number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_id` int NOT NULL,
  `Step_Action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Step_Result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `Task_id` bigint UNSIGNED NOT NULL,
  `Task_Project` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_JiraProject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Task_Number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Task_Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_Priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_Stage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task_isActual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Task_Folder` int DEFAULT NULL,
  `Task_isForRegress` int DEFAULT NULL,
  `Task_ActualVersion` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`Task_id`, `Task_Project`, `Task_JiraProject`, `Task_Number`, `Task_Name`, `Task_Priority`, `Task_Stage`, `Task_isActual`, `Task_Folder`, `Task_isForRegress`, `Task_ActualVersion`, `created_at`, `updated_at`) VALUES
(1, '1', 'PROMEDWEB', '213432', 'Доработки СЭМД \"Выписной эпикриз из роддома\"', '1', '1', NULL, 1, NULL, 0, '2022-10-25 19:45:07', '2022-11-06 14:30:39'),
(2, '1', 'PROMEDWEB', '137845', 'МСЭ и ВК. Добавление нового поля', '2', '1', '', 1, NULL, 0, '2022-10-27 12:56:42', NULL),
(4, '1', 'PROMEDWEB', '84842', 'СЭМД Роддом - Отправка в РЭМД ЕГИСЗ по требованию заказчика (Екатеринбург прод ошибка) INC 4324323423222222222222223432423432 (SLA) Срок передачи в релиз - 39.432.321', '0', '2', NULL, 1, NULL, 0, '2022-10-27 13:04:20', '2022-11-03 16:48:36'),
(5, '1', 'PROMEDWEB', '64565', 'Старая задача', '1', '0', NULL, 3, 2, 0, '2022-10-27 13:11:17', '2023-02-01 15:28:42'),
(34, '1', 'PROMEDWEB', '123321', '32132123', '1', '0', NULL, 1, 0, 0, '2023-02-12 09:08:11', NULL),
(35, '1', 'PROMEDWEB', '234', '432342', '1', '0', NULL, 1, 0, 0, '2023-02-12 09:09:51', NULL),
(36, '1', 'PROMEDWEB', '243', '432', '1', '0', NULL, 1, 0, 0, '2023-02-12 09:47:42', NULL),
(37, '1', 'PROMEDWEB', '423234', 'crew', '1', '0', NULL, 1, 0, 0, '2023-02-12 09:49:06', NULL),
(46, '1', 'PROMEDWEB', '1111', 'ЗАДАЧА', '3', '1', NULL, 1, 0, 7, '2023-02-12 17:54:20', '2023-02-14 17:38:40'),
(47, '1', 'PROMEDWEB', '43243', 'Нормалды', '3', '2', NULL, 1, 0, 1, '2023-02-16 18:03:41', '2023-02-16 18:03:41'),
(48, '1', NULL, NULL, 'Список пациентов', '3', '2', NULL, 3, 1, 1, '2023-02-18 13:49:35', '2023-02-18 13:49:35'),
(49, '1', NULL, NULL, 'СЭМД гемотрансфузия', '1', '0', NULL, 3, 1, 1, '2023-02-18 17:27:12', '2023-02-18 17:27:12'),
(50, '1', 'PROMEDWEB', '4444444', '44444', '3', '1', NULL, 1, 0, 1, '2023-03-12 17:52:06', '2023-03-12 17:52:06'),
(51, '1', 'PROMEDWEB', '44444', '44444', '1', '0', NULL, 1, 0, 1, '2023-05-10 21:23:26', '2023-05-10 21:23:26'),
(52, '1', 'PROMEDWEB', '4', 'папка 4', '3', '2', NULL, 4, 0, 1, '2023-05-11 11:26:26', '2023-05-11 11:26:26'),
(53, '1', 'PROMEDWEB', '23232', '43223232', '3', '2', NULL, 13, 0, 1, '2023-05-11 18:48:26', '2023-05-11 18:48:26');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_Role` int DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `User_Role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$ykx.rzMfeAr1UeB7XFCE0OqrbPhNTMaUVS02v.xTCF2AEG2bRj0YG', 99, 'wUjWXgiFCjninAp5pA5DWoODlAuUQX3mC15yk2z634yyXwIcFbVwOPbJrigG', '2022-10-17 17:51:13', NULL),
(94, 'teamStac', '$2y$10$ycxBg8ckVHCpCkP8m2CCpe7o5vd0cKNzhPzCZwSAtPvmdGpSO9zMG', 1, 'coVSXsi5IpoFw6dvRGrifHg1qAlKOzHWSx2sc4dhnP4PGqjNTRj7pxNC84dE', '2022-10-22 15:30:08', '2022-10-22 15:50:25'),
(95, 'teamPolka', '$2y$10$TghVGpjWC4/vLAuUFzl7d.h.dzQoKreAvr0bZQaRIsHyBvjmwMoma', 1, 'LnFjeIspyt', '2022-10-22 15:30:28', '2022-10-22 16:05:19'),
(96, 'lexxvel', '$2y$10$5eJss9PT.NRWs5XLBew6mex4G9wate.rVFh0G4gfeLcqIroGkM4L.', 99, 'c1P4IDnllmbA8smGI0FNdQGhkPmlB8lF1mvU87onN1UJ9yEoFFIwueID5kaW', '2022-10-22 15:30:47', '2022-10-22 15:30:47'),
(102, 'testAPI4', '$2y$10$BMh31G7zieTglSdqb1azBO5GeU1.lP3GSijaWQvAQvwfIraTKVJxu', 1, NULL, NULL, '2022-10-28 14:17:28'),
(105, 'newUser', '$2y$10$B5eleya1VpDWmvzJVusetuaotb/t6hmj9c.Y3fGE6HwAFMzM5lqDG', 2, NULL, '2023-05-11 19:13:39', '2023-05-11 19:43:52');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `case_versions`
--
ALTER TABLE `case_versions`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `run_case_result_versions`
--
ALTER TABLE `run_case_result_versions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `case_versions`
--
ALTER TABLE `case_versions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `Project_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `runs`
--
ALTER TABLE `runs`
  MODIFY `Run_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `run_case_result_versions`
--
ALTER TABLE `run_case_result_versions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `run_results`
--
ALTER TABLE `run_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `run_statuses`
--
ALTER TABLE `run_statuses`
  MODIFY `RunStatus_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `steps`
--
ALTER TABLE `steps`
  MODIFY `Step_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `Task_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

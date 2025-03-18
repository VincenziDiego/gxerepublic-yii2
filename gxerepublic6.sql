-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 18, 2025 alle 18:25
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gxerepublic5`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `activity_type_id` int(11) NOT NULL COMMENT 'FK alla categoria di attività',
  `name` varchar(100) NOT NULL COMMENT 'Nome dell''attività (titolo)',
  `default_players` int(11) NOT NULL COMMENT 'Numero di giocatori predefinito per questa attività',
  `description` text DEFAULT NULL COMMENT 'Descrizione dell''attività'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `activity`
--

INSERT INTO `activity` (`id`, `activity_type_id`, `name`, `default_players`, `description`) VALUES
(9, 5, 'Salvation\'s Edge', 6, 'Free the Light.'),
(10, 5, 'Leviathan', 6, '\"Grow fat from strength.\"'),
(11, 5, 'Leviathan, Spire of Stars', 6, 'On the wings of Icarus.'),
(12, 5, 'Scourge of the Past', 6, 'Beneath the ruins of the Last City lies the Black Armory\'s most precious vault, now under siege by Siviks and his crew, the Kell\'s Scourge.'),
(13, 5, 'Leviathan, Eater of Worlds', 6, '\"In the belly of the beast.\"'),
(14, 5, 'Deep Stone Crypt', 6, 'The chains of legacy must be broken.'),
(15, 5, 'Crown of Sorrow', 6, 'Grow [weak] with [pride].'),
(16, 5, 'Garden of Salvation', 6, '\"The Garden calls out to you.\"'),
(17, 5, 'King\'s Fall', 6, 'Long live the King...'),
(18, 5, 'Vow of the Disciple', 6, 'The disciple beckons...'),
(19, 5, 'Root of Nightmares', 6, 'a');

-- --------------------------------------------------------

--
-- Struttura della tabella `activity_type`
--

CREATE TABLE `activity_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nome della categoria (es. Campagna, Crogiolo, etc.)',
  `description` text DEFAULT NULL COMMENT 'Descrizione della categoria'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `activity_type`
--

INSERT INTO `activity_type` (`id`, `name`, `description`) VALUES
(1, 'Campagna', 'Attività legata alle campagne.'),
(2, 'Crogiolo', 'Attività del Crogiolo.'),
(3, 'Dungeon', 'Dungeon.'),
(4, 'Azzardo', 'Attività di Azzardo.'),
(5, 'Raid', 'Raid.'),
(6, 'Stagionale', 'Attività stagionali.'),
(7, 'Avanguardia', 'Attività della Avanguardia.'),
(8, 'Altro', 'Altre attività.');

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1741767891),
('author', '2', 1741768198),
('user', '10', 1742228294);

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/activity-type/*', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity-type/create', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity-type/delete', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity-type/index', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity-type/update', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity-type/view', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity/*', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity/create', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity/delete', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity/index', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity/update', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/activity/view', 2, NULL, NULL, NULL, 1742227645, 1742227645),
('/admin/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/default/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/default/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/menu/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/menu/create', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/menu/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/menu/update', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/menu/view', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/create', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/get-users', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/update', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/permission/view', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/assign', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/create', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/delete', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/get-users', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/remove', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/update', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/role/view', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/route/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/route/assign', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/route/create', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/route/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/route/remove', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/rule/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/rule/create', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/rule/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/rule/update', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/rule/view', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/*', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/activate', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/delete', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/index', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/login', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/logout', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/signup', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/admin/user/view', 2, NULL, NULL, NULL, 1741681669, 1741681669),
('/debug/*', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/default/*', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/default/index', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/default/view', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/user/*', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1741708510, 1741708510),
('/gii/*', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/gii/default/*', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/gii/default/action', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/gii/default/diff', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/gii/default/index', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/gii/default/preview', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/gii/default/view', 2, NULL, NULL, NULL, 1741682067, 1741682067),
('/lfg/*', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/create', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/delete', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/get-activities', 2, NULL, NULL, NULL, 1742222863, 1742222863),
('/lfg/get-activity-details', 2, NULL, NULL, NULL, 1742222863, 1742222863),
('/lfg/index', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/join', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/join-reserve', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/leave', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/reserve', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/update', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/lfg/view', 2, NULL, NULL, NULL, 1741876500, 1741876500),
('/news/*', 2, NULL, NULL, NULL, 1741688417, 1741688417),
('/news/create', 2, NULL, NULL, NULL, 1741681677, 1741681677),
('/news/delete', 2, NULL, NULL, NULL, 1741681677, 1741681677),
('/news/index', 2, NULL, NULL, NULL, 1741681677, 1741681677),
('/news/public', 2, NULL, NULL, NULL, 1741688417, 1741688417),
('/news/read', 2, NULL, NULL, NULL, 1741688417, 1741688417),
('/news/update', 2, NULL, NULL, NULL, 1741681677, 1741681677),
('/news/view', 2, NULL, NULL, NULL, 1741681677, 1741681677),
('/profile/*', 2, NULL, NULL, NULL, 1741876831, 1741876831),
('/profile/update', 2, NULL, NULL, NULL, 1741876831, 1741876831),
('admin', 1, NULL, NULL, NULL, 1741681686, 1741681686),
('author', 1, NULL, NULL, NULL, 1741681704, 1741681704),
('user', 1, NULL, NULL, NULL, 1741688696, 1741688696);

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '/activity-type/*'),
('admin', '/activity-type/create'),
('admin', '/activity-type/delete'),
('admin', '/activity-type/index'),
('admin', '/activity-type/update'),
('admin', '/activity-type/view'),
('admin', '/activity/*'),
('admin', '/activity/create'),
('admin', '/activity/delete'),
('admin', '/activity/index'),
('admin', '/activity/update'),
('admin', '/activity/view'),
('admin', '/admin/*'),
('admin', '/admin/assignment/*'),
('admin', '/admin/assignment/assign'),
('admin', '/admin/assignment/index'),
('admin', '/admin/assignment/revoke'),
('admin', '/admin/assignment/view'),
('admin', '/admin/default/*'),
('admin', '/admin/default/index'),
('admin', '/admin/menu/*'),
('admin', '/admin/menu/create'),
('admin', '/admin/menu/delete'),
('admin', '/admin/menu/index'),
('admin', '/admin/menu/update'),
('admin', '/admin/menu/view'),
('admin', '/admin/permission/*'),
('admin', '/admin/permission/assign'),
('admin', '/admin/permission/create'),
('admin', '/admin/permission/delete'),
('admin', '/admin/permission/get-users'),
('admin', '/admin/permission/index'),
('admin', '/admin/permission/remove'),
('admin', '/admin/permission/update'),
('admin', '/admin/permission/view'),
('admin', '/admin/role/*'),
('admin', '/admin/role/assign'),
('admin', '/admin/role/create'),
('admin', '/admin/role/delete'),
('admin', '/admin/role/get-users'),
('admin', '/admin/role/index'),
('admin', '/admin/role/remove'),
('admin', '/admin/role/update'),
('admin', '/admin/role/view'),
('admin', '/admin/route/*'),
('admin', '/admin/route/assign'),
('admin', '/admin/route/create'),
('admin', '/admin/route/index'),
('admin', '/admin/route/refresh'),
('admin', '/admin/route/remove'),
('admin', '/admin/rule/*'),
('admin', '/admin/rule/create'),
('admin', '/admin/rule/delete'),
('admin', '/admin/rule/index'),
('admin', '/admin/rule/update'),
('admin', '/admin/rule/view'),
('admin', '/admin/user/*'),
('admin', '/admin/user/activate'),
('admin', '/admin/user/change-password'),
('admin', '/admin/user/delete'),
('admin', '/admin/user/index'),
('admin', '/admin/user/login'),
('admin', '/admin/user/logout'),
('admin', '/admin/user/request-password-reset'),
('admin', '/admin/user/reset-password'),
('admin', '/admin/user/signup'),
('admin', '/admin/user/view'),
('admin', '/debug/*'),
('admin', '/debug/default/*'),
('admin', '/debug/default/db-explain'),
('admin', '/debug/default/download-mail'),
('admin', '/debug/default/index'),
('admin', '/debug/default/toolbar'),
('admin', '/debug/default/view'),
('admin', '/debug/user/*'),
('admin', '/debug/user/reset-identity'),
('admin', '/debug/user/set-identity'),
('admin', '/gii/*'),
('admin', '/gii/default/*'),
('admin', '/gii/default/action'),
('admin', '/gii/default/diff'),
('admin', '/gii/default/index'),
('admin', '/gii/default/preview'),
('admin', '/gii/default/view'),
('admin', 'author'),
('author', '/news/*'),
('author', '/news/create'),
('author', '/news/delete'),
('author', '/news/index'),
('author', '/news/update'),
('author', '/news/view'),
('author', 'user'),
('user', '/lfg/*'),
('user', '/lfg/create'),
('user', '/lfg/delete'),
('user', '/lfg/get-activities'),
('user', '/lfg/get-activity-details'),
('user', '/lfg/index'),
('user', '/lfg/join'),
('user', '/lfg/join-reserve'),
('user', '/lfg/leave'),
('user', '/lfg/reserve'),
('user', '/lfg/update'),
('user', '/lfg/view'),
('user', '/news/public'),
('user', '/news/read'),
('user', '/profile/*'),
('user', '/profile/update');

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lfg`
--

CREATE TABLE `lfg` (
  `id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL COMMENT 'ID del giocatore creatore (riferimento alla tabella user)',
  `activity_type` varchar(100) NOT NULL COMMENT 'Tipo di attività (raid, strike, dungeon, etc.)',
  `description` text DEFAULT NULL COMMENT 'Descrizione e note sull''attività',
  `max_players` int(11) NOT NULL COMMENT 'Numero massimo di giocatori',
  `current_players` text DEFAULT NULL COMMENT 'Lista dei giocatori attivi (es. JSON o CSV dei bungieid)',
  `reserve_players` text DEFAULT NULL COMMENT 'Lista dei giocatori in riserva',
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT 'Stato del gruppo: 1 = aperto, 0 = chiuso',
  `start_time` timestamp NULL DEFAULT NULL COMMENT 'Data e ora di inizio attività',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Data e ora di creazione',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Data e ora di aggiornamento',
  `activity_id` int(11) DEFAULT NULL COMMENT 'ID dell''attività associata',
  `activity_type_id` int(11) DEFAULT NULL COMMENT 'ID del tipo di attività associato'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabella per la gestione dei gruppi LFG del clan di Destiny';

-- --------------------------------------------------------

--
-- Struttura della tabella `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1741681413),
('m140506_102106_rbac_init', 1741681456),
('m140602_111327_create_menu_table', 1741681463),
('m160312_050000_create_user', 1741681463),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1741681456),
('m180523_151638_rbac_updates_indexes_without_prefix', 1741681456),
('m200409_110543_rbac_update_mssql_trigger', 1741681456),
('m250310_083328_create_user_table', 1741767997),
('m250310_133045_create_news_table', 1741790320),
('m250313_101229_create_lfg_table', 1741864606),
('m250317_134729_create_activity_type_table', 1742220377),
('m250317_135802_create_activity_table', 1742220377),
('m250317_140221_alter_lfg_table_add_activity_id', 1742220378),
('m250317_140702_alter_lfg_table_add_activity_type_id', 1742220517);

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_username` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `published_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `author_id`, `author_username`, `status`, `created_at`, `updated_at`, `published_at`) VALUES
(2, 'Test1', 'test', 1, 'Kirito', 1, '2025-03-12 14:49:15', '2025-03-12 14:52:00', '2025-03-12 14:52:00'),
(3, 'Test2', 'Test', 2, 'Author', 1, '2025-03-12 16:51:13', '2025-03-12 16:54:05', '2025-03-12 16:54:05'),
(5, 'gianni', 'sda', 1, 'Kirito', 1, '2025-03-14 14:10:14', '2025-03-14 14:10:14', '2025-03-14 14:10:14'),
(6, 'This Week In Destiny - 06/03/2025', 'asd', 1, 'Kirito', 1, '2025-03-14 14:29:41', '2025-03-14 14:29:41', '2025-03-14 14:29:41'),
(7, 'This Week ', 'asd', 1, 'Kirito', 0, '2025-03-18 08:57:33', '2025-03-18 08:57:33', NULL),
(8, 'asd', 'Beneath the ruins of the Last City lies the Black Armory\'s most precious vault, now under siege by Siviks and his crew, the Kell\'s Scourge ciao test test test test test test test test test test test test test test tes test tes te  st ', 1, 'Kirito', 0, '2025-03-18 15:05:43', '2025-03-18 15:37:16', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bungieid` varchar(255) DEFAULT NULL,
  `clan` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `icon_url` varchar(255) DEFAULT 'uploads/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabella per la gestione degli utenti';

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `auth_key`, `email`, `created_at`, `updated_at`, `bungieid`, `clan`, `status`, `icon_url`) VALUES
(1, 'Kirito', '$2y$13$UTqh16eT3vwiHpcuUfDIi.bJPcDnUWslKWhUSGIU8WEtlUCFUjAG.', '2-Ud5-yyW7ko8SimlpYpzfFKba6mkG6K', 'gxe.kirito@gxerepublic.com', '2025-03-12 08:26:52', '2025-03-13 16:50:26', 'Kirito#1540', 'GXE Republic', 1, 'uploads/icons/67d30cd2ba706.jpg'),
(2, 'Author', '$2y$13$Ni1.SzOGLOT333y5MHfHieIC5s9Uo.4JrfBUs/qsAQkyhQQMYECOW', 'RDpX0m4zo9mmclCSJ2lCrYORvp8U9mhf', 'gxe.author@gxerepublic.com', '2025-03-12 08:28:46', '2025-03-13 16:49:47', 'Test#1540', NULL, 1, 'uploads/default.jpg'),
(10, 'User', '$2y$13$mL/2NXZu3y7iPwUJ7pkNEeeEyLhHJLnLfhFjVWaOKjCbbpewCqQUC', '9ICyN6YoEYc2yy_s0CiYVwY3IJloNnhr', 'gxe.user@gxerepublic.com', '2025-03-17 16:18:14', '2025-03-17 16:18:14', NULL, NULL, 1, 'uploads/default.jpg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-activity-activity_type_id` (`activity_type_id`);

--
-- Indici per le tabelle `activity_type`
--
ALTER TABLE `activity_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indici per le tabelle `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indici per le tabelle `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indici per le tabelle `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indici per le tabelle `lfg`
--
ALTER TABLE `lfg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-lfg-leader_id` (`leader_id`),
  ADD KEY `fk-lfg-activity_id` (`activity_id`),
  ADD KEY `fk-lfg-activity_type_id` (`activity_type_id`);

--
-- Indici per le tabelle `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indici per le tabelle `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indici per le tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `fk-news-author` (`author_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `bungieid` (`bungieid`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `activity_type`
--
ALTER TABLE `activity_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `lfg`
--
ALTER TABLE `lfg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk-activity-activity_type_id` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_type` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `lfg`
--
ALTER TABLE `lfg`
  ADD CONSTRAINT `fk-lfg-activity_id` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-lfg-activity_type_id` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_type` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-lfg-leader_id` FOREIGN KEY (`leader_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk-news-author` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

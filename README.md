# mvc
This is a test case for my interview on web developer. Implements the MVC structure on pure PHP without using frameworks. This is task list web application.
To install the application create database 'beejee' with next table:

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `mail` tinytext NOT NULL,
  `text` tinytext NOT NULL,
  `complete` int(11) NOT NULL,
  `admin_edit` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

Login and password you can see in settings.php file/

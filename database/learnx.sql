-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2024 a las 11:14:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `learnx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_notificacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditorias`
--

CREATE TABLE `auditorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `auditorias`
--

INSERT INTO `auditorias` (`id`, `usuario_id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 1, 'El usuario ha agregado el curso: Domina Python: De principiante a desarrollador web', '2024-09-23 14:51:10', '2024-09-23 14:51:10'),
(2, 1, 'El usuario ha agregado el curso: Matemáticas para la Vida: Dominando los Fundamentos', '2024-09-23 14:57:36', '2024-09-23 14:57:36'),
(3, 1, 'El usuario ha agregado el curso:  Marketing Digital Dominado: De Principiante a Experto', '2024-09-23 14:59:49', '2024-09-23 14:59:49'),
(4, 1, 'El usuario ha agregado el curso: Del Novato al Chef: Dominando el Arte de la Cocina', '2024-09-23 15:02:17', '2024-09-23 15:02:17'),
(5, 1, 'El usuario ha agregado el aula: Laboratorio Matemático', '2024-09-23 15:09:35', '2024-09-23 15:09:35'),
(6, 1, 'El usuario ha eliminado un aula', '2024-09-23 15:09:45', '2024-09-23 15:09:45'),
(7, 1, 'El usuario ha agregado el aula:  Laboratorio Matemático', '2024-09-23 15:10:15', '2024-09-23 15:10:15'),
(8, 1, 'El usuario ha agregado el aula: El Código Lab', '2024-09-23 15:12:39', '2024-09-23 15:12:39'),
(9, 1, 'El usuario ha agregado el aula: Espacio de la Conciencia', '2024-09-23 15:14:47', '2024-09-23 15:14:47'),
(10, 1, 'El usuario ha eliminado un curso', '2024-09-23 15:49:01', '2024-09-23 15:49:01'),
(11, 1, 'El usuario ha actualizado el curso: Domina Python: De principiante a desarrollador web', '2024-09-23 15:49:33', '2024-09-23 15:49:33'),
(12, 1, 'El usuario ha actualizado la materia: Espacio de la Conciencia', '2024-09-23 15:59:52', '2024-09-23 15:59:52'),
(13, 1, 'El usuario ha agregado el examen: La Prueba del Uno', '2024-09-23 16:05:03', '2024-09-23 16:05:03'),
(14, 1, 'El usuario ha agregado el examen: La Prueba del Triángulo', '2024-09-23 16:06:10', '2024-09-23 16:06:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Programación', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(2, 'Diseño Web', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(3, 'Marketing Digital', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(4, 'Gestión de Negocios', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(5, 'Finanzas', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(6, 'Desarrollo Personal', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(7, 'Lenguas Extranjeras', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(8, 'Música', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(9, 'Arte', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(10, 'Ciencias', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(11, 'Matemáticas', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(12, 'Historia', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(13, 'Literatura', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(14, 'Filosofía', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(15, 'Ciencias Sociales', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(16, 'Ciencias de la Salud', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(17, 'Ingeniería', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(18, 'Ciencias de la Computación', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(19, 'Derecho', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(20, 'Educación', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(21, 'Cocina', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(22, 'Deporte', '2024-09-23 07:49:15', '2024-09-23 07:49:15'),
(23, 'Belleza y Estética', '2024-09-23 07:49:15', '2024-09-23 07:49:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats_classrooms`
--

CREATE TABLE `chats_classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `documento` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` text DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `codigo_acceso` varchar(255) NOT NULL,
  `estatus` enum('activo','inactivo') NOT NULL,
  `tipo` enum('publico','privado') NOT NULL,
  `max_estudiantes` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `classrooms`
--

INSERT INTO `classrooms` (`id`, `foto`, `nombre`, `descripcion`, `profesor_id`, `materia_id`, `codigo_acceso`, `estatus`, `tipo`, `max_estudiantes`, `created_at`, `updated_at`) VALUES
(2, 'public/classrooms/DEbgilwOkFkEDqZklLW1csvyHzAs6UEtyUTFA6Qu.jpg', ' Laboratorio Matemático', 'Un espacio acogedor y estimulante donde los estudiantes pueden explorar el mundo fascinante de las matemáticas a través de la creatividad, el razonamiento lógico y la resolución de problemas.', 1, 1, 'yEOWEZ6Hvr', 'activo', 'publico', 90, '2024-09-23 15:10:15', '2024-09-23 15:10:15'),
(3, 'public/classrooms/yoXtmeZnf2P4uaIhb4UwSMxxhOzHHTqoVP0J2RlY.png', 'El Código Lab', 'El Código Lab es un espacio dinámico y creativo donde la imaginación se convierte en código. Ofrecemos un ambiente de aprendizaje colaborativo para principiantes y expertos en programación JavaScript.', 1, 12, 'yZbKkGwOr6', 'activo', 'publico', 80, '2024-09-23 15:12:39', '2024-09-23 15:12:39'),
(4, 'public/classrooms/jgnbwMnFs9WRg421pcPJQtL1eFFZcmpkccn2dcXh.jpg', 'Espacio de la Conciencia', ' Un ambiente sereno y reflexivo, dedicado a la exploración de la conciencia humana.', 1, 9, 'VwAvoSAJsr', 'activo', 'publico', 80, '2024-09-23 15:14:47', '2024-09-23 15:59:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classroom_users`
--

CREATE TABLE `classroom_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `classroom_users`
--

INSERT INTO `classroom_users` (`id`, `usuario_id`, `classroom_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2024-09-23 15:18:26', '2024-09-23 15:18:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_cursos`
--

CREATE TABLE `comentarios_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comentario` text NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `image` text NOT NULL,
  `tipo` enum('gratis','premium') NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `estatus` enum('activo','inactivo') NOT NULL,
  `calificacion` int(11) NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `image`, `tipo`, `precio`, `estatus`, `calificacion`, `profesor_id`, `categoria_id`, `created_at`, `updated_at`) VALUES
(1, 'Domina Python: De principiante a desarrollador web', 'Este curso intensivo te lleva de cero a experto en Python, el lenguaje de programación más versátil y popular del mundo. Aprenderás los fundamentos de la programación, desde las variables y las estructuras de control hasta la programación orientada a objetos y la creación de aplicaciones web. ', 'public/cursos/7GpiljvZOazadGIjHBCCtwSc0LJLqRTLQkyypo08.png', 'gratis', 0, 'activo', 0, 1, 1, '2024-09-23 14:51:10', '2024-09-23 15:49:33'),
(3, ' Marketing Digital Dominado: De Principiante a Experto', 'Este curso integral te llevará de la mano desde los fundamentos del marketing digital hasta estrategias avanzadas para dominar el panorama digital actual. Aprenderás las herramientas, técnicas y estrategias más efectivas para conectar con tu audiencia, aumentar tu presencia en línea y alcanzar tus objetivos de negocio.', 'public/cursos/rIcjigXJXLDiuWcIt7WXAIiN9ryvixWsDqBoNSjG.jpg', 'premium', 50, 'activo', 0, 1, 3, '2024-09-23 14:59:49', '2024-09-23 14:59:49'),
(4, 'Del Novato al Chef: Dominando el Arte de la Cocina', 'Este curso te llevará de la mano desde los conceptos básicos de la cocina hasta la creación de platillos deliciosos y complejos. Aprenderás técnicas esenciales, recetas clásicas y consejos prácticos para convertirte en un chef casero experto.', 'public/cursos/53dTVo60nctVkeWxk6V0Pv86IlNdu5fP8B4BARAE.jpg', 'gratis', 0, 'activo', 0, 1, 21, '2024-09-23 15:02:17', '2024-09-23 15:02:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesor_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` enum('clasico','multiple') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `lim_tiempo` int(11) DEFAULT NULL,
  `estatus` enum('activo','inactivo') NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `submateria_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id`, `profesor_id`, `nombre`, `descripcion`, `tipo`, `fecha_inicio`, `fecha_fin`, `lim_tiempo`, `estatus`, `materia_id`, `submateria_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'La Prueba del Uno', 'Este examen ultrafácil contiene una sola pregunta matemática que pondrá a prueba tu habilidad para sumar. ', 'clasico', '2004-02-12', '2004-02-13', 60, 'activo', 1, 4, '2024-09-23 16:05:03', '2024-09-23 16:05:03'),
(2, 1, 'La Prueba del Triángulo', 'Este examen de opción múltiple te desafiará a poner a prueba tu conocimiento básico de geometría. ¡Recuerda, solo hay una respuesta correcta!', 'multiple', '2024-05-11', '2004-05-12', 60, 'activo', 1, 4, '2024-09-23 16:06:10', '2024-09-23 16:06:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_clasicos`
--

CREATE TABLE `examenes_clasicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examen_id` bigint(20) UNSIGNED NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes_clasicos`
--

INSERT INTO `examenes_clasicos` (`id`, `examen_id`, `pregunta`, `respuesta`, `created_at`, `updated_at`) VALUES
(1, 1, '¿Cuánto es 1 + 1?', '2', '2024-09-23 16:06:53', '2024-09-23 16:06:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_clasicos_entregados`
--

CREATE TABLE `examenes_clasicos_entregados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examenes_entregado_id` bigint(20) UNSIGNED NOT NULL,
  `examen_clasico_id` bigint(20) UNSIGNED NOT NULL,
  `respuesta` text NOT NULL,
  `estatus` enum('correcto','incorrecto','pendiente') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_entregados`
--

CREATE TABLE `examenes_entregados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `examen_id` bigint(20) UNSIGNED NOT NULL,
  `calificacion` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `tiempo_entrega` int(11) NOT NULL,
  `estatus` enum('corregido','pendiente','rechazado') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_multiples`
--

CREATE TABLE `examenes_multiples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examen_id` bigint(20) UNSIGNED NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta_1` text NOT NULL,
  `respuesta_2` text DEFAULT NULL,
  `respuesta_3` text DEFAULT NULL,
  `respuesta_4` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes_multiples`
--

INSERT INTO `examenes_multiples` (`id`, `examen_id`, `pregunta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `created_at`, `updated_at`) VALUES
(1, 2, '¿Cuántos lados tiene un triángulo?', '3', '2', '4', '5', '2024-09-23 16:07:33', '2024-09-23 16:07:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_multiples_entregados`
--

CREATE TABLE `examenes_multiples_entregados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `examen_entregado_id` bigint(20) UNSIGNED NOT NULL,
  `examenes_multiples_id` bigint(20) UNSIGNED NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta_1` text NOT NULL,
  `estatus` enum('correcto','incorrecto','pendiente') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `codigo_ref` varchar(255) NOT NULL,
  `estatus` enum('pagado','pendiente','rechazado') NOT NULL,
  `fecha_pago` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_cursos`
--

CREATE TABLE `inscripciones_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `videos_terminados` int(11) NOT NULL DEFAULT 0,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscripciones_cursos`
--

INSERT INTO `inscripciones_cursos` (`id`, `videos_terminados`, `estudiante_id`, `curso_id`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 4, '2024-09-23 15:49:56', '2024-09-23 15:49:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `like` int(11) NOT NULL DEFAULT 0,
  `dislike` int(11) NOT NULL DEFAULT 0,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Matemáticas', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(2, 'Física', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(3, 'Química', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(4, 'Biología', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(5, 'Historia', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(6, 'Geografía', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(7, 'Lengua y Literatura', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(8, 'Filosofía', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(9, 'Psicología', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(10, 'Sociología', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(11, 'Economía', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(12, 'Informática', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(13, 'Arte', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(14, 'Música', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(15, 'Educación Física', '2024-09-23 07:40:32', '2024-09-23 07:40:32'),
(16, 'Lenguas Extranjeras', '2024-09-23 07:40:32', '2024-09-23 07:40:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_29_185503_materia', 1),
(6, '2024_06_29_192438_sub_materia', 1),
(7, '2024_06_29_194244_classroom', 1),
(8, '2024_06_29_194245_classroom_user', 1),
(9, '2024_06_29_214450_chat_classroom', 1),
(10, '2024_06_29_215135_tarea', 1),
(11, '2024_06_29_215849_tareas_entregada', 1),
(12, '2024_06_29_221133_examen', 1),
(13, '2024_06_29_224820_examen_clasico', 1),
(14, '2024_06_29_225327_examen_multiple', 1),
(15, '2024_06_29_225951_examen_entregado', 1),
(16, '2024_06_29_232458_examenes_clasico_entregado', 1),
(17, '2024_06_29_232843_examenes_multiple_entregado', 1),
(18, '2024_06_29_233149_categorias', 1),
(19, '2024_06_29_233150_curso', 1),
(20, '2024_06_29_233914_comentarios_curso', 1),
(21, '2024_06_29_234210_modulo_curso', 1),
(22, '2024_06_29_234211_videos_curso', 1),
(23, '2024_06_29_234315_like', 1),
(24, '2024_06_29_234316_inscripcion_curso', 1),
(25, '2024_06_29_234317_videos_completados', 1),
(26, '2024_06_29_234433_factura', 1),
(27, '2024_06_29_235111_alerta', 1),
(28, '2024_06_29_235404_auditoria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_cursos`
--

CREATE TABLE `modulos_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` text NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulos_cursos`
--

INSERT INTO `modulos_cursos` (`id`, `titulo`, `curso_id`, `created_at`, `updated_at`) VALUES
(3, 'Fundamentos de la Cocina', 4, '2024-09-23 15:43:41', '2024-09-23 15:43:41'),
(4, 'Dominando las Técnicas', 4, '2024-09-23 15:43:49', '2024-09-23 15:43:49'),
(5, 'Nociones básicas de la programacion', 1, '2024-09-23 15:52:09', '2024-09-23 15:52:09'),
(6, 'Paleta de colores', 3, '2024-09-23 15:54:17', '2024-09-23 15:54:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submaterias`
--

CREATE TABLE `submaterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `materia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `submaterias`
--

INSERT INTO `submaterias` (`id`, `nombre`, `materia_id`, `created_at`, `updated_at`) VALUES
(1, 'Álgebra', 1, '2024-09-23 07:46:47', '2024-09-23 07:46:47'),
(2, 'Geometría', 1, '2024-09-23 07:46:47', '2024-09-23 07:46:47'),
(3, 'Trigonometría', 1, '2024-09-23 07:46:47', '2024-09-23 07:46:47'),
(4, 'Cálculo', 1, '2024-09-23 07:46:47', '2024-09-23 07:46:47'),
(5, 'Probabilidad y Estadística', 1, '2024-09-23 07:46:47', '2024-09-23 07:46:47'),
(6, 'Mecánica', 2, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(7, 'Termodinámica', 2, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(8, 'Electromagnetismo', 2, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(9, 'Óptica', 2, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(10, 'Física Moderna', 2, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(11, 'Química General', 3, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(12, 'Química Orgánica', 3, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(13, 'Química Inorgánica', 3, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(14, 'Química Analítica', 3, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(15, 'Bioquímica', 3, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(16, 'Biología Celular', 4, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(17, 'Genética', 4, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(18, 'Ecología', 4, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(19, 'Evolución', 4, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(20, 'Anatomía y Fisiología', 4, '2024-09-23 07:46:50', '2024-09-23 07:46:50'),
(21, 'Historia Antigua', 5, '2024-09-23 07:46:51', '2024-09-23 07:46:51'),
(22, 'Historia Medieval', 5, '2024-09-23 07:46:51', '2024-09-23 07:46:51'),
(23, 'Historia Moderna', 5, '2024-09-23 07:46:51', '2024-09-23 07:46:51'),
(24, 'Historia Contemporánea', 5, '2024-09-23 07:46:51', '2024-09-23 07:46:51'),
(25, 'Gramática', 7, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(26, 'Literatura Española', 7, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(27, 'Literatura Universal', 7, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(28, 'Ética', 8, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(29, 'Metafísica', 8, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(30, 'Epistemología', 8, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(31, 'Psicología General', 9, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(32, 'Psicología Social', 9, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(33, 'Psicología del Desarrollo', 9, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(34, 'Sociología General', 10, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(35, 'Sociología del Trabajo', 10, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(36, 'Sociología de la Educación', 10, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(37, 'Microeconomía', 11, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(38, 'Macroeconomía', 11, '2024-09-23 07:47:07', '2024-09-23 07:47:07'),
(39, 'Programación', 12, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(40, 'Redes', 12, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(41, 'Bases de Datos', 12, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(42, 'Pintura', 13, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(43, 'Escultura', 13, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(44, 'Arquitectura', 13, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(45, 'Historia de la Música', 14, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(46, 'Teoría Musical', 14, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(47, 'Atletismo', 15, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(48, 'Gimnasia', 15, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(49, 'Gramática Inglesa', 16, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(50, 'Conversación Inglesa', 16, '2024-09-23 07:47:08', '2024-09-23 07:47:08'),
(51, 'Literatura Inglesa', 16, '2024-09-23 07:47:08', '2024-09-23 07:47:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `documento` text DEFAULT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_entregadas`
--

CREATE TABLE `tareas_entregadas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `tarea_id` bigint(20) UNSIGNED NOT NULL,
  `documento` text NOT NULL,
  `fecha_entrega` date NOT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `estatus_email` enum('2','1') NOT NULL DEFAULT '2',
  `estatus` enum('activo','inactivo','pendiente') NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `lastName`, `email`, `email_verified_at`, `estatus_email`, `estatus`, `password`, `rol`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cristian', 'public/user_photos/Wtkz6dNXIEkrF9V453UuyStJooBx45voV71cR6nt.png', 'Gerig', 'chriscodetech@gmail.com', NULL, '2', 'activo', '$2y$10$PzCcwu/6k341yFqMe7Hw4uVzR7EXaWam/pV7roCgLTRRuINCRbkQe', 1, NULL, NULL, '2024-09-23 14:21:34'),
(2, 'Lucia', NULL, 'Salcedo', 'luciarondon05@gmail.com', NULL, '2', 'activo', '$2y$10$038aNpTaEOmrPmdGI.H1/OLUroxsoip8Blb7zRCMJnn0NWXT7Ne2C', 2, NULL, NULL, NULL),
(3, 'Eduardo', NULL, 'Díaz', 'eduardo@gmail.com', NULL, '2', 'activo', '$2y$10$Qh0WAgk8QmGwIG4QGnq0KOz7nlFQSi5KsAeG0woG0xzJ0/3rzLUpq', 3, NULL, '2024-09-23 14:18:45', '2024-09-23 14:22:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_completados`
--

CREATE TABLE `videos_completados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `videos_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos_completados`
--

INSERT INTO `videos_completados` (`id`, `estudiante_id`, `videos_id`, `created_at`, `updated_at`) VALUES
(2, 1, 5, '2024-09-23 16:00:52', '2024-09-23 16:00:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_cursos`
--

CREATE TABLE `videos_cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `vistas` int(11) NOT NULL DEFAULT 0,
  `video` text NOT NULL,
  `modulo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos_cursos`
--

INSERT INTO `videos_cursos` (`id`, `titulo`, `descripcion`, `vistas`, `video`, `modulo_id`, `created_at`, `updated_at`) VALUES
(1, 'Cocinar proteínas', 'Carne, aves, pescado, mariscos: métodos de cocción, tiempos y temperaturas.', 0, 'public/videos-cursos/a0CE5aTHyQdJkwHQOyWohBuC9A5Y0R4D4RFgB5R7.mp4', 4, '2024-09-23 15:44:49', '2024-09-23 15:44:49'),
(2, 'Cocinar vegetales:', 'Técnicas de cocción, preservación de nutrientes, selección y almacenamiento.', 0, 'public/videos-cursos/II4XgLx4Kg0kZK32miwdWb9VvGW0cXliV99fiVJ0.mp4', 4, '2024-09-23 15:45:15', '2024-09-23 15:45:15'),
(3, 'Cocina segura y limpia', ' Normas de higiene, manipulación de alimentos, limpieza de la cocina.', 0, 'public/videos-cursos/ZaTbqmNnTOZHM7bvoziXPDrXbdQnWo2nAUF2A2Ie.mp4', 3, '2024-09-23 15:46:51', '2024-09-23 15:46:51'),
(4, 'Equipos y utensilios básicos', 'Familiarización con los equipos de cocina esenciales (estufa, horno, microondas, etc.), cuchillos, tablas de cortar, etc.', 0, 'public/videos-cursos/SmfV4oEqoSlbgX21SN3Q7XMXcVblUR6sd0Gw6Z0o.mp4', 3, '2024-09-23 15:47:15', '2024-09-23 15:47:15'),
(5, 'Introducción', 'Introducción a la programación con javascript', 0, 'public/videos-cursos/XPUIingapoaAYtEXS7fwRs0TjazP7hEKXwBeXE2c.mp4', 5, '2024-09-23 15:53:08', '2024-09-23 15:53:08'),
(6, 'Teoria del color', 'Principio para mejorar tus ilustraciones', 0, 'public/videos-cursos/6X8PDR5t5xikt5bJF6BIu3n47JpnGkER4cyj5fe9.mp4', 6, '2024-09-23 15:54:54', '2024-09-23 15:54:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alertas_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `auditorias`
--
ALTER TABLE `auditorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auditorias_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chats_classrooms`
--
ALTER TABLE `chats_classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_classrooms_classroom_id_foreign` (`classroom_id`),
  ADD KEY `chats_classrooms_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classrooms_profesor_id_foreign` (`profesor_id`),
  ADD KEY `classrooms_materia_id_foreign` (`materia_id`);

--
-- Indices de la tabla `classroom_users`
--
ALTER TABLE `classroom_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_users_usuario_id_foreign` (`usuario_id`),
  ADD KEY `classroom_users_classroom_id_foreign` (`classroom_id`);

--
-- Indices de la tabla `comentarios_cursos`
--
ALTER TABLE `comentarios_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentarios_cursos_profesor_id_foreign` (`profesor_id`),
  ADD KEY `comentarios_cursos_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cursos_profesor_id_foreign` (`profesor_id`),
  ADD KEY `cursos_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_profesor_id_foreign` (`profesor_id`),
  ADD KEY `examenes_materia_id_foreign` (`materia_id`),
  ADD KEY `examenes_submateria_id_foreign` (`submateria_id`);

--
-- Indices de la tabla `examenes_clasicos`
--
ALTER TABLE `examenes_clasicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_clasicos_examen_id_foreign` (`examen_id`);

--
-- Indices de la tabla `examenes_clasicos_entregados`
--
ALTER TABLE `examenes_clasicos_entregados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_clasicos_entregados_examenes_entregado_id_foreign` (`examenes_entregado_id`),
  ADD KEY `examenes_clasicos_entregados_examen_clasico_id_foreign` (`examen_clasico_id`);

--
-- Indices de la tabla `examenes_entregados`
--
ALTER TABLE `examenes_entregados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_entregados_estudiante_id_foreign` (`estudiante_id`),
  ADD KEY `examenes_entregados_examen_id_foreign` (`examen_id`);

--
-- Indices de la tabla `examenes_multiples`
--
ALTER TABLE `examenes_multiples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_multiples_examen_id_foreign` (`examen_id`);

--
-- Indices de la tabla `examenes_multiples_entregados`
--
ALTER TABLE `examenes_multiples_entregados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_multiples_entregados_examen_entregado_id_foreign` (`examen_entregado_id`),
  ADD KEY `examenes_multiples_entregados_examenes_multiples_id_foreign` (`examenes_multiples_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_usuario_id_foreign` (`usuario_id`),
  ADD KEY `facturas_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `inscripciones_cursos`
--
ALTER TABLE `inscripciones_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inscripciones_cursos_estudiante_id_foreign` (`estudiante_id`),
  ADD KEY `inscripciones_cursos_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_estudiante_id_foreign` (`estudiante_id`),
  ADD KEY `likes_video_id_foreign` (`video_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos_cursos`
--
ALTER TABLE `modulos_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulos_cursos_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `submaterias`
--
ALTER TABLE `submaterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submaterias_materia_id_foreign` (`materia_id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tareas_classroom_id_foreign` (`classroom_id`);

--
-- Indices de la tabla `tareas_entregadas`
--
ALTER TABLE `tareas_entregadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tareas_entregadas_usuario_id_foreign` (`usuario_id`),
  ADD KEY `tareas_entregadas_tarea_id_foreign` (`tarea_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `videos_completados`
--
ALTER TABLE `videos_completados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_completados_estudiante_id_foreign` (`estudiante_id`),
  ADD KEY `videos_completados_videos_id_foreign` (`videos_id`);

--
-- Indices de la tabla `videos_cursos`
--
ALTER TABLE `videos_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_cursos_modulo_id_foreign` (`modulo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditorias`
--
ALTER TABLE `auditorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `chats_classrooms`
--
ALTER TABLE `chats_classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `classroom_users`
--
ALTER TABLE `classroom_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios_cursos`
--
ALTER TABLE `comentarios_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `examenes_clasicos`
--
ALTER TABLE `examenes_clasicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `examenes_clasicos_entregados`
--
ALTER TABLE `examenes_clasicos_entregados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examenes_entregados`
--
ALTER TABLE `examenes_entregados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examenes_multiples`
--
ALTER TABLE `examenes_multiples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `examenes_multiples_entregados`
--
ALTER TABLE `examenes_multiples_entregados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripciones_cursos`
--
ALTER TABLE `inscripciones_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `modulos_cursos`
--
ALTER TABLE `modulos_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `submaterias`
--
ALTER TABLE `submaterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas_entregadas`
--
ALTER TABLE `tareas_entregadas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `videos_completados`
--
ALTER TABLE `videos_completados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `videos_cursos`
--
ALTER TABLE `videos_cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `alertas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `auditorias`
--
ALTER TABLE `auditorias`
  ADD CONSTRAINT `auditorias_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `chats_classrooms`
--
ALTER TABLE `chats_classrooms`
  ADD CONSTRAINT `chats_classrooms_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `chats_classrooms_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `classrooms_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `classroom_users`
--
ALTER TABLE `classroom_users`
  ADD CONSTRAINT `classroom_users_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `classroom_users_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `comentarios_cursos`
--
ALTER TABLE `comentarios_cursos`
  ADD CONSTRAINT `comentarios_cursos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `comentarios_cursos_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `cursos_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD CONSTRAINT `examenes_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `examenes_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `examenes_submateria_id_foreign` FOREIGN KEY (`submateria_id`) REFERENCES `submaterias` (`id`);

--
-- Filtros para la tabla `examenes_clasicos`
--
ALTER TABLE `examenes_clasicos`
  ADD CONSTRAINT `examenes_clasicos_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examenes` (`id`);

--
-- Filtros para la tabla `examenes_clasicos_entregados`
--
ALTER TABLE `examenes_clasicos_entregados`
  ADD CONSTRAINT `examenes_clasicos_entregados_examen_clasico_id_foreign` FOREIGN KEY (`examen_clasico_id`) REFERENCES `examenes_clasicos` (`id`),
  ADD CONSTRAINT `examenes_clasicos_entregados_examenes_entregado_id_foreign` FOREIGN KEY (`examenes_entregado_id`) REFERENCES `examenes_entregados` (`id`);

--
-- Filtros para la tabla `examenes_entregados`
--
ALTER TABLE `examenes_entregados`
  ADD CONSTRAINT `examenes_entregados_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `examenes_entregados_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examenes` (`id`);

--
-- Filtros para la tabla `examenes_multiples`
--
ALTER TABLE `examenes_multiples`
  ADD CONSTRAINT `examenes_multiples_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examenes` (`id`);

--
-- Filtros para la tabla `examenes_multiples_entregados`
--
ALTER TABLE `examenes_multiples_entregados`
  ADD CONSTRAINT `examenes_multiples_entregados_examen_entregado_id_foreign` FOREIGN KEY (`examen_entregado_id`) REFERENCES `examenes_entregados` (`id`),
  ADD CONSTRAINT `examenes_multiples_entregados_examenes_multiples_id_foreign` FOREIGN KEY (`examenes_multiples_id`) REFERENCES `examenes_multiples` (`id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `facturas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `inscripciones_cursos`
--
ALTER TABLE `inscripciones_cursos`
  ADD CONSTRAINT `inscripciones_cursos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `inscripciones_cursos_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos_cursos` (`id`);

--
-- Filtros para la tabla `modulos_cursos`
--
ALTER TABLE `modulos_cursos`
  ADD CONSTRAINT `modulos_cursos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Filtros para la tabla `submaterias`
--
ALTER TABLE `submaterias`
  ADD CONSTRAINT `submaterias_materia_id_foreign` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`);

--
-- Filtros para la tabla `tareas_entregadas`
--
ALTER TABLE `tareas_entregadas`
  ADD CONSTRAINT `tareas_entregadas_tarea_id_foreign` FOREIGN KEY (`tarea_id`) REFERENCES `tareas` (`id`),
  ADD CONSTRAINT `tareas_entregadas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `videos_completados`
--
ALTER TABLE `videos_completados`
  ADD CONSTRAINT `videos_completados_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `videos_completados_videos_id_foreign` FOREIGN KEY (`videos_id`) REFERENCES `videos_cursos` (`id`);

--
-- Filtros para la tabla `videos_cursos`
--
ALTER TABLE `videos_cursos`
  ADD CONSTRAINT `videos_cursos_modulo_id_foreign` FOREIGN KEY (`modulo_id`) REFERENCES `modulos_cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

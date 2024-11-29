<?php

require_once 'config/config.php';

class Model {
        protected $db;

        public function __construct() {

            $this->db = new PDO(
                "mysql:host=".MYSQL_HOST .
                ";dbname=".MYSQL_DB.";charset=utf8", 
                MYSQL_USER, MYSQL_PASS);

            $this->_deploy();            
        }

        function crearConexion() {
          
            try {
                $pdo = $this->db;
            } catch (\Throwable $th) {
                die($th);
            }
            return $pdo;
        }

        function getCount($tabla){
            $pdo = $this->crearConexion();
            $sql = "SELECT count(*) FROM $tabla" ;
            $query = $pdo->prepare($sql);
            $query->execute();

            $elementos = $query->fetch(PDO::FETCH_OBJ);

        return ($elementos);
        }

        function existeCampo($nombreTabla, $campo){
            $pdo = $this->crearConexion();
            $sql = "SELECT * FROM Information_Schema.COLUMNS WHERE TABLE_NAME = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$nombreTabla]);
            $columnas = $query->fetchall(PDO::FETCH_OBJ);
            foreach($columnas as $columna){
                if ($columna->COLUMN_NAME == $campo)
                    return true;
            } 
            return false; 
        }

        private function _deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables) == 0) {
                $sql = <<<END
                -- phpMyAdmin SQL Dump
                -- version 5.2.1
                -- https://www.phpmyadmin.net/
                --
                -- Servidor: 127.0.0.1
                -- Tiempo de generación: 17-11-2024 a las 23:39:28
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
                -- Base de datos: `trebol_muebleria`
                --
                -- --------------------------------------------------------
                --
                -- Estructura de tabla para la tabla `materiales`
                --
                CREATE TABLE `materiales` (
                `id_material` int(11) NOT NULL,
                `material` varchar(50) NOT NULL,
                `proveedor` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
                --
                -- Volcado de datos para la tabla `materiales`
                --
                INSERT INTO `materiales` (`id_material`, `material`, `proveedor`) VALUES
                (1, 'pino', 1),
                (2, 'melamina', 1),
                (5, 'chenille', 2),
                (6, 'algarrobo duro', 3),
                (7, 'Madera balza', 52);
                -- --------------------------------------------------------
                --
                -- Estructura de tabla para la tabla `opiniones`
                --
                CREATE TABLE `opiniones` (
                `id_opinion` int(11) NOT NULL,
                `calificacion` tinyint(4) NOT NULL,
                `comentario` varchar(250) NOT NULL,
                `id_usuarios` int(11) NOT NULL,
                `id_producto` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
                --
                -- Volcado de datos para la tabla `opiniones`
                --
                INSERT INTO `opiniones` (`id_opinion`, `calificacion`, `comentario`, `id_usuarios`, `id_producto`) VALUES
                (1, 3, 'lindo', 5, 10),
                (2, 9, 'muy muy lindo', 5, 10),
                (3, 3, 'lindo', 5, 10),
                (4, 3, 'medio pelo', 5, 9),
                (9, 3, 'medio pelo', 5, 3),
                (10, 3, 'estupendo', 5, 10),
                (11, 3, 'estupendo', 5, 10);
                -- --------------------------------------------------------
                --
                -- Estructura de tabla para la tabla `productos`
                --
                CREATE TABLE `productos` (
                `id_producto` int(11) NOT NULL,
                `nombre` varchar(50) NOT NULL,
                `precio` float NOT NULL,
                `descripcion` varchar(250) NOT NULL,
                `imagen` varchar(200) NOT NULL,
                `id_material` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
                --
                -- Volcado de datos para la tabla `productos`
                --
                INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `descripcion`, `imagen`, `id_material`) VALUES
                (3, 'mesa de 6 lugares', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (4, 'sillón de 2 cuerpos', 106985, 'sillón de 2 cuerpos forrado con chenille gris, totalmente lavable.', 'img/sillon1.jpg', 5),
                (5, 'silla de pino', 50000, 'silla de pino reforzada por unidad', 'img/silla1.jpg', 1),
                (6, 'mesa de tv', 402970, 'mesa de tv hecha en melamina', 'img/mesatv1.jpg', 2),
                (7, 'Meson', 600, 'Mesón de pino parana', '', 1),
                (8, 'Meson', 600, 'Mesón de pino parana', '', 1),
                (9, 'sillon', 200, 'sillon de pino ', 'img/', 1),
                (10, 'banco', 5000, 'banco tapizado', 'img/', 5),
                (11, 'mesa de 6 lugares', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (12, 'mesa de 6 lugares', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (13, 'sillón de 2 cuerpos y extension', 106985, 'sillón de 2 cuerpos forrado con chenille gris, totalmente lavable.', 'img/sillon1.jpg', 5),
                (14, 'mesa de 6 lugares pero nueva', 2062, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (15, 'mesa de 6 lugares pero nueva', 54, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (16, 'mesa de 6 lugares pero nueva', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (17, 'mesa de 6 lugares pero nueva', 2000, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (18, 'mesa de 6 lugares pero nueva', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (19, 'mesa de 6 lugares pero nueva', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (20, 'mesa de 6 lugares pero nueva', 5836, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (21, 'mesa de 6 lugares pero nueva', 650, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (22, 'mesa de 6 lugares pero nueva', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (23, 'mesa de 6 lugares pero nueva', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (24, 'mesa de 12 lugares pero nueva', 200981, 'mesa de algarrobo de 180x160 mts.', 'img/mesa1.jpg', 6),
                (25, 'mesa de 12 lugares pero nueva', 200981, 'mesa de madera dura de 180x160 mts.', 'img/mesa1.jpg', 6),
                (26, 'mesa de 12 lugares pero nueva', 200981, 'mesa de madera dura de 180x160 mts.', 'img/mesa1.jpg', 6),
                (27, 'mesa de 12 lugares pero nueva', 200981, 'mesa de madera dura de 180x160 mts.', 'img/mesa1.jpg', 6),
                (28, 'mesa de 12 lugares pero nueva', 200981, 'mesa de madera dura de 180x160 mts.', 'img/mesa1.jpg', 6);
                -- --------------------------------------------------------
                --
                -- Estructura de tabla para la tabla `usuarios`
                --
                CREATE TABLE `usuarios` (
                `id_usuarios` int(11) NOT NULL,
                `nombre` varchar(50) NOT NULL,
                `apellido` varchar(50) NOT NULL,
                `email` varchar(50) NOT NULL,
                `nombre_usuario` varchar(50) NOT NULL,
                `password` varchar(254) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
                --
                -- Volcado de datos para la tabla `usuarios`
                --
                INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellido`, `email`, `nombre_usuario`, `password`) VALUES
                (1, 'admin', 'admin', 'admin@admin', 'webadmin', '$2y$10$9/9DAt3bI5xUFiWTX8mQ.uW25C0W7C5Re3Mb.Sq85hL1Hr5WY7kQK'),
                --
                -- Índices para tablas volcadas
                --
                --
                -- Indices de la tabla `materiales`
                --
                ALTER TABLE `materiales`
                ADD PRIMARY KEY (`id_material`);
                --
                -- Indices de la tabla `opiniones`
                --
                ALTER TABLE `opiniones`
                ADD PRIMARY KEY (`id_opinion`),
                ADD KEY `opiniones_ibfk_1` (`id_producto`),
                ADD KEY `opiniones_ibfk_2` (`id_usuarios`);
                --
                -- Indices de la tabla `productos`
                --
                ALTER TABLE `productos`
                ADD PRIMARY KEY (`id_producto`),
                ADD KEY `id_material` (`id_material`);
                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                ADD PRIMARY KEY (`id_usuarios`);
                --
                -- AUTO_INCREMENT de las tablas volcadas
                --
                --
                -- AUTO_INCREMENT de la tabla `materiales`
                --
                ALTER TABLE `materiales`
                MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
                --
                -- AUTO_INCREMENT de la tabla `opiniones`
                --
                ALTER TABLE `opiniones`
                MODIFY `id_opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
                --
                -- AUTO_INCREMENT de la tabla `productos`
                --
                ALTER TABLE `productos`
                MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
                --
                -- Restricciones para tablas volcadas
                --
                --                
                -- Filtros para la tabla `opiniones`
                --
                ALTER TABLE `opiniones`
                ADD CONSTRAINT `opiniones_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
                ADD CONSTRAINT `opiniones_ibfk_2` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE;
                --
                -- Filtros para la tabla `productos`
                --
                ALTER TABLE `productos`
                ADD CONSTRAINT `material` FOREIGN KEY (`id_material`) REFERENCES `materiales` (`id_material`);
                COMMIT;
                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

                END;
                $this->db->query($sql);
            }
        }
    
}

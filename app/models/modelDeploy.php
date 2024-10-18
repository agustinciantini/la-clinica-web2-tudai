<?php 
require_once './config.php';

abstract class modelDeploy {

    public $db;

    public function __construct(){
        $this->ConectionDb();
        //Conexion a la base de datos.
        $this->db = $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);

            $this->_deployUser();
            $this->_deployCategory(); 
            $this->_deployTurns();
    }
    public function ConectionDb(){
        $db = new PDO(
            "mysql:host=" . MYSQL_HOST .";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);

        $sql = "CREATE DATABASE IF NOT EXISTS `".MYSQL_DB."`
                DEFAULT CHARACTER SET utf8mb4
                COLLATE utf8mb4_general_ci";
        $db->exec($sql);        
    }

    public function _deployUser() {

        $sql =<<<SQL
        CREATE DATABASE IF NOT EXISTS `clinica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        USE `clinica`;
        SQL;

        $this->db->query($sql);
        $query = $this->db->query("SHOW TABLES LIKE 'usuario'");
        $tables = $query->fetchAll();

        if (count($tables) == 0) {

            $sql =<<<SQL
            CREATE TABLE `usuario` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(300) NOT NULL,
            `password` char(60) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `email` (`email`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            SQL;

            $this->db->query($sql);

            $insertSql = "INSERT INTO usuario (email, password) VALUES ( ?, ?)"; // chequear acá
            $this->db->prepare($insertSql)->execute([ 'webadmin', '$2y$10$mrjZzr7CGZI7ckIaF4qWaubeg7QutszR6vQ91ZYA58Ruo79kk1ply']);
        }
    }

    public function _deployTurns() {
        $query = $this->db->query("SHOW TABLES LIKE 'turno'");
        $tables = $query->fetchAll();

        if (count($tables) == 0) {

            $sql = <<<SQL

            CREATE TABLE `turno` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `fecha` date NOT NULL,
            `hora` int(11) NOT NULL,
            `consultorio` int(11) NOT NULL,
            `medico` varchar(2000) NOT NULL,
            `id_paciente` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `id_paciente` (`id_paciente`),
              CONSTRAINT `turno_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE CASCADE
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            SQL;
            $this->db->query($sql);
    
            $insertSql = "INSERT INTO `turno` (`id`, `fecha`, `hora`, `consultorio`, `medico`, `id_paciente`) VALUES
                        (4, '2024-09-27', 13, 3, 'Mariana Solis', 3),
                        (1, '2024-09-28', 12, 2, 'Juan Carlos Gomez', 1),
                        (2, '2024-09-30', 14, 1, 'Fausto Herrera', 4),
                        (3, '2024-09-29', 11, 2, 'Mariana Solis', 2)";
                        
            $this->db->prepare($insertSql)->execute();
        }
    }

    public function _deployCategory() {
        $query = $this->db->query("SHOW TABLES LIKE 'paciente'");
        $tables = $query->fetchAll();

        if (count($tables) == 0) {

            $sql = <<<SQL

            CREATE TABLE `paciente` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `nombre` varchar(100) NOT NULL,
            `apellido` varchar(100) NOT NULL,
            `dni` int(11) NOT NULL,
            `edad` int(100) NOT NULL,
            `enfermedad` varchar(100) NOT NULL,
            `medico` varchar(100) NOT NULL,
            `img` varchar(300) NOT NULL,

              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            SQL;
    
            $this->db->query($sql);
    
            $insertSql = "INSERT INTO `paciente` (`id`, `nombre`, `apellido`, `dni`, `edad`, `enfermedad`, `medico`) VALUES
                        (1, 'Agustin', 'Ciantini', 1234567, 19, 'Apendicitis', 'Juan Carlos Gomez'),
                        (2, 'Jazmin', 'Barragan', 1234568, 19, 'Fractura', 'Mariana Solis'),
                        (3, 'Juan Pablo', 'Chiclana', 1234560, 19, 'Congestion', 'Mariana Solis'),
                        (4, 'Francisco', 'Cocirio', 12345679, 18, 'Larinjitis', 'Fausto Herrera')";
    
            $this->db->prepare($insertSql)->execute();
        }
    }
}
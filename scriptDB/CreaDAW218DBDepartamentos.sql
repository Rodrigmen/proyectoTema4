/* Creación de la Base de Datos */
    CREATE DATABASE if NOT EXISTS DAW218DBDepartamentos;
    
/* Creación del usuario */
    CREATE USER IF NOT EXISTS 'usuarioDAW218DBDepartamentos'@'%' identified BY 'P@ssw0rd'; 
/* Dar permisos al usuario creado */
    GRANT ALL PRIVILEGES ON DAW218DBDepartamentos.* TO 'usuarioDAW218DBDepartamentos'@'%'; 
/* Usar la base de datos creada */
    USE DAW218DBDepartamentos;

/* Creación de la table departamento */
CREATE TABLE IF NOT EXISTS Departamento (
    CodDepartamento CHAR(3) PRIMARY KEY,
    DescDepartamento VARCHAR(255) NOT NULL,
    VolumenNegocio FLOAT NOT NULL,
    FechaBaja DATE
)  ENGINE=INNODB;

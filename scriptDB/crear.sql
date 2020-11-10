
/* Creación de la table departamento */
CREATE TABLE IF NOT EXISTS Departamento (
    CodDepartamento CHAR(3) PRIMARY KEY,
    DescDepartamento VARCHAR(255) NOT NULL,
    VolumenNegocio FLOAT NOT NULL,
    FechaBaja DATE
)  ENGINE=INNODB;

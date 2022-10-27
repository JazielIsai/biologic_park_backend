CREATE DATABASE biologic_park;
USE biologic_park;

CREATE TABLE IF NOT EXISTS roles (
    id int not null auto_increment primary key,
    rol varchar(90) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO roles(rol) VALUES ('admin'), ('user'), ('view');

SELECT * FROM roles;

DROP TABLE IF EXISTS roles;


CREATE TABLE IF NOT EXISTS users (
    id int not null auto_increment primary key,
    firstname varchar(55),
    lastname varchar(80),
    academicTitle varchar(55),
    email varchar(90) not null,
    password varchar(16) not null,
    id_rol int not null,
    CONSTRAINT id_rol FOREIGN KEY (id_rol) REFERENCES roles(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO users(firstname, lastname, academicTitle, email, password, id_rol)
VALUES
    ('Carla Mariana', 'Martinez Garcia', 'Ing. Sistemas Computacionales', 'carla@gmail.com', '12345', 2),
    ('Marion Michelle', 'Garcia Barron', 'Ing. Sistemas Computacionales', 'marion@gmail.com', '12345', 2),
    ('Maximiliano', 'Ruiz Manjarrez', 'Ing. Sistemas Computacionales', 'max@gmail.com', '12345', 2),
    ('Sergio Luis', 'Sanchez', 'Ing. Sistemas Computacionales', 'sergio@gmail.com', '12345', 1);

SELECT firstname, lastname, academicTitle, email FROM users;

SELECT
    firstName, lastname, academicTitle, email, roles.rol AS rol
FROM users
    INNER JOIN roles
        ON roles.id = users.id;


CREATE TABLE IF NOT EXISTS  city_states (
    id int not null auto_increment primary key,
    name varchar(100) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS city_states;

INSERT INTO city_states(name) VALUES ("Guanajuato");

SELECT * FROM city_states;

CREATE TABLE IF NOT EXISTS municipality (
    id int not null auto_increment primary key,
    name varchar(100),
    idCityState int,
    CONSTRAINT id_city_state FOREIGN KEY (idCityState) REFERENCES city_states(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS municipality;

-- CITY STATE Guanajuato
INSERT INTO municipality(name, idCityState) VALUES
("Abasolo", 1),
("Acámbaro", 1),
("Apaseo el Alto", 1),
("Apaseo el Grande", 1),
("Atarjea", 1),
("Celaya", 1),
("Manuel Doblado", 1),
("Comonfort", 1),
("Coroneo", 1),
("Cortazar", 1),
("Cuerámaro", 1),
("Doctor Mora", 1),
("Dolores Hidalgo", 1),
("Guanajuato", 1),
("Huanímaro", 1),
("Irapuato", 1),
("Jaral del Progreso", 1),
("Jerécuaro", 1),
("León", 1),
("Moroleón", 1),
("Ocampo", 1),
("Pénjamo", 1),
("Pueblo Nuevo", 1),
("Purísima del Rincón", 1),
("Romita", 1),
("Salamanca", 1),
("Salvatierra", 1),
("San Diego de la Unión", 1),
("San Felipe", 1),
("San Francisco del Rincón", 1),
("San José Iturbide", 1),
("San Luis de la Paz", 1),
("Santa Catarina", 1),
("Santa Cruz de Juventino Rosas", 1),
("Santiago Maravatío", 1),
("Silao de la Victoria", 1),
("Tarandacuao", 1),
("Tarimoro", 1),
("Tierra Blanca", 1),
("Uriangato", 1),
("Valle de Santiago", 1),
("Victoria", 1),
("Villagrán", 1),
("Xichú", 1),
("Yuriria", 1);

SELECT * FROM municipality;


CREATE TABLE IF NOT EXISTS  parks_data (
    id int not null primary key auto_increment,
    name varchar(100),
    trainingBackground text, -- antecedentes de Formacion
    areaHa text,
    form text, -- forma
    boundaries text, -- colindancias
    recreationAreas text, -- areasRecreo
    street text, -- calle
    suburb text, -- colonia
    latitude double,
    length double,
    idMunicipality int,
    idCityStates int,
    CONSTRAINT id_municipality FOREIGN KEY (idMunicipality) REFERENCES municipality(id),
    CONSTRAINT id_state FOREIGN KEY (idCityStates) REFERENCES city_states(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS parks_data;

INSERT INTO parks_data(name, trainingbackground, areaha, form, boundaries,
                       recreationareas, street, suburb, latitude, length,
                       idmunicipality, idcitystates)
VALUES
    ('Irekua Park', '', '5', 'Reactangular', '', '', 'Jardines de Irapuato', 'Av. Guerreroz', 20.7206124, -101.391474313, 16, 1);

CREATE TABLE IF NOT EXISTS category (
    id int not null primary key auto_increment,
    description varchar(100) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO category(description)
VALUES
    ('Aves'),
    ('Anfibios'),
    ('Reptiles'),
    ('Mamíferos'),
    ('Peces con aletas radiadas'),
    ('Moluscos'),
    ('Arañas, alacranes y parientes'),
    ('Insectos'),
    ('Plantas'),
    ('Hongos incluyendo Líquenes'),
    ('Protozoarios'),
    ('Desconocido');

SELECT * FROM category;

CREATE TABLE IF NOT EXISTS images (
    id int not null auto_increment primary key,
    name text not null,
    ruta text not null,
    author varchar(100) not null,
    idBiologicalData int
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO images(name, ruta, author, idBiologicalData)
VALUES ('Calandria Dorso Negro Menor - Icterus cucullatus',
        '/var/www/html/biological_parks_backend/Categorias/Pajaros/Calandria Dorso Negro Menor.jpeg',
        'efrenbiologia', 1);


CREATE TABLE IF NOT EXISTS biologic_data(
    id int not null primary key auto_increment,
    commonName varchar(100),
    scientificName varchar(100),
    sightingDate date, -- fecha de avistamiento
    description text,
    geographicalDistribution text, -- distribucion Geografica
    naturalHistory text, -- historia natural
    statusConservation text, -- estatus de conservacion
    authorBiologicData int, -- autor de la ficha biologica
    idCategory int,
    idParkData int,
    idUser int,
    idImage int,
    CONSTRAINT id_category FOREIGN KEY (idCategory) REFERENCES category(id),
    CONSTRAINT id_park_data FOREIGN KEY (idParkData) REFERENCES parks_data(id),
    CONSTRAINT id_user FOREIGN KEY (idUser) REFERENCES users(id),
    CONSTRAINT id_image FOREIGN KEY (idImage) REFERENCES images(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO biologic_data(commonName, scientificName, sightingDate,
                          description, geographicalDistribution,
                          naturalHistory, statusConservation, authorBiologicData,
                          idCategory, idParkData, idUser, idImage)
VALUES ('Calandria Dorso Negro Menor', 'Hooded oriole (Icterus cucullatus)', '',
        'El turpial enmascarado (Icterus cucullatus) también conocido como bolsero cuculado, bolsero encapuchado, bolsero encapuchinado, bolsero zapotero, chorcha de capucha, chorcha rojiza o turpial zapotero, es una especie de ave paseriforme de la familia de los ictéridos (Icteridae). Es originaria de América del Norte y Centroamérica.',
        '', 'Bosques abiertos, árboles de sombra y palmeras. Se reproduce en bosques de árboles como el álamo, el nogal y el sicomoro, a lo largo de arroyos y en cañones, y en bosques abiertos en tierras bajas. Es común verlo en suburbios y parques urbanos. Por lo general, prefiere las palmeras y arma su nido en grupos de palmeras aislados, incluso en las ciudades.',
        'Mirlos y Oropéndolas', 'Lives of North American Birds', 1, 1, 1, 1);

DROP TABLE IF EXISTS biologic_data;

CREATE TABLE IF NOT EXISTS pivot_biologic_park (
    id int not null auto_increment primary key,
    idBiologicData int,
    idParksData int,
    CONSTRAINT id_biologic_data FOREIGN KEY (idBiologicData) REFERENCES biologic_data(id),
    CONSTRAINT id_parks_data FOREIGN KEY (idParksData) REFERENCES parks_data(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS pivot_biologic_park;
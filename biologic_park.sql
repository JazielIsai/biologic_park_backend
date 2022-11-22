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

UPDATE users
SET password = '123456'
WHERE id = 2;

SELECT * FROM users;

DELETE FROM users WHERE id = 7;

SELECT id, firstname, lastname, academicTitle, email FROM users;

SELECT users.id, firstname, lastname, academicTitle, email, id_rol,
       roles.rol as Rol
FROM users
INNER JOIN roles ON users.id_rol = roles.id
WHERE email = 'carla@gmail.com' AND password = '12345';

SELECT
    firstName, lastname, academicTitle, email, roles.rol AS rol
FROM users
    INNER JOIN roles
        ON roles.id = users.id_rol;


SELECT firstname, lastname, academicTitle, email, roles.rol AS rol
FROM users
INNER JOIN roles ON roles.id = users.id_rol
WHERE firstname LIKE '%' OR lastname LIKE '%' OR academicTitle LIKE '%' OR email LIKE '%';


CREATE TABLE IF NOT EXISTS  city_states_bp (
    id int not null auto_increment primary key,
    nameCityStates varchar(100) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS city_states;

INSERT INTO city_states_bp(nameCityStates) VALUES ("Guanajuato");

SELECT id, nameCityStates FROM city_states_bp;

CREATE TABLE IF NOT EXISTS municipality_bp (
    id int not null auto_increment primary key,
    nameMunicipality varchar(100),
    idCityState int,
    CONSTRAINT id_city_state FOREIGN KEY (idCityState) REFERENCES city_states_bp(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS municipality;

-- CITY STATE Guanajuato
INSERT INTO municipality_bp(nameMunicipality, idCityState) VALUES
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

SELECT * FROM municipality_bp WHERE nameMunicipality = 'Leon';

SELECT municipality_bp.id, municipality_bp.nameMunicipality
    FROM municipality_bp
    WHERE municipality_bp.idCityState = ?;

SELECT municipality_bp.id, municipality_bp.nameMunicipality,
       city_states_bp.nameCityStates AS cityState
FROM municipality_bp
INNER JOIN city_states_bp
    ON municipality_bp.idCityState = city_states_bp.id
WHERE idCityState = 1;

CREATE TABLE IF NOT EXISTS  parks_data (
    id int not null primary key auto_increment,
    namePark varchar(100),
    trainingBackground text, -- antecedentes de Formacion
    areaHa text,
    form text, -- forma
    boundaries text, -- colindancias
    recreationAreas text, -- areasRecreocion
    street text, -- calle
    suburb text, -- colonia
    latitude double,
    length double,
    idMunicipality int,
    idCityStates int,
    idUser int,
    CONSTRAINT id_municipality FOREIGN KEY (idMunicipality) REFERENCES municipality_bp(id),
    CONSTRAINT id_state FOREIGN KEY (idCityStates) REFERENCES city_states_bp(id),
    CONSTRAINT id_user_pk FOREIGN KEY (idUser) REFERENCES users(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS parks_data;

ALTER TABLE parks_data
    ADD COLUMN registrationDate DATE;

ALTER TABLE parks_data
    MODIFY COLUMN registrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

UPDATE parks_data
    SET parks_data.registrationDate = '2022-03-05 14:00:10'
    WHERE parks_data.id = 4;


SELECT * FROM parks_data;
SELECT * FROM biologic_data;

INSERT INTO parks_data
    (namePark, trainingbackground, areaha, form, boundaries,
     recreationareas, street, suburb, latitude, length,
     idmunicipality, idcitystates, idUser)
VALUES
    ('Irekua Park', '', '5', 'Reactangular', '', '', 'Jardines de Irapuato', 'Av. Guerreroz', 20.7206124, -101.391474313, 16, 1, 1);


INSERT INTO parks_data(namePark, trainingbackground, areaha, form, boundaries,
                       recreationareas, street, suburb, latitude, length,
                       idmunicipality, idcitystates, idUser)
VALUES
    ('Tabachines Park', '', '3', 'Reactangular', '', '', 'Argentina', 'Tabachines', 20.6927692, -101.36239071904, 16, 1, 2);


INSERT INTO parks_data(namePark, trainingbackground, areaha, form, boundaries,
                       recreationareas, street, suburb, latitude, length,
                       idmunicipality, idcitystates, idUser)
VALUES
    ('Gorrión Doméstico', '', '', '', '', '', '', '', 21.1218994, -101.736051412, 19, 1, 3);

INSERT INTO parks_data(namePark, trainingbackground, areaha, form, boundaries,
                       recreationareas, street, suburb, latitude, length,
                       idmunicipality, idcitystates, idUser)
VALUES
    ('Jardines De Arandas', '', 'Cuadrado', '', '', '', 'Jardines De Arandas', 'Blvrd Arandas, 36807 Irapuato, Gto.', 20.7280905, -101.3760126211, 19, 1, 2);


UPDATE parks_data
SET namePark = 'Leon Gto' WHERE id = 3;


SELECT * FROM parks_data;

SELECT namePark, trainingBackground, areaHa, form,
       boundaries, recreationAreas, street, suburb, latitude, length,
       municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState
FROM parks_data
INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
WHERE parks_data.idUser = ?;

-- by id
SELECT * FROM parks_data WHERE id = ?;

-- by municipality
SELECT namePark, trainingBackground, areaHa, form,
       boundaries, recreationAreas, street, suburb, latitude, length,
       municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState
FROM parks_data
INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
WHERE municipality_bp.nameMunicipality  LIKE 'Irapuato';

-- by city state
SELECT namePark, trainingBackground, areaHa, form,
       boundaries, recreationAreas, street, suburb, latitude, length,
       municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState
FROM parks_data
INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
WHERE city_states_bp.nameCityStates  LIKE 'Guanajauto';



SELECT namePark, trainingBackground, areaHa, form,
       boundaries, recreationAreas, street, suburb, latitude, length,
       municipality_bp.nameMunicipality AS municipality, city_states_bp.nameCityStates AS cityState,
       users.firstName AS ParkWasRegisterByUser
FROM parks_data
INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
INNER JOIN users ON parks_data.idUser = users.id;


SELECT namePark, trainingBackground, areaHa, form, boundaries,
       recreationAreas, street, suburb, latitude, length,
       municipality_bp.nameMunicipality as municipality,
       city_states_bp.nameCityStates AS cityState,
       users.firstName AS ParkWasRegisterByUser
FROM parks_data
INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
INNER JOIN users ON parks_data.idUser = users.id
WHERE parks_data.namePark LIKE ?;


SELECT namePark, trainingBackground, areaHa, form, boundaries,
       recreationAreas, street, suburb, latitude, length,
       municipality_bp.nameMunicipality as municipality,
       city_states_bp.nameCityStates AS cityState,
       users.firstName AS ParkWasRegisterByUser
FROM parks_data
INNER JOIN municipality_bp ON parks_data.idMunicipality = municipality_bp.id
INNER JOIN city_states_bp ON parks_data.idCityStates = city_states_bp.id
INNER JOIN users ON parks_data.idUser = users.id
WHERE parks_data.namePark LIKE ?;


SELECT id, namePark FROM parks_data;

CREATE TABLE IF NOT EXISTS images_parks (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(200),
  ruta TEXT,
  author VARCHAR(55),
  idParks INT,
  idUser INT,
  CONSTRAINT id_parks FOREIGN KEY (idParks) REFERENCES parks_data(id),
  CONSTRAINT id_user_img_pk FOREIGN KEY (idUser) REFERENCES users(id)
);

ALTER TABLE images_parks
    ADD COLUMN sightingDate date;

ALTER TABLE images_parks
    MODIFY COLUMN sightingDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

SELECT * FROM images_parks;

UPDATE images_parks
SET images_parks.sightingDate = '2022-02-19 01:15:10'
WHERE images_parks.id = 1;

DROP TABLE IF EXISTS images_parks;

INSERT INTO images_parks(name, ruta, author, idParks, idUser)
VALUES (?, ?, ?, ?, ?);

INSERT INTO images_parks(name, ruta, author, idParks, idUser)
VALUES
    ('Canario', '/var/www/html/biologic_park_backend/categories/pajaro/', 'Marion', 1, 2);

SELECT images_parks.id,
       images_parks.name,
       images_parks.ruta,
       images_parks.author,
       images_parks.sightingDate,
       images_parks.idParks,
       users.firstName AS imageWasResgisterByUser
FROM images_parks
INNER JOIN users ON images_parks.idUser = users.id
WHERE images_parks.idParks = ?;

SELECT images_parks.id,
       images_parks.name,
       images_parks.ruta,
       images_parks.author,
       images_parks.sightingDate,
       images_parks.idParks,
       users.firstName AS imageWasResgisterByUser
FROM images_parks
INNER JOIN users ON images_parks.idUser = users.id
WHERE images_parks.idUser = ?;

SELECT images_parks.id,
       images_parks.name,
       images_parks.ruta,
       images_parks.author,
       images_parks.sightingDate,
       images_parks.idParks,
       images_parks.idUser,
       parks_data.id,
       parks_data.namePark,
       parks_data.recreationAreas,
       parks_data.latitude,
       parks_data.length,
       parks_data.street,
       parks_data.suburb,
       parks_data.idUser
FROM images_parks
RIGHT JOIN parks_data ON images_parks.idParks = parks_data.id
WHERE images_parks.idUser = 2 OR parks_data.idUser = 2;

SELECT * FROM users;

SELECT * FROM parks_data;

SELECT * FROM images_parks;


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

SELECT id, description FROM category;

SELECT id, description FROM category WHERE id = ?;


CREATE TABLE IF NOT EXISTS biologic_data(
    id int not null auto_increment primary key,
    commonName varchar(100),
    scientificName varchar(100),
    description text,
    geographicalDistribution text, -- distribucion Geografica
    naturalHistory text, -- historia natural
    statusConservation bool, -- estatus de conservacion
    authorBiologicData varchar(250), -- autor de la ficha biologica
    idCategory int,
    idUser int,
    CONSTRAINT id_category FOREIGN KEY (idCategory) REFERENCES category(id),
    CONSTRAINT id_user FOREIGN KEY (idUser) REFERENCES users(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE biologic_data
    ADD COLUMN registrationDate DATE;

ALTER TABLE biologic_data
    MODIFY COLUMN registrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

SELECT * FROM biologic_data;

DELETE FROM biologic_data WHERE id = 4;

UPDATE biologic_data
SET biologic_data.registrationDate = '2022-02-04 11:15:10'
WHERE biologic_data.id = 3;


INSERT INTO biologic_data(commonName, scientificName,
                          description, geographicalDistribution,
                          naturalHistory, statusConservation, authorBiologicData,
                          idCategory, idUser)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);

INSERT INTO biologic_data(commonName, scientificName,
                          description, geographicalDistribution,
                          naturalHistory, statusConservation, authorBiologicData,
                          idCategory, idUser)
VALUES ('Calandria Dorso Negro Menor', 'Hooded oriole (Icterus cucullatus)',
        'El turpial enmascarado (Icterus cucullatus) también conocido como bolsero cuculado, bolsero encapuchado, bolsero encapuchinado, bolsero zapotero, chorcha de capucha, chorcha rojiza o turpial zapotero, es una especie de ave paseriforme de la familia de los ictéridos (Icteridae). Es originaria de América del Norte y Centroamérica.',
        '', 'Bosques abiertos, árboles de sombra y palmeras. Se reproduce en bosques de árboles como el álamo, el nogal y el sicomoro, a lo largo de arroyos y en cañones, y en bosques abiertos en tierras bajas. Es común verlo en suburbios y parques urbanos. Por lo general, prefiere las palmeras y arma su nido en grupos de palmeras aislados, incluso en las ciudades.',
        true, 'Lives of North American Birds', 1, 1);

INSERT INTO biologic_data(commonName, scientificName,
                          description, geographicalDistribution,
                          naturalHistory, statusConservation, authorBiologicData,
                          idCategory, idUser)
VALUES ('Gorrión Doméstico', 'Passer domesticus',
        'Una de las aves cantoras más expandidas y abundantes en el mundo actual, el gorrión común tiene una fórmula simple para el éxito: se asocia con los seres humanos. Autóctono de Eurasia y del norte de África, ha tenido éxito en las áreas urbanas y agrícolas de todo el mundo, incluida América del Norte, donde fue liberado por primera vez en Nueva York en 1851. Es resistente, adaptable y agresivo, razón por la cual sobrevive en las aceras de la ciudad, donde pocas aves lo logran. En las zonas rurales, puede desalojar a las aves autóctonas de sus nidos.',
        '', 'Ciudades, pueblos y granjas. Los entornos generales varían, pero en especial en América del Norte, siempre se lo encuentra alrededor de las estructuras levantadas por el hombre y nunca en hábitats naturales vírgenes. Vive en centros de ciudades, suburbios y granjas. También en casas o edificios aislados que se encuentren rodeados por un terreno inadecuado para los gorriones comunes, como el desierto o el bosque.',
        true, 'Audubon', 1, 2),
        ('Búho Cara Oscura', 'Stygian owl (Asio stygius)',
        'El búho cara oscura (Asio stygius) es un estrígido neotropical de amplia pero discontinua distribución en las zonas intertropicales y subtropicales del continente americano (Howell y Webb 1995). Su distribución conocida abarca desde el norte de México hasta el norte de Argentina, e incluye registros accidentales en el sur de Texas, EUA (Wright y Wright 1997, Cooksey 1998). A través de esta vasta área, el búho cara oscura se encuentra en un amplio intervalo altitudinal (1500-3000 msnm) y de tipos de vegetación que van desde bosques perennifolios, bosques de pino, pino-encino, selvas perennifolias, bosques tropicales caducifolios de tierras bajas, sabanas, parques y áreas abiertas arboladas (Holt et al. 1999, Rodríguez-Ruiz y Herrera-Herrera 2009, Arizmendi et al. 2010).',
        '', 'El 5 de agosto de 2011 dos oficiales de la policía municipal de Landa de Matamoros, Querétaro, se presentaron en las instalaciones del Grupo Ecológico Sierra Gorda (municipio de Jalpan de Serra) con el fin de buscar ayuda y atención para un ejemplar adulto de A. stygius. El ave había sido previamente decomisada por los oficiales cuando se percataron que vecinos del municipio habían agredido al ejemplar con un arma de fuego (Figura 1). Al momento de ser lesionado, el búho se encontraba posando en un encino (Quercus mexicana) en un ecotono entre matorral sub-montano y bosque de encino (21°11''50"N, 99° 19''46"O; 1080 m snm). El sitio es un conjunto de lomeríos en el interior de los valles intermontanos del centro de la RBSG. Los elementos florísticos característicos del sitio son Acacia micrantha, Cordia boissieri, Helietta parvifolia, Mimosa leucaenoides, Pithecellobium pallens, Quercus mexicana, entre otros.',
        true, 'Alan Monroy-Ojeda1* y Roberto Pedraza-Ruiz2', 1, 2);


SELECT * FROM biologic_data;

SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
       biologic_data.geographicalDistribution, biologic_data.naturalHistory,
       biologic_data.statusConservation, biologic_data.authorBiologicData,
       category.description as category
FROM biologic_data
INNER JOIN category ON biologic_data.idCategory = category.id
WHERE biologic_data.idUser = 2;

SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
       biologic_data.geographicalDistribution, biologic_data.naturalHistory,
       biologic_data.statusConservation, biologic_data.authorBiologicData,
       category.description as category,
       users.firstName as user
FROM biologic_data
INNER JOIN category ON biologic_data.idCategory = category.id
INNER JOIN users on biologic_data.idUser = users.id;


SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
       biologic_data.geographicalDistribution, biologic_data.naturalHistory,
       biologic_data.statusConservation, biologic_data.authorBiologicData,
       category.description as category,
       users.firstName as user
FROM biologic_data
INNER JOIN category ON biologic_data.idCategory = category.id
INNER JOIN users on biologic_data.idUser = users.id
WHERE biologic_data.commonName LIKE ?;


SELECT biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
       biologic_data.geographicalDistribution, biologic_data.naturalHistory,
       biologic_data.statusConservation, biologic_data.authorBiologicData,
       category.description as category,
       users.firstName as user
FROM biologic_data
INNER JOIN category ON biologic_data.idCategory = category.id
INNER JOIN users on biologic_data.idUser = users.id
WHERE biologic_data.scientificName LIKE ?;


DROP TABLE IF EXISTS biologic_data;


CREATE TABLE IF NOT EXISTS images_biologic_data (
    id int not null auto_increment primary key,
    name text not null,
    ruta text not null,
    author varchar(100) not null,
    sightingDate date, -- fecha de avistamiento
    idBiologicalData int,
    idUser int,
    CONSTRAINT id_biological_data FOREIGN KEY (idBiologicalData) REFERENCES biologic_data(id),
    CONSTRAINT id_user_img FOREIGN KEY (idUser) REFERENCES users(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- RENAME TABLE images TO images_biologic_data;

DROP TABLE IF EXISTS images_biologic_data;

ALTER TABLE images_biologic_data
MODIFY COLUMN sightingDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

SELECT * FROM images_biologic_data;

UPDATE images_biologic_data
SET images_biologic_data.sightingDate = '2022-05-19 01:15:10'
WHERE images_biologic_data.id = 1;

INSERT INTO images_biologic_data(name, ruta, author,sightingDate, idBiologicalData, idUser)
VALUES ('Calandria Dorso Negro Menor - Icterus cucullatus',
        '/var/www/html/biological_parks_backend/Images/ImgBiologicData/Calandria Dorso Negro Menor.jpeg',
        'efrenbiologia', DEFAULT, 1, 2);


SELECT name, ruta, author,sightingDate, idBiologicalData,
       users.firstName AS imageWasResgisterByUser
FROM images_biologic_data
INNER JOIN users ON images_biologic_data.idUser = users.id;


SELECT images_biologic_data.id,
       images_biologic_data.name,
       images_biologic_data.ruta,
       images_biologic_data.author,
       images_biologic_data.sightingDate,
       images_biologic_data.idBiologicalData,
       users.firstName AS imageWasResgisterByUser
FROM images_biologic_data
INNER JOIN users ON images_biologic_data.idUser = users.id
WHERE images_biologic_data.idBiologicalData = ?;


SELECT images_biologic_data.id, images_biologic_data.name,
       images_biologic_data.ruta, images_biologic_data.author,
       images_biologic_data.sightingDate, images_biologic_data.idBiologicalData,
       biologic_data.id AS id_tl_biologic_data,
       biologic_data.commonName, biologic_data.scientificName, biologic_data.description,
       biologic_data.geographicalDistribution, biologic_data.naturalHistory,
       biologic_data.statusConservation, biologic_data.authorBiologicData,
       category.description AS category
FROM images_biologic_data
RIGHT JOIN biologic_data ON images_biologic_data.idBiologicalData = biologic_data.id
INNER JOIN category ON biologic_data.idCategory = category.id
WHERE biologic_data.id = ?;



CREATE TABLE IF NOT EXISTS pivot_biologic_park (
    id int not null auto_increment primary key,
    idBiologic int,
    idParksData int,
    CONSTRAINT id_biologic FOREIGN KEY (idBiologic) REFERENCES biologic_data(id),
    CONSTRAINT id_parks_data FOREIGN KEY (idParksData) REFERENCES parks_data(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS pivot_biologic_park;


SELECT * FROM pivot_biologic_park;

SELECT * FROM pivot_biologic_park
WHERE idBiologic = 1 AND idParksData = 1;


INSERT INTO pivot_biologic_park(idBiologic, idParksData)
VALUES (1,1);


INSERT INTO pivot_biologic_park(idBiologic, idParksData)
VALUES (2,2), (3, 3);


SELECT
    biologic_data.commonName,
    parks_data.namePark
FROM pivot_biologic_park
INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
WHERE parks_data.id = ? AND biologic_data.id = ?;

SELECT
    biologic_data.commonName,
    biologic_data.scientificName,
    biologic_data.description,
    biologic_data.authorBiologicData,
    biologic_data.naturalHistory,
    biologic_data.geographicalDistribution,
    parks_data.namePark,
    parks_data.recreationAreas,
    parks_data.latitude,
    parks_data.length,
    parks_data.street,
    parks_data.suburb
FROM pivot_biologic_park
INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
ORDER BY pivot_biologic_park.id DESC;
-- WHERE biologic_data.id = ?;


SELECT * FROM biologic_data;
SELECT * FROM parks_data;
SELECT * FROM images_biologic_data;


SELECT pivot_biologic_park.id,
       pivot_biologic_park.idBiologic,
       pivot_biologic_park.idParksData,
       biologic_data.commonName AS commonName,
       biologic_data.scientificName AS scientificName,
       parks_data.namePark as NamePark,
       parks_data.street AS Street,
       parks_data.suburb AS Suburb,
       images_biologic_data.name AS name_img_biologic_data,
       images_biologic_data.ruta AS path_img_biologic_data,
       images_parks.name as name_img_parks,
       images_parks.ruta AS path_img_parks
FROM pivot_biologic_park
RIGHT OUTER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
RIGHT OUTER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
LEFT JOIN images_biologic_data ON biologic_data.id = images_biologic_data.idBiologicalData
LEFT JOIN images_parks ON parks_data.id = images_parks.idParks
ORDER BY pivot_biologic_park.id DESC;


SELECT * FROM biologic_data;

SELECT biologic_data.commonName AS commonName,
       biologic_data.scientificName AS scientificName,
       parks_data.namePark as NamePark,
       parks_data.street AS Street,
       parks_data.suburb AS Suburb,
       images_biologic_data.ruta AS path_img_biologic_data,
       images_parks.ruta AS path_img_parks,
       users.firstname AS User
FROM pivot_biologic_park
INNER JOIN biologic_data ON pivot_biologic_park.idBiologic = biologic_data.id
INNER JOIN parks_data ON pivot_biologic_park.idParksData = parks_data.id
INNER JOIN users ON biologic_data.idUser = users.id
INNER JOIN images_biologic_data ON biologic_data.id = images_biologic_data.idBiologicalData
INNER JOIN images_parks ON parks_data.id = images_parks.idParks
WHERE users.id = ?;

--  --



(SELECT
    CASE
        WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
    END AS verificate,
    biologic_data.commonName AS names,
    biologic_data.scientificName AS column1,
    biologic_data.description AS column2,
    biologic_data.authorBiologicData AS column3,
    biologic_data.naturalHistory AS column4,
    biologic_data.geographicalDistribution AS column5,
    biologic_data.registrationDate AS registrationDate
FROM biologic_data WHERE biologic_data.idUser = 2
UNION
SELECT
    CASE
        WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
    END AS verificate,
    parks_data.namePark AS names,
    parks_data.recreationAreas AS column1,
    parks_data.latitude AS column2,
    parks_data.length AS column3,
    parks_data.street AS column4,
    parks_data.suburb AS column5,
    parks_data.registrationDate AS registrationDate
FROM parks_data WHERE idUser = 2)
ORDER BY registrationDate DESC;

(SELECT
    images_biologic_data.id,
    images_biologic_data.name,
    images_biologic_data.ruta,
    images_biologic_data.author,
    images_biologic_data.sightingDate,
    images_biologic_data.idBiologicalData
FROM images_biologic_data
WHERE images_biologic_data.idUser = 2
UNION ALL
SELECT
    images_parks.id,
    images_parks.name,
    images_parks.ruta,
    images_parks.author,
    images_parks.sightingDate,
    images_parks.idParks
FROM images_parks
WHERE images_parks.idUser = 2
) ORDER BY sightingDate DESC;

UPDATE images_biologic_data
SET images_biologic_data.ruta = 'biological_parks_backend/Images/ImgBiologicData/Calandria Dorso Negro Menor.jpeg'
WHERE images_biologic_data.idUser = 2;

UPDATE images_parks
SET images_parks.ruta = 'biological_parks_backend/Images/ImgParksData/Calandria Dorso Negro Menor.jpeg'
WHERE images_parks.idUser = 2;

(SELECT
    CASE
        WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
    END AS verificate,
    biologic_data.commonName AS names,
    biologic_data.scientificName AS column1,
    biologic_data.description AS column2,
    biologic_data.authorBiologicData AS column3,
    biologic_data.naturalHistory AS column4,
    biologic_data.geographicalDistribution AS column5,
    biologic_data.registrationDate AS registrationDate
FROM biologic_data WHERE biologic_data.idUser = 2
UNION ALL
SELECT
    CASE
        WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
    END AS verificate,
    parks_data.namePark AS names,
    parks_data.recreationAreas AS column1,
    parks_data.latitude AS column2,
    parks_data.length AS column3,
    parks_data.street AS column4,
    parks_data.suburb AS column5,
    parks_data.registrationDate AS registrationDate
FROM parks_data WHERE idUser = 2
UNION ALL
SELECT
    CASE
        WHEN images_biologic_data.id IS NOT NULL THEN 'img biologic data'
    END AS verificate,
    images_biologic_data.id,
    images_biologic_data.name,
    images_biologic_data.ruta,
    images_biologic_data.author,
    images_biologic_data.idBiologicalData,
    images_biologic_data.idUser,
    images_biologic_data.sightingDate AS registrationDate
FROM images_biologic_data
WHERE images_biologic_data.idUser = 2
UNION ALL
SELECT
    CASE
        WHEN images_parks.id IS NOT NULL THEN 'img parks data'
    END AS verificate,
    images_parks.id,
    images_parks.name,
    images_parks.ruta,
    images_parks.author,
    images_parks.idParks,
    images_parks.idUser,
    images_parks.sightingDate AS registrationDate
FROM images_parks
WHERE images_parks.idUser = 2
)ORDER BY registrationDate DESC;


(SELECT
    CASE
        WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
    END AS verificate,
    biologic_data.commonName AS names,
    biologic_data.scientificName AS column1,
    biologic_data.description AS column2,
    biologic_data.authorBiologicData AS column3,
    biologic_data.naturalHistory AS column4,
    biologic_data.geographicalDistribution AS column5,
    biologic_data.registrationDate AS registrationDate
FROM biologic_data
WHERE biologic_data.commonName LIKE ?
UNION ALL
SELECT
    CASE
        WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
    END AS verificate,
    parks_data.namePark AS names,
    parks_data.recreationAreas AS column1,
    parks_data.latitude AS column2,
    parks_data.length AS column3,
    parks_data.street AS column4,
    parks_data.suburb AS column5,
    parks_data.registrationDate AS registrationDate
FROM parks_data
WHERE parks_data.namePark LIKE ?
UNION ALL
SELECT
    CASE
        WHEN images_biologic_data.id IS NOT NULL THEN 'img biologic data'
    END AS verificate,
    images_biologic_data.id,
    images_biologic_data.name,
    images_biologic_data.ruta,
    images_biologic_data.author,
    images_biologic_data.idBiologicalData,
    images_biologic_data.idUser,
    images_biologic_data.sightingDate AS registrationDate
FROM images_biologic_data
WHERE images_biologic_data.name LIKE ?
UNION ALL
SELECT
    CASE
        WHEN images_parks.id IS NOT NULL THEN 'img parks data'
    END AS verificate,
    images_parks.id,
    images_parks.name,
    images_parks.ruta,
    images_parks.author,
    images_parks.idParks,
    images_parks.idUser,
    images_parks.sightingDate AS registrationDate
FROM images_parks
WHERE images_parks.name LIKE ?
) ORDER BY registrationDate DESC;



(SELECT
    CASE
        WHEN biologic_data.id IS NOT NULL THEN 'Biologic Data'
    END AS verificate,
    biologic_data.id AS ID,
    biologic_data.commonName AS names,
    biologic_data.scientificName AS column1,
    biologic_data.description AS column2,
    biologic_data.authorBiologicData AS column3,
    biologic_data.naturalHistory AS column4,
    biologic_data.geographicalDistribution AS column5,
    biologic_data.registrationDate AS registrationDate
FROM biologic_data
UNION ALL
SELECT
    CASE
        WHEN parks_data.id IS NOT NULL THEN 'Parks Data'
    END AS verificate,
    parks_data.id AS ID,
    parks_data.namePark AS names,
    parks_data.recreationAreas AS column1,
    parks_data.latitude AS column2,
    parks_data.length AS column3,
    parks_data.street AS column4,
    parks_data.suburb AS column5,
    parks_data.registrationDate AS registrationDate
FROM parks_data
UNION ALL
SELECT
    CASE
        WHEN images_biologic_data.id IS NOT NULL THEN 'img biologic data'
    END AS verificate,
    images_biologic_data.id AS ID,
    images_biologic_data.id,
    images_biologic_data.name,
    images_biologic_data.ruta,
    images_biologic_data.author,
    images_biologic_data.idBiologicalData,
    images_biologic_data.idUser,
    images_biologic_data.sightingDate AS registrationDate
FROM images_biologic_data
UNION ALL
SELECT
    CASE
        WHEN images_parks.id IS NOT NULL THEN 'img parks data'
    END AS verificate,
    images_parks.id AS ID,
    images_parks.id,
    images_parks.name,
    images_parks.ruta,
    images_parks.author,
    images_parks.idParks,
    images_parks.idUser,
    images_parks.sightingDate AS registrationDate
FROM images_parks
)ORDER BY registrationDate DESC;

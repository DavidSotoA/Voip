CREATE TABLE pelicula(
    id int(3) AUTO_INCREMENT NOT NULL,
    nombre varchar(30) NOT NULL,
    descripcion varchar(600) NOT NULL,
    genero varchar(30) NOT NULL,
    precio int(5) NOT NULL,
    sala varchar(2)NOT NULL,
    formato varchar(30) NOT NULL,
    fecha datetime NOT NULL,
    PRIMARY KEY(id)
)ENGINE=INNODB;

CREATE TABLE usuario(
  codigo varchar(4) NOT NULL,
  nombre varchar(30) NOT NULL,
  PRIMARY KEY(codigo)
)ENGINE=INNODB;

CREATE TABLE boleto(
  pelicula int(3),
  usuario varchar(4),
  PRIMARY KEY(pelicula,usuario),
  CONSTRAINT FOREIGN KEY (pelicula) REFERENCES pelicula(id),
  CONSTRAINT FOREIGN KEY (usuario) REFERENCES usuario(codigo)
)ENGINE=INNODB;

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('el coco',
  'Una muerte, una herencia y una mansion solitaria haran que, Piroberta y sus amigos se encuentren en una oscura pesadilla, en donde seran perseguidos por un espanto con el que todo chico crecio, EL COoooooooCOOOOOOO',
  'comedia',20000,'3','simple','2016-09-22 12:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('el coco',
  'Una muerte, una herencia y una mansion solitaria haran que, Piroberta y sus amigos se encuentren en una oscura pesadilla, en donde seran perseguidos por un espanto con el que todo chico crecio, EL COoooooooCOOOOOOO',
  'comedia',30000,'2','3d','2016-09-23 2:15:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('el coco',
  'Una muerte, una herencia y una mansion solitaria haran que, Piroberta y sus amigos se encuentren en una oscura pesadilla, en donde seran perseguidos por un espanto con el que todo chico crecio, EL COoooooooCOOOOOOO',
  'comedia',30000,'2','3d','2016-10-01 2:15:00');

INSERT INTO usuario(codigo,nombre) values('123','david');
INSERT INTO usuario(codigo,nombre) values('111','jhonatan');
INSERT INTO usuario(codigo,nombre) values('222','andres');
INSERT INTO usuario(codigo,nombre) values('333','manuela');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('la chica del tren',
  'En este thriller, Rachel (Emily Blunt), quien esta devastada por su reciente divorcio, pasa los días fantaseando con una pareja aparentemente perfecta que ve todas las tardes desde el tren, hasta que un dia se da cuenta que algo impactante esta pasando y se envuelve en el misterio',
  'Thriller',20000,'3','simple','2016-10-12 17:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('la chica del tren',
  'En este thriller, Rachel (Emily Blunt), quien esta devastada por su reciente divorcio, pasa los días fantaseando con una pareja aparentemente perfecta que ve todas las tardes desde el tren, hasta que un dia se da cuenta que algo impactante esta pasando y se envuelve en el misterio',
  'Thriller',20000,'3','simple','2016-10-12 20:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('la chica del tren',
  'En este thriller, Rachel (Emily Blunt), quien esta devastada por su reciente divorcio, pasa los días fantaseando con una pareja aparentemente perfecta que ve todas las tardes desde el tren, hasta que un dia se da cuenta que algo impactante esta pasando y se envuelve en el misterio',
  'Thriller',20000,'3','3d','2016-10-14 20:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('inferno',
  'Ron Howard, ganador de un Premio de la Academia, regresa para dirigir Inferno, el mas reciente best seller en la serie multimillonaria de Robert Landon (Da Vinci Code), de Dan Brown, que presenta al famoso simbolista (interpretado otra vez por Tom Hanks) en busca de pistas relativas al excelso Dante',
  'Thriller',20000,'3','3d','2016-10-18 11:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('inferno',
  'Ron Howard, ganador de un Premio de la Academia, regresa para dirigir Inferno, el mas reciente best seller en la serie multimillonaria de Robert Langdon (Da Vinci Code), de Dan Brown, que presenta al famoso simbolista (interpretado otra vez por Tom Hanks) en busca de pistas relativas al excelso Dante',
  'Thriller',20000,'3','simple','2016-10-20 16:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('conexion mortal',
  'Clayton Riddell se encuentra en Boston celebrando el exito de su ultima novela grafica y quiere regresar a casa y ver a su familia. Pero de un momento a otro se desata un caos apocaliptico: un misterioso fenomeno que parece contagiarse por la senal de los telefonos moviles esta convirtiendo a la gente en monstruos sedientos de sangre',
  'Suspenso',20000,'3','simple','2016-10-19 13:00:00');

INSERT INTO pelicula(nombre,descripcion,genero,precio,sala,formato,fecha) values('conexion mortal',
  'Clayton Riddell se encuentra en Boston celebrando el exito de su ultima novela grafica y quiere regresar a casa y ver a su familia. Pero de un momento a otro se desata un caos apocaliptico: un misterioso fenomeno que parece contagiarse por la senal de los telefonos moviles esta convirtiendo a la gente en monstruos sedientos de sangre',
  'Suspenso',20000,'3','3d','2016-10-22 13:00:00');

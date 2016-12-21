create table ADMIN (
	id SERIAL NOT NULL,
	rut INT NOT NULL,
	pass VARCHAR(10) NOT NULL,
	PRIMARY KEY (id)
);


create table FUNCION (
	id SERIAL NOT NULL,
	fecha DATE NOT NULL,
	hora VARCHAR (10) NOT NULL,
	admin_id INT REFERENCES ADMIN (id) NOT NULL,
	PRIMARY KEY (id)
);


create table PARTICIPA (
	id SERIAL NOT NULL,
	funcion_id INT REFERENCES FUNCION (id) NOT NULL,
	acomod_id INT REFERENCES ACOMOD (id) NOT NULL,
	PRIMARY KEY (id)
);


create table ACOMOD (
	id SERIAL NOT NULL,
	rut INT NOT NULL,
	pass VARCHAR (10) NOT NULL,
	PRIMARY KEY (id)
);

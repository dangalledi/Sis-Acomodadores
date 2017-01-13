start transaction;
drop table if exists users CASCADE;
drop table if exists funciones CASCADE;
drop table if exists participantes_funcion CASCADE;

create table users (
	id SERIAL NOT NULL,
	rut INT NOT NULL,
	rol INT NOT NULL DEFAULT 1,
	password VARCHAR(255) NOT NULL,
	remember_token VARCHAR(255),
	PRIMARY KEY (id)
);

create table funciones (
	id SERIAL NOT NULL,
	fecha timestamp NOT NULL,
	admin_id INT REFERENCES users (id) NOT NULL,
	PRIMARY KEY (id)
);

create table participantes_funcion (
	id SERIAL NOT NULL,
	funcion_id INT REFERENCES funciones (id) NOT NULL,
	acomodador_id INT REFERENCES users (id) NOT NULL,
	PRIMARY KEY (id)
);

end transaction;

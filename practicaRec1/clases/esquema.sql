
create database subida default
character set utf8 collate utf8_unicode_ci;

use subida;

grant all on subida * to subida2015@localhost identified by 'clave2015';

flush privileges;

create table archivos (
  nombre varchar(30) not null,
  carpeta varchar(80) not null,
  nombreoriginal varchar(30) not null,
  PRIMARY KEY(nombre,carpeta)
) engine=innodb charset=utf8 collate=utf8_unicode_ci;
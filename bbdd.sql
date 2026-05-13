create database zapatos;
use zapatos;

create table productos 
(
id_producto int primary key auto_increment,
nombre_producto varchar(45) not null,
precio decimal(10,2) not null,
cantidad int not null,
talle decimal not null,
categoria varchar(10) not null
);
create table usuario
(
id_usuario int primary key auto_increment,
dni int not null unique,
nombre varchar(45) not null,
apellido varchar(45) not null,
email varchar(60) not null unique,
telefono varchar(14) not null,
direccion varchar(60) not null,
provincia varchar(50) not null,
localidad varchar(50) not null,
codigo_postal varchar(10) not null,
fecha_nacimiento date,
rol enum('cliente', 'admin', 'vendedor') default 'cliente'
);
create table pedido
(
id_pedido int primary key auto_increment,
fecha_pedido datetime,
estado_pedido enum('pendiente','preparacion','viaje','completado','devolucion','cancelado') default 'pendiente',
total_pedido decimal(10,2),
direccion_pedido varchar(60) not null,
telefono_pedido varchar(14) not null,
id_usuario_fk int not null,
foreign key (id_usuario_fk) references usuario(id_usuario)
);

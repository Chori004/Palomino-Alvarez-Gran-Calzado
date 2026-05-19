create database zapatos;
use zapatos;

create table rol
(
id_rol int primary key auto_increment,
rol varchar(20)
);
create table tipo_documento
(
id_tipodocumento int primary key auto_increment,
tipo_documento varchar(45)
);

create table categoria_zapato
(
id_categoria int primary key auto_increment,
tipo varchar(16) not null
);
create table productos 
(
id_producto int primary key auto_increment,
nombre_producto varchar(45) not null,
precio decimal(10,2) not null,
activo char default 'S',
id_categoria_fk int not null,
foreign key (id_categoria_fk) references categoria_zapato(id_categoria)
);

create table usuario
(
id_usuario int primary key auto_increment,
documento varchar(20) not null unique,
id_tipodocumento_fk int not null,
nombre varchar(45) not null,
apellido varchar(45) not null,
email varchar(60) not null unique,
telefono decimal(14,0) not null,
direccion varchar(60) not null,
provincia varchar(50) not null,
localidad varchar(50) not null,
codigo_postal varchar(10) not null,
fecha_nacimiento date,
nombre_usuario varchar(255) unique,
password_hash varchar(255),
id_rol_fk int not null,
foreign key (id_tipodocumento_fk) references tipo_documento(id_tipodocumento),
foreign key (id_rol_fk) references rol(id_rol)
);

create table producto_variante
(
  id_variante int primary key auto_increment,
  id_producto_fk int not null,
  talle decimal(3,1) not null,
  vendido char default 'N',
  activo char default 'S',
  foreign key (id_producto_fk) references productos(id_producto)
);
create table transporte
(
id_transporte int primary key auto_increment,
empresa varchar(45) not null
);
create table pedido
(
id_pedido int primary key auto_increment,
fecha_pedido datetime default current_timestamp,
estado_pedido enum('pendiente','preparacion','viaje','completado','devolucion','cancelado') default 'pendiente',
empresa_transporte_fk int not null,
fecha_entrega_estimada date,
id_usuario_fk int not null,
foreign key (id_usuario_fk) references usuario(id_usuario)
);

create table detalle_pedido
(
  id_detalle_pedido int primary key auto_increment,
  id_pedido_fk int not null,
  id_variante_fk int not null,
  foreign key (id_variante_fk) references producto_variante(id_variante),
  foreign key (id_pedido_fk) references pedido(id_pedido)
  );

create table reserva
(
  id_reserva int primary key auto_increment,
  fecha_reserva datetime default current_timestamp,
  fecha_expiracion datetime default (current_timestamp + interval 7 day),
  id_usuario_fk int not null,
  estado_reserva enum('pendiente', 'cancelado','retirado','expirado') default 'pendiente',
  foreign key (id_usuario_fk) references usuario(id_usuario)
  );
create table detalle_reserva
(
  id_detalle_reserva int primary key auto_increment,
  id_reserva_fk int not null,
  id_variante_fk int not null,
  foreign key (id_variante_fk) references producto_variante(id_variante),
  foreign key (id_reserva_fk) references reserva(id_reserva)
);

create table factura
(
id_factura int primary key auto_increment,
fecha_factura datetime default current_timestamp
);

create table detalle_factura
(
id_detalle_factura int primary key auto_increment,
id_factura_fk int not null,
id_producto_variante_fk int not null,
foreign key (id_factura_fk) references factura(id_factura),
foreign key (id_producto_variante_fk) references producto_variante(id_variante)
);

create table carrito 
(
  id_carrito int primary key auto_increment,
  id_usuario_fk int not null,
  id_variante_fk int not null,
  fecha_agregado datetime default current_timestamp,
  foreign key (id_usuario_fk) references usuario(id_usuario),
  foreign key (id_variante_fk) references producto_variante(id_variante)
);




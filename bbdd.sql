create database zapatos;
use zapatos;

create table productos 
(
id_producto int primary key auto_increment,
nombre_producto varchar(45) not null,
precio decimal(10,2) not null,
categoria varchar(10) not null,
activo boolean default True /*para borrar productos sin perder historial*/
);
create table producto_variante
(
  id_variante int primary key auto_increment,
  id_producto_fk int not null,
  talle decimal(3,1) not null,
  stock int not null,
  foreign key (id_producto_fk) references productos(id_producto)
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
nombre_usuario varchar(255) unique,
password_hash varchar(255),  
rol enum('cliente', 'admin', 'vendedor') default 'cliente'
);


create table pedido
(
id_pedido int primary key auto_increment,
fecha_pedido datetime default current_timestamp,
estado_pedido enum('pendiente','preparacion','viaje','completado','devolucion','cancelado') default 'pendiente',
total_pedido decimal(10,2) not null,
direccion_pedido varchar(60) not null,
telefono_pedido varchar(14) not null,
codigo_seguimiento varchar(45),
empresa_transporte varchar(45),
fecha_entrega_estimada date,
id_usuario_fk int not null,
foreign key (id_usuario_fk) references usuario(id_usuario)
);

create table detalle_pedido
(
  id_detalle_pedido int primary key auto_increment,
  id_pedido_fk int not null,
  id_variante_fk int not null,
  cantidad_pedido int not null,
  precio_unitario decimal(10,2) not null,
  foreign key (id_variante_fk) references producto_variante(id_variante),
  foreign key (id_pedido_fk) references pedido(id_pedido)
  );
  
create table reserva
(
  id_reserva int primary key auto_increment,
  fecha_reserva datetime,
  total_reserva decimal(10,2),
  id_usuario_fk int not null,
  telefono_reserva varchar(14) not null,
  estado_reserva enum('pendiente', 'cancelado','retirado','expirado') default 'pendiente',
  foreign key (id_usuario_fk) references usuario(id_usuario)
  );
create table detalle_reserva
(
  id_detalle_reserva int primary key auto_increment,
  id_reserva_fk int not null,
  id_variante_fk int not null,
  cantidad_reserva int not null,
  precio_unitario decimal(10,2) not null,
  foreign key (id_variante_fk) references producto_variante(id_variante),
  foreign key (id_reserva_fk) references reserva(id_reserva)
);

create table carrito 
(
  id_carrito int primary key auto_increment,
  id_usuario_fk int not null,
  id_variante_fk int not null,
  cantidad int not null default 1,
  fecha_agregado datetime default current_timestamp,
  foreign key (id_usuario_fk) references usuario(id_usuario),
  foreign key (id_variante_fk) references producto_variante(id_variante)
);




-- Migración de proyecto.sql (MySQL → PostgreSQL)

BEGIN;

-- Tabla campesinos
CREATE TABLE campesinos (
  id SERIAL PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  apellidos VARCHAR(255) NOT NULL,
  cedula VARCHAR(20) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  correo VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  departamento VARCHAR(100) NOT NULL,
  municipio VARCHAR(100) NOT NULL,
  nombre_usuario VARCHAR(50) UNIQUE NOT NULL,
  contraseña VARCHAR(255) NOT NULL
);

INSERT INTO campesinos (id, nombre, apellidos, cedula, telefono, correo, direccion, departamento, municipio, nombre_usuario, contraseña) VALUES
(1, 'john luis', 'buelvas rosario', '119353267', '3023893054', 'jhonbuar@hotmail.com', 'villa grande 1 mz g prima lote 9', 'bolivar', 'cartagena', 'john', '$2y$10$ZmI/gIGC3Z/Tu7YrjwnCpuKg9v5PNXGOlOtEnovFp37iChoZNwl5K'),
(2, 'samuel ', 'perez', '1193532648', '3023536985', 'samuel@hotmail.com', 'mz j lt8', 'bolivar', 'san juan', 'samuel', '$2y$10$o9PcjTG4dSxKuu8G.vUkOuB4Ll1E8x6qIum7iCCVQi2vO6x0SCY32'),
(3, 'juan', 'perez', '1193532648', '3023893054', 'juan@hotmail.com', 'SECTOR 2 MZG-9', 'bolivar', 'san juan', 'juan', '$2y$10$t6vT3ClEn7fMuSEyp16NQOd/Fjwo4kz.CFoR2cMMc9fpz.v3.dxH.'),
(4, 'luis', 'gomez', '73226485', '3023893054', 'luis@hotmail.com', 'mz j lt8', 'bolivar', 'san juan', 'luis', '$2y$10$CT3cTztPcswOzRrTqFQxie6gaF0mrq/ldzkCKCCQDOPGuoVcaXhey'),
(7, 'Francisco luis', 'pallares', '73226425', '3124745896', 'franciscoluis52@hotmail.com', 'mz j lt8', 'Bolívar', 'Santa Rosa', 'francisco', '$2y$10$htxKMiv.iFtAMYj22Tv2S.kEc0u1bGif.fMEjtwOgqG0zUCavqay.'),
(8, 'johan', 'davila', '1193543454', '3023845654', 'johan123@gmail.com', 'mz 4 lt 9', 'Bolívar', 'Cartagena', 'johan', '$2y$10$dpXKqiho4NRwaWkLvglq3OQhextR9cIrUAtjoOMyL705hZNKKBSHC');

-- Tabla cliente
CREATE TABLE cliente (
  id_cliente SERIAL PRIMARY KEY,
  nombre_cliente VARCHAR(100) NOT NULL,
  cedula VARCHAR(100) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  direccion TEXT NOT NULL,
  telefono VARCHAR(100) NOT NULL,
  departamento VARCHAR(100) NOT NULL,
  municipio VARCHAR(100) NOT NULL
);

INSERT INTO cliente (id_cliente, nombre_cliente, cedula, correo, direccion, telefono, departamento, municipio) VALUES
(2, 'john luis', '1193532648', 'juan@hotmail.com', 'Multicentro el amparo, tercer piso, oficina 3A2.', '3023893054', 'bolivar', 'cartagena'),
(3, 'john ', '73226485', 'jhonbuar@hotmail.com', 'mz j lt8', '3023536985', 'bolivar', 'cartagena'),
(4, 'john luis', '73226485', 'juan@hotmail.com', 'SECTOR 2 MZG-9', '3023893054', 'bolivar', 'cartagena'),
(5, 'john ', '10432945520', 'kbuelvas899@gmail.com', 'mz j lt8', '3023536985', 'bolivar', 'cartagena'),
(6, 'john ', '73226485', 'kbuelvas899@gmail.com', 'villa grande 1 mz g prima lote 9', '3023893054', 'bolivar', 'cartagena'),
(7, 'john ', '10432945520', 'juan@hotmail.com', 'villa grande de indias 1 mz g prima lote 9', '3023536985', 'bolivar', 'san juan'),
(8, 'juan perez', '73226485', 'juan@hotmail.com', 'villa grande de indias 1 mz g prima lote 9', '3023536985', 'bolivar', 'san juan'),
(9, 'john ', '73226485', 'juan@hotmail.com', 'villa grande 1 mz g prima lote 9', '3023893054', 'bolivar', 'cartagena'),
(10, 'john luis', '73226485', 'kbuelvas899@gmail.com', 'mz j lt8', '3023893054', 'bolivar', 'cartagena'),
(11, 'juan perez', '73226485', 'kbuelvas899@gmail.com', 'Multicentro el amparo, tercer piso, oficina 3A2.', '3023536985', 'bolivar', 'cartagena');

-- Tabla productos
CREATE TABLE productos (
  id SERIAL PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  precio NUMERIC(10,2) NOT NULL,
  cantidad INT NOT NULL,
  imagen_url VARCHAR(255) NOT NULL,
  campesino_id INT REFERENCES campesinos(id)
);

INSERT INTO productos (id, titulo, descripcion, precio, cantidad, imagen_url, campesino_id) VALUES
(9, 'Mango', 'Mango maduro, listo para consumir', 5000.00, 3, 'uploads/670c921063004.jpg', 2),
(10, 'Yuca', 'Raíz comestible de la yuca', 2000.00, 5, 'uploads/670c95ccb6b75.jpg', 2),
(13, 'Papaya', 'Fruta tropical de pulpa dulce y jugosa, rica en vitaminas y minerales.', 4000.00, 3, 'uploads/670d55a1c311f.jpg', 4),
(14, 'Cilantro', 'Cilantro fresco, ideal para sazonar platos colombianos.', 8000.00, 1, 'uploads/67338c30ef6b4.jpg', 1),
(15, 'Mango Tommy Atkins', 'Mango de gran tamaño, pulpa firme y jugosa, sabor dulce y ligeramente ácido. Ideal para consumir fresco o en jugos.', 8000.00, 10, 'uploads/673bd40d6245a.jpg', 1),
(16, 'Guineo Verde', 'Guineos verdes frescos, cosechados en su punto óptimo de madurez para asegurar un sabor dulce y una textura firme.  Libres de golpes y magulladuras, ideales para consumo inmediato o para cocinar.', 2500.00, 150, 'uploads/673c1733bffc0.jpg', 3),
(21, 'Papas criollas', 'Papas criollas de excelente calidad, recién cosechadas. Variedad mixta con tubérculos firmes, de piel lisa y color variado (amarilla, roja). Libre de golpes y enfermedades, ideal para consumo inmediato.', 3500.00, 50, 'uploads/68d178af8cc79.jpg', 8);

-- Tabla pedido
CREATE TABLE pedido (
  id_pedido SERIAL PRIMARY KEY,
  id_producto INT REFERENCES productos(id) ON DELETE CASCADE ON UPDATE CASCADE,
  id_cliente INT UNIQUE REFERENCES cliente(id_cliente) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO pedido (id_pedido, id_producto, id_cliente) VALUES
(5, 13, 6),
(6, 13, 7),
(7, 14, 8),
(8, 14, 9),
(9, 14, 10),
(10, 14, 11);

COMMIT;

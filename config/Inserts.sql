USE psuGangWeb;

INSERT INTO users(username, first_name, last_name, pass, email, permissions)
VALUES	('Sebas_EPV', 'Sebastian', 'Perez', '12345', 'sebas@gmail.com', True),
		('Carlos_GM', 'Carlos', 'Gonzales', '12345', 'carlos@gmail.com', True),
		('Bryan_NC', 'Bryan', 'Navarrete', '12345', 'bryan@gmail.com', True),
        ('Nahui_PP', 'Nahui', 'Perez', '12345', 'nahui@gmail.com', True);
        
        
INSERT INTO users(username, first_name, last_name, pass, email, permissions)
	VALUES('clientTest', 'client', 'test', '12345', 'client@gmail.com', false);


INSERT INTO tiers (tier_name, tier_description) VALUES ('A', 'Productos de gama alta con excelente rendimiento');
INSERT INTO tiers (tier_name, tier_description) VALUES ('B', 'Productos de alta calidad con grandes características');
INSERT INTO tiers (tier_name, tier_description) VALUES ('C', 'Productos buenos con rendimiento decente');
INSERT INTO tiers (tier_name, tier_description) VALUES ('D', 'Productos promedio con rendimiento aceptable');
INSERT INTO tiers (tier_name, tier_description) VALUES ('E', 'Productos por debajo del promedio con características básicas');
INSERT INTO tiers (tier_name, tier_description) VALUES ('F', 'Productos de baja calidad con características mínimas');

INSERT INTO brands (brand_name) VALUES ('Samsung');
INSERT INTO brands (brand_name) VALUES ('Kingston');
INSERT INTO brands (brand_name) VALUES ('Corsair');
INSERT INTO brands (brand_name) VALUES ('Logitech');
INSERT INTO brands (brand_name) VALUES ('ASUS');
INSERT INTO brands (brand_name) VALUES ('MSI');
INSERT INTO brands (brand_name) VALUES ('Razer');
INSERT INTO brands (brand_name) VALUES ('Seagate');
INSERT INTO brands (brand_name) VALUES ('Western Digital');
INSERT INTO brands (brand_name) VALUES ('G.Skill');

INSERT INTO categories (category_name, category_description) VALUES ('SSD', 'Unidades de estado sólido para almacenamiento rápido');
INSERT INTO categories (category_name, category_description) VALUES ('RAM', 'Memoria de acceso aleatorio para computadoras');
INSERT INTO categories (category_name, category_description) VALUES ('Teclados', 'Teclados mecánicos y de membrana para PC');
INSERT INTO categories (category_name, category_description) VALUES ('Ratones', 'Ratones ópticos y láser para computadoras');
INSERT INTO categories (category_name, category_description) VALUES ('Monitores', 'Pantallas de alta resolución para computadoras');
INSERT INTO categories (category_name, category_description) VALUES ('Fuentes de poder', 'Fuentes de alimentación para PC');
INSERT INTO categories (category_name, category_description) VALUES ('Tarjetas gráficas', 'Tarjetas de video para procesamiento gráfico');
INSERT INTO categories (category_name, category_description) VALUES ('Placas base', 'Placas madre para montar componentes de PC');
INSERT INTO categories (category_name, category_description) VALUES ('Auriculares', 'Auriculares para gaming y multimedia');
INSERT INTO categories (category_name, category_description) VALUES ('Discos duros', 'Discos duros para almacenamiento masivo');

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Samsung 970 EVO Plus', 'SSD NVMe de alto rendimiento', 129.99, 1, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Kingston A2000', 'SSD NVMe con buen costo-beneficio', 89.99, 2, 2);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Corsair Vengeance LPX 16GB', 'Memoria RAM DDR4 de alta velocidad', 79.99, 3, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Logitech G Pro', 'Ratón gaming ligero y preciso', 59.99, 4, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('ASUS ROG Strix Z590-E', 'Placa base de alto rendimiento para gaming', 299.99, 5, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('MSI GeForce RTX 3070', 'Tarjeta gráfica potente para juegos AAA', 499.99, 6, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Razer BlackWidow V3', 'Teclado mecánico con retroiluminación RGB', 149.99, 7, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Seagate BarraCuda 4TB', 'Disco duro para almacenamiento masivo', 89.99, 8, 3);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('Western Digital Blue 1TB', 'SSD SATA con buen rendimiento', 99.99, 9, 2);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('G.Skill Trident Z RGB 32GB', 'Memoria RAM DDR4 con iluminación RGB', 159.99, 10, 1);

INSERT INTO products (product_name, product_description, product_price, fk_brand_id, fk_tier_id) 
VALUES ('CX450', 'Fuente de poder de 450w', 59.99, 3, 1);

-- Continúa con más productos según las marcas y categorías mencionadas.

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Excelente SSD', 'El Samsung 970 EVO Plus es extremadamente rápido y fiable.', 1, 1, 1);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Buena opción económica', 'El Kingston A2000 ofrece un buen rendimiento a un precio accesible.', 2, 2, 2);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Rendimiento sólido', 'La Corsair Vengeance LPX 16GB es perfecta para gaming y multitarea.', 3, 1, 3);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Precisión increíble', 'El Logitech G Pro es ideal para juegos de disparos gracias a su precisión.', 4, 1, 4);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Placa base robusta', 'La ASUS ROG Strix Z590-E tiene características excepcionales para gaming.', 5, 1, 1);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Potencia gráfica', 'La MSI GeForce RTX 3070 maneja juegos AAA sin problemas.', 6, 1, 2);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Teclado excelente', 'El Razer BlackWidow V3 tiene un diseño cómodo y una gran respuesta táctil.', 7, 1, 3);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Gran capacidad', 'El Seagate BarraCuda 4TB ofrece mucho espacio a un buen precio.', 8, 3, 4);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Buen SSD', 'El Western Digital Blue 1TB tiene un buen rendimiento para tareas diarias.', 9, 2, 1);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('Estética y rendimiento', 'La G.Skill Trident Z RGB 32GB no solo es rápida, sino que también se ve increíble.', 10, 1, 2);

INSERT INTO reviews (title, content, fk_product_id, fk_tier_id, fk_author_id) 
VALUES ('PSU BBB', 'Excelente fuente de poder a bajo costo', 11, 1, 2);

INSERT INTO locations (location, email, phoneNumber)
	VALUES 
	('Cancún', 'carlglz30@gmail.com', '+52 9984201311'),
	('CDMX', 'sebasPerezVinas@gmail.com', '+52 9984123305'),
	('Guadalajara', 'mariaLopez@example.com', '+52 3334567890'),
    ('Monterrey', 'joseMartinez@example.com', '+52 8187654321'),
    ('Tijuana', 'anaGomez@example.com', '+52 6641234567'),
    ('Mérida', 'luisFernandez@example.com', '+52 9998765432'),
    ('Puebla', 'sofiaHernandez@example.com', '+52 2223344556'),
    ('Querétaro', 'javierRamirez@example.com', '+52 4429876543'),
    ('Veracruz', 'patriciaSanchez@example.com', '+52 2291234567'),
    ('León', 'diegoTorres@example.com', '+52 4776543210');


INSERT INTO psuList (psuName, wattage) VALUES
('Corsair RM750x', 750),
('EVGA SuperNOVA 650 G5', 650),
('Seasonic Focus GX-850', 850),
('Thermaltake Toughpower GF1 1000W', 1000);

INSERT INTO cpuList (cpuName, wattage) VALUES
('Intel Core i9-12900K', 125),
('AMD Ryzen 9 5900X', 105),
('Intel Core i7-12700K', 125),
('AMD Ryzen 5 5600X', 65);

INSERT INTO gpuList (gpuName, wattage) VALUES
('NVIDIA GeForce RTX 3080', 320),
('AMD Radeon RX 6800 XT', 300),
('NVIDIA GeForce RTX 3070', 220),
('AMD Radeon RX 6700 XT', 230);

INSERT INTO mobosList (moboName, wattage) VALUES
('ASUS ROG Strix Z590-E', 30),
('MSI MAG B550 TOMAHAWK', 30),
('Gigabyte AORUS X570 Elite', 40),
('ASRock B450 Steel Legend', 30);

-- Continúa con más reseñas para otros productos.

INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (1, 1); -- Samsung 970 EVO Plus en categoría SSD
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (2, 1); -- Kingston A2000 en categoría SSD
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (3, 2); -- Corsair Vengeance LPX 16GB en categoría RAM
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (4, 4); -- Logitech G Pro en categoría Ratones
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (5, 8); -- ASUS ROG Strix Z590-E en categoría Placas base
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (6, 7); -- MSI GeForce RTX 3070 en categoría Tarjetas gráficas
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (7, 3); -- Razer BlackWidow V3 en categoría Teclados
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (8, 10); -- Seagate BarraCuda 4TB en categoría Discos duros
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (9, 1); -- Western Digital Blue 1TB en categoría SSD
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (10, 2); -- G.Skill Trident Z RGB 32GB en categoría RAM
INSERT INTO product_categories (fk_product_id, fk_category_id) VALUES (11, 6); -- cx450


INSERT INTO comments (content, fk_user_id, fk_review_id) VALUES
('¡Totalmente de acuerdo! Este SSD es realmente impresionante.', 1, 1),
('Para el precio, no se puede pedir más. Muy buen SSD.', 2, 2),
('Sin duda, una de las mejores RAMs que he usado para gaming.', 3, 3),
('Me ha mejorado mi precisión en los juegos, excelente.', 4, 4),
('La placa base es robusta y estable, excelente para mi configuración.', 1, 5),
('La calidad gráfica es sobresaliente, incluso en los juegos más exigentes.', 2, 6),
('El teclado es muy cómodo para largas sesiones de escritura.', 3, 7),
('Gran capacidad para almacenar todos mis archivos importantes.', 4, 8),
('El rendimiento es más que suficiente para mis necesidades diarias.', 1, 9),
('El diseño RGB hace que mi PC se vea increíble y el rendimiento es top.', 2, 10),

('La velocidad del SSD me ha sorprendido gratamente.', 1, 1),
('Buen rendimiento, pero no es el mejor en términos de durabilidad.', 2, 2),
('Una gran opción para quienes necesitan RAM rápida para juegos.', 3, 3),
('Excelente precisión para juegos FPS, muy recomendable.', 4, 4),
('Buena opción para un sistema de gama alta.', 1, 5),
('Una tarjeta gráfica muy poderosa, vale cada centavo.', 2, 6),
('El teclado tiene una respuesta táctil que mejora mi experiencia de escritura.', 3, 7),
('Perfecto para almacenar juegos y aplicaciones sin preocupaciones.', 4, 8),
('Ideal para usuarios que buscan una buena relación calidad-precio.', 1, 9),
('Un componente estético que también ofrece un rendimiento excelente.', 2, 10),

('Estoy muy satisfecho con la velocidad de este producto.', 1, 1),
('Un SSD de buena relación calidad-precio para un uso general.', 2, 2),
('Rendimiento sólido, aunque podría ser un poco más rápido.', 3, 3),
('La precisión del ratón mejora mi desempeño en juegos.', 4, 4),
('Excelente placa base con muchas características útiles.', 1, 5),
('Los gráficos son simplemente impresionantes, ideal para juegos modernos.', 2, 6),
('El teclado tiene una respuesta que me encanta, ideal para gaming.', 3, 7),
('El espacio de almacenamiento es perfecto para mi setup.', 4, 8),
('Una opción sólida para quienes no necesitan la máxima velocidad.', 1, 9),
('Una memoria RAM que combina estética y gran rendimiento.', 2, 10),

('Muy buen rendimiento en tareas intensivas.', 1, 1),
('No es el mejor en su clase, pero cumple con lo prometido.', 2, 2),
('Perfecta para un sistema que requiere mucho multitasking.', 3, 3),
('Recomiendo esta opción para jugadores serios.', 4, 4),
('La placa base cumple bien su función, aunque podría tener más puertos.', 1, 5),
('Excelente para juegos en alta resolución.', 2, 6),
('Teclado robusto con buen feedback táctil.', 3, 7),
('Un buen disco duro con mucho espacio y rendimiento aceptable.', 4, 8),
('Un buen SSD para usuarios generales, sin sorpresas.', 1, 9),
('Rendimiento y estética en un solo paquete.', 2, 10);



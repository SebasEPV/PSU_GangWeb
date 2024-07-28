USE psuGangWeb;

INSERT INTO users(username, first_name, last_name, pass, email, permissions)
VALUES	('Sebas_EPV', 'Sebastian', 'Perez', '12345', 'sebas@gmail.com', True),
		('Carlos_GM', 'Carlos', 'Gonzales', '12345', 'carlos@gmail.com', True),
		('Bryan_NC', 'Bryan', 'Navarrete', '12345', 'bryan@gmail.com', True),
        ('Nahui_PP', 'Nahui', 'Perez', '12345', 'nahui@gmail.com', True);
        
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

-- Continúa asignando productos a sus categorías correspondientes.


-- uso de la base de datos creada
USE ola_ke_hace_xela;


-- Insertar roles
INSERT INTO user_role (name) VALUES ('Administrador'), ('Usuario'), ('Moderador');

-- Insertar usuarios
INSERT INTO user (username, password, role_id, email, cui, name, lastname, phone) VALUES
                                                                                        ('admin1', 'password1', 1, 'admin1@example.com', '1234567890123', 'Admin', 'Uno', '555-1234'),
                                                                                        ('usuario1', 'password2', 2, 'usuario1@example.com', '1234567890124', 'Usuario', 'Uno', '555-1235'),
                                                                                        ('moderador1', 'password3', 3, 'moderador1@example.com', '1234567890125', 'Moderador', 'Uno', '555-1236'),
                                                                                        ('admin2', 'password4', 1, 'admin2@example.com', '1234567890126', 'Admin', 'Dos', '555-1237'),
                                                                                        ('usuario2', 'password5', 2, 'usuario2@example.com', '1234567890127', 'Usuario', 'Dos', '555-1238'),
                                                                                        ('moderador2', 'password6', 3, 'moderador2@example.com', '1234567890128', 'Moderador', 'Dos', '555-1239'),
                                                                                        ('admin3', 'password7', 1, 'admin3@example.com', '1234567890129', 'Admin', 'Tres', '555-1240'),
                                                                                        ('usuario3', 'password8', 2, 'usuario3@example.com', '1234567890130', 'Usuario', 'Tres', '555-1241'),
                                                                                        ('moderador3', 'password9', 3, 'moderador3@example.com', '1234567890131', 'Moderador', 'Tres', '555-1242'),
                                                                                        ('usuario4', 'password10', 2, 'usuario4@example.com', '1234567890132', 'Usuario', 'Cuatro', '555-1243');

-- Insertar categorías de publicaciones
INSERT INTO post_category (name) VALUES ('Deporte'),
                                        ('Danza'),
                                        ('Socio-Cultural'),
                                        ('Lectura'),
                                        ('Mascotas');

-- Insertar publicaciones
INSERT INTO post (user_id, title, place, description, start_date_time, end_date_time, capacity_limit, category_id) VALUES
                                                                                                   (2, '10K Parque Central','Parque Central','Carrera 10K Parque Central', '2024-10-13 10:00:00', '2024-10-13 12:00:00', 100, 1),
                                                                                                   (5, 'Tango - Pasion y Deporte','Centro Intercultural','Danza clasica mixta', '2024-10-14 14:00:00', '2024-10-14 16:00:00', 50, 2),
                                                                                                   (8, 'Charla - Pueblos unidos','Teatro Municipal','Charla informativa CODECA', '2024-10-15 09:00:00', '2024-10-15 11:00:00', 75, 3),
                                                                                                   (8, 'Harry Potter','Biblioteca Municipal','Evento para realizar la entrega de todos los tomos de Harry Potter a la Biblioteca Municipal', '2024-10-16 13:00:00', '2024-10-16 15:00:00', 200, 4),
                                                                                                   (10, 'Pasos y Pedales','Interplaza','Espacio abierto y gratuito para socializacion de mascotas',  '2024-10-17 08:00:00', '2024-10-17 10:00:00', 150, 5),
                                                                                                   (10, 'Final Torneo Papifut','Centro Universitario de Occidente','Final de torneo interdivisiones CUNOC',  '2024-10-18 17:00:00', '2024-10-18 19:00:00', 120, 1),
                                                                                                   (2, 'Bachata Mode ON','Pradera Xela','Clases de Bachata abiertas para todo el publico',  '2024-10-19 11:00:00', '2024-10-19 13:00:00', 80, 2),
                                                                                                   (2, 'Procesión Virgen Rosario','Parque Central','Procesion en honor a la virgen del rosario',  '2024-10-20 15:00:00', '2024-10-20 17:00:00', 60, 3),
                                                                                                   (5, 'Manga para todos','Utz Ulew','Actividad para exponer sobre el Manga y dar apertura a nuevos miembros',  '2024-10-21 07:00:00', '2024-10-21 09:00:00', 90, 4),
                                                                                                   (2, 'Adopcion Libre','Parque Thelma Quixtan','Actividad para realizar procesos de adopcion de mascotas en situacion de calle',  '2024-10-22 12:00:00', '2024-10-22 14:00:00', 110, 5);

-- Insertar reportes
INSERT INTO report (post_id, user_id, comment) VALUES
                                                   (1, 10, 'No me gusta la organizacion'),
                                                   (2, 10, 'Parece fake'),
                                                   (3, 5, 'No me parece interesante'),
                                                   (4, 5, 'El señor de los anillos es mejor'),
                                                   (5, 5, 'No me dejaron entrar a mi animalito'),
                                                   (6, 5, 'Solo a beber se juntan'),
                                                   (7, 2, 'Es totalmente falso'),
                                                   (8, 2, 'Evento sin sentido'),
                                                   (9, 2, 'Demasiada afluencia de personas'),
                                                   (10, 10, 'Cobran por adopcion');

-- Insertar notificaciones
INSERT INTO notification (user_id, message) VALUES
                                                (2, 'Notificación 1'),
                                                (3, 'Notificación 2'),
                                                (4, 'Notificación 3'),
                                                (5, 'Notificación 4'),
                                                (6, 'Notificación 5'),
                                                (7, 'Notificación 6'),
                                                (8, 'Notificación 7'),
                                                (9, 'Notificación 8'),
                                                (10, 'Notificación 9'),
                                                (2, 'Notificación 10');

-- Insertar asistencias
INSERT INTO attendance (user_id, post_id) VALUES
                                              (2, 1),
                                              (3, 2),
                                              (4, 3),
                                              (5, 4),
                                              (6, 5),
                                              (7, 6),
                                              (8, 7),
                                              (9, 8),
                                              (10, 9),
                                              (2, 10);

-- Insertar publicaciones aprobadas
INSERT INTO approved_post (post_id, approved_by) VALUES
                                                     (1, 2),
                                                     (2, 3),
                                                     (3, 4),
                                                     (4, 5),
                                                     (5, 6),
                                                     (6, 7),
                                                     (7, 8),
                                                     (8, 9),
                                                     (9, 10),
                                                     (10, 2);
-- Insertion de données pour la base EcoRide

-- Utilisateurs : Admin, Employé, Chauffeur, Passager
INSERT INTO Users (first_name, last_name, username, email, phone, consent, consent_date) VALUES 
('José', 'Parrot', 'admin_jose', 'jose.parrot@example.com', '0600000001', TRUE, NOW()),
('Alain', 'Prost', 'employee_alain', 'alain.prost@example.com', '0600000002', TRUE, NOW()),
('Jean', 'Dupont', 'jdupont', 'jean.dupont@example.com', '0612345678', TRUE, NOW()),
('Marie', 'Curie', 'mcurie', 'marie.curie@example.com', '0623456789', TRUE, NOW());

-- Authentification des utilisateurs
INSERT INTO Authentication (user_id, username, password_hash, last_login) VALUES 
(1, 'admin_jose', '$2y$10$taB6qvW.9eSVG5IHx.1ubO8t1BZAAv.qj9JpbdjhKy8QhuedcGWmu', NOW()),
(2, 'employee_alain', '$2y$10$I2dqhwM2LEFZ844MAV5RCuDtjPsNWOgVDkuASUmpyzYwe3KAJfW7.', NOW()),
(3, 'jdupont', '$2y$10$yb63zFXQP2kBw79rVUP5bejeRFg5UZhS00NmNiN84mUghUTmZ95i2', NOW()),
(4, 'mcurie', '$2y$10$hL1syrvxyCvtuIvcBa01xO.W3JYPngGj/ddRdD6fzAqVcawdgbadG', NOW());

-- Véhicules des chauffeurs
INSERT INTO Vehicles (user_id, brand, model, color, energy_type, plate_number) VALUES 
(3, 'Tesla', 'Model 3', 'Rouge', 'electric', 'AB-123-CD'),
(4, 'Renault', 'Zoe', 'Bleu', 'electric', 'CD-456-EF');

-- Trajets disponibles
INSERT INTO Trips (driver_id, vehicle_id, origin, destination, departure_time, price, max_passengers, eco_friendly) VALUES 
(3, 1, 'Paris', 'Lyon', '2024-02-15 08:00:00', 30.00, 3, TRUE),
(4, 2, 'Marseille', 'Nice', '2024-02-16 09:30:00', 25.00, 2, TRUE);

-- Réservations
INSERT INTO Reservations (passenger_id, trip_id, status) VALUES 
(4, 1, 'confirmed');

-- Messages de contact
INSERT INTO Messages (user_id, first_name, last_name, email, subject, message, status) VALUES 
(NULL, 'Paul', 'Durand', 'paul.durand@example.com', 'Problème de réservation', 'Je ne parviens pas à réserver un trajet.', 'pending');

-- Invitations en attente
INSERT INTO Invitations (email, role, token, status, created_at) VALUES 
('new.employee@example.com', 'employee', 'token12345', 'pending', NOW()),
('new.user@example.com', 'user', 'token67890', 'pending', NOW());
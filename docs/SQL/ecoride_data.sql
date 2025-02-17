

-- Insérer des utilisateurs
INSERT INTO users (id, first_name, last_name, role, phone, address, city, postal_code, birth_date, photo, consent, consent_date)
VALUES
(1, 'Alice', 'Dupont', 'user', '0601020304', '12 rue de Paris', 'Paris', '75001', '1992-05-14', NULL, TRUE, NOW()),
(2, 'Bob', 'Martin', 'user', '0611223344', '34 avenue Lyon', 'Lyon', '69001', '1988-09-23', NULL, TRUE, NOW()),
(3, 'Charlie', 'Lemoine', 'employed', '0622334455', '56 boulevard Nice', 'Nice', '06000', '1990-11-11', NULL, TRUE, NOW()),
(4, 'David', 'Morel', 'admin', '0633445566', '78 route Marseille', 'Marseille', '13000', '1985-02-02', NULL, TRUE, NOW());

-- Insérer des données d'authentification
INSERT INTO authentication (user_id, username, email, password_hash, email_verified, verification_token)
VALUES
(1, 'aliceD', 'alice@example.com', 'hash1', FALSE, 'token1'),
(2, 'bobM', 'bob@example.com', 'hash2', FALSE, 'token2'),
(3, 'charlieL', 'charlie@example.com', 'hash3', TRUE, NULL),
(4, 'davidAdmin', 'admin@example.com', 'adminhash', TRUE, NULL);

-- Insérer des véhicules
INSERT INTO vehicles (id, user_id, type, brand, model, year, color, energy_type, plate_number, registration_date, seats, mobility_restricted, smoker_friendly, pets_allowed)
VALUES
(1, 1, 'voiture', 'Renault', 'Clio', 2020, 'Rouge', 'essence', 'AB-123-CD', '2020-06-15', 5, FALSE, FALSE, TRUE),
(2, 2, 'voiture', 'Tesla', 'Model 3', 2022, 'Noir', 'électrique', 'CD-456-EF', '2022-04-10', 5, FALSE, FALSE, FALSE);

-- Insérer des trajets
INSERT INTO trips (id, driver_id, vehicle_id, departure_city, departure_address, departure_date, arrival_city, arrival_address, arrival_date, available_seats, price, status, eco_friendly)
VALUES
(1, 1, 1, 'Paris', 'Gare du Nord', '2025-03-10 08:00:00', 'Lyon', 'Gare de Lyon', '2025-03-10 12:00:00', 3, 30.50, 'pending', FALSE),
(2, 2, 2, 'Lyon', 'Place Bellecour', '2025-03-11 09:30:00', 'Marseille', 'Vieux-Port', '2025-03-11 14:30:00', 4, 25.00, 'confirmed', TRUE);

-- Insérer des réservations
INSERT INTO reservations (passenger_id, trip_id, status, reserved_at)
VALUES
(2, 1, 'confirmed', NOW()),
(3, 2, 'pending', NOW());

-- Insérer des signalements
INSERT INTO reports (reporter_id, trip_id, reported_user_id, reason, message, status)
VALUES
(2, 1, 1, 'dangerous_driving', 'Le conducteur roulait trop vite.', 'pending');

-- Insérer des modérations
INSERT INTO moderation (moderator_id, report_id, trip_id, moderation_type, action, reason)
VALUES
(4, 1, 1, 'report', 'pending', 'Vérification en cours');

-- Insérer des messages
INSERT INTO messages (user_id, first_name, last_name, email, subject, message, status)
VALUES
(NULL, 'Paul', 'Durand', 'paul.durand@example.com', 'Problème de réservation', 'Je ne parviens pas à réserver un trajet.', 'pending'),
(1, NULL, NULL, NULL, "Demande d'infos", 'Comment fonctionne votre plateforme ?', 'resolved');

-- Insérer des invitations (confirmation d'email)
INSERT INTO invitations (user_id, token)
VALUES
(1, 'confirmation_token1'),
(2, 'confirmation_token2');


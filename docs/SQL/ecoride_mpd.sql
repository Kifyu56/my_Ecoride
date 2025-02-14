-- EcoRide MPD

CREATE TABLE Users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    address VARCHAR(255) NULL,
    postal_code VARCHAR(20) NULL,
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    consent BOOLEAN NOT NULL DEFAULT FALSE,
    consent_date DATETIME NULL
);

CREATE TABLE Authentication (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    last_login DATETIME NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Vehicles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    color VARCHAR(30) NOT NULL,
    energy_type ENUM('electric', 'hybrid', 'gasoline', 'diesel', 'other') NOT NULL,
    plate_number VARCHAR(20) UNIQUE NOT NULL,
    mobility_restricted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Trips (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    driver_id INT UNSIGNED NOT NULL,
    vehicle_id INT UNSIGNED NOT NULL,
    origin VARCHAR(255) NOT NULL,
    destination VARCHAR(255) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NULL,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'approved', 'canceled', 'finished') DEFAULT 'pending',
    max_passengers INT NOT NULL,
    eco_friendly BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (driver_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_id) REFERENCES Vehicles(id) ON DELETE CASCADE
);

CREATE TABLE Reservations (
    passenger_id INT UNSIGNED NOT NULL,
    trip_id INT UNSIGNED NOT NULL,
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    reserved_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (passenger_id, trip_id),
    FOREIGN KEY (passenger_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES Trips(id) ON DELETE CASCADE
);

CREATE TABLE Reports (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reporter_id INT UNSIGNED NOT NULL,
    trip_id INT UNSIGNED NULL,
    reported_user_id INT UNSIGNED NULL,
    reason ENUM('dangerous_driving', 'spam', 'other') NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved', 'rejected') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reporter_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES Trips(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_user_id) REFERENCES Users(id) ON DELETE CASCADE
);


CREATE TABLE Messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NULL,
    first_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NULL,
    email VARCHAR(255) NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    resolved_at DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE SET NULL
);

CREATE TABLE Invitations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('employee', 'user') NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    status ENUM('pending', 'accepted', 'expired') DEFAULT 'pending',
    linked_user_id INT UNSIGNED NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    accepted_at DATETIME NULL,
    FOREIGN KEY (linked_user_id) REFERENCES Users(id) ON DELETE SET NULL
);

CREATE TABLE Moderation (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    moderator_id INT UNSIGNED NOT NULL,
    report_id INT UNSIGNED NULL,
    trip_id INT UNSIGNED NULL,
    moderation_type ENUM('trip', 'rating', 'report', 'other') NOT NULL CHECK (moderation_type IN ('trip', 'rating', 'report', 'other')),
    action ENUM('approved', 'rejected', 'pending') DEFAULT 'pending',
    reason TEXT NOT NULL,
    moderated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (moderator_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES Trips(id) ON DELETE CASCADE,
    FOREIGN KEY (report_id) REFERENCES Reports(id) ON DELETE CASCADE
);



-- NoSQL Collections:
-- Credits (Managed in NoSQL)
-- Ratings (Managed in NoSQL)
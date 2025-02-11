-- Creation of tables for EcoRide MPD

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
    user_id INT NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    last_login DATETIME NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Vehicles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
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
    driver_id INT NOT NULL,
    vehicle_id INT NOT NULL,
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
    user_id INT NOT NULL,
    trip_id INT NOT NULL,
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    reserved_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, trip_id),
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (trip_id) REFERENCES Trips(id) ON DELETE CASCADE
);

CREATE TABLE Reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trip_id INT NOT NULL,
    reported_user INT NOT NULL,
    reason TEXT NOT NULL,
    status ENUM('open', 'resolved', 'rejected') DEFAULT 'open',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trip_id) REFERENCES Trips(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_user) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE Messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    resolved_at DATETIME NULL
);

CREATE TABLE Invitations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('employee', 'user') NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    status ENUM('pending', 'accepted', 'expired') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    accepted_at DATETIME NULL
);

CREATE TABLE Moderation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    moderator_id INT NOT NULL,
    action ENUM('approved', 'rejected', 'suspended') NOT NULL,
    reason TEXT NULL,
    FOREIGN KEY (moderator_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- NoSQL Collections:
-- Credits (Managed in NoSQL)
-- Ratings (Managed in NoSQL)

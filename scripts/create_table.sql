CREATE TABLE IF NOT EXISTS Business (
    businessid INT AUTO_INCREMENT PRIMARY KEY,
    bName VARCHAR(30) NOT NULL,
    `address` VARCHAR(30) NOT NULL,
    tel VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(30) NOT NULL,
    bus_password VARCHAR(255) NOT NULL -- Increased length for hashed passwords
);

CREATE TABLE IF NOT EXISTS APIServices (
    aserviceid INT AUTO_INCREMENT PRIMARY KEY,
    servicename VARCHAR(50), -- Increased length for service names
    businessid INT,
    datecreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (businessid) REFERENCES Business(businessid) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS APIUser (
    apiuserid INT AUTO_INCREMENT PRIMARY KEY,
    businessid INT,
    apikey VARCHAR(100), -- Increased length for secure keys
    token VARCHAR(100), -- Increased length for secure tokens
    serviceId INT,
    dateGenerated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (businessid) REFERENCES Business(businessid),
    FOREIGN KEY (serviceId) REFERENCES APIServices(aserviceid) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Keyservices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    apikey VARCHAR(100) NOT NULL, -- Increased length for secure keys
    services VARCHAR(50) NOT NULL, -- Increased length for service names
    businessid INT,
    FOREIGN KEY (businessid) REFERENCES Business(businessid) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ServiceItems (
    sitemid INT AUTO_INCREMENT PRIMARY KEY,
    feature VARCHAR(50), -- Increased length for feature names
    aserviceid INT,
    FOREIGN KEY (aserviceid) REFERENCES APIServices(aserviceid) ON DELETE CASCADE
);

ALTER TABLE Keyservices 
MODIFY COLUMN apikey VARCHAR(100) NOT NULL UNIQUE;


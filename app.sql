CREATE DATABASE IF NOT EXISTS comp_1006_your_student_id;
USE comp_1006_your_student_id;

-- YOU MUST USE THIS TABLE AS IS (or at least the 3 defined fields name, email, and password)
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(256) NOT NULL
);

CREATE TABLE parent_resource (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE child_resource (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    parent_id INT NOT NULL,
    FOREIGN KEY (parent_id) REFERENCES parent_resource (id) ON DELETE CASCADE
);
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isadmin BOOLEAN DEFAULT 0,
    is_active BOOLEAN DEFAULT 1,
    deleted_at TIMESTAMP DEFAULT NULL,
    deleted_by INT DEFAULT NULL,
    FOREIGN KEY (deleted_by) REFERENCES users(id) ON DELETE SET NULL
);


CREATE TABLE estate (
    id INT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    location VARCHAR(255),
    price DECIMAL(10, 2),
    picture1_url VARCHAR(255),
    picture2_url VARCHAR(255),
    picture3_url VARCHAR(255),
    description TEXT,
    type VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE about_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    history_title VARCHAR(255) NOT NULL,
    history_description TEXT NOT NULL,
    owners_title VARCHAR(255) NOT NULL,
    owners_description TEXT NOT NULL
);

CREATE TABLE contact_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
);

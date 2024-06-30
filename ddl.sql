CREATE TABLE `users` (
  `eid` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_token` varchar(255) NULL,
  `avatar` varchar(45) NULL,
  `role` ENUM('admin', 'contributor', 'participant') NOT NULL DEFAULT 'participant',
  `deleted` bool NOT NULL DEFAULT false,
  `created_at` timestamp not null default current_timestamp,
  `updated_at` timestamp not null default current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `email_un` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

insert into users (eid, email, phone_number, fullname, password_hash, `role`) values (111111, 'rdiSensation@gmail.com', '081243328881', 'Super Administrator', md5('admin'), 'admin');

-- Category Events Table
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL,
    deleted bool NOT NULL DEFAULT false,
    created_by INT NOT NULL,
    updated_by int not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(eid),
    FOREIGN KEY (updated_by) REFERENCES users(eid)
);

insert into category (category, created_by, updated_by) values ('Keuangan', 111111, 111111);

-- Training Events Table
CREATE TABLE training (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    start_time TIMESTAMP NOT NULL,
    end_time TIMESTAMP NOT NULL,
    venue text not null default 'Online',
    map_link VARCHAR(255) null,
    online_link VARCHAR(255) null,
    cat_id INT NOT NULL,
    published bool not null default false,
    deleted bool not null default false,
    created_by INT NOT NULL,
    updated_by int not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(eid),
    FOREIGN KEY (updated_by) REFERENCES users(eid),
    FOREIGN KEY (cat_id) REFERENCES category(id)
);

-- News Table
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    published bool not null default false,
    deleted bool not null default false,
    created_by INT NOT NULL,
    updated_by int not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(eid),
    FOREIGN KEY (updated_by) REFERENCES users(eid)
);

-- Comments Table
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT NOT NULL,
    event_id INT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(eid)
);

-- Event Registrations Table
CREATE TABLE event_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(eid),
    FOREIGN KEY (event_id) REFERENCES training(id)
);


CREATE TABLE states (
	code varchar(20) NOT NULL PRIMARY KEY,
	`name` varchar(100) NULL
);

CREATE TABLE cities (
	code varchar(20) NOT NULL PRIMARY KEY,
	state_code varchar(20) NULL,
	`name` varchar(100) NULL
);

alter table users add column addr text not null default '';
alter table users add column cities varchar(20) not null default '';
alter table users add column ktp varchar(25) not null default '';
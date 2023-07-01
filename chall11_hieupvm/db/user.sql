CREATE TABLE Users (
  user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  full_name varchar(50) NOT NULL,
  username varchar(50) unique,
  password varchar(50) NOT NULL,
  avatar varchar(500),
  email varchar(150) NOT NULL,
  phone_number varchar(20) NOT NULL,
  role_id int(11) NOT NULL 
);

CREATE TABLE Assignment (
  assign_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  description longtext,
  path varchar(500) NOT NULL,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE submission (
    submission_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    assign_id int(11) NOT NULL,
    student_id int(11) NOT NULL,
    title varchar(255) NOT NULL,
    path varchar(500) NOT NULL,
    description longtext,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE messenger(
  messenger_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  from_id int(11) NOT NULL,
  to_id int(11) NOT NULL,
  content varchar(500) NOT NULL,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE challenger(
  challenger_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  path varchar(500) NOT NULL,
  hint varchar(500) NOT NULL
);
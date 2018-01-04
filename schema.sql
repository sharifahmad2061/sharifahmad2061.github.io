DROP DATABASE IF EXISTS web_proj;
CREATE DATABASE web_proj;
USE web_proj;
CREATE TABLE sign_in
(
	UIDN INT NOT NULL,
	password VARCHAR(15) NOT NULL,
	PRIMARY KEY (UIDN)
);

CREATE TABLE teacher
(
	UIDN INT NOT NULL,
	fname VARCHAR(15) NOT NULL,
	lname VARCHAR(15),
	email VARCHAR(40) NOT NULL,
	PRIMARY KEY (UIDN),
	UNIQUE (email)
);

CREATE TABLE student
(
	UIDN INT NOT NULL,
	fname VARCHAR(15) NOT NULL,
	lname VARCHAR(15),
	email VARCHAR(40) NOT NULL,
	section VARCHAR(10),
	advisor_id INT,
	PRIMARY KEY (UIDN),
	FOREIGN KEY (advisor_id) REFERENCES teacher(UIDN)
);

CREATE TABLE subject
(
	sub_id INT AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	PRIMARY KEY (sub_id)
);
ALTER TABLE subject AUTO_INCREMENT=1000;

CREATE TABLE problem
(
	p_id INT AUTO_INCREMENT,
	problem VARCHAR(140) NOT NULL,
	student_id INT NOT NULL,
	teacher_id INT NOT NULL,
	PRIMARY KEY (p_id),
	FOREIGN KEY (student_id) REFERENCES student(UIDN),
	FOREIGN KEY (teacher_id) REFERENCES teacher(UIDN)
);
ALTER TABLE problem AUTO_INCREMENT=4000;

CREATE TABLE exam
(
	student_id INT NOT NULL,
	sub_id INT NOT NULL,
	oht1 INT,
	oht2 INT,
	ese INT,
	quiz_1 INT,
	quiz_2 INT,
	quiz_3 INT,
	quiz_4 INT,
	quiz_5 INT,
	quiz_6 INT,
	quiz_7 INT,
	assignment_1 INT,
	assignment_2 INT,
	assignment_3 INT,
	assignment_4 INT,
	assignment_5 INT,
	PRIMARY KEY (student_id, sub_id),
	FOREIGN KEY (student_id) REFERENCES student(UIDN),
	FOREIGN KEY (sub_id) REFERENCES subject(sub_id)
);

CREATE TABLE attendance
(
	sub_id INT NOT NULL,
	student_id INT NOT NULL,
	attendance INT NOT NULL,
	PRIMARY KEY (sub_id, student_id),
	FOREIGN KEY (sub_id) REFERENCES subject(sub_id),
	FOREIGN KEY (student_id) REFERENCES student(UIDN)
);

CREATE TABLE msg
(
	m_id INT AUTO_INCREMENT,
	m_text VARCHAR(140) NOT NULL,
	s_uidn INT NOT NULL,
	r_uidn INT NOT NULL,
	s_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (m_id)
);
ALTER TABLE msg AUTO_INCREMENT=8000;

CREATE TABLE user_status
(
	u_id INT NOT NULL,
	status VARCHAR(15) NOT NULL,
	PRIMARY KEY (u_id)
);
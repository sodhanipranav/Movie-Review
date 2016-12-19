-- Create.sql File
-- Author: Pranav Sodhani

CREATE TABLE Movie(
			id INT NOT NULL,
			title VARCHAR(100 ) NOT NULL,
			year INT,
			rating VARCHAR(10),
			company VARCHAR(50),
			PRIMARY KEY(id), -- UNIQUE Movie ID
			CHECK(year>0) -- YEAR NEEDS TO BE A POSTIVE INTEGER.
			) ENGINE = INNODB;

CREATE TABLE Actor(
			id INT NOT NULL,
			last VARCHAR(20) NOT NULL,
			first VARCHAR(20) NOT NULL,
			sex VARCHAR(6) NOT NULL,
			dob DATE NOT NULL,
			dod DATE,
			PRIMARY KEY(id), /*-- UNIQUE Actor ID*/
			CHECK(dod IS NULL OR dob<=dod) -- DEATH SHOULD OCCUR AFTER BIRTH
			)ENGINE = INNODB;

CREATE TABLE Director(
			id INT NOT NULL,
			last VARCHAR(20) NOT NULL,
			first VARCHAR(20) NOT NULL,
			dob DATE NOT NULL,
			dod DATE,
			PRIMARY KEY(id) /*-- UNIQUE Director ID*/
			)ENGINE = INNODB;

CREATE TABLE MovieGenre(
			mid INT,
			genre VARCHAR(20),
			FOREIGN KEY(mid) REFERENCES Movie(id)
/* This movie must exist in the movie table */
			)ENGINE = INNODB;

CREATE TABLE MovieDirector(
				mid INT,
				did INT,
				FOREIGN KEY (mid) REFERENCES Movie (id),
/* This movie must exist in the movie table. */
				FOREIGN KEY (did) REFERENCES Director (id)
/* This Director must exist in the Director table. */
				)ENGINE = INNODB;

CREATE TABLE MovieActor(
				mid INT,
				aid INT,
				role VARCHAR(50),
				FOREIGN KEY (mid) REFERENCES Movie(id), 
/* This movie must exist in the movie table. */
				FOREIGN KEY (aid) REFERENCES Actor(id)
/* This Actor must exist in the Actor table. */
				)ENGINE = INNODB;

CREATE TABLE Review(
			name VARCHAR(20),
			time TIMESTAMP,
			mid INT,
			rating INT,
			comment VARCHAR(500),
			FOREIGN KEY (mid) REFERENCES Movie(id),
/* This movie must exist in the movie table. */
			CHECK(rating>=0 AND rating<=5) -- RATING IS OUT OF 5
			)ENGINE = INNODB;

CREATE TABLE MaxPersonID(
				id INT
			)ENGINE = INNODB;

CREATE TABLE MaxMovieID(
				id INT
			)ENGINE = INNODB;




CREATE TABLE Bois(
	id MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL UNIQUE,
	deaths INT DEFAULT 0,
	PRIMARY KEY(id)
);

CREATE TABLE Games(
	id MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
	name VARCHAR(12) NOT NULL UNIQUE,
	total_deaths INT DEFAULT 0,
	PRIMARY KEY(id)
);

CREATE TABLE Missions(
	id MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
	game_id MEDIUMINT NOT NULL,
	name VARCHAR(20) NOT NULL UNIQUE,
	total_deaths INT DEFAULT 0,
	time_to_finish FLOAT DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(game_id) REFERENCES Games(id)
);

CREATE TABLE Mission_Deaths(
	id MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
	boi_id MEDIUMINT NOT NULL,
	mission_id MEDIUMINT NOT NULL,
	deaths INT DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(boi_id) REFERENCES Bois(id),
	FOREIGN KEY(mission_id) REFERENCES Missions(id)
);

CREATE TABLE Game_Deaths(
	id MEDIUMINT NOT NULL UNIQUE AUTO_INCREMENT,
	boi_id MEDIUMINT NOT NULL,
	game_id MEDIUMINT NOT NULL,
	deaths INT DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(boi_id) REFERENCES Bois(id),
	FOREIGN KEY(game_id) REFERENCES Games(id)
);
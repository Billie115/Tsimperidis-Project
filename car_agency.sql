CREATE TABLE Etairia(
    koddikos_etairias CHAR(4) PRIMARY KEY,
    onoma VARCHAR(30) UNIQUE NOT NULL,
    xora VARCHAR(20) NOT NULL,
    tilefono CHAR(10) UNIQUE NOT NULL);

CREATE TABLE Modelo(
    kodikos_modelu INT PRIMARY KEY,
    onomasia VARCHAR(30) UNIQUE NOT NULL,
    kuvismo_kinitira INT,
    Kafsimo_kinitira VARCHAR(20) NOT NULL,
    katigoria ENUM('sport', 'SUV', 'IX') NOT NULL,
    apo_etairia CHAR(4) NOT NULL,
    FOREIGN KEY (apo_etairia) REFERENCES Etairia(kodikos_etairias));

CREATE TABLE Autokinhto(
    VIN CHAR(17) PRIMARY KEY,
    xroma VARCHAR(15) NOT NULL,
    etos_agoras YEAR,
    modelo INT NOT NULL,
    etos_kataskevis YEAR NOT NULL,
    endictikh_timh DECIMAL(11,2),
    FOREIGN KEY (modelo) REFERENCES Modelo(kodikos_modelu));

CREATE TABLE Pelatis(
    AT CHAR(8) PRIMARY KEY,
    onoma VARCHAR(30) NOT NULL,
    eponimo VARCHAR(30));

CREATE TABLE Politis(
    kodikos_ypalilou CHAR(3) PRIMARY KEY,
    onoma VARCHAR(20) NOT NULL,
    eponimo VARCHAR(20),
    hmpros DATE NOT NULL);

CREATE TABLE Poliseis(
    kodikos_polishs CHAR(17) PRIMARY KEY,
    hmago DATE NOT NULL,
    timh DECIMAL(11,2) NOT NULL,
    autokinito CHAR(17) UNIQUE NOT NULL,
    pelatis CHAR(8) NOT NULL,
    ypalilos CHAR(3) NOT NULL,
    FOREIGN KEY (autokinito) REFERENCES Autokinhto(VIN),
    FOREIGN KEY (pelatis) REFERENCES Pelatis(AT),
    FOREIGN KEY (ypalilos) REFERENCES Politis(kodikos_ypalilou));

CREATE TABLE Michanikos(
    kodikos_Michanikou CHAR(3) PRIMARY KEY,
    onoma VARCHAR(20) NOT NULL,
    eponimo VARCHAR(20),
    hmpros DATE NOT NULL);

CREATE TABLE Syntirish(
    kodikos CHAR(17) PRIMARY KEY,
    hm_rant DATE NOT NULL,
    perigrafi TEXT NOT NULL,
    autokinito CHAR(17) NOT NULL,
    michanikos CHAR(3),
    FOREIGN KEY (autokinito) REFERENCES Autokinhto(VIN),
    FOREIGN KEY (michanikos) REFERENCES Michanikos(kodikos_Michanikou));

CREATE TABLE login( 
    username VARCHAR(20) PRIMARY KEY,
    password VARCHAR(30) NOT NULL);
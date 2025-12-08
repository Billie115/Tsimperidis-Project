CREATE TABLE etairia(
    id_etairias CHAR(4) PRIMARY KEY,
    onoma VARCHAR(30) UNIQUE NOT NULL,
    xwra VARCHAR(20) NOT NULL,
    etairiko_afm VARCHAR(9) UNIQUE NOT NULL --Mporei na min xriazete exoume kati monadiko gia na ksexorizoume tis etairies 
);

CREATE TABLE thlefono_etairias(
    thlefono CHAR(10) PRIMARY KEY,
    id_etairias CHAR(4) NOT NULL,
    FOREIGN KEY (id_etairias) REFERENCES etairia(id_etairias)
);

CREATE TABLE montelo(
    id_montelou CHAR(4) PRIMARY KEY,
    onomasia VARCHAR(20) UNIQUE NOT NULL,
    id_etairias CHAR(4) NOT NULL,
    FOREIGN KEY (id_etairias) REFERENCES etairia(id_etairias)
);

CREATE TABLE autokinhto(
    VIN CHAR(17) PRIMARY KEY, --(sta ellhnika einai ari8mos plaisiou)eimai sxedon shgouros oti vin einai kati pou exei ka8e ama3i, ebala to id giati 8eloume kati na 3exorhzoume emeis sthn aiteria
    montelo CHAR(4) NOT NULL,
    ari8mos_kinhthra VARCHAR(17) UNIQUE NOT NULL,
    aitos_kataskebhs YEAR NOT NULL, --onoma montelou
    eidos_mhxanhs VARCHAR(20) NOT NULL, --ti kaei, benzinh, petreleo, hybrid, hlektriko.
    kibhka INT(5) NOT NULL,
    tansmission VARCHAR(20) NOT NULL, --AFTOMATO, ME TAXHTHTES.
    xhliometra DECIMAL(8,2), --null an einai neo, timh an einai metaxeirhsmeno
    xrwma VARCHAR(15) NOT NULL,
    endiktikh_timh DECIMAL(11,2) NOT NULL,
    katastash ENUM('dia8eshmo', 'poulhmeno', 'me paragelia'), --dia8eshmo, poulhmeno, h kati allo den mou erxete kati allo.
    FOREIGN KEY (montelo) REFERENCES montelo(id_montelou) 
);

CREATE TABLE pelates(
    afm_pelath VARCHAR(9) PRIMARY KEY,
    onoma VARCHAR(30) NOT NULL,
    epwnumo VARCHAR(30) NOT NULL,
    email VARCHAR(254) NOT NULL,
    thlefwno1 CHAR(10) UNIQUE NOT NULL,
    thlefwno2 CHAR(10)
);

CREATE TABLE upallhloi(
    id_upallhlou CHAR(4) PRIMARY KEY,
    onoma VARCHAR(20) NOT NULL,
    epwnumo VARCHAR(20) NOT NULL,
    thlefwno1 CHAR(10) UNIQUE NOT NULL,
    thlefwno2 CHAR(10),
    hm_proslhpshs DATE NOT NULL,
    idikothta ENUM('poliths', 'mhxanikos', 'manager', 'ka8arisths') NOT NULL --poliths, mhxanikos, manager, klp
);

CREATE TABLE poliseis(
    id_polishs CHAR(17) PRIMARY KEY,
    hm_ago DATE NOT NULL,
    timh DECIMAL(11,2) NOT NULL,
    VIN CHAR(17) UNIQUE NOT NULL,
    afm_pelath CHAR(8) NOT NULL,
    id_upallhlou CHAR(4) NOT NULL,
    FOREIGN KEY (VIN) REFERENCES autokinhto(VIN),
    FOREIGN KEY (afm_pelath) REFERENCES pelates(afm_pelath),
    FOREIGN KEY (id_upallhlou) REFERENCES upallhloi(id_upallhlou)
);

DELIMITER //
CREATE TRIGGER check_politis
BEFORE INSERT ON poliseis
FOR EACH ROW
BEGIN
    IF (SELECT idikothta
        FROM upallhloi
        WHERE id_upallhlou = NEW.id_upallhlou) <> 'poliths' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'O upallhlos den einai poliths';
    END IF;
END;//
DELIMITER ;

CREATE TABLE syntirish(
    id_suntirishs CHAR(17) PRIMARY KEY,
    hm_rant DATE NOT NULL,
    perigrafi TEXT NOT NULL,
    id_upallhlou CHAR(4),
    pinakida_kukloforias VARCHAR(8), --morfh: AAA-1234
    katastash VARCHAR(20), --akurw8hke, oloklhrw8hke.
    FOREIGN KEY (id_upallhlou) REFERENCES upallhloi(id_upallhlou)
);

DELIMITER //
CREATE TRIGGER check_mhxanikos
BEFORE INSERT ON syntirish
FOR EACH ROW
BEGIN
    IF (SELECT idikothta
        FROM upallhloi
        WHERE id_upallhlou = NEW.id_upallhlou) <> 'mhxanikos' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'O upallhlos den einai mhxanikos';
    END IF;
END;//
DELIMITER ;

CREATE TABLE login( 
    username VARCHAR(20) PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    admin ENUM('True', 'False')
);
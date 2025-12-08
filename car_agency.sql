CREATE TABLE etairia(
    id_etairias CHAR(4) PRIMARY KEY,
    onoma VARCHAR(30) UNIQUE NOT NULL,
    xwra VARCHAR(20) NOT NULL,
    thlefwno1 CHAR(10) UNIQUE NOT NULL,
    thlefwno2 CHAR(10) UNIQUE, --2o thl mporei na einai null an den exei
    thlefwno3 CHAR(10), --3o thl an exei h etairia, kai ebgala to unique se periptwhsh pou exei thl apo ta kentrika
    etairiko_afm VARCHAR(9) UNIQUE NOT NULL); --to exei ka8e aiteria, oxi oles h megales nomizw alla sthn periptwsh mas prepei na exoun oles nmzw.

CREATE TABLE montelo(
    id_montelou CHAR(4) PRIMARY KEY,
    onoma VARCHAR(20) UNIQUE NOT NULL,
    id_aiterias CHAR(4),
    FOREIGN KEY (id_aiterias) REFERENCES etairia(id_etairias));

CREATE TABLE autokinhto(
    id_autonikhtou CHAR(4) PRIMARY KEY,
    marka VARCHAR(30) UNIQUE NOT NULL, --onoma aiterias
    montelo VARCHAR(20) UNIQUE NOT NULL,
    VIN VARCHAR(17) UNIQUE NOT NULL, --(sta ellhnika einai kodikos plaisiou)eimai sxedon shgouros oti vin einai kati pou exei ka8e ama3i, ebala to id giati 8eloume kati na 3exorhzoume emeis sthn aiteria
    ari8mos_kinhthra VARCHAR(17),
    aitos_kataskebhs YEAR, --onoma montelou
    eidos_mhxanhs VARCHAR(20), --ti kaei, benzinh, petreleo, hybrid, hlektriko.
    kibhka INT(5) NOT NULL,
    tansmission VARCHAR(20) NOT NULL, --AFTOMATO, ME TAXHTHTES.
    xhliometra DECIMAL(8,2), --null an einai neo, timh an einai metaxeirhsmeno
    xrwma VARCHAR(15) NOT NULL,
    endiktikh_timh DECIMAL(11,2) NOT NULL,
    katastash VARCHAR(20), --dia8eshmo, poulhmeno, h kati allo den mou erxete kati allo.
    FOREIGN KEY (montelo) REFERENCES montelo(id_montelou),
    FOREIGN KEY (marka) REFERENCES etairia(id_etairias));

CREATE TABLE pelates(
    afm_pelath VARCHAR(9) PRIMARY KEY,
    onoma VARCHAR(30) NOT NULL,
    epwnumo VARCHAR(30) NOT NULL,
    email VARCHAR(254), NOT NULL,
    thlefwno1 CHAR(10) UNIQUE NOT NULL,
    thlefwno2 CHAR(10));

CREATE TABLE upallhloi(
    id_upallhlou CHAR(4) PRIMARY KEY,
    onoma VARCHAR(20) NOT NULL,
    epwnumo VARCHAR(20) NOT NULL,
    thlefwno1 CHAR(10) UNIQUE NOT NULL,
    thlefwno2 CHAR(10),
    hm_proslhpshs DATE NOT NULL,
    idikothta VARCHAR(30), NOT NULL --poliths, mhxanikos, manager, klp
    );

CREATE TABLE poliseis(
    id_polishs CHAR(17) PRIMARY KEY,
    hm_ago DATE NOT NULL,
    timh DECIMAL(11,2) NOT NULL,
    id_autonikhtou CHAR(17) UNIQUE NOT NULL,
    afm_pelath CHAR(8) NOT NULL,
    id_upallhlou CHAR(3) NOT NULL,
    FOREIGN KEY (id_autonikhtou) REFERENCES autokinhto(id_autonikhtou),
    FOREIGN KEY (afm_pelath) REFERENCES pelates(afm_pelath),
    FOREIGN KEY (id_upallhlou) REFERENCES upallhloi(id_upallhlou));

CREATE TABLE syntirish(
    id_suntirishs CHAR(17) PRIMARY KEY,
    hm_rant DATE NOT NULL,
    perigrafi TEXT NOT NULL,
    id_upallhlou CHAR(3),
    pinakida_kukloforias VARCHAR(8), --morfh: AAA-1234
    FOREIGN KEY (id_upallhlou) REFERENCES upallhloi(id_upallhlou));

CREATE TABLE login( 
    username VARCHAR(20) PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    admin ENUM('True', 'False'));
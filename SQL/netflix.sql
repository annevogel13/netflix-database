/*  https://bdw1.univ-lyon1.fr/phpmyadmin/index.php  
 id : p1905532
 ww : Shrill87Pebble
 */
CREATE TABLE Categorie (
    catId int NOT NULL,
    nomCat VARCHAR (250) NOT NULL,
    PRIMARY KEY (catId)
);
INSERT INTO Categorie (catId, nomCat)
VALUES (1, 'fantasy');
INSERT INTO Categorie (catId, nomCat)
VALUES (2, 'comedy');
INSERT INTO Categorie (catId, nomCat)
VALUES(3, 'dramas');

/*************************************************************************/


CREATE TABLE Photo (
    photoId int NOT NULL,
    nomFich VARCHAR (250) NOT NULL,
    description VARCHAR(250) NOT NULL,
    catId int NOT NULL, 
    PRIMARY KEY (photoId),
    FOREIGN KEY (catId) REFERENCES Categorie(catId)
);
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        999,
        'lucifer.jpg',
        'The series revolves around the story of Lucifer Morningstar (Tom Ellis), the Devil, who abandons Hell for Los Angeles where he runs his own nightclub named LUX and becomes a consultant to the LAPD.',
        1
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        998,
        'winx_sage.jpg',
        'The Winx Saga is a teen drama series based on the Nickelodeon animated series Winx Club',
        1
    );

CREATE TABLE Categorie  (catId DECIMAL(3),
                        nomCat VARCHAR (250),
                        PRIMARY KEY (catId));


INSERT INTO Categorie (001, 'fantasy');
INSERT INTO Categorie (002, 'comedy'); 
INSERT INTO Categorie (003, 'dramas'); 

CREATE TABLE Photo  (photoId DECIMAL(3),
                    nomFich VARCHAR (250),
                    description VARCHAR(250),
                    PRIMARY KEY (photoId), 
                    FOREIGN KEY (catId) REFERENCES Categorie(catId)); 

INSERT INTO Photo (999, 'lucifer.jpg', 'The series revolves around the story of Lucifer Morningstar (Tom Ellis), the Devil, who abandons Hell for Los Angeles where he runs his own nightclub named 'LUX' and becomes a consultant to the LAPD.');
INSERT INTO Photo (998, 'winx_sage.jpg', 'The Winx Saga is a teen drama series based on the Nickelodeon animated series Winx Club'); 
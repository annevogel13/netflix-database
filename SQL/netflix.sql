/*  https://bdw1.univ-lyon1.fr/phpmyadmin/index.php  
 id : p1905532
 ww : Shrill87Pebble
 */
CREATE TABLE Categorie (
    catId int NOT NULL,
    nomCat VARCHAR (250) NOT NULL,
    PRIMARY KEY (catId)
);

/** ici on peut inserer d es categoreis 
    le catId c'est une numero que on choisi ;-) 
**/
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

/* de meme pour les photos. 
    photoId = numero qu'on choissi
    nomFich = le nom du fichier avec le .jpeg ou .png <-- tres important --> 
    !!!! si tu trouve le photo tu le mets directement dans le /images avec le nom comme nomFich !!!
    description = une phase (moi j'ai mis les description des netflix)
    catId = est le numero qui correponds au categorie 
*/
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        999,
        'lucifer.jpg',
        'Lassé d’être le Seigneur des Enfers, le diable s’installe à Los Angeles où il ouvre un nightclub et se lie avec une policière de la brigade criminelle.',
        1
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        998,
        'winx_sage.jpg',
        'À Alféa, un internat magique, des amies déterminées à maîtriser leurs pouvoirs poursuivent leurs études sur le surnaturel tout en découvrant les rivalités et l amour.',
        1
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        997,
        'Friends.jpg',
        'Les aventures de six amis à New York. Entre amour, travail et famille, Monica, Rachel, Ross, Phoebe, Joey et Chandler aiment se retrouver pour partager leurs bonheurs, leurs soucis et se raconter leurs péripéties au Central Perk, leur café favori.',
        2
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        996,
        'Gilmore_Girls.jpg',
        'Lorelai, mère célibataire très indépendante et pleine d esprit, élève sa fille surdouée Rory pour la faire entrer dans l une des meilleures universités.',
        2
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        995,
        'Emily_in_Paris.jpg',
        'Quand elle décroche le boulot de ses rêves à Paris, Emily, jeune cadre ambitieuse de Chicago, adopte une nouvelle vie tout en jonglant entre marketing, amis et amours.',
        2
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        994,
        'Sweet_Magnolias.jpg',
        'Amies depuis toujours, Maddie, Helen et Dana Sue s épaulent alors qu elles essaient de concilier couple, famille et carrière dans une petite ville du Sud des États-Unis.',
        2
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        993,
        'How_i_met.jpg',
        'Ted Mosby raconte à ses enfants la suite d événements qui l a conduit à rencontrer leur mère. Entouré de sa bande d amis, il a vécu bon nombre de situations comiques au cours de sa recherche du grand amour.',
        2
    ); 
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        992,
        'Riverdale.jpg',
        'Naviguant dans les eaux troubles du sexe, de l amour, de l éducation et de la famille, Archie et ses amis se retrouvent plongés au cœur d une mystérieuse affaire.',
        1
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        991,
        'The_Good_Place.jpg',
        'À sa mort, l égocentrique Eleanor Shellstrop se retrouve par erreur dans un monde paradisiaque. Déterminée à y rester, elle va tenter de devenir une meilleure personne.',
        1
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        990,
        '13_RW.jpg',
        'Le jeune Clay Jensen se retrouve au centre d une série de secrets déchirants qui prennent un tour tragique après le suicide d une camarade de classe.',
        3
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        989,
        'Elite.jpg',
        'Lorsque trois ados issus de la classe ouvrière accèdent à une école élitiste d Espagne, le fossé qui les sépare des élèves fortunés conduit à la pire des tragédies.',
        3
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        988,
        'Gossip_Girl.jpg',
        'La vie, les amours et les malheurs d un groupe d étudiants privilégiés appartenant aux sphères huppées de l Upper East Side, à Manhattan. Deux inséparables amies Blair et Serena et leurs amis, vivent au rythme des commentaires de la mystérieuse Gossip Girl, qui colporte les derniers potins sur son blog.',
        3
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        987,
        'Lupin.jpg',
        'Inspiré par les aventures d Arsène Lupin, le gentleman cambrioleur Assane Diop décide de venger son père d une terrible injustice.',
        3
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        986,
        'Outer_Banks.jpg',
        'Sur une île où les inégalités sont accentuées, John B recrute ses trois meilleurs amis pour partir à la recherche d un trésor légendaire lié à la disparition de son père.',
        3
    );
INSERT INTO Photo (photoId, nomFich, description, catId)
VALUES (
        985,
        'La_Casa_de_Papel.jpg',
        'Huit voleurs font une prise d otages dans la Maison royale de la Monnaie d Espagne, tandis qu un génie du crime manipule la police pour mettre son plan à exécution.',
        3
    );







function valeurDropDown(){
    const c = document.getElementById("categorie").value; 
    console.log(c)
    // apres on peut faire une if 
    // qui tri selon les categorie selectionnées dans le "dropdown"

    // compter le numero de photo affichees 
    const quantite = 10 ; 
    document.getElementById("greenbox").innerText = quantite + " photo(s) selectionée(s)"; 
    console.log("done valuerDropDown() ")
}

function passInformation(){
    console.log(test); 
}

function ajoutePhotoDatabase(){

    const fichier = document.getElementById("fichier").value // is een path 
    const description = document.getElementById("description").value
    const categorie = document.getElementById("categorieAjoutePhoto").value
    
    // if error --> rand van de input moeten rood worden  !!!

    if(description.length < 1 || description == " "){ // works 
        console.log("error  description")
    
    }

    if(categorie == "none"){ // works 
        console.log("error categorie")
    }

    if(fichier == undefined || fichier == null){
        console.log("error fichier")
    }

    

    console.log("ajoute photo aux database");
}


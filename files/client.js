



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



// esayer de generere une photo specifique page 

// stap 1 : generale page for a image 
// stap 2 : onclick function met essentiele waardes van de foto 
// stap 3 : essentiele waardes worden in de pagina geimplementeerd 

function genererPage(photoId, nomFich, description, catId){
   // location.href = "https://bdw1.univ-lyon1.fr/p1905532/bdw1/files/specificImage.html";
   // document.getElementById("test").innerHTML = "HALLLLLLLLL0"; 

    console.log("console : "+photoId + ' '+ nomFich + ' '+ description + ' ' + catId+ ' '); 

}
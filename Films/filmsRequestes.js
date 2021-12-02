function lister(){

	var formFilm = new FormData();
	formFilm.append('action','lister');
    $.ajax({
        type : 'POST',
		url : 'Films/filmsControleur.php',
		data : formFilm,//{action:'lister'}
		contentType : false,
		processData : false,
		dataType : 'json', //text pour le voir en format de string
		success : function (reponse){
            filmsVue(reponse);
		},
		fail : function (err){
  
		} 
    });   
 
}

function deleteR(idFilm){
	var formFilm = new FormData();
	formFilm.append('action','delete');
	formFilm.append('idFilm',idFilm);
    $.ajax({
        type : 'POST',
		url : 'Films/filmsControleur.php',
		data : formFilm,//{action:'lister'}
		contentType : false,
		processData : false,
		dataType : 'json', //text pour le voir en format de string
		success : function (reponse){
			
            filmsVue(reponse);
		},
		fail : function (err){
		
		} 
    });   
 
}


function ajouter(){
	
}
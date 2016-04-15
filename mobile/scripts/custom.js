/**
** Fichier : custom.js
** Date de dernière modification : 28/03/2012
** Auteur  : Charles <charles at charlesen.fr>
**/

//Configuration de l'application

$(document).bind("mobileinit", function(){
	//$.mobile.ajaxEnabled = false;//Désactive Ajax dans l'application
	//$.mobible.allowCrossDomainPages = true;
	//$.mobible.autoInitializePage = false;
	$.mobile.defaultPageTransition = "slide";
	$.mobile.loadingMessage = "Chargement...";
	$.mobile.loadingMessageTextVisible = true;
	$.mobile.pageLoadErrorMessage = "Oups ! Erreur de chargement.";
});


// Gestion des évènements

$('div').bind("scrollstart", function(){
	alert("Le scrolling c'est classe ...");
});

$(document).bind("pagebeforechange", function(event, data) {
	//console.log('Chargement de ' + data.toPage.find('h1').text());
});

$( 'div' ).live( 'pageshow',function(event, data){
  console.log( 'Le contenu de  "'+ data.prevPage.find('h1').text() + '" vient juste de disparaitre');
});

$( 'div' ).live( 'pagehide',function(event, data){
  console.log( 'Le contenu de  "'+ data.nextPage.find('h1').text() + '" vient juste d\'apparaitre');
});
$(document).ready(function(){
   timer = setInterval('next();',3000);
   $(".slider").mouseover(function(){stop()});
   $(".slider").mouseout(function(){play()});
   /*Initialisation des variables*/
   nbSlide = $(".slider .img li").length;
   current = 1;
   
   /*La fonction qui perrmet d afficher un slide precis sli*/
   gotoSlide = function(sli){
       slide = sli;
       if(slide == current) return false;
       slide --;
       $(".slider .img li").fadeOut();
       $(".slider .img li:eq("+slide+")").fadeIn();
       $(".slider .paginator li").removeClass("active");
       $(".slider .paginator li:eq("+slide+")").addClass("active");
       current = slide+1;
   };
   
   /*fonction qui affiche le slide suivant*/
   next = function(){
       numSlide = current + 1;
       if(numSlide > nbSlide)   numSlide = 1;
       gotoSlide(numSlide);
   }
   
   /*fonction qui affiche le slide precedent*/
   prev = function(){
       numSlide = current - 1;
       if(numSlide < 1)   numSlide = nbSlide;
       gotoSlide(numSlide);
   }
   
   /*fonction qui stop le slider*/
   stop = function(){
       window.clearInterval(timer);
   }
   
   /*fonction qui lance le slider*/
   play = function(){
       timer = setInterval('next();',3000);
   }
   
   /*Afficher le premier slider*/
   $(".slider .img li").hide();
   $(".slider .img li:first").show();

   /*Gestion de la pagination*/
   $(".slider").append('<ul class="paginator"></ul>');
   for(var i=1; i<=nbSlide; i++){
       $(".slider .paginator").append('<li>'+i+'</li>')
   }
   $(".slider .paginator li:first").addClass("active");

   /*Gestion du click sur la pagination(choix d un slide)*/
   $(".slider .paginator li").click(function(){
       gotoSlide($(this).text());
   });
   

   
});


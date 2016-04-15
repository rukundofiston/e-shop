$(document).ready(function(){
	$("#all h1").live("click", function(){
		$("#all h1 + .para").slideToggle(300);
	});
	$("#leftSide h1").live("click", function(){
		$("#leftSide h1 + .para").slideToggle(300);
	});
	$("#rightSide h1").live("click", function(){
		$("#rightSide h1 + .para").slideToggle(300);
	});

	$("#params #gear").toggle(function() {
  		$("#params p").animate({width: '200px'}, 300);
  		$("#params").animate({right: '195px'}, 300);
	}, function() {
  		$("#params p").animate({width: '0'}, 300);
		$("#params").animate({right: '0'}, 300);
	});

	$("#params p img").live("click", function(){
		if($(this).attr("class") == "corps"){
			$("#conteneur").css('background',$(this).attr('href'));
		}else if($(this).attr("class") == "header"){
			$("header").css('background',$(this).attr('href'));
		}
	});
});
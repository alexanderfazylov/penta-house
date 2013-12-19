/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    // Common
    $(window).resize();

    $(".header").width(function(){
        return $(".first-col").width()+2;
    });

    //$( "#logo" ).animate( { opacity:"1" }, 1500);

    // Index page
    //$(".banner").click( function(){window.location.href = '/dornbracht/horizontal-shower.html';});
    
    // About
    $(".about").width(function(){
        return $(".first-col").width()*3;
    });
});

$(window).resize(function(){

    // Hide-show last column
    if($(window).width()<1200){
        $(".last-col").hide();
        $(".header").css( "min-width", "240px");
        $("table.content td").css( "width", $(window).width()/5);
    } else {
        $(".last-col").show();
        $(".header").css( "min-width", "200px");
        $("table.content td").css( "width", $(window).width()/6);
    }
    
    $(".about").css( "width", "100%");
    
    // Header width
    $(".header").css( "width", function(index){
        return $("table.content td").width()+2;
    });
});

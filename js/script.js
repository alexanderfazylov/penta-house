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

    // Index page
    //$(".banner").click( function(){window.location.href = '/dornbracht/horizontal-shower.html';});
    
    // About
    $(".about").width(function(){
        return $(".first-col").width()*3;
    });
});

$(window).resize(function(){
    $("table.content td").css( "width", $(window).width()/6);
    $(".about").css( "width", "100%");
    
    // Header width
    $(".header").css( "width", function(index){
        return $("table.content td").width()+2;
    });
});

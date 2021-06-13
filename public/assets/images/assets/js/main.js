$('.menu-toggle').click(function() {
       
    // $("nav").slideToggle("1000"); 
    $('nav').toggleClass('opening');
    
    $(this).toggleClass('nav');
       
  })
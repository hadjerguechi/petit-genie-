$('.menu-toggle').click(function() {
       
    // $("nav").slideToggle("1000"); 
    $('nav').toggleClass('opening');
    
    $(this).toggleClass('nav');
       
  })

  //#################### DETECTER LE SCROLL TOP ######################
var scrollTopBtn = document.getElementById("scroll_to_top"); 
var rootElement = document.documentElement;

//Ajout d'un évenement d'écoute de click au bouton
function handleScroll() {
    // Nombre total de pixel que nous pouvons faire défiler
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if ((rootElement.scrollTop / scrollTotal ) > 0.20 ) {
        // Show button
        scrollTopBtn.classList.add("show-scroll")
      } else {
        // Hide button
        scrollTopBtn.classList.remove("show-scroll");
      }
}

document.addEventListener("scroll", handleScroll);

//#################### FIN DETECTER LE SCROLL TOP ######################
// SIDEBAR
window.onload = (function () {
    var sidebar = document.getElementById('sidebar');
    var sidebarOverlay = document.getElementsByClassName('sidebar-overlay')[0];
    var container = document.getElementsByClassName('container')[0];
    var sidebarBtnClose = document.getElementById('sidebarBtnClose');
    var sidebarBtnOpen = document.getElementById('sidebarBtnOpen');

    var openSidebar = function () {
        sidebarOverlay.style.left = '0';
        sidebar.style.left = '0';
    }

    var closeSidebar = function (e) {
        e.cancelBubble = true;
        sidebarOverlay.style.left = '-100%';
        sidebar.style.left = '-100%';
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
    if (sidebarBtnClose) {
        sidebarBtnClose.addEventListener('click', closeSidebar);
    }
    if (sidebarBtnOpen) {
        sidebarBtnOpen.addEventListener('click', openSidebar);
    }
})()

//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


// Search
var ismobile = navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i) != null
var touchorclick = (ismobile) ? 'touchstart' : 'click'
var searchcontainer = document.getElementById('searchcontainer')
var searchfield = document.getElementById('search-terms')
var searchlabel = document.getElementById('search-label')
var closeSearch = document.getElementById('closeSearch')

//  searchlabel.addEventListener(touchorclick, function (e) { // when user clicks on search label
//     searchcontainer.classList.toggle('opensearch') // add or remove 'opensearch' to searchcontainer
//     if (!searchcontainer.classList.contains('opensearch')) { // if hiding searchcontainer
//         searchfield.blur() // blur search field
//         e.preventDefault() // prevent default label behavior of focusing on search field again
//     }
//     e.stopPropagation() // stop event from bubbling upwards
// }, false)

// closeSearch.addEventListener(touchorclick, function (e) { // when user clicks anywhere in document
//     searchcontainer.classList.remove('opensearch')
// }, false)



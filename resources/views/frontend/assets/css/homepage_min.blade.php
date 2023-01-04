<style>
    /*! CSS Used from: Embedded */
*,::after,::before{box-sizing:border-box;}
body{margin:0;font-family:var(--bs-font-sans-serif);font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent;}
[tabindex="-1"]:focus:not(:focus-visible){outline:0!important;}
h2{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;}
h2{font-size:calc(1.325rem + .9vw);}
@media (min-width:1200px){
h2{font-size:2rem;}
}
p{margin-top:0;margin-bottom:1rem;}
ul{padding-left:2rem;}
ul{margin-top:0;margin-bottom:1rem;}
ul ul{margin-bottom:0;}
a:hover{color:#0a58ca;}
figure{margin:0 0 1rem;}
img,svg{vertical-align:middle;}
button{border-radius:0;}
button:focus{outline:dotted 1px;outline:-webkit-focus-ring-color auto 5px;}
button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button{text-transform:none;}
[type=button],button{-webkit-appearance:button;}
::-moz-focus-inner{padding:0;border-style:none;}
.img-fluid{max-width:100%;height:auto;}
.container{width:100%;padding-right:var(--bs-gutter-x,.75rem);padding-left:var(--bs-gutter-x,.75rem);margin-right:auto;margin-left:auto;}
@media (min-width:576px){
.container{max-width:540px;}
}
@media (min-width:768px){
.container{max-width:720px;}
}
@media (min-width:992px){
.container{max-width:960px;}
}
@media (min-width:1200px){
.container{max-width:1140px;}
}
@media (min-width:1400px){
.container{max-width:1320px;}
}
.row{--bs-gutter-x:1.5rem;--bs-gutter-y:0;display:flex;flex-wrap:wrap;margin-top:calc(var(--bs-gutter-y) * -1);margin-right:calc(var(--bs-gutter-x)/ -2);margin-left:calc(var(--bs-gutter-x)/ -2);}
.row>*{flex-shrink:0;width:100%;max-width:100%;padding-right:calc(var(--bs-gutter-x)/ 2);padding-left:calc(var(--bs-gutter-x)/ 2);margin-top:var(--bs-gutter-y);}
.col-4{flex:0 0 auto;width:33.3333333333%;}
.col-8{flex:0 0 auto;width:66.6666666667%;}
.col-12{flex:0 0 auto;width:100%;}
@media (min-width:768px){
.col-md-4{flex:0 0 auto;width:33.3333333333%;}
.col-md-6{flex:0 0 auto;width:50%;}
}
@media (min-width:992px){
.col-lg-4{flex:0 0 auto;width:33.3333333333%;}
.col-lg-6{flex:0 0 auto;width:50%;}
.col-lg-8{flex:0 0 auto;width:66.6666666667%;}
.col-lg-12{flex:0 0 auto;width:100%;}
}
@media (min-width:1200px){
.col-xl-6{flex:0 0 auto;width:50%;}
}
.form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.form-control{transition:none;}
}
.form-control:focus{color:#212529;background-color:#fff;border-color:#86b7fe;outline:0;box-shadow:0 0 0 .25rem rgba(13,110,253,.25);}
.form-control::-webkit-input-placeholder{color:#6c757d;opacity:1;}
.form-control::-moz-placeholder{color:#6c757d;opacity:1;}
.form-control::placeholder{color:#6c757d;opacity:1;}
.form-control:disabled{background-color:#e9ecef;opacity:1;}
.btn{display:inline-block;font-weight:400;line-height:1.5;color:#212529;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.btn{transition:none;}
}
.btn:hover{color:#212529;}
.btn:focus{outline:0;box-shadow:0 0 0 .25rem rgba(13,110,253,.25);}
.btn:disabled{pointer-events:none;opacity:.65;}
.btn-info{color:#000;background-color:#0dcaf0;border-color:#0dcaf0;}
.btn-info:hover{color:#000;background-color:#31d2f2;border-color:#25cff2;}
.btn-info:focus{color:#000;background-color:#31d2f2;border-color:#25cff2;box-shadow:0 0 0 .25rem rgba(11,172,204,.5);}
.btn-info:active{color:#000;background-color:#3dd5f3;border-color:#25cff2;}
.btn-info:active:focus{box-shadow:0 0 0 .25rem rgba(11,172,204,.5);}
.btn-info:disabled{color:#000;background-color:#0dcaf0;border-color:#0dcaf0;}
.btn-sm{padding:.25rem .5rem;font-size:.875rem;border-radius:.2rem;}
.collapse:not(.show){display:none;}
.nav-link{display:block;padding:.5rem 1rem;text-decoration:none;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.nav-link{transition:none;}
}
.navbar{position:relative;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;padding-top:.5rem;padding-bottom:.5rem;}
.navbar>.container{display:flex;flex-wrap:inherit;align-items:center;justify-content:space-between;}
.navbar-brand{padding-top:.3125rem;padding-bottom:.3125rem;margin-right:1rem;font-size:1.25rem;text-decoration:none;white-space:nowrap;}
.navbar-nav{display:flex;flex-direction:column;padding-left:0;margin-bottom:0;list-style:none;}
.navbar-nav .nav-link{padding-right:0;padding-left:0;}
.navbar-collapse{align-items:center;width:100%;}
.navbar-toggler{padding:.25rem .75rem;font-size:1.25rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:.25rem;transition:box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.navbar-toggler{transition:none;}
}
.navbar-toggler:hover{text-decoration:none;}
.navbar-toggler:focus{text-decoration:none;outline:0;box-shadow:0 0 0 .25rem;}
.navbar-toggler-icon{display:inline-block;width:1.5em;height:1.5em;vertical-align:middle;background-repeat:no-repeat;background-position:center;background-size:100%;}
@media (min-width:992px){
.navbar-expand-lg{flex-wrap:nowrap;justify-content:flex-start;}
.navbar-expand-lg .navbar-nav{flex-direction:row;}
.navbar-expand-lg .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem;}
.navbar-expand-lg .navbar-collapse{display:flex!important;}
.navbar-expand-lg .navbar-toggler{display:none;}
}
.d-block{display:block!important;}
.d-flex{display:flex!important;}
.d-none{display:none!important;}
.justify-content-end{justify-content:flex-end!important;}
.m-0{margin:0!important;}
.m-2{margin:.5rem!important;}
.mx-auto{margin-right:auto!important;margin-left:auto!important;}
.my-4{margin-top:1.5rem!important;margin-bottom:1.5rem!important;}
.mt-3{margin-top:1rem!important;}
.mt-4{margin-top:1.5rem!important;}
.mb-4{margin-bottom:1.5rem!important;}
.pt-3{padding-top:1rem!important;}
.pb-3{padding-bottom:1rem!important;}
.text-uppercase{text-transform:uppercase!important;}
.text-center{text-align:center!important;}
.text-white{color:#fff!important;}
@media (min-width:992px){
.d-lg-block{display:block!important;}
.pt-lg-0{padding-top:0!important;}
}
/*! CSS Used from: Embedded */
.fa-solid{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:var(--fa-display,inline-block);font-style:normal;font-variant:normal;line-height:1;text-rendering:auto;}
.fa-align-left:before{content:"\f036";}
.fa-arrow-up:before{content:"\f062";}
.fa-magnifying-glass:before{content:"\f002";}
.fa-caret-down:before{content:"\f0d7";}
.fa-xmark:before{content:"\f00d";}
.fa-solid{font-family:"Font Awesome 6 Free";font-weight:900;}
/*! CSS Used from: Embedded */
body a{color:#454545;}
p{text-align:justify!important;}
.fa-magnifying-glass{padding-top:5px;}
@media (max-width:820px){
.fa-magnifying-glass{padding-top:15px;}
}
#glider .splide__pagination,#myBtn,#search-container{display:none;}
#search-container form{display:flex;gap:10px;padding-top:10px;}
.close-search{padding-top:5px;font-weight:400;font-size:20px;}
.navbar-nav .nav-item{position:relative;text-transform:uppercase;}
.dropdown-mobile,.navbar-nav .dropdown-list{display:none;list-style:none;}
.display-menu,.navbar-nav .nav-link:hover>ul{display:block;}
.parent:hover>.fa-caret-down,.rotate-icon{transform:rotate(90deg);}
.navbar-nav .dropdown-list{position:absolute;background:#3a3b3c;top:90%;left:0;border-radius:0 0 7px 7px;min-width:300px;padding:20px 0;}
.navbar-nav .dropdown-list li{float:none;padding:15px 10px;}
.links,.navbar-nav .dropdown-list li a{color:#fff;}
.nav-item:active,.nav-item:hover{background:0 0!important;}
::-moz-selection{background:#012835;color:#d2d2d4;}
::selection{background:#012835;color:#d2d2d4;}
.meta{margin:0;}
body{font-family:Helvetica, Sans-serif;letter-spacing:.3px;}
.meta{padding:0;text-align:right;display:block;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;}
.article-author a:hover{color:#00a6ff;}
@media (max-width:720px){
#navScroll-btn{display:none;}
}
.footer-section{background:#151414;}
.footer-section ul{margin:0 35px 0 0;padding:0;list-style:none;display:flex;flex-direction:row;color:#d2d2d4;font-size:13px;}
.footer-section li a{color:#d4d4d2;}
.footer-section .footer-content{padding:0 35px;position:relative;z-index:2;}
.footer-section .footer-logo h2 a{color:#b0aeae!important;font-size:24px;text-transform:uppercase;letter-spacing:5px;}
.footer-section .footer-social-icon{text-align:right!important;}
.footer-section .copyright-text p{margin:0;font-style:italic;font-size:12px;color:#d2d2d2;}
.footer-section .copyright-text p a,.navbar #sidebar .menu li a:hover,.navbar #sidebar .sub-menu li a:hover{color:#fff!important;}
.footer-section ul li{margin-right:15px;}
a{text-decoration:none!important;}
.container{max-width:1200px;}
.adver{margin-top:20px;margin-bottom:20px;}
main{padding-bottom:50px;}
.category-segment{color:#fff;border-bottom:3px solid #1e2129;margin:0;}
.category-segment span{background-color:#1e2129;border-top-left-radius:3px;border-top-right-radius:3px;font-size:18px;padding:7px 10px 4px;margin:0;}
.heading{font-weight:400!important;text-transform:uppercase;}
.load .btn{color:#313131!important;}
.heading{font-size:16px!important;}
.load .btn{font-size:16px;font-weight:400;line-height:12px!important;border:1px solid #888!important;border-radius:5px!important;padding:15px 30px;-webkit-transition:.2s;transition:.2s;}
.load .btn:hover{background:#505050!important;border:1px solid #505050!important;border-radius:5px;color:#fff!important;}
header{position:-webkit-sticky;position:sticky;background-color:#fff;top:0;z-index:87;}
header .navbar{height:70px;padding:0;background-color:#242526;}
.article-author,.article-author a,.article-date{color:#555657;font-weight:700;padding:5px 0;font-size:11px;}
header .navbar .brand-logo{padding:0;font-size:20px;font-weight:600;text-transform:uppercase;letter-spacing:3px;color:#2f3846;margin-left:20px;}
header .navbar .navbar-brand{padding:0;font-size:26px;line-height:200%;font-weight:500;color:#d4d2d2!important;align-items:center;text-align:center;text-transform:uppercase;letter-spacing:3px;transition:.3s;}
@media (max-width:820px){
p{text-align:left!important;}
.navbar-brand{padding:10px 0 0 0!important;margin:0!important;}
header .navbar .navbar-brand{padding:0;font-size:26px;line-height:125%;font-weight:500;color:#d4d2d2!important;align-items:center;text-align:center;text-transform:uppercase;letter-spacing:3px;transition:.3s;}
}
header .navbar .navbar-brand:hover{font-weight:500;color:#878787!important;text-transform:uppercase;letter-spacing:3px;}
header .navbar .navbar-brand img{width:130px;height:auto;}
header .navbar .navbar-nav .nav-item{padding:0 .5rem;}
header .navbar .navbar-nav .nav-item .nav-link{font-size:15px!important;font-weight:700!important;line-height:20px!important;color:#d4d2d2!important;letter-spacing:1px;position:relative;}
header .navbar .navbar-nav .nav-item .active,header .navbar .navbar-nav .nav-item .nav-link:hover{background-color:#3a3b3c;border-radius:5px;}
@media (max-width:720px){
.navbar-brand{line-height:200%;}
}
.article-date{display:inline-block;margin:0;}
.article-author,.article-author a{margin:0;display:inline;}
@media (max-width:992px){
.navbar-brand{-webkit-transform:translateX(-50%);transform:translateX(-50%);left:50%;top:-4px;position:absolute;}
}
#myBtn{position:fixed;bottom:20px;right:30px;z-index:99;border:none;outline:0;background-color:#878787!important;color:#fff;cursor:pointer;padding:1rem;border-radius:50px;width:50px;height:50px;-webkit-transition:.2s;transition:.2s;}
#myBtn i{font-size:18px;}
#myBtn:hover{background-color:#888!important;}
.search{color:#fff;cursor:pointer;}
.search #search-label{font-size:20px;cursor:pointer;color:#fff;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;z-index:100;}
input{z-index:130;}
.navbar #sidebar,.sidebar-overlay{top:0;left:-100%;position:fixed;width:100%;}
.navbar #sidebar{background-color:#2a2726!important;color:#fff!important;height:100vh;margin:0;z-index:100;overflow-y:auto;-webkit-transition:.2s cubic-bezier(.17, .67, .83, .67);transition:.2s cubic-bezier(.17, .67, .83, .67);}
.menu-icon,.menu-icon:hover{margin-right:15px;transition:.3s;font-size:29px;}
.menu-icon{color:#d4d2d2;}
.menu-icon:hover{color:#878787;}
.navbar #sidebar .sidebar__btn-close{cursor:pointer;text-align:center;font-size:29px;margin-top:10px;margin-right:10px;margin-left:10px;width:15%;line-height:60px;height:45px;}
.navbar #sidebar .menu,.navbar #sidebar .sub-menu{list-style:none;margin:0;padding:0;}
.navbar #sidebar .menu li{padding:5px;border-bottom:1px solid #fff!important;}
.navbar #sidebar .menu li:hover,.navbar #sidebar .sub-menu li:hover{background-color:#020739;}
.navbar #sidebar .menu li a,.navbar #sidebar .sub-menu li a{color:#fff;-webkit-transition:.2s;transition:.2s;text-transform:uppercase;}
.navbar #sidebar .sub-menu li{padding:5px;border-bottom:1px solid #a9aaac;}
.navbar .btn-menu{border:none;border-radius:5px;color:transparent;cursor:pointer;outline:0;padding-left:0;-webkit-animation:2s fadein;animation:2s fadein;}
.side-links{font-size:20px;padding-bottom:10px;}
.sidebar-overlay{background:rgba(0, 0, 0, .5);height:100%;z-index:86;}
@media (min-width:992px){
.navbar #sidebar{width:20%;position:fixed;left:-100%;top:0;}
}
/*! CSS Used from: Embedded */
#glider{width:100%;background-color:#ededed4d;}
#glider .splide__slide{margin-top:25px;}
#glider .splide__slide .slider-image{position:relative;margin:0;}
#glider .splide__slide .slider-image .title-section{display:flex;flex-direction:column;justify-content:space-between;}
#glider .splide__slide .slider-image .slider-title{flex:1;margin:0;width:100%;padding:5px;font-size:15px;font-weight:600;hyphens:auto;display:-webkit-box;overflow:hidden;-webkit-line-clamp:1;-webkit-box-orient:vertical;}
#glider .splide__slide .slider-image-img{border-radius:6px;margin:0;max-width:100%;height:auto;}
#glider .splide__slide .slider-image .slider-category{position:absolute;top:0;right:0;background:rgb(28, 28, 30, .7);border-bottom-left-radius:5px;border-top-right-radius:6px;color:#fff;font-weight:700;padding:5px;font-size:13px;}
.splide__list{margin:0!important;padding:0!important;width:-webkit-max-content;width:max-content;will-change:transform;}
.splide.is-active .splide__list{display:flex;}
.splide__pagination{display:inline-flex;align-items:center;width:95%;flex-wrap:wrap;justify-content:center;margin:0;}
.splide__pagination li{list-style-type:none;display:inline-block;line-height:1;margin:0;}
.splide{visibility:hidden;}
.splide,.splide__slide{position:relative;outline:0;}
.splide__slide{box-sizing:border-box;list-style-type:none!important;margin:0;flex-shrink:0;}
.splide__slide img{vertical-align:bottom;}
.splide__track{position:relative;z-index:0;overflow:hidden;}
.splide__arrow,.splide__pagination{z-index:1;position:absolute;padding:0;}
.splide--draggable>.splide__track>.splide__list>.splide__slide{-webkit-user-select:none;user-select:none;}
.splide__arrow:hover,.splide__pagination__page:hover{opacity:1;cursor:pointer;}
.splide__arrow svg{width:1.2em;height:1.2em;}
.splide__arrow:focus{outline:0;}
.splide__arrow--prev{left:1em;}
.splide__arrow--prev svg{transform:scaleX(-1);}
.splide__arrow--next{right:1em;}
.splide__pagination{bottom:.5em;left:50%;transform:translateX(-50%);}
.splide__pagination__page{display:inline-block;width:8px;height:8px;background:#ccc;border-radius:50%;margin:3px;padding:0;transition:transform .2s linear;border:none;opacity:.7;}
.splide__pagination__page.is-active{transform:scale(1.4);background:#fff;}
.splide__pagination__page:focus{outline:0;}
@media (max-width:992px){
#glider .splide__arrows .splide__arrow--prev{left:1em;}
#glider .splide__arrows .splide__arrow--next{right:1em;}
}
.biography-right .image_img,.image_img{min-width:100%;object-fit:cover;object-position:top;border-radius:15px;}
.outer-section{border:1px solid rgba(182, 178, 178, .5);box-shadow:1px 1px rgba(202, 199, 199, .6);margin:10px 0;border-radius:6px;background-color:rgba(237, 237, 237, .3);}
.biography-left .biography-single .image_img,.trending-single .image_img{max-height:70px;min-height:70px;border-radius:5px;min-width:100%;object-fit:cover;object-position:top;}
.biography-left,.trending{margin:0;padding:0;}
.trending-single{margin-bottom:15px;display:flex;}
.trending-single .image{width:30%;height:30%;margin-right:10px;}
.biography-left .biography-single .biography-title,.trending-single .trending-title{width:65%;max-height:70px;min-height:70px;display:flex!important;flex-direction:column!important;justify-content:space-between;flex:1;}
.biography-left .biography-single .biography-title h2,.trending-single .trending-title h2{font-size:15px;font-weight:600;display:-webkit-box;overflow:hidden;-webkit-line-clamp:2;-webkit-box-orient:vertical;}
.biography-left .biography-single{margin-bottom:15px;padding-left:12px;max-height:70px;min-height:70px;display:flex;}
.image_overlay .image_description,.textover figcaption{display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;color:#fff;}
.biography-single .image{width:30%;margin-right:10px;overflow:hidden;}
.biography-right .image_img{min-height:240px;max-height:240px;}
.textover{position:relative;margin-left:0;}
.image_overlay,.textover figcaption{position:absolute;left:0;width:100%;}
.textover figcaption{bottom:0;padding:10px 15px;background-color:rgba(0, 0, 0, .8);border-bottom-left-radius:15px;border-bottom-right-radius:15px;-webkit-line-clamp:2;}
.image_overlay{top:0;height:100%;background:rgba(0, 0, 0, .75);opacity:0;transition:opacity .5s;backdrop-filter:blur(5px);border-radius:15px;}
.image_overlay:hover{opacity:1;}
.image_overlay>*{transform:translate(20px);transition:transform .5s;}
.image_overlay:hover>*{transform:translate(0);}
.image_overlay .image_description{font-size:18px;padding:10px 10px 0;justify-content:center;border-bottom:15px;-webkit-line-clamp:6;}
.image_img{max-height:230px;min-height:230px;}
@media (max-width:820px){
.biography-right{display:none;}
}
/*! CSS Used from: Embedded */
.splide__list{margin:0!important;padding:0!important;width:-webkit-max-content;width:max-content;will-change:transform;}
.splide.is-active .splide__list{display:flex;}
.splide__pagination{display:inline-flex;align-items:center;width:95%;flex-wrap:wrap;justify-content:center;margin:0;}
.splide__pagination li{list-style-type:none;display:inline-block;line-height:1;margin:0;}
.splide{visibility:hidden;}
.splide,.splide__slide{position:relative;outline:none;}
.splide__slide{box-sizing:border-box;list-style-type:none!important;margin:0;flex-shrink:0;}
.splide__slide img{vertical-align:bottom;}
.splide__track{position:relative;z-index:0;overflow:hidden;}
.splide--draggable>.splide__track>.splide__list>.splide__slide{-webkit-user-select:none;user-select:none;}
.splide__arrow{position:absolute;z-index:1;top:45%;transform:translateY(-50%);width:2em;height:2em;border-radius:50%;display:flex;align-items:center;justify-content:center;border:none;padding:0;opacity:.7;background:#23fff5;}
.splide__arrow svg{width:1.2em;height:1.2em;}
.splide__arrow:hover{cursor:pointer;opacity:.9;}
.splide__arrow:focus{outline:none;}
.splide__arrow--prev{left:1em;}
.splide__arrow--prev svg{transform:scaleX(-1);}
.splide__arrow--next{right:1em;}
.splide__pagination{position:absolute;z-index:1;bottom:.5em;left:50%;transform:translateX(-50%);padding:0;}
.splide__pagination__page{display:inline-block;width:8px;height:8px;background:#ccc;border-radius:50%;margin:3px;padding:0;transition:transform .2s linear;border:none;opacity:.7;}
.splide__pagination__page.is-active{transform:scale(1.4);background:#fff;}
.splide__pagination__page:hover{cursor:pointer;opacity:.9;}
.splide__pagination__page:focus{outline:none;}
/*! CSS Used fontfaces */
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:400;font-display:block;src:url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-regular-400.woff2) format("woff2"),url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:900;font-display:block;src:url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-solid-900.woff2) format("woff2"),url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-solid-900.ttf) format("truetype");}
</style>

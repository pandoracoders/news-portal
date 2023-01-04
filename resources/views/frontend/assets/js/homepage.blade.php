<script>
   ((document.getElementById("slider").style.display = ""),
            new Splide(".splide", {
                type: "loop", perPage: 4, gap: "10px", autoplay: !0, perMove: 1, breakpoints: { 820: { perPage: 2, gap: "10px" }, 480: { perPage: 1, gap: "10px" } } }).mount()),
window.addEventListener('scroll', () => {
    var moreCategory = document.getElementById("more-category-section");
    if((moreCategory && (window.innerHeight + window.scrollY > moreCategory.offsetTop && window.innerHeight + window.scrollY < moreCategory.offsetTop+100) && moreCategory.innerText == '')){
        fetch("{{ route('ajax.getHomePageAjax') }}")
        .then((e) => e.json())
        .then(({ data: e }) => {
            moreCategory.innerHTML = e.category_section_html
            document.getElementById("born-today").innerHTML = e.born_today
            document.getElementById("died-today").innerHTML = e.died_today
        });
    }
}, {capture: true,passive: true})

</script>

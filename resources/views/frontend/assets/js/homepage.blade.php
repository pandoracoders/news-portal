<script>
	document.getElementById("slider").style.display = "", new Splide(".splide", {
    type: "loop",
    perPage: 4,
    gap: "10px",
    autoplay: !0,
    perMove: 1,
    breakpoints: {
        820: {
            perPage: 2,
            gap: "10px"
        },
        480: {
            perPage: 1,
            gap: "10px"
        }
    }
    }).mount();

</script>

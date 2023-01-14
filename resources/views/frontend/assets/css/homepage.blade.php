<style>

#glider {
								width: 100%;
								background-color: #ededed4d
				}

				#glider .splide__slide {
								margin-top: 25px
				}

				#glider .splide__slide .slider-image {

								position: relative;
								margin: 0
				}



#glider .splide__slide .slider-image .title-section{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

#glider .splide__slide .slider-image .slider-title {
    flex: 1;
    margin: 0;
    width: 100%;
    padding: 5px;
    font-size: 15px;
    font-weight: 600;
    hyphens: auto;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

				#glider .splide__slide .slider-image-img {
								border-radius: 6px;
								margin: 0;
								width: 100%;
								height: 200px;
                                object-fit: cover;
								object-position: top;

				}

                @media(max-width: 500px){
                    #glider .splide__slide .slider-image-img {
                        width: 100%;
                        height: 240px;
                    }
                }

				#glider .splide__slide .slider-image .slider-category {
								position: absolute;
								top: 0;
								right: 0;
								background: rgb(28, 28, 30, .7);
								border-bottom-left-radius: 5px;
								border-top-right-radius: 6px;
								color: #fff;
								font-weight: 700;
								padding: 5px;
								font-size: 13px
				}

				.splide__list {
								margin: 0 !important;
								padding: 0 !important;
								width: -webkit-max-content;
								width: max-content;
								will-change: transform
				}

				.splide.is-active .splide__list {
								display: flex
				}

				.splide__pagination {
								display: inline-flex;
								align-items: center;
								width: 95%;
								flex-wrap: wrap;
								justify-content: center;
								margin: 0
				}

				.splide__pagination li {
								list-style-type: none;
								display: inline-block;
								line-height: 1;
								margin: 0
				}

				.splide {
								visibility: hidden
				}

				.splide,
				.splide__slide {
								position: relative;
								outline: 0
				}

				.splide__slide {
								box-sizing: border-box;
								list-style-type: none !important;
								margin: 0;
								flex-shrink: 0
				}

				.splide__slide img {
								vertical-align: bottom
				}

				.splide__track {
								position: relative;
								z-index: 0;
								overflow: hidden
				}

				.splide__arrow,
				.splide__pagination {
								z-index: 1;
								position: absolute;
								padding: 0
				}

				.splide--draggable>.splide__track>.splide__list>.splide__slide {
								-webkit-user-select: none;
								user-select: none
				}

                .splide__arrow:hover,
				.splide__pagination__page:hover {
								opacity: 1;
								cursor: pointer
				}

				.splide__arrow {

				}

				.splide__arrow svg {
								width: 1.2em;
								height: 1.2em
				}

				.splide__arrow:focus {
								outline: 0
				}

				.splide__arrow--prev {
								left: 1em
				}

				.splide__arrow--prev svg {
								transform: scaleX(-1)
				}

				.splide__arrow--next {
								right: 1em
				}

				.splide__pagination {
								bottom: .5em;
								left: 50%;
								transform: translateX(-50%)
				}

				.splide__pagination__page {
								display: inline-block;
								width: 8px;
								height: 8px;
								background: #ccc;
								border-radius: 50%;
								margin: 3px;
								padding: 0;
								transition: transform .2s linear;
								border: none;
								opacity: .7
				}

				.splide__pagination__page.is-active {
								transform: scale(1.4);
								background: #fff
				}

				.splide__pagination__page:focus {
								outline: 0
				}

                #glider .splide__slide .box:hover .wrapper a h2,
				.popular .image .wrapper .author-div .author:hover,
				.popular .main-title h2 .colored,
				.top-wrap .wrapper .author-div .name .author {
								color: #505050 !important
				}

                #glider .splide__slide .box .wrapper a h2,
				.bc,
				.h-profile .main-grid .item .featured-para p,
				.right .popular .wrapper .title-div .small-title,
				.title h2 a {
                    display: -webkit-box;
                    text-overflow: ellipsis;
                    -webkit-box-orient: vertical;
                    overflow: hidden
				}


                @media(max-width:992px){
                    #glider .splide__arrows .splide__arrow--prev {
                        left: 1em
                    }

                    #glider .splide__arrows .splide__arrow--next {
                        right: 1em
                    }
                }

				.biography-right .image_img,
				.entertainment-right .image_img,
				.image_img {
								min-width: 100%;
								object-fit: cover;
								object-position: top;
								border-radius: 15px
				}

				.outer-section {
								border: 1px solid rgba(182, 178, 178, .5);
								box-shadow: 1px 1px rgba(202, 199, 199, .6);
								margin: 10px 0;
								border-radius: 6px;
								background-color: rgba(237, 237, 237, .3)
				}

				.biography-left .biography-single .image_img,
				.entertainment-left .entertainment-single .image_img,
				.trending-single .image_img {
								max-height: 70px;
								min-height: 70px;
								border-radius: 5px;
								min-width: 100%;
								object-fit: cover;
								object-position: top
				}

				.biography-left,
				.entertainment-left,
				.trending {
								margin: 0;
								padding: 0
				}

				.trending-single {
								margin-bottom: 15px;
								display: flex
				}

				.trending-single .image {
								width: 30%;
								height: 30%;
								margin-right: 10px
				}

				.biography-left .biography-single .biography-title,
				.entertainment-left .entertainment-single .entertainment-title,
				.trending-single .trending-title {
								width: 65%;
								max-height: 70px;
								min-height: 70px;
								display: flex !important;
								flex-direction: column !important;
								justify-content: space-between;
								flex: 1
				}

				.biography-left .biography-single .biography-title h2,
				.entertainment-left .entertainment-single .entertainment-title h2,
				.trending-single .trending-title h2 {
								font-size: 15px;
								font-weight: 600;
								display: -webkit-box;
								overflow: hidden;
								-webkit-line-clamp: 2;
								-webkit-box-orient: vertical
				}

				.biography-left .biography-single,
				.entertainment-left .entertainment-single {
								margin-bottom: 15px;
								padding-left: 12px;
								max-height: 70px;
								min-height: 70px;
								display: flex
				}

				.image_overlay .image_description,
				.textover figcaption {
								display: -webkit-box;
								overflow: hidden;
                                -webkit-line-clamp: 2;
								-webkit-box-orient: vertical;
								color: #fff
				}

				.biography-single .image,
				.entertainment-left .entertainment-single .image {
								width: 30%;
								margin-right: 10px;
								overflow: hidden
				}

				.biography-right .biography-single .image,
				.entertainment-right .entertainment-single .image {
								width: 95%;
								height: 95%;
								margin: 0 0 10px
				}

				.biography-right .image_img,
				.entertainment-right .image_img {
								min-height: 240px;
								max-height: 240px
				}

				.textover {
								position: relative;
								margin-left: 0
				}


				.textover figcaption {
								position: absolute;
								left: 0;
								width: 100%;
								color: rgb(209, 209, 209)
				}
                .textover figcaption a{
                    display: -webkit-box;
                    overflow: hidden;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }

				.textover figcaption {
                    bottom: 0;
                    padding: 10px 15px;
                    background-color: rgba(0, 0, 0, .8);
                    border-bottom-left-radius: 15px;
                    border-bottom-right-radius: 15px;

				}


                /* .image_overlay{
                    position: absolute;
                    left: 0;
                    width: 100%;
                    padding: 15px;
                    color: #d1d1d1;

                } */
				.image_overlay {
                    top: 0;
                    height: 100%;
                    background: rgba(0, 0, 0, .75);
                    opacity: 0;
                    transition: opacity .5s;
                    backdrop-filter: blur(5px);
                    border-radius: 15px;
                    color: #d1d1d1;
                    padding: 15px;
                    overflow: hidden;
                    -webkit-line-clamp: 7;
                    -webkit-box-orient: vertical;
				}

				.image_overlay:hover {
								opacity: 1
				}

				.image_overlay>* {
								transform: translate(20px);
								transition: transform .5s
				}

				.image_overlay:hover>* {
                    transform: translate(0)
				}

				.image_overlay {
                    position:absolute;
                    left:0;
                    top: 0;
                    font-size: 18px;
                    padding: 10px 10px;
                    justify-content: center;
                    border-bottom: 15px;

				}

                .image_overlay .image_description{
                    display: -webkit-box;
                    -webkit-line-clamp: 5;
                }

				.image_img {
								max-height: 230px;
								min-height: 230px
				}
				
				.read-more {
								text-align: right
				}

				.read-more .button {
								background-color: rgba(89, 128, 161, .64);
								padding: 7px;
								border-radius: 5px;
								margin-right: 15px;
								color: #fff
				}

				.read-more .button:hover {
								background-color: rgba(53, 81, 103, .855);
								color: #ddd
				}

				@media (max-width:820px) {

								.biography-right,
								.entertainment-right {
												display: none
								}
				}

				@media (max-width:768px) {
								.biography-left:nth-child(5) {
												display: none
								}
				}
</style>

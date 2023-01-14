<style>
				.twitter-tweet {
								margin: 0 auto !important;
				}

				.instagram-media {
								margin: 0 auto !important;

				}

				.content-detail a,
				.content-detail a:hover {
								text-decoration: underline !important;
								text-underline-offset: 5px
				}

				.social-share .facebook,
				.social-share .pinterest,
				.social-share .twitter {
								font-size: 1.6rem;
								padding-right: .5rem
				}

				.sidebar-post .sidebar-post-title h2,
				.similar-post-title .title {
								overflow: hidden;
								-webkit-line-clamp: 3;
								-webkit-box-orient: vertical
				}

				.meta-property,
				.meta-property a {
								flex: 1;
								margin: 0;
								color: #555657;
								font-weight: 700;
								padding: 5px 0;
								font-size: 11px
				}

                .meta-section{
                    display:flex;
                    margin-bottom: 10px;
                }

				.biography {
								margin: 25px 0;
								padding: 0 50px
				}

				.biography .main-content-section .left-section {
								position: sticky;
								top: 4rem
				}

				.biography .main-content-section .left-section .featured-image {
								border-radius: 5px;
								margin-bottom: 15px
				}

				.biography .main-content-section .left-section .featured-image img {
								border-radius: 5px;
								max-height: 250px;
								width: 100%;
								object-fit: cover;
								object-position: top
				}

                @media(min-width:520px) and (max-width: 820px){
                    .biography .main-content-section .left-section .featured-image img {
                        border-radius: 5px;
                        min-height: 400px;
                        width: 100%;
                        object-fit: cover;
                        object-position: top
                    }
                }

				@media(min-width:825px) {
                    .biography .main-content-section .left-section .featured-image img {
                                    border-radius: 5px;
                                    height: 300px;
                                    width: 100%;
                                    object-fit: cover;
                                    object-position: top
                    }
				}

				.biography .main-content-section .left-section .facts .fact-title {
								font-weight: 700
				}

				.biography .main-content-section .right-section .content-title,
				h1 {
								text-transform: capitalize
				}

				h1 {
								font-size: 2.2rem;
								font-weight: 600;
								max-width: 100%;
				}

				.content-detail figure {
								max-width: 80%;
								display: block;
								margin: 10px auto;
								text-align: center;
								border: 1px solid #ddd8d8;
								padding: 10px;
								border-radius: 5px
				}

                @media(max-width:525px){
                    .content-detail figure {
                                    width: 100%;
                                    margin: 10px 0px;
                                }
                }

				.content-detail h2,
				.content-detail h3,
				.content-detail h4,
				.content-detail h5,
				.content-detail h6 {
								margin: 1rem 0;
								max-width: 728px;
								line-height: 2.7rem;
								text-transform: capitalize;
								scroll-margin-top: 100px
				}

                .content-detail h2 strong,
				.content-detail h3 strong,
				.content-detail h4 strong,
				.content-detail h5 strong,
				.content-detail h6 strong{
                    font-weight: bold;
                }

				.content-detail figure.image img {
								max-width: 100%;
								min-width: 100%
				}

				.content-detail {
								font-size: 17px;
								font-weight: 400;
								line-height: 28px;
								color: rgba(0, 0, 0, .95)
				}

				.content-detail a {
								color: #00f;
								font-weight: 700;
								font-style: italic
				}

				.content-detail a:hover {
								color: #00a6ff;
								transition: text-underline-offset .3s
				}

				.content-detail a:visited {
								color: #a90b7e
				}

				.content-detail a:visited:hover {
								color: #00a6ff
				}

				.content-detail h2 {
								font-weight: 600;
								font-size: 1.75rem
				}

				.content-detail h3 {
								font-weight: 600;
								font-size: 1.4rem
				}

				.content-detail h4 {
								font-weight: 600;
								font-size: 1.25rem
				}

				.content-detail h5 {
								font-weight: 600;
								font-size: 1rem
				}

				.content-detail h6 {
								font-weight: 600;
								font-size: .75rem
				}

				.biography .main-content-section .right-section .content-detail figure figcaption {
								padding: 0 5px;
								font-size: .85rem;
								font-weight: 300;
								margin: auto;
								width: 95%;
								text-align: left;
								font-style: italic
				}

				.biography .main-content-section .right-section .content-detail img {
                    width: 100%;
                    height: auto;
                    object-fit: cover;
                    object-position: top;
				}

				.social-share {
								flex: 1;
								margin-right: 40px;
								text-align: right
				}

				@media(max-width:500px) {
								.biography {
												margin: 15px 0;
												padding: 0 20px
								}

								.biography .main-content-section .left-section .featured-image img {
												border-radius: 5px;
												max-height: 200px;
												min-height: 200px;
												min-width: 100%;
												object-fit: cover;
												object-position: top
								}

								.social-share {
												flex: 1;
												margin-right: 0
								}
				}



				.social-share .facebook {
								color: #2374e1
				}

				.social-share .twitter {
								color: #1d9bf0
				}

				.social-share .pinterest {
								color: #b8321d
				}

				.sidebar-section {
								position: relative;
								margin-bottom: 30px;
								padding-left: 15px
				}

				.post-section,
				.sidebar-section-wrap .sidebar-post {
								display: flex
				}

				.tags .single-tag,
				.tags a {
								display: inline-block
				}

				.sidebar-section-wrap .sidebar-post .image {
								width: 35%;
								margin-right: 10px
				}

				.sidebar-section .sidebar-post .image_img {
								width: 100%;
								max-height: 90px;
								object-fit: cover;
								object-position: top;
								border-radius: 5px
				}

				.sidebar-post .sidebar-post-title {
								width: 65%;
								max-height: 70px;
								min-height: 70px
				}

				.sidebar-post .sidebar-post-title h2 {
								font-size: 15px;
								font-weight: 700;
								line-height: 25px;
								display: -webkit-box
				}

				.tags a {
								text-transform: uppercase;
								color: #f6f6f6 !important;
								padding: 6px 12px 5px;
								margin-right: 8px;
								margin-bottom: 8px;
								font-size: 12px !important;
								font-weight: 400 !important;
								background: #241f1f;
								border: 1px solid #241f1f;
								border-radius: 5px;
								transition: .3s;
								-webkit-transition: .3s;
								-moz-transition: .3s;
								outline: 0
				}

				.tags a:hover {
								color: #212121 !important;
								background-color: #e7e7e7 !important;
								border-color: #e7e7e7 !important
				}

				.similar-post-section .similar-post {
								display: flex;
								flex-direction: column !important;
								flex: 1;
								margin-bottom: 20px;
								padding: 0;
								border: 1px solid rgba(122, 122, 122, .8);
								border-radius: 20px;
								box-shadow: 2px 1px rgba(31, 30, 30, .7);
								width: 100%
				}

				.similar-post-section .image_img {
								border-top-right-radius: 20px;
								border-top-left-radius: 20px;
								min-width: 100%;
								max-width: 100%;
								max-height: 230px;
								min-height: 230px;
								object-fit: cover;
								object-position: top
				}

				.similar-post-section .similar-post-title {
								padding: 15px 15px 0;
								font-weight: 600;
								color: #1f1a1a;
								font-size: 15px;
								display: flex !important;
								flex-direction: column !important;
								justify-content: space-between;
								flex: 1
				}

				.similar-post-title .title {
								display: -webkit-box
				}

				@media(max-width:820px) {
								.tags {
												margin-bottom: 2rem
								}

								body {
												overflow-x: hidden
								}
				}

				.table-of-contents {
								background-color: #f8f9fa;
								padding: 10px;
								border: 1px solid #a2a9b1;
								border-radius: 5px
				}

				.contents-heading:hover {
								color: #000;
								cursor: pointer
				}

				.table-of-contents #title {
								color: #171716;
								font-weight: 600;
								border-bottom: 1px solid #000
				}

				.table-of-contents ul {
								list-style: circle;
								color: #454545
				}

				.head-2 {
								padding-left: 0;
								font-size: 1rem;
								font-weight: 600;
                                margin-bottom:10px;
				}

				.head-3 {
								margin-left: 30px;
								font-weight: 500;
								font-size: 1rem;
                                margin-bottom: 10px;
				}

				.head-4 {
								margin-left: 60px;
								font-weight: 400;
								font-size: .9rem
				}

				.head-5 {
								margin-left: 90px;
								font-weight: 300;
								font-size: .8rem
				}

				.head-6 {
								margin-left: 120px;
								font-weight: 200;
								font-size: .7rem
				}

                .readmore-container{
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    margin: 0px 0px 15px 0px;
                    padding: 10px;
                    background: #e9f8fa;
                }

				.readmore-title,
				.readmore-title a,
				.readmore-title a:visited {
								font-size: 17px;
								margin-top: 5px;
								font-weight: 700;
								color: #000;
								text-decoration: none !important;
								line-height: 25px;
								text-align: left !important
				}

                .readmore-title{
                    margin:0px;
                    padding: 0px;
                }
				.readmore-text {
                    margin-left: 2px;
                    font-size: 22px;
                    font-weight: 700;
                    color: #c41111;
				}

                .readmore-image{
                    display:flex;
                    flex-direction: row;
                    gap: 10px;
                    margin-bottom:10px;
                }
                .readmore-image-img{
                    width: 190px !important;
                    height: 120px !important;
                }
</style>

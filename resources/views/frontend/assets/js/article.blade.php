<script>
				const tblOfContents = document.querySelector(".table-of-contents");
				document.getElementById("collapse-btn").addEventListener("click", function() {
								"true" == this.getAttribute("aria-expanded") ? (this.setAttribute("aria-expanded", "false"), this.classList
												.add("collapsed"), document.getElementById("collapseOne").classList.remove("show"), tblOfContents
												.classList.remove("content-height")) : (this.setAttribute("aria-expanded", "true"), this.classList
												.remove("collapsed"), document.getElementById("collapseOne").classList.add("show"), tblOfContents
												.classList.add("content-height"))
				});
				var headingList = document.querySelector(".content-detail").querySelectorAll(["h2","h3"]),
								contentSection = document.querySelector(".list");

				function string_to_slug(e) {
								return e = (e = e.toLowerCase().trim()).replace(/\s+/g, "-").replace(/-+/g, "-")
				}
				0 == headingList.length && (document.querySelector(".table-of-contents").style = "display:none;");
				for (var i = 0; i < headingList.length; i++)
								if ("h2" == headingList[i].localName) {
												var e = string_to_slug(headingList[i].innerText);
												headingList[i].id = `${e}`, contentSection.innerHTML +=
																`<li class="head-2"><a href="#${e}">${headingList[i].innerText}</a></li>`
								} else if ("h3" == headingList[i].localName) {
								var e = string_to_slug(headingList[i].innerText);
								contentSection.innerHTML += `<li class="head-3"><a href="#${e}">${headingList[i].innerText}</a></li>`, headingList[
												i].id = `${e}`
				} else if ("h4" == headingList[i].localName) {
								var e = string_to_slug(headingList[i].innerText);
								contentSection.innerHTML += `<li class="head-4"><a href="#${e}">${headingList[i].innerText}</a></li>`, headingList[
												i].id = `${e}`
				} else if ("h5" == headingList[i].localName) {
								var e = string_to_slug(headingList[i].innerText);
								contentSection.innerHTML += `<li class="head-5"><a href="#${e}">${headingList[i].innerText}</a></li>`, headingList[
												i].id = `${e}`
				} else if ("h6" == headingList[i].localName) {
								var e = string_to_slug(headingList[i].innerText);
								contentSection.innerHTML += `<li class="head-6"><a href="#${e}">${headingList[i].innerText}</a></li>`, headingList[
                                i].id = `${e}`
				}
				setTimeout(() => {
								fetch("{{ route('ajax.youMayAlsoLike', $article->id) }}").then(e => e.json()).then(e => {
                                    document.querySelector(".sidebar-section-wrap").innerHTML = e.data.youMayAlsoLike
								}).catch(e => {
                                    console.log(e)
								})
				}, 7e3);
				var page = 1,
								loading = 0;
				window.onscroll = function() {
								var e = document.querySelector(".similar-post-section");

								e && window.innerHeight + window.scrollY > e.offsetTop && 0 === loading && (loading = 1, fetch(
												"{{ route('ajax.moreOnCategory', $article->id) }}", {
																method: "POST",
																headers: {
																				"Content-Type": "application/json",
																				"X-Requested-With": "XMLHttpRequest",
																				"X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
																},
																body: JSON.stringify({
																				page
																})
												}).then(e => e.json()).then(t => {

												t.data && t.data.length > 0 && (e.insertAdjacentHTML("beforeend", t.data), page++, loading = 0)
								}).catch(e => {
												console.log(e)
								}))
				}, fetch("{{ route('ajax.readMoreSectionAjax', $article->id) }}").then(e => e.json()).then(e => {
								var t = document.querySelectorAll(".readmore");
								if (t.length > 0)
												for (let n = 0; n < t.length; n++) t[n].innerHTML = e.readMoreSection
				});


                document.addEventListener('copy', () => {
                    var selObj = window.getSelection();
                    if(selObj != ''){
                        pagelink = " Read more at: " + document.location.href;
                        copytext = selObj + pagelink;
                        var textArea = document.createElement('textarea');
                        textArea.value = copytext;
                        document.body.appendChild(textArea);
                        textArea.style.opacity = 0;
                        textArea.select();
                        navigator.clipboard.writeText(textArea.value);
                        selObj.deleteFromDocument();
                        textArea.remove();
                    }
                })

				if (document.querySelectorAll(".instagram-media").length) {
								var tag = document.createElement('script');
								tag.src = "//www.instagram.com/embed.js";
								tag.defer = true;
								tag.async = true;
								var firstScriptTag = document.getElementsByTagName('script')[0];
								firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				}

				if (document.querySelectorAll(".twitter-tweet").length) {
								var tag = document.createElement('script');
								tag.src = "//platform.twitter.com/widgets.js";
								tag.defer = true;
								tag.async = true;
								var firstScriptTag = document.getElementsByTagName('script')[0];
								firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				}


</script>

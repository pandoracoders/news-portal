<script>var page=1,loading=0,extra=500;window.onscroll=function(){let e=document.getElementById("scroll-content");window.innerHeight+window.scrollY>e.offsetHeight-extra&&0===loading&&(loading=1,fetch("{{ route('categoryArticles', $category->slug) }}",{method:"POST",headers:{"Content-Type":"application/json","X-Requested-With":"XMLHttpRequest","X-CSRF-Token":document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({page})}).then(e=>e.json()).then(t=>{if(t&&t.length>0){var a="";for(let i=0;i<t.length;i++)a+='<div class="col-md-6 col-lg-4 mb-1 single-post">',a+='<div class="category-post">',a+='<div class="image">',a+='<figure class="m-0">',a+='<a href="'+t[i].url+'">',a+='<img src="'+t[i].image+'" alt="" class="image_img img-fluid">',a+="</a>",a+="</figure>",a+="</div>",a+='<div class="category-post-title">',a+='<div class="title mb-3">',a+='<a href="'+t[i].url+'">',a+=t[i].title,a+="</a>",a+="</div>",a+='<div class="meta"><p class = "article-date" >'+t[i].published_at+" | </p>",a+='<p class="article-author">',a+='<a href="'+t[i].author.url+'"> '+t[i].author.name+"</a></p>",a+="</div>",a+="</div>",a+="</div>",a+="</div>";e.insertAdjacentHTML("beforeend",a),page++,loading=0}}))};</script>

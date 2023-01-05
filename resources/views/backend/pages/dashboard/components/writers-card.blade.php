<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-5">
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="mx-auto widget-icon bg-light-dark text-dark">
                    <i class="bi bi-journals"></i>
                </div>
                <div class="text-center mt-3">
                    <h3 class="text-dark mb-1">{{ $todays_posts }}</h3>
                    <p class="text-muted mb-4">Today's Posts</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="mx-auto widget-icon bg-light-dark text-dark">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div class="text-center mt-3">
                    <h3 class="text-dark mb-1">{{ $yesterday_posts }}</h3>
                    <p class="text-muted mb-4">Yesterday's Post</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="mx-auto widget-icon bg-light-dark text-dark">
                    <i class="bi bi-window-stack"></i>
                </div>
                <div class="text-center mt-3">
                    <h3 class="text-dark mb-1">{{ $total_posts }}</h3>
                    <p class="text-muted mb-4">Total Posts</p>
                </div>
            </div>
        </div>
    </div>
</div>

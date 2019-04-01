
            <div id="homeCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" style="padding-bottom: 40px">
                    <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#homeCarousel" data-slide-to="1"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <?=img(UPLOAD_DIRECTORY.'carousel_1.jpg', ['width' => '100%'])?>
                        <div class="container" >
                            <div class="carousel-caption" style="padding-bottom: 80px">
                                <h1><?=STORE_NAME?></h1>
                                <p>Mari Hijaukan Lingkungan Kita</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <?=img(UPLOAD_DIRECTORY.'carousel_1.jpg', ['width' => '100%'])?>
                        <div class="container">
                            <div class="carousel-caption" style="padding-bottom: 80px">
                                <h1><?=STORE_NAME?></h1>
                                <p>Mari Hijaukan Lingkungan Kita</p>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="left carousel-control" href="#homeCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#homeCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
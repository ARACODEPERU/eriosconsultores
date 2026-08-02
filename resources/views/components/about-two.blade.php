<div>
    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>{{ $about[0]->content }}</h5>
                        <h2>{{ $about[1]->content }}</h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>
                            {{ $about[2]->content }}
                        </p>
                        <p>
                            {{ $about[3]->content }}
                        </p>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{ asset('storage/' . $about[5]->content) }}" alt="About">
                    </div>  <!-- about image -->
                </div> 
            </div>
        </div> <!-- container -->
    </section>
</div>
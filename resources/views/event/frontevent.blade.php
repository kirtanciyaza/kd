<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- site metas -->
    <title>Coffo</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link href="https://royalfarmhouserent.in/Frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Swipers CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .layout_padding {
            padding-top: 100px;
            padding-bottom: 0px;
        }

        .about_section {
            width: 100%;
            float: left;
        }

        .about_section_2 {
            width: 100%;
            float: left;
        }

        .about_taital {
            width: 100%;
            float: left;
            font-size: 40px;
            color: #3b3b3b;
            text-transform: uppercase;
            font-weight: bold;
            padding-bottom: 0px;
        }

        .about_taital_box {
            width: 100%;
            float: left;
            padding-top: 15px;
        }

        .about_img {
            width: 100%;
            height: auto;
        }

        .about_taital_1 {
            width: 100%;
            float: left;
            font-size: 30px;
            color: #3b3b3b;
            margin: 10px 0px;
        }

        .about_text {
            width: 100%;
            float: left;
            font-size: 16px;
            color: #232222;
            margin: 0px;
        }

        .readmore_btn {
            width: 170px;
            float: left;
            margin-top: 40px;
        }

        .readmore_btn a {
            width: 100%;
            float: left;
            font-size: 18px;
            color: #f01c1c;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid #f01c1c;
            padding: 10px;
            text-align: center;
        }

        .readmore_btn a:hover {
            color: #4a4949;
            border: 1px solid #4a4949;
        }

        .swiper {
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }

        .swiper-slide {
            text-align: center;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .swiper-slide:hover {
            transform: translateY(-5px);
        }

        .swiper-slide img,
        .swiper-slide video {
            width: 100%;
            height: auto;
            max-height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        video {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    @foreach ($events as $event)
    <div class="about_section layout_padding">
        <div class="container">
            <div class="about_section_2">
                <div class="row">
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <div class="about_taital_box">
                            <h1 class="about_taital">{{ $event->title }}</h1>
                            <h1 class="about_taital_1">{{ $event->name }}</h1>
                            <p class="about_text">{!! $event->desc !!}</p>
                            <div class="readmore_btn">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="swiper imageSwiper">
                            <div class="swiper-wrapper">
                                @if ($event->image || $event->video)
                                @php
                                $images = json_decode($event->image);
                                $video = $event->video;
                                @endphp
                                @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset($image) }}" alt="Image">
                                </div>
                                @endforeach
                                @if ($video)
                                <div class="swiper-slide">
                                    <video controls>
                                        <source src="{{ asset($video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                @endif
                                @else
                                <div class="swiper-slide">No images or videos available</div>
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var imageSwiper = new Swiper(".imageSwiper", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

</body>

</html>

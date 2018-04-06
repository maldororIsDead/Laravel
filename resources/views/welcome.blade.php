<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JobAge</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style>
        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 34rem;
            background-color: #777;
        }

        .carousel-item > img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 34rem;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="links">
            <a class="navbar-brand" href="{{ url('/') }}">JobSearch</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active links">
                    <a class="nav-link links" href="{{ url('/') }}">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item links">
                    <a class="nav-link" href="{{ route('all-vacancies') }}">Вакансии</a>
                </li>
                <li class="nav-item links">
                    <a class="nav-link" href="{{ route('all-resumes') }}">Резюме</a>
                </li>
                <li class="nav-item links">
                    <a class="nav-link" href="#">Новости</a>
                </li>
                <li class="nav-item links">
                    <a class="nav-link" href="#">О нас</a>
                </li>
            </ul>
            <form action="/search/vacancies" method="GET" class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" name="search" type="text" placeholder="Поиск..."
                       aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Поиск</button>
            </form>
            @if (Route::has('login'))
                <div class="links form-inline mt-2 mt-md-0">
                    @auth
                        <a href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div>
    </nav>
</header>
<main role="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide"
                     src="../images/slide-1.jpg"
                     alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>{{ $vacancy->company }}</h1>
                        <p>{{ $vacancy->title }}</p>
                        @guest
                            <p><a class="btn btn-lg btn-primary" href="{{ route('vacancy', $vacancy->id) }}"
                                  role="button">Смотреть вакансию</a></p>
                        @else
                            @if (Auth::user()->isWorker())
                                <p><a class="btn btn-lg btn-primary" href="{{ route('worker-vacancy', $vacancy->id) }}"
                                      role="button">Смотреть вакансию</a></p>
                            @else
                                <p><a class="btn btn-lg btn-primary" href="{{ route('vacancy', $vacancy->id) }}"
                                      role="button">Смотреть вакансию</a></p>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide"
                     src="../images/slide-2.jpg"
                     alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>{{ $resume->name }}</h1>
                        <p>{{ $resume->post }}</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('resume', $resume->id) }}" role="button">Смотреть
                                резюме</a></p>
                    </div>
                </div>
            </div>
            @guest
                <div class="carousel-item">
                    <img class="second-slide"
                         src="../images/slide-3.jpg"
                         alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Ищите работу или набираете персонал</h1>
                            <p>Зарегестрируйтесь и вы откроете для себя уйму возможностей, новые пути личностного
                                процветания или развития бизнеса</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Регистрация</a></p>
                        </div>
                    </div>
                </div>
            @else
                <div class="carousel-item">
                    <img class="second-slide"
                         src="../images/slide-4.jpg"
                         alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Спасибо, что выбрали нас</h1>
                            <p>Перейдите в свой профиль для полномасштабного пользования ресурсом</p>
                            <p><a class="btn btn-lg btn-primary" href="{{ url('/home') }}" role="button">Профиль</a></p>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img class="rounded-circle"
                     src="../images/recruitment.png"
                     alt="Generic placeholder image" width="140" height="140">
                <h2>Вакансии</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies
                    vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo
                    cursus magna.</p>
                <p><a class="btn btn-secondary" href="{{ route('all-vacancies') }}" role="button">Просмотр »</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle"
                     src="../images/resume.png"
                     alt="Generic placeholder image" width="140" height="140">
                <h2>Резюме</h2>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras
                    mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                    condimentum nibh.</p>
                <p><a class="btn btn-secondary" href="{{ route('all-resumes') }}" role="button">Просмотр »</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle"
                     src="../images/news.png"
                     alt="Generic placeholder image" width="140" height="140">
                <h2>Новости и статьи</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula
                    porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh,
                    ut.</p>
                <p><a class="btn btn-secondary" href="#" role="button">Просмотр »</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette align-items-center">
            <div class="col-md-7">
                <h2 class="featurette-heading">Выбирайте категорию <span
                            class="text-muted">и открывайте новые возможности</span></h2>
                <p class="lead">На нашем сайте представлены всевозможные направления трудовой деятельности, множество
                    квалифицированных специалистов,
                    творческих и креативных людей</p>
            </div>
            <div class="col-md-5">
                <div class="list-group">
                    <div class="row ">
                        @foreach($categories as $category)
                            <div class="col-md-6">
                                <a href="{{ route('category-company', $category->id) }}"
                                   class="list-group-item list-group-item-action list-group-item-success">{{ $category->category }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette align-items-center">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Выберите отрасль, <span
                            class="text-muted">чтобы найти работу своей мечты</span></h2>
                <p class="lead">Множество вакансий ведущих фирм Украины готовы предложить свои услуги. Торопитесь</p>
            </div>
            <div class="col-md-5 order-md-1">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-6">
                            <a href="{{ route('category-worker', $category->id) }}"
                               class="list-group-item list-group-item-action list-group-item-primary">{{ $category->category }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2018 Company, Inc.</p>
    </footer>
</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
</body>
</html>

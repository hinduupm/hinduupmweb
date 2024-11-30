<!DOCTYPE html>
<html lang="zxx">
    <?php
       if (isset($_GET['tab']))
         {
          $tab = $_GET['tab'];
         }
         else{
          $tab = "tab1";        
         }
 ?>

<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>Hindu UPM || About</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/fav.png">
        <!-- bootstrap v3.3.7 css -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
        <!-- slick css -->
        <!-- <link rel="stylesheet" type="text/css" href="css/slick.css"> -->
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="css/off-canvas.css">
        <!-- linea-font css -->
        <!-- <link rel="stylesheet" type="text/css" href="fonts/linea-fonts.css"> -->
        <!-- nivo slider CSS -->
        <!-- <link rel="stylesheet" type="text/css" href="inc/custom-slider/css/nivo-slider.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="inc/custom-slider/css/preview.css"> -->
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="cs<!-- s -->/magnific-popup.css">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="css/rsmenu-main.css">
        <!-- Scroll tab css -->
        <link rel="stylesheet" href="css/jquery.scrolling-tabs.css">
        <!-- tab -->
        <link rel="stylesheet" href="css/ab.css">
        <!-- rsmenu transitions css -->
        <link rel="stylesheet" href="css/rsmenu-transitions.css">
        <!-- style css -->
        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
        <link rel="stylesheet" type="text/css" href="style.css"> <!-- This stylesheet dynamically changed from style.less -->
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="css/responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="about">
        <!-- Preloader area start here -->
      <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <!-- <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div> -->
                    <img src="images/loader.gif">
                </div>
            </div>
        </div>
        <!--End preloader here -->

        <!--Header Start-->
      <header id="rs-header" class="rs-header">
            <!-- Header Menu Start -->
            <div class="menu-area rs-defult-header menu-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                      <!-- <div class="col-2 col-sm-2">
                             <img class="gif" src="images/sun-logo.gif" alt="logo">
                        </div> -->
                        <div class="col-lg-12 col-sm-12 col-11 col-sm-9">
                            <div class="logo-area text-center">
                                <a href="index.html"><img src="images/logo2.gif" alt="logo"></a>
                                <div class="pull-right lang"><a href="#">ENG</a> || <a href="#">தமிழ் </a></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <div class="main-menu">
                                <a class="rs-menu-toggle"><i class="fa fa-bars"></i></a>
                                <nav class="rs-menu">
                                    <ul class="nav-menu text-center">
                                       <li ><a  href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                                        </li>
                                        <li class="current-menu-item"><a class="active" href="about.html"><i class="fa fa-bell" aria-hidden="true"></i> Our Work</a>
                                        </li>
                                        <li class=" "><a href="devotional.html"><i class="fa fa-music" aria-hidden="true"></i> Devotional Speech</i></a>
                                        </li>
                                        <li class=""><a href="publication.html"><i class="fa fa-book" aria-hidden="true"></i> Publications</a>
                                        </li>
                                        <li class=""><a href="contact.html"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a>
                                        </li>
                                        <li>
                                          <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle" style="background-color: #bdd4e7;
background-image: linear-gradient(315deg, #bdd4e7 0%, #8693ab 74%);
" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Choose Language
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item text-dark" style="margin: auto;width: 50%;padding: 10px;" href="index.html">தமிழ்</a>
                                                <a class="dropdown-item text-dark" style="margin: auto;width: 50%;padding: 10px;" href="index_eng.html">English</a>
                                              </div>
                                            </div>
                                        </li>
                                    </ul>
                               </nav>
                            </div>
                            <div class="appointment-cart hidden-md">
                                <ul class="cart">
                                    <li><a id="nav-expander" class="nav-expander"><i class="fa fa-bars fa-lg white"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Menu End -->

            <!-- Canvas Menu start -->
            <nav class="right_menu_togle">
                <div class="close-btn"><span id="nav-close" class="text-center"><i class="fa fa-close"></i></span></div>
                <div class="canvas-logo text-center">
                    <a href="index.html"><img src="images/logo2.gif" alt="logo"></a>
                </div>
                <div class="canvas-contact">
                    <h5 class="canvas-contact-title">Contact Info</h5>
                    <ul class="contact">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i><span>
                                Hindu United Progressive Movement,<br>Dhurai Murugar Siva Marabu <br>Sithaantha Dhyana Sabha Premises, kanakkanpatty, <br>Dindukkal Main Road,<br> Palani - 624 613.<br></span></li>
                       <li><i class="fa fa-envelope" aria-hidden="true"></i> hinduupm@gmail.com</li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> +91 9750682449</li>

                    </ul>
                    <ul class="social">
                        <li><a href="#"><i class="fab fa-facebook-square fa-1x"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                    </ul>
                </div>
            </nav>
            <!-- Canvas Menu end -->
        </header>
        <!--Header End-->

		<!-- Main content Start -->
        <div class="main-content" id="work_tab">
            <!-- Breadcrumbs Start -->
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs sec-color">
                <div class="breadcrumbs-image">
                    <div class="breadcrumbs-inner">
                        <div class="container">
                            <div class="breadcrumbs-text">
                                <h1 class="breadcrumbs-title">Our Works</h1>
                                <ul class="breadcrumbs-subtitle">
                                    <li><a href="index.html"><i class="fa fa-home"></i>  Home</a></li>
                                    <li><a href="#"> Works</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs End -->
        <ul class="nav nav-tabs nav-justified align-items-center justify-content-center bg-light mt-2" style="border-bottom: 2px solid orange;">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab1">இல்லந்தோறும் இறைவாசகம் </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2">கோயில்கள்தோறும் இறைவாசகம்</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab3">அன்னதானம்</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab4">தியான, யோகப் பயிற்சிகள்</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab5">கூட்டுப்பிரார்த்தனை</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab6">மருத்துவமனைகளில் பிரார்த்தனை </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab7">  திருத்தொண்டர்களின்  குழந்தைகளுக்கு கல்வி</a>
          </li>
        </ul>

        <!-- TEst -->


        <!-- End here -->
           <div class="container-fluid my-3">
    <div class="row" id="works">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab" id="cont">
                <div class="bhoechie-tab-content active" id="tab1">
                  <div class="row">
                    <section id="rs-team" class=" col-lg-6">
                        <div id="works_1" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                              <li data-target="#works_1" data-slide-to="0" class="active"></li>
                               <li data-target="#works_1" data-slide-to="1" ></li>
                                <li data-target="#works_1" data-slide-to="2"></li>
                               <li data-target="#works_1" data-slide-to="3" ></li>
                               <li data-target="#works_1" data-slide-to="4" ></li>
                                <li data-target="#works_1" data-slide-to="5"></li>
                               <li data-target="#works_1" data-slide-to="6" ></li>
                               <li data-target="#works_1" data-slide-to="7" ></li>
                                <li data-target="#works_1" data-slide-to="8"></li>
                               <li data-target="#works_1" data-slide-to="9" ></li>
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <img src="works/1/1.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/2.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/3.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/4.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/5.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/6.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/7.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/8.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/9.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/1/10.jpg" alt="team Image" />
                              </div>
                            </div>
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#works_1" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#works_1" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                    </section>
                    <div class="col-lg-6">
                      <br><h5><strong>இல்லந்தோறும் இறைவாசகம் </strong></h5>
                        <p>மனதிற்குள் கோயிலை கொண்டு வந்து வழிபட்டால் மகத்தான வெற்றி பெறுவீர்கள்
                        மந்திரம் கூறிக்கொண்டே இறைநினைப்போடு செய்யும் மானசீக பூஜை, வழிபாடு, பஜனை, கிரிவலம், பாதயாத்திரை யாவும் உங்களை பல வழிகளில் உயர்வடையச் செய்யும். “பயம், சந்தேகம், சோம்பல் ஆகிய மூன்று குணங்களும் வெற்றியை நெருங்க விடாது தடுக்கும்” என்று பாரதியார் கூறுகிறார்.<br><br> இம்மூன்றும் நம்மை விட்டு போக, அத்துடன் நாம் வெற்றி பெற வேண்டுமானால் முறையாக இறைவழிபாட்டை கற்றுக் கொள்ள வேண்டும். எதை செய்தாலும் அதற்கு ஒரு சூத்திரம், அதாவது வழிமுறைகள் இருக்கும் அல்லவா! <br> அது போலத்தான் நமது இனிய இந்து மதம் நாம் எப்படி பகவானை வழிபட்டு வாழ்க்கையில் உயர்வடைவது என்று கூறுவதை சுருக்கமாக பிரிண்ட் செய்து வீடுகள் தோறும் கொடுத்தும், கதவு மற்றும் சுவரில் அவர்கள் அனுமதியோடு ஒட்டியும் போதனை செய்து வருகிறோம்.<br>ஒவ்வொருவரையும் சந்திக்கும் பொழுது “ஓம் நமசிவாய வாழ்க! வாழ்க!!” என்று மந்திரம் கூற அன்புடன் கேட்டுக் கொள்கிறோம்.</p>
                    </div>
                  </div>
                  <p><br>அத்துடன் மானசீக இறைவழிபாட்டையும் மற்றும் ஆறுகால பூஜை முறையும் சொல்லிக் கொடுக்கிறோம். பகவானை எப்படி முறையாக வழிபடுவது என்று தெரியாது இருக்கும் எத்தனையோ இந்து மக்கள், நமது இயக்கம் வீடுகள் தோறும் செல்லும் இந்த முயற்சியினால் வழிபாட்டுத் துறையில் உறுதியாக வெற்றி பெறுவர், வாழ்கையில் கட்டாயம் உயர்வு பெறுவர்.<br></br>
                        <i>குறிப்பு: தமிழ்நாட்டில் அனைத்து மாவட்டங்களிலும் வீடுகள் தோறும் இறை வாசகம் ஓட்டும் பணி 9௦% நிறைவேறியுள்ளது.</i>
                        </p>
                        <div class="text-center">
                          <img src="works/1/poster.jpg" class="img-thumbnail">
                        </div>
                </div>
                <div class="bhoechie-tab-content" id="tab2">
                  <div class="row">
                    <div class="col-lg-5">
                      <section id="rs-team" class="rs-defult-team">
                        <div id="works_2" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                               <li data-target="#works_2" data-slide-to="0" class="active"></li>
                               <li data-target="#works_2" data-slide-to="1" ></li>
                                <li data-target="#works_2" data-slide-to="2"></li>
                               <li data-target="#works_2" data-slide-to="3" ></li>
                               <li data-target="#works_2" data-slide-to="4" ></li>
                                <li data-target="#works_2" data-slide-to="5"></li>
                               <li data-target="#works_2" data-slide-to="6" ></li>
                               <li data-target="#works_2" data-slide-to="7" ></li>
                                <li data-target="#works_2" data-slide-to="8"></li>
                               <li data-target="#works_2" data-slide-to="9" ></li>
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <img src="works/3/1.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/3/2.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item ">
                                 <img src="works/3/3.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/3/4.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/3/5.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item ">
                                 <img src="works/3/6.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/3/7.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/3/8.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item ">
                                 <img src="works/3/9.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/3/10.jpg" alt="team Image" />
                              </div>
                            </div>
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#works_2" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#works_2" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                      </section>
                    </div>
                    <div class="col-lg-6">
                      <br><h5><strong>கோயில்கள்தோறும் இறைவாசகம்</strong></h5>
                    <p>நமது இயக்கத்தின் சார்பாக தமிழ்நாட்டில் உள்ள முக்கியக் கோயில்களில் 10X20 அடி உயரத்தில் இனிய இந்து மதம் கூறும் வழிபாட்டு முறைகள் அடங்கிய BANNERகள் வைக்கப்பட்டுள்ளது.மேலும், கிழக்கு கடற்கரை சாலையில் (ECR road) சென்னை to கன்னியாகுமாரி வரை ஒவ்வொரு 20 கி.மீ க்கும் 9X15 அடி உயரத்தில் இறைவாசகங்கள் அடங்கிய BANNER கள் வைக்கப்பட்டுள்ளது. <br><br>
                    அதுமட்டுமல்லாது கிராமங்கள் தோறும் நமது இயக்க தொண்டர்கள் சென்று அங்குள்ள சிறிய சிறிய கோயில்களிலும் 2X4 அடி உயரத்தில் இறைவழிபாட்டு முறைகள் அடங்கிய FOAM BOARD வைத்திருக்கிறார்கள். இதுவரை ஏறத்தாழ 7000 கிராமங்களில் 10000 board கள் தமிழ்நாடு முழுவதும் வைக்கப்பட்டுள்ளது.<br> இந்த இறை செய்தியுள்ள board-ஐ படித்த பின் பல இந்து மக்கள் மந்திரம் கூறி மானசீகமாக கோயிலை உள்ளத்தில் வைத்து ஆறுகால பூஜை செய்து வருகிறார்கள் என்பது பாராட்டத்தக்க ஒன்றாகும்.</p>
                    </div>
                  </div>

                </div>
                <div class="bhoechie-tab-content" id="tab3">
                  <div class="row">
                    <div class="col-lg-6">
                      <section id="rs-team" class="rs-defult-team">
                        <div id="works_3" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                              <li data-target="#works_3" data-slide-to="0" class="active"></li>
                              <li data-target="#works_3" data-slide-to="1" ></li>
                              <li data-target="#works_3" data-slide-to="2" ></li>
                              <li data-target="#works_3" data-slide-to="3" ></li>
                              <li data-target="#works_3" data-slide-to="4" ></li>
                              <li data-target="#works_3" data-slide-to="5" ></li>
                              <li data-target="#works_3" data-slide-to="6" ></li>
                              <li data-target="#works_3" data-slide-to="7" ></li>
                              <li data-target="#works_3" data-slide-to="8" ></li>
                              <li data-target="#works_3" data-slide-to="9" ></li>
                              <li data-target="#works_3" data-slide-to="10" ></li>
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <img src="works/5/1.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/2.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/3.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/4.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                  <img src="works/5/5.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/6.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/7.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/8.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                  <img src="works/5/9.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/10.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/5/11.jpg" alt="team Image" />
                              </div>
                            </div>
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#works_3" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#works_3" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                      </section>
                    </div>
                    <div class="col-lg-6">
                      <br><h5>தொண்டர்களுக்கு அன்னதானம் </h5>
                     <p>ஆன்மிகம் வளர்ந்து வருகின்ற இடங்களில் எல்லாம் பக்தர்களுக்கு அன்னதானம் வழங்கப்படுகிறது. நமது இயக்கத்தில் 3௦௦ முழுநேர இறைத் தொண்டர்களும், சுமார் 5௦௦ இறை அன்பர்களும் வீடுவீடாக சென்று எல்லோருக்கும் மந்திரம் கூறி மானசீக பூஜை செய்யும் முறையை போதித்து வருகின்றனர்.<br><br>
                    பொதுவாக, நமது தொண்டர்கள் எல்லோரும் படித்த, பட்டதாரி இளைஞர்களே! எல்லோரும் இறைநினைப்போடு முன்னேற்றம் அடைய வேண்டும் என்ற கொள்கையை முன்வைத்தே தனது சுயவருமானத்தை பொருட்படுத்தாது இறைத் தொண்டு செய்ய வருகிறார்கள். இப்படிப்பட்ட உயர்ந்த உள்ளம் கொண்ட இறைத் தொண்டர்களுக்கு அன்றாடம் அன்னதானம் ஆங்காங்கே வழங்கப்படுகிறது.<br> <br>இப்படிப்பட்ட இறைத் தொண்டர்களின் அன்னதானத்திற்க்கு உதவ முன்வாருங்கள்.<br>“நாம் செய்யும் நல்ல காரியம் தர்மம் “ இறைத் தொண்டு செய்யும் ஒருவருக்கு அன்னதானம் செய்வதால் கோடிப் புண்ணியம் சேரும்"

                    </p>
                    </div>
                  </div>
                    <br>
                    <h5>ஞாயிறு தோறும் அன்னதானம் </h5>
                    <p>ஞாயிறு தோறும் காஞ்சிபுரம் மாவட்டம் வாலாஜாபாத் தாலுக்கா, நத்தாநெல்லூரில் அமைந்திருக்கும் தியான சபையில் இலவசமாக தியான வகுப்புகள், யோகா,ஆன்மிக சொற்பொழிவு, மந்திரப் பயிற்சி நடத்தப்படுகிறது. நிகழ்ச்சி நடந்து முடிந்தவுடன் பயிற்சியில் கலந்து கொண்ட மக்களுக்கு சிறப்பான அன்னதானம் வழங்கப்படுகிறது. இதில் பலர் கலந்துக்கொண்டு பயன் பெற்றுவருகின்றனர். இந்த அன்னதான நிகழ்ச்சியை வாரந்தோறும் நடத்த ஆன்மிகம் ஆர்வம் கொண்ட பக்தர்கள் SPONSOR செய்து வருகின்றனர். விருப்பம் இருந்தால் நீங்களும் SPONSOR செய்து அன்னதான நிகழ்ச்சியில் பங்கேற்கலாம்.<br><br>
                    தாங்கள் இதில் கலந்து கொள்ள விரும்பினால் அன்னதான நன்கொடை வழங்கலாம் அல்லது அரிசி, பருப்பு வாங்கிக் கொடுக்கலாம்.
                    </p>
                    <h5>பழனி பாதயாத்திரை பக்தர்களுக்கான அன்னதான நிகழ்ச்சி</h5>
                    <p>பக்தியோடு பழனிக்கு மந்திரம் கூறிக்கொண்டே மானசீக பூஜை செய்து கொண்டு வருபவர்களுக்கு எல்லாம் கைக்கூடும். நமது தியான சபை பழனி to திண்டுக்கல் ரோடு கணக்கன்பட்டியில் அமைந்திருப்பதால் பாதயாத்திரை செல்பவருக்கு அன்னதானம் சிறப்பாக வழங்கி வருகிறோம். இதில் பல நல்ல உள்ளங்கள் எங்களுடன் பங்கேற்கின்றனர். இந்த பாதயாத்திரை பக்தர்களுக்கு செய்யப்படும் அன்னதானத்தில் நீங்கள் விரும்பினால் பருப்பு, அரிசி, நன்கொடை ஏதாவது ஒன்றை வழங்கலாம்.
                    </p>
                    <h5>ஐயப்ப பக்தர்களுக்கான அன்னதானம்</h5>
                    <p>பொதுவாக, ஐயப்பன் கோயிலுக்கு வாகனத்தில் செல்லும் பக்தர்கள் தரிசனம் முடித்து திரும்பும் போது பழனியை தரிசனம் செய்து செல்வது பழக்கமாக வைதிருக்கிறார்கள். சென்னை, விழுப்புரம், காஞ்சிபுரம், வேலூர், திருவண்ணாமலை மாவட்டங்களிலிருந்து வரும் பக்தர்கள் நமது தியான சபையில் தங்கி அன்னதானம் சாப்பிட்ட பின் செல்கிறார்கள். கார்த்திகை, மார்கழி, தை மாதங்களில் தொடர்ந்து அன்னதானம் நடைபெற்று வருகிறது. இதில் நீங்கள் பங்கேற்க விரும்பினால் அரிசி, பருப்பு, மளிகை பொருட்கள் வாங்கிக் கொடுத்து புண்ணியம் சேர்க்கலாம்.</p>
                </div>
                <div class="bhoechie-tab-content" id="tab4">
                  <div class="row">
                    <div class="col-lg-6">
                      <section id="rs-team" class="rs-defult-team">
                        <div id="works_4" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                              <li data-target="#works_4" data-slide-to="0" class="active"></li>
                              <li data-target="#works_4" data-slide-to="1" ></li>
                              <li data-target="#works_4" data-slide-to="2" ></li>
                              <li data-target="#works_4" data-slide-to="3" ></li>
                              <li data-target="#works_4" data-slide-to="4" ></li>
                              <li data-target="#works_4" data-slide-to="5" ></li>
                              <li data-target="#works_4" data-slide-to="6" ></li>
                              <li data-target="#works_4" data-slide-to="7" ></li>
                              <li data-target="#works_4" data-slide-to="8" ></li>
                              <li data-target="#works_4" data-slide-to="9" ></li>
                              <li data-target="#works_4" data-slide-to="10" ></li>
                              <li data-target="#works_4" data-slide-to="11" ></li>

                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <img src="works/4/1.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/2.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/3.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/4.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                  <img src="works/4/5.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/6.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/7.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/8.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                  <img src="works/4/9.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/10.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/11.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/4/12.jpg" alt="team Image" />
                              </div>
                            </div>
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#works_4" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#works_4" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                      </section>
                    </div>
                    <div class="col-lg-6">
                     <br> <h5> தியான, யோகப் பயிற்சிகள்  </h5>
                    <p>மனம் தெளிவடைவதற்கு கண்டிப்பாக தியானம் அவசியம். உடல் உள் உறுப்புக்களை சரியாக வைத்துக் கொள்ள யோகாசனம் தேவை. இதை நமது சித்தர்கள் முனிவர்கள் கண்டுபிடித்திருக்கின்றனர்.<br>
                  யோகாசனமும், தியானமும் ஆரோக்கிய கவசங்கள் என்று தான் கூறவேண்டும். 80% வியாதிகளை யோகாசனத்தாலும், தியானத்தாலும் போக்கி விடமுடியும். இது பலருடைய அனுபவத்தில் நடந்திருக்கிறது. யோகாசனங்கள் நோய்களை குணப்படுத்துவது மட்டுமல்லாது நோய்கள் வராமல் தடுக்கும் வல்லமை கொண்டது.தியானம் ஞாபக சக்தியையும், இறை சக்தியையும் வளர்க்கும் கலையாகும். இவை இரண்டும் நமக்கு இரண்டு கண் போன்றதாகும்.<br></p><blockquote>
                “ உடம்பார் அழியின் உயிரார் அழிவர்
                திடம்பட மெய்ஞ்ஞானம் சேரவும் மாட்டார் உடம்பை வளர்க்கும் உபாயம் அறிந்தேன்
                உடம்பை வளர்த்தேன் உயிர் வளர்த்தேனே ”
                - திருமூலர்</blockquote>
                      </div>
                </div>
                <br>
                <p>பொதுவாக, உடம்பு அழிந்தால் உயிரும் அழியும் சிறந்த மெய்ஞானத்தை அடைய முடியாது. ஆகவே உடம்பை வளர்க்கும் விஷயத்தை நான் அறிந்து கொண்டேன். எனது உடம்பை யோகப் பயிற்சிகளால் காத்துக் கொண்டேன். இதனால் உடம்பும் வளர்ந்தது, உயிரையும் வளர்த்தேன் என்று திருமூலர் கூறியிருக்கிறார். உடல் பல நோய்களால் கஷ்டப்படுகிறது மனமோ ஆசைகளால் சிக்கித் தவிக்கிறது. யோகப் பயிற்சிகளையும் தியானப் பயிற்சிகளையும் முறையாக மேற்கொண்டு வந்தால் மன துன்பத்திலிருந்தும், உடல் துன்பதிலிருந்தும், மன சிக்கலிருந்தும் விடுபட்டு பகவானை நினைத்துக் கொண்டே ஆனந்தமாக வாழலாம்.<br><br>
                இப்படிப்பட்ட உயர்ந்த விஷயங்களை நமது குழந்தைச் செல்வங்களாகிய மாணவர்களிடம் கொண்டு போய் சேர்க்க வேண்டும் என்பதே நமது இயக்கத்தின் இலட்சியமாகும். இதனால், கிராமங்கள் தோறும் உள்ள பள்ளிகளில் அனுமதி வாங்கி சுமார் 5 ஆண்டுகளாக நமது இந்து இளைஞர்கள் ஆன்மிக சேவா சங்கம் மற்றும் MODERN HEALTHY INDIAN YOGA FOUNDATION இணைந்து யோகா தியான வகுப்புகள் எடுத்து அதற்கான பாராட்டு கடிதங்களும் தலைமை ஆசிரியரிடம் பெற்றுள்ளது. இது மட்டுமல்லாது வீதிகள் தோறும் சென்று MEGA PHONE மூலமாக பேசி பிள்ளைகளை வரவழைத்து ஒன்று சேர்த்து யோகா தியானம் மந்திரம் பயிற்சியளித்து மாலை பொழுதை மகத்தான பொழுதாக ஆக்கியுள்ளது.
                </p>
                </div>
                <div class="bhoechie-tab-content" id="tab5">
                  <div class="row">
                    <div class="col-lg-6">
                      <section id="rs-team" class="rs-defult-team">
                        <div id="works_5" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                              <li data-target="#works_5" data-slide-to="0" class="active"></li>
                               <li data-target="#works_5" data-slide-to="1" ></li>
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="works/2/1.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                <img src="works/2/1.jpg" alt="team Image" />
                              </div>
                            </div>
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#works_5" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#works_5" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                    </section>
                    </div>
                    <div class="col-lg-6">
                     <br> <h5>கூட்டுப்பிரார்த்தனை</h5>
                  <p>நல்லது செய்ய வாய்ப்புக் கொடுக்குமாறு பகவானிடம் வேண்டுபவரே மனிதரில் நல்லவர். அப்படி நல்லது செய்ய வாய்ப்பு கிடைத்தவுடன் அதை சிறப்பாகச் செய்ய பகவானிடம் வேண்டிக் கொண்டு விறுவிறுப்பாக செயல்படுபவர்களே மனிதர்களில் உயர்ந்தவர். எவ்வளவு எதிர்ப்பும் இடற்பாடுகளும் வந்தாலும் தான் செய்யும் சமூகச் சேவையை தளராது செய்பவரே மனிதரில் புனிதமானவர். இவரே இறைத்தொண்டர். இத்தொண்டரை நோக்கி வந்த பிரச்சனைகள் யாவும், உணர்வுப் பூர்வமாகப் பக்குவப்படுத்த வந்தவைகளே ஆகும். <br><br> வளர்ச்சிக்காகவும், மக்களின் முன்னேற்றத்திற்காகவும் தினந்தோறும் பிரம்ம மூகூர்த்தத்தில் 260 திருத்தொண்டர்கள் கொண்ட குழு அமைத்து பல்வேறு இடங்களில் கூட்டுப் பிரார்த்தனை செய்து வருகிறது.  மேலும், இயக்கத்திற்கு பொருள் உதவி செய்தவர்கள், திருத்தொண்டர்களுக்கு அன்னதானம் செய்பவர்கள் மற்றும் இறை வாசக பிரதி அச்சடித்துக் கொடுத்தவர்களுக்காவும் பிரார்த்தனை செய்யப்பட்டு வருகிறது.</p>
                    </div>
                  </div>
                    <br>
                  <p> பெயர் பதிவு செய்த மாணவ மாணவிகளுக்கு நீண்ட ஆயுளும், நோயற்ற வாழ்வும், நல்லொழுக்கமும், கல்வியில் நல்ல ஆர்வமும் கொண்டு பிற்காலத்தில் நல்ல வேலையில் சிறந்து விளங்க வேண்டும் என பிரார்த்தனை செய்யப்பட்டு வருகிறது. மேலும், பிரச்சனைகள் தீர வேண்டி முன்பதிவு செய்து கொண்ட பொது மக்களுக்கு கூட்டுப் பிரார்த்தனையின் போது தனித்தனியாக பிரார்த்தனை செய்யப்பட்டு வருகிறது.<br><br>
                <i>குறிப்பு: ஒவ்வொரு குடும்பத்திலும் காலை அல்லது மாலையில் அனைவரும் ஒன்று சேர்ந்து ஒரு பதினைந்து நிமிடம் தனக்கு பிடித்த கோயிலை உள்ளத்தில் நினைத்து இறை மந்திரம் கூறி மானசீகமாக பூஜை செய்து கூட்டாக பகவானிடம் வேண்டி பிரார்த்தனை செய்து வந்தால் பிரச்சனை தீரும், காரியம் வெற்றியாகும். </i>
                <ul style="  list-style-position: inside;">
                <li>மாணவர்கள் கல்விக்காக பிரார்த்தனை</li>
                <li>திருமணம் தாமதிக்கின்ற காரணத்திற்காக பிரார்த்தனை</li>
                <li>இல்வாழ்க்கை சிறக்க பிரார்த்தனை</li>
                <li>குழந்தை பாக்கியம் வேண்டி பிரார்த்தனை</li>
                <li>நோய்கள் நீங்கி உடல் நலம் தேற பிரார்த்தனை</li>
                <li>கடன் பிரச்சனை தீர பிரார்த்தனை</li>
                <li>தொழில் துவங்க, தொழில் முன்னேற்றம் பெற பிரார்தனை</li>
                <li>குடும்பத்தில் ஒற்றுமையாக இருக்க பிரார்த்தனை</li>
                <li>குழந்தைகள் நலம் பெற பிரார்த்தனை</li>
                <li>மங்கள பிரார்த்தனை அதாவது இறந்தவர்கள் ஆத்மாவிற்காக பிரார்த்தனை</li>
                <li>வேலை தேடுபவர்களுக்காக பிரார்த்தனை</li>
                </ul>
                <div class="alert alert-warning">
                    <p><strong>நாள்தோறும் நடக்கும் கூட்டுப்பிரார்த்தனையில் பதிவு செய்ய தொடர்பு கொள்ள வேண்டிய  <br>மொபைல் எண் : + 91 82480 09953</strong>
                    </p>
                </div>
                </div>
                <div class="bhoechie-tab-content" id="tab6">
                    <h5>மருத்துவமனைகளில் பிரார்த்தனை </h5>
                       <blockquote>” இறைவன் யாருக்கு நலம் புரிய நாடுகின்றாரோ அவருக்கே அதிக துன்பங்களை தருகின்றார் “</blockquote>
                        <p>என்ற பொன்மொழிக்கிணங்க பகவான் தனது பக்தர்களுக்கு சோதனைகளை தந்து அவர்களது மனதை பக்குவப்படுத்தி மென்மேலும் உயர்த்துகின்றார்.<br><br>
                        சோதனை கால கட்டங்களில் இருக்கும் நோயாளிகளை ஒவ்வொரு மருத்துவமனைகளிலும் நமது இயக்க திருத்தொண்டர்கள் சந்தித்து அவர்கள் மனம் தளர்ந்து விடாமல் இருக்க தொடர்ந்த இறை நினைப்பு மற்றும் மந்திரம் உச்சரிப்பதன் முக்கியத்துவத்தை உணர்த்தி வருகிறோம். மேலும் அவர்கள் வெற்றி அடைய செய்யும் பொருட்டு “ஆன்மிகம் , ஆரோக்கியம் பொருளாதாரம் மேம்பட இனிய இந்து மதம் கூறும் வழிமுறைகள்” அடங்கிய பிரசுரங்கள் மற்றும் ஆறுகால மானசீக பூஜை அட்டவணை கொண்ட கார்டுகள் கொடுத்து அவர்களது ஓய்வு நேரத்தை பகவானை நினைக்கும் பயனுள்ள நேரமாக மாற்ற உதவி செய்கின்றோம்.<br><br></p>
                        <blockquote> “எதை இழந்தாலும் யார் ஒருவர் இறை நினைப்பை இழக்கவில்லையோ அவர் மீண்டும் எதிலும் வெற்றி பெறுவார்.”
                        – சுவாமி விவேகானந்தர்</blockquote>
                    </p>
                </div>
                 <div class="bhoechie-tab-content" id="tab7">
                  <div class="row">
                    <div class="col-lg-5">
                       <section id="rs-team" class="rs-defult-team">
                        <div id="works_6" class="carousel slide" data-ride="carousel" data-interval="3000">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                              <li data-target="#works_6" data-slide-to="0" class="active"></li>
                               <li data-target="#works_6" data-slide-to="1" ></li>
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                 <img src="works/6/1.jpg" alt="team Image" />
                              </div>
                              <div class="carousel-item">
                                 <img src="works/6/1.jpg" alt="team Image" />
                              </div>
                            </div>
                          <!-- Left and right controls -->
                          <a class="carousel-control-prev" href="#works_6" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#works_6" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                    </section>
                    </div>
                    <div class="col-lg-6">
                     <br> <h5>திருத்தொண்டர்களின்  குழந்தைகளுக்கு கல்வி </h5>
                  <p>
                     நமது இந்து ஒருங்கிணைப்பு மேம்பாட்டு இயக்கம் மற்றும் இந்து இளைஞர்கள் ஆன்மிக சேவா சங்கத்தில் முழுநேர தொண்டர்களாகப் பணியாற்றுபவர்களின் குழந்தைகளை பள்ளிக்கு அனுப்பி நமது இயக்கமே அவர்களை பாதுகாத்து வருகிறது.<br> இந்த மாணவர்களுக்கு வித்யா கல்வியோடு, யோகப் பயிற்சியும், தியானப் பயிற்சியும் சொல்லித்தரப்படுகிறது. <br>இவர்கள் இனிய இந்து மதம் கூறும் ஆறுகால பூஜையை அன்றாடம் மந்திரம் கூறி மானசீகமாக செய்துவருகின்றனர்.<br></p>
                    <blockquote> “ஓதாமல் ஒருநாளும் இருக்க வேண்டாம்”
                    “இளமையில் கல்” – ஔவையார்</blockquote>
                    </div>
                  </div>
                    <br>
                    <p>பள்ளிக்கு சென்று படிக்காமலும், மனதினில் இறை மந்திரம் ஓதாமலும் இருக்க வேண்டாம், இது இரண்டும் அவசியம். இதனால் இதை இளமையில் கற்றுக்கொள் என்று ஔவையார் சிறப்பாக கூறியிருக்கிறார். இதனால் நமது மாணவர்கள் உயர்வடைய பள்ளிப் படிப்போடு பக்திப் படிப்பையும் படிக்கவைத்து நாம் மகிழ்வடைவோம்.<br><br>
                    <i>குறிப்பு: இயக்கத்தில் முழுநேர தொண்டர்களாகப் பணியாற்றும் இளைஞர்களுக்கு மேற்படிப்பிற்கான அஞ்சல் வழிக் கல்வி உதவியும் இயக்கம் செய்து வருகிறது.</i>
                  </p>
                </div>
            </div>
        </div>
  </div>
</div>


            </div>
            <!-- Partner End -->
        </div>

        <!-- Footer Start -->
       <footer id="rs-footer" class="rs-footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 mb-md-30">
                            <h5 class="footer-title">Contact Us</h5>
                            <div class="about-widget">
                               <!--  <a href="index.html">
                                    <img src="images/logo.png" alt="Footer Logo">
                                </a> -->
                                <ul class="contact">
                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i><span>
                                            Hindu United Progressive Movement,<br>Dhurai Murugar Siva Marabu <br>Sithaantha Dhyana Sabha Premises, kanakkanpatty, <br>Dindukkal Main Road, Palani - 624 613.<br></span></li>
                                   <li><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; hinduupm@gmail.com</li>
                                    <li><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; +91 9750682449</li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 mb-md-30">
                            <h5 class="footer-title">Donate Us</h5>
                            <p><span class="left"> Bank </span><span>: Indian Bank</span><br>
                                <span class="left">Branch </span><span>: Palani</span><br>
                            <span class="left">AC No</span><span>: 6657854883</span><br>
                            <span class="left">AC Name </span><span>: Hindu United Progressive Movement<br>
                               <span class="left"> IFSC Code</span><span>: IDIB000P014</span></span></p>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <h5 class="footer-title">Follow Us</h5>
                             <ul class="footer">
                                    <li><a href="https://www.facebook.com/hinduupm/"><h5><i class="fa fa-facebook-official" aria-hidden="true"></i> &nbsp; Facebook</h5></a></li>
                                    <li><a href="https://www.youtube.com/channel/UCnB_TsbRvtXbI6mPFtuRlsw"><h5><i class="fa fa-youtube-play" aria-hidden="true"></i> &nbsp;Youtube</h5></a></li>
                                    <li><a href="https://twitter.com/hinduupm"><h5><i class="fa fa-twitter" aria-hidden="true"></i>  &nbsp;Twitter</h5></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="ft-bottom-right">
                        <div class="footer-bottom-share">
                            <ul>
                               <li ><a href="index.html">Home</a></li>
                                <li class="active"><a href="about.html">Our Works</a></li>
                                <li><a href="devotional.html">Devotional Speech</a></li>
                                <li><a href="publication.html">Publications</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="copyright">
                       <p>&copy; 2019 All Rights Reserved, Powered by <a href="http://efacetts.com/">Efacetts</a> Pvt Ltd</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp">
            <i class="fa fa-angle-up"></i>
        </div>
<script type="text/javascript">
    $(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>
        <!-- modernizr js -->
        <script src="js/modernizr-2.8.3.min.js"></script>
        <!-- jquery latest version -->
        <script src="js/jquery.min.js"></script>
        <!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Menu js -->
        <script src="js/rsmenu-main.js"></script>
        <!-- op nav js -->
        <script src="js/jquery.nav.js"></script>
        <!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>

        <!-- <script src="js/slick.min.js"></script> -->
        <!-- isotope.pkgd.min js -->
        <!-- <script src="js/isotope.pkgd.min.js"></script> -->
        <!-- imagesloaded.pkgd.min js -->
        <!-- <script src="js/imagesloaded.pkgd.min.js"></script> -->
        <!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- counter top js -->
        <!-- <script src="js/waypoints.min.js"></script> -->
        <!-- Skill bar js -->
        <!-- <script src="js/skill.bars.jquery.js"></script> -->
        <script src="js/jquery.counterup.min.js"></script>
        <!-- video js -->
        <!-- <script src="js/jquery.mb.YTPlayer.min.js"></script> -->
        <!-- magnific popup -->
        <!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
        <!-- Nivo slider js -->
        <!-- <script src="inc/custom-slider/js/jquery.nivo.slider.js"></script>        -->
        <!-- plugins js -->
        <script src="js/plugins.js"></script>
        <!-- contact form js -->
        <!-- <script src="js/contact.form.html"></script> -->
        <!-- one page js -->
        <!-- <script src="js/jquery.singlePageNav.min.js"></script> -->
        <!-- Scroll tab js -->
        <script src="js/jquery.scrolling-tabs.js"></script>
        <!-- main js -->
        <script src="js/main.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
             $('.nav-tabs a[href="#<?php echo $tab;?>"]').tab('show');
          });
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

<!-- Mirrored from rstheme.com/products/html/hepta/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Jan 2019 11:21:38 GMT -->
</html>

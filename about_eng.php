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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                                                <a class="dropdown-item text-dark" style="margin: auto;width: 50%;padding: 10px;" href="index_hi.html">हिंदी</a>
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
            <a class="nav-link active" data-toggle="tab" href="#tab1">Door to Door Divine messages </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2">Divine messages in Temples்</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab3">Annadhanam</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab4">Yoga & Meditation்</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab5">Group Prayer</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab6">Prayer in Hospitals </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab7">Education for children</a>
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
                      <br><h5><strong>Door to Door Divine messages</strong></h5>
                        <p>If you visualize the temple in your mind and worship, you will achieve success. <br>
                        Maansik Puja, Worship, Bajan, Girivalam, Padyathra when performed while reciting mantras, will elevate you in many ways. <br>
                        Bharathiyar says, "The three qualities of fear, doubt and laziness prevent us from approaching success."<br>
                        <br>
                        We know that for doing any work, there exists a procedure or a formula.
                        <br> Likewise the teachings of our beloved Hindu dharma on how to worship Bhagavan
                        and rise in life are compiled in a brief door-slip (as shown below) and are pasted on the door/wall with the owner's permission.
                        <br> When we meet everyone, lets greet with divine mantra "Om Namasivaya Namo Namaha!” </p></div>
                  </div>
                  <p><br>We also preach doing six time Maansik pooja.
                    This endeavor of going door to door will definitely create an awareness on spiritual practices which can elevate the life of our hindu community. <br></br>
                        <i>Note: In all districts of Tamil Nadu, the work of door-to-door preaching is 90% completed.</i>
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
                      <br><h5><strong>Divine messages in Temples</strong></h5>
                    <p>
                    On behalf of our organization, 10X20 feet high BANNERs with divine Hindu messages have been placed in the main temples
                    in Tamil Nadu.
                    <br>
                    Also, on East Coast Road (ECR road) from Chennai to Kanyakumari, banners with divine messages and mantras are placed at a height of 9X15 feet for every 20 km.<br>
                    <br>In addition, our volunteers visit villages and erect spiritual message boards (2X4 feet high) in small temples. <br>
                    <br>So far 10000 boards have been placed across Tamil Nadu in about 7000 villages.<br>
It is commendable that after reading this divine message board, many Hindu people have been chanting mantras and doing Maansik pooja six times a day.
                    </p></div>
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
                      <br><h5>Annadhanam for Devotees</h5>
                     <p>Annadhanam is being giving at many places of worship. In our organization, 300 full-time devotees and about 500 devotees go from house to house preaching Maansik pooja and divine mantras to everyone.<br><br>
                       In general, all of our volunteers are educated, graduate youth! <br>
                       <br>They have dedicated their life to do spiritual work regardless of their own income, with the intent that everyone should progress spiritually. Annadhan is given daily to such  devotees. <br> <br> Come forward to support for Annadhan of such volunteers. You will receive divine grace.<br>


                    </p>
                    </div>
                  </div>
                    <br>
                    <h5>Annadhan program during Sundays</h5>
                    <p> Free Meditation classes, Yoga, Spiritual Discourse and Mantra Chanting classes are conducted every Sunday at the Dhiyaana Sabha located at Nathanallur, Walajabad Taluk, Kanchipuram District.
                      <br>Annadhanam is being given to the people who attended the classes .
                      <br>Many are participating and benefiting.
                      <br>Devotees who are spiritually interested in hosting this auspicious event on a weekly basis are sponsoring for this. If you wish, you can also SPONSOR and participate in the charity event. <br> <br>
                      If you want to participate in this you can make a generous donation or buy rice / oil / food items.
                      </p>
                    <h5>Annadhanam for devotees coming Padyathra to Pazhani</h5>
                    <p>As our Dhiyaana Sabha is located at Pazhani, Kanakkanpatti, we have been offering special Annadhan to the Devotees especially during Thai Poosam festival every year. Many good souls are participating with us in this event.
                      If you want, you can donate rice, grocery items and anything else in the Annadhan given to the pilgrims.
                     </p>
                    </p>
                    <h5>Annadhan for Ayyappa Devotees</h5>
                    <p>Usually, devotees who go to the Iyappan Temple have a habit of visiting Palani when they return after completing their darshan.
                      Devotees from Chennai, Villupuram, Kanchipuram, Vellore and Thiruvannamalai districts stay in our Dhiyaana Sabha.
                      Annathanam is held regularly during the months of Karthika, Markazhi and Thai. If you want to take part in this, you can buy rice, pulses,
                      groceries and get Bhagavan's blessings.</p>
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
                     <br> <h5> Yoga and Meditation Classes </h5>
                    <p>Meditation is definitely essential for a clear mind. Yogasana is required to keep the internal organs of the body in order.
                      This has been discovered by our Siddhas and Sages. <br>
                 It is completely right to say that yoga and meditation are shields of health. 80% of diseases can be cured by yoga and meditation.
                 This has happened in the experience of many. Yogasanas not only cure diseases but also prevent diseases. Meditation is the art of
                 developing memory and divine power. These two are like two eyes to us. <br> </p> <blockquote>
                “I learned the trick of developing a healthy body <br>
                I grew my body and I grew my life ”
                - Thirumoolar</blockquote>
                      </div>
                </div>
                <br>
                <p>"In general, wisdom cannot be achieved if the body is affected by disease. So I learned to nurture my body. I guarded my body with yoga and exercises" says Thirumoolar. The body suffers from many diseases and the mind is plagued with desires. If you practice yoga and meditation regularly, you can get rid of mental and physical problems and live blissfully thinking of Bhagawan.<br><br>
                The mission of our organization is to create awareness on this to the students who are our richest resources. Thus, our Hindu UPM and MODERN HEALTHY INDIAN YOGA FOUNDATION have been taking yoga and meditation classes for about 5 years with the permission of the schools in the villages and have received letters of appreciation from the Headmaster. Not only this, we go to the streets and
                with the help of MEGA PHONE gather children
                and practice Yoga and Meditation and make their evenings a great time.</p>
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
                     <br> <h5>Group Prayer</h5>
                     Good men are those who asks God to give them a chance to do good deeds.
                     <br>
                     The highest of human beings are those who actively work when given the opportunity to do such good deeds.
                     <br>
                     Sacred people are those who do not give up their service to society no matter how much opposition and obstacles come their way. They are servants of God. All the problems that comes on their path are the ones that were sent to make them emotionally matured.
                     <br></p>
                     <p>Hindu United Progressive Movement have formed a group of 260 spiritual volunteers to conduct Group Prayers daily early morning (at Brahma Muhurtha) for the development of our country and the progress of our people.
                     <br>
                     Prayers are also being offered to those who contributed materially to the spiritual activities of our organization and to those who donated to the Annadhanam.
                     <br>
                     Prayers are offered for the registered students to have good virtues, excellence in their work, healthy body and long life.
                     <br>
                     In addition, prayers are being offered separately for general public who have contacted us and requested for a group prayer to their individual problems.

                     </p>
                     <p><i>Note: In every family, either in the morning or in the evening, if everyone comes together for fifteen minutes, meditates
                        on their favorite temple, recites the Divine Mantra, do Maansik pooja and prays to Bhagavan collectively,
                      problems will be solved. </i></p>
                     <p>• Prayer for education of students <br>
                     •   Prayer for delays in marriage<br>
                     •   Prayer for job seekers<br>
                     •   Prayer for well being of family<br>
                     •   Prayer for Bhagavan's blessings for child birth<br>
                     •   Prayer for healing from diseases<br>
                     •   Prayer for financial wellness<br>
                     •   Prayer for unity in family<br>
                     •   Prayer for well-being of children<br>
                     •   Prayer for soul of the deceased<br>

                     </p>
                <div class="alert alert-warning">
                  <p>To register in group prayer conducted daily morning, please contact this number :<strong> + 91 82480 09953</strong>
              </p>
                </div>
                </div>
                <div class="bhoechie-tab-content" id="tab6">
                    <h5>Prayer in Hospitals</h5>
                       <blockquote>"Bhagavan gives more sufferings to those whom he wants to do good"</blockquote>
                        <p> Bhagavan gives trials to his devotees and matures and elevates his devotees minds. <br> <br>
                        We meet hospital patients who are in suffering and emphasize the importance of continuing to meditate and recite mantras so that they do not become discouraged.
                        In order to help them succeed, we help them to turn their leisure time into a useful time to meditate on God by giving them
                        leaflets and pamphlets containing "Ways to Improve Health, Spirituality and Economy in our Hindu Dharma" and a six-point Maansik Pooja schedule.<br><br></p>
                        <blockquote> The one who does not fail in remembering god though even if he loses everything, will achieve success again.”
                        – Swami Vivekananda</blockquote>
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
                     <br> <h5>Education for Children</h5>
                  <p>
Our ourganization is providing education to  the children of its full-time volunteers.<br> Along with education, these students are taught yoga and meditation. <br> They perform the six daily pujas of the Hindu dharma by chanting mantras daily. <br> </p>                    <blockquote> “ஓதாமல் ஒருநாளும் இருக்க வேண்டாம்”
                    "Education is to be done in Youth period” – Saint Avvaiyar</blockquote>
                    </div>
                  </div>
                    <br>
                    <p> Do not go to school without studying and reciting the divine mantra in your mind, both of these are necessary.
                      Thus it is better to learn this at a young age. So we will be happy to keep our students studying high school as well as devotional courses. <br> <br>
                      <i> Note: Hindu UPM also provides ssistance for postal education to young people who serve as full-time volunteers in the organization. </i>
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

<!DOCTYPE html>
<html lang="zxx">

<head>
   <!-- META TAGS -->
   <meta charset="UTF-8">
   <meta name="keywords" content="HTML, CSS, JavaScript, PHP, MYSQL">
   <meta name="description" content="Projekti per Inxhinieri t'Webit">
   <meta name="author" content="Fitim Bytyqi">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- TITLE -->
   <title>Groove App - Welcome</title>

   <!-- CSS -->
   <link rel="stylesheet" href="assets/css/styles.css">

   <!-- FAVICON -->
   <link rel="icon" href="favicon.ico" type="image/ico">

   <!-- GOOGLE FONT -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">

   <!-- FONT AWESOME -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

</head>

<body>
   <!-- PRELOADER -->
   <?php include_once 'inc/preloader.php' ?>

   <!-- HEADER -->
   <header id="header">
      <img src="assets/images/banner.jpg" alt="header banner" class="header__banner">
      <div class="container">
         <!-- NAVIGATION -->
         <div class="header__navbar">
            <div class="header__logo">
               <a href="index.php">
                  <img src="assets/images/logo.png" alt="groove app logo">
               </a>
            </div>

            <nav id="header__navigation">
               <ul class="nav__links">
                  <li class="nav__link">
                     <a href="#header">Home</a>
                  </li>
                  <li class="nav__link">
                     <a href="#section__a">About</a>
                  </li>
                  <li class="nav__link">
                     <a href="#section__d">App</a>
                  </li>
                  <li class="nav__link">
                     <a href="#section__e">Info</a>
                  </li>
                  <li class="nav__link">
                     <a href="blog.php">Blog</a>
                  </li>
                  <li class="nav__link">
                     <a href="login.php">Login</a>
                  </li>
               </ul>
            </nav>
         </div>

         <!-- SHOWCASE -->
         <div class="header__showcase">
            <div class="showcase__content">
               <div class="header__slider">
                  <!-- TEXT SLIDER -->
                  <h1 id="slider__text">Choose a better way to represent your app</h1>
               </div>

               <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
               <div class="showcase__buttons">
                  <a href="#section__d" class="btn__download--white">Download Free</a>
                  <a href="#section__f" class="btn__contact--outlined">Contact Us</a>
               </div>
            </div>
         </div>
      </div>
   </header>

   <!-- MAIN -->
   <main>
      <!-- SECTION A -->
      <div id="section__a">
         <div class="container">
            <div class="section__smartphone">
               <img src="assets/images/smartphone.jpg" alt="smartphone">
            </div>

            <div class="section__content">
               <div class="section__box box1">
                  <img src="assets/images/icons/section_a-icon1.jpg" alt="section icon">
                  <h3>First 7 Days Free</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ullam explicabo eos. Quaerat
                     consectetur unde corporis harum? In, recusandae nisi.</p>
               </div>
               <div class="section__box box2">
                  <img src="assets/images/icons/section_a-icon2.jpg" alt="section icon">
                  <h3>Modern Flat Design</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ullam explicabo eos. Quaerat
                     consectetur unde corporis harum? In, recusandae nisi.</p>
               </div>
               <div class="section__box box3">
                  <img src="assets/images/icons/section_a-icon3.jpg" alt="section icon">
                  <h3>Fully Support</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ullam explicabo eos. Quaerat
                     consectetur unde corporis harum? In, recusandae nisi.</p>
               </div>
               <div class="section__box box4">
                  <img src="assets/images/icons/section_a-icon4.jpg" alt="section icon">
                  <h3>User Friendly</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ullam explicabo eos. Quaerat
                     consectetur unde corporis harum? In, recusandae nisi.</p>
               </div>
            </div>
         </div>
      </div>

      <!-- SLIDER -->
      <div id="slideshow__container">

         <div class="slider__slide fade">
            <img src="assets/images/sliderPics/image__one.jpg" alt="random picture">
         </div>

         <div class="slider__slide fade">
            <img src="assets/images/sliderPics/image__two.jpg" alt="random picture">
         </div>

         <div class="slider__slide fade">
            <img src="assets/images/sliderPics/image__three.jpg" alt="random picture">
         </div>

         <div class="slider__slide fade">
            <img src="assets/images/sliderPics/image__four.jpg" alt="random picture">
         </div>

         <div class="slider__slide fade">
            <img src="assets/images/sliderPics/image__five.jpg" alt="random picture">
         </div>

         <div class="slider__slide fade">
            <img src="assets/images/sliderPics/image__six.jpg" alt="random picture">
         </div>

         <span class="prev" onclick="plusSlides(-1)">&lt;</span>
         <span class="next" onclick="plusSlides(1)">&gt;</span>

      </div>
      <!-- END OF SLIDER -->

      <!-- SECTION B -->
      <section id="section__b">
         <div class="container">
            <!-- LEFT SIDE -->
            <div class="left__side">
               <h2>Stable And Ready</h2>
               <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. At in accusamus aliquam nesciunt
                  inventore,
                  ullam velit quas quos ad fugiat quia aperiam repudiandae obcaecati! Tenetur nulla rem laboriosam
                  deleniti sequi aut adipisci odio quod, hic error aperiam cupiditate blanditiis facere?</p>
               <button type="button" class="download__button">Download Free</button>
            </div>

            <!-- RIGHT SIDE -->
            <div class="right__side">
               <ul class="aside__information">
                  <li class="aside__item">
                     <img src="assets/images/icons/section_b-icon1.jpg" alt="section icon">
                     <p>Made With Love</p>
                  </li>
                  <li class="aside__item active">
                     <img src="assets/images/icons/section_b-icon2.jpg" alt="section icon">

                     <div class="aside__wrapper">
                        <p>Free of Use</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis,
                           accusamus.</p>
                     </div>
                  </li>
                  <li class="aside__item">
                     <img src="assets/images/icons/section_b-icon3.jpg" alt="section icon">
                     <p>Fully Support Avaliable</p>
                  </li>
                  <li class="aside__item">
                     <img src="assets/images/icons/section_b-icon4.jpg" alt="section icon">
                     <p>Flat and Modern Ui & Ux</p>
                  </li>
               </ul>
            </div>
         </div>
      </section>

      <!-- SECTION C -->
      <section id="section__c">
         <div class="container">
            <div class="left__side">
               <img src="assets/images/icons/section_c-icon1.jpg" alt="editor picture">
            </div>
            <div class="right__side">
               <h2>Everything You Need</h2>
               <ul class="aside__information">
                  <li class="aside__item">
                     <i class="fas fa-check-circle"></i>
                     <p>Android</p>
                  </li>
                  <li class="aside__item">
                     <i class="fas fa-check-circle"></i>
                     <p>iPhone</p>
                  </li>
               </ul>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, non deleniti. Unde
                  perspiciatis,
                  ipsam deleniti aut distinctio voluptatum eius architecto quod, accusamus delectus repudiandae
                  hic,
                  labore adipisci? Quibusdam ab et vero dolorum obcaecati quidem. Ea rem et aliquid tenetur
                  perferendis!
               </p>
            </div>
         </div>
      </section>

      <!-- SECTION D -->
      <section id="section__d">
         <div class="container">
            <div class="left__side">
               <img src="assets/images/section_smartphone.jpg" alt="smartphone">
            </div>
            <div class="right__side">
               <h2>Now Available</h2>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, non deleniti. Unde
                  perspiciatis,
                  ipsam deleniti aut distinctio voluptatum eius architecto quod, accusamus delectus repudiandae
                  hic,
                  labore adipisci? Quibusdam ab et vero dolorum obcaecati quidem. Ea rem et aliquid tenetur
                  perferendis!
               </p>
               <div class="section__buttons">
                  <img src="assets/images/appstore_btn.jpg" alt="appstore button">
                  <img src="assets/images/playstore_btn.jpg" alt="playstore button">
               </div>
            </div>
         </div>

         <button type="button" class="absolute__btn">GET THE APP TODAY</button>
      </section>

      <!-- SECTION E -->
      <section id="section__e">
         <div class="container">
            <div class="footer__navigation">
               <div class="menu">
                  <p>Company</p>
                  <ul>
                     <li>Home</li>
                     <li>Jobs</li>
                     <li>Press</li>
                  </ul>
               </div>

               <div class="menu">
                  <p>Development</p>
                  <ul>
                     <li>iOS</li>
                     <li>Android</li>
                  </ul>
               </div>

               <div class="menu">
                  <p>Community</p>
                  <ul>
                     <li>Social</li>
                     <li>Forum</li>
                     <li>Contact</li>
                     <li>FAQ</li>
                  </ul>
               </div>

               <div class="menu">
                  <p>Info</p>
                  <ul>
                     <li>Terms of Service</li>
                     <li>Privacy Policy</li>
                  </ul>
               </div>
            </div>


            <!-- NEWSLETTER -->
            <?php include_once "inc/newsletter.php" ?>
         </div>
      </section>

      <!-- SECTION F -->
      <div id="section__f">
         <div class="container">
            <!-- CONTACT -->
            <?php include_once "inc/contact.php" ?>
         </div>
      </div>
   </main>

   <!-- FOOTER -->
   <footer id="footer">
      <div class="footer__copyright">
         <p>&copy; 2020 - <?php echo date("Y"); ?> FITIM BYTYQI, All Right Reserved</p>
      </div>

      <div class="footer__socials">
         <a href="https://facebook.com/fitimbyttyqi" target="_blank">
            <i class="fab fa-facebook-f fa-1x"></i>
         </a>
         <a href="#">
            <i class="fab fa-twitter fa-1x"></i>
         </a>
         <a href="#">
            <i class="fab fa-dribbble fa-1x"></i>
         </a>
         <a href="#">
            <i class="fab fa-google-plus-g fa-1x"></i>
         </a>
         <a href="#">
            <i class="fab fa-youtube fa-1x"></i>
         </a>
      </div>
   </footer>

   <!-- JS Scripts -->
   <script src="assets/js/slider.js"></script>
   <script src="assets/js/contactForm.js"></script>
</body>

</html>
<?php
session_start();
/*hello State*/
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");
include("includes/functions/vehicle_functions.php");

//print_r($_SESSION);

$all_vehicles = get_all_vehicles();
$page = get_pages_view('index');
$page_bottom = get_pages_view('quote_bottom');
$company_info = get_company_info(); 
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page['page_title'];?></title>
<meta name="keywords" content="<?php echo $page['meta_keywords']; ?>">
<meta name="description" content="<?php echo $page['meta_description']; ?>">
<meta name="verify-v1" content="xW+PxO8wGC7dI4P7aSIdeDceylTAnulPQxKkx1YeBW8=" />
<meta name="msvalidate.01" content="28C912B6D4DAF1D9375673C2FB676C85" />
<META name="y_key" content="01e0d029447d7513">
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/lightbox_rates.css" media="screen,projection" type="text/css" />
<link rel="icon" type="image/png" href="https://www.sunstatelimo.com/images/favicon.png">

<!--<script type="text/javascript" src="scripts/prototype.js"></script>
<script type="text/javascript" src="scripts/lightbox.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>-->
<script type="text/javascript" src="includes/js/date.js"></script>
<script type="text/javascript" src="includes/js/validate.js"></script>

<script language="javascript">
	function setcarseat(id){
		if(id=="1" || id=="3"){
			document.reserve.child_carseat.disabled = true;
			document.reserve.child_carseat.checked = false;
		}
		else
			document.reserve.child_carseat.disabled = false;
	}
</script>
    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Vegas Min CSS ===-->
    <link href="assets/css/plugins/vegas.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="assets/style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="assets/css/responsive.css" rel="stylesheet">
<script>
jQuery.noConflict();
jQuery(function() {
/**
	var $travel_date = jQuery('#travel_date');
    var $reserve_btn = jQuery('#reserve_btn');
    var date;
    $travel_date.on('blur', function(){
        date = $travel_date.val();
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: date, check: true}
        })
          .done(function( res ) {

            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
            };
          });
    });
    
    $reserve_btn.on('click', function(e){
        date = $travel_date.val();
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: date, check: true}
        })
          .done(function( res ) {

            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
                
                window.location.replace("http://www.sunstatelimo.com");
            };
          });
    });
    **/
});
</script>
<script type="text/javascript">
var http = createRequestObject();
function createRequestObject() {
	var objAjax;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		objAjax = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		objAjax = new XMLHttpRequest();
	}
	return objAjax;
}

function getNewContent(val){
http.open('get','loadlocations.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
}
}

function getNewlocationContent(val){
http.open('get','loadflight1.php?val='+val);
http.onreadystatechange = updateNewLocationContent;
http.send(null);
return false;
}

function updateNewLocationContent(){
if(http.readyState == 4){
document.getElementById('myLocationdetails').innerHTML = http.responseText;
}
}

function getNewlocationtoContent(val){
http.open('get','loadflight2.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent;
http.send(null);
return false;
}

function updateNewLocationtoContent(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto').innerHTML = http.responseText;
}
}
</script>
<script language="Javascript">
function xmlhttpPost(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring());
}

function getquerystring() {
    var form     = document.forms['reserve'];
	var vehicle_id = getCheckedValue(form.vehicle);
    var passenger_count = form.passenger_count.value;
	var trip_type = form.trip_type.value;
	var from = form.from.value;
	var to = form.to.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from=' + escape(from) +  '&to=' + escape(to);  // NOTE: no '?' before querystring
    return qstr;
}

function updatepage(str){
    //document.getElementById("result").innerHTML = str;
	document.reserve.total_amount.value = str;
}
</script>
</head>

<body onload="MM_preloadImages('images/rates_active.gif','images/fleet_active.gif','images/faq_active.gif','images/testimonials_active.gif','images/reserve_active.gif','images/contact_active.gif')">

    

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
	<?php include('includes/common/seasonal_header.php'); ?>
        <!--== Header Top Start ==-->
        <div id="header-top" class="d-none d-xl-block">
            <div class="container">
                <div class="row">
                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-6 text-left">
                        <i class="fa fa-map-marker"></i><span class="top-text">7021 Grand National Park Suite 104 Orlando, FL 32819 </span>
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-center">
                         <span class="top-text">Tel: 407-601-7900, Fax: 407-601-7901 </span>
                    </div>
                    <!--== Single HeaderTop End ==-->

                    
                    <!--== Single HeaderTop End ==-->

                    <!--== Social Icons Start ==-->
                    <div class="col-lg-3 text-right">
                        <a href="my-account.html"><span class="top-text">My Account</span></a>
                        <a href="login.html"><span class="top-text">Client Login</span></a>
                    </div>
                    <!--== Social Icons End ==-->
                </div>
            </div>
        </div>
        <!--== Header Top End ==-->

        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="index.html" class="logo">
                            <img src="assets/img/logo.png" alt="img">
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li class="active"><a href="index.html">Home</a></li>
                                <li><a href="rates.html">Rates</a></li>
                                <li><a href="fleet.html">Fleet</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="testimonial.html">Testimonials</a></li>
                                <li><a href="#">Reserve Online</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--== Main Menu End ==-->
                </div>
            </div>
        </div>
        <!--== Header Bottom End ==-->
    </header>
    <!--== Header Area End ==-->

    <!--== SlideshowBg Area Start ==-->
    <section id="slideslow-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="slideshowcontent">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <h1>Orlando's Premiere</h1>
                                <h3 style="color: #fff;">Transportation Company</h3>

                                <!--<div class="book-ur-car">
                                    <form action="">
                                        <div class="pick-location bookinput-item">
                                            <select class="custom-select">
                                              
                                              <option value="" selected="selected">Trip Type</option>
                                              <optgroup label="Orlando Area">
                                              <option value="1">Orlando Area - One Way</option>
                                              <option value="2">Orlando Area - Round Trip</option>
                                              </optgroup>
                                              <optgroup label="Cruise Transfer">
                                              <option value="76">Disney/Universal&gt;Cruise&gt;MCO - Round trip</option>
                                              <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                              <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                              <option value="7">MCO&gt;Disney or Universal&gt;Cruise terminal&gt;MCO (3 leg)</option>
                                              <option value="8">MCO&gt;Cruise Terminals&gt;Disney or Universal&gt;MCO (3 leg)</option>
                                              <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="10">Sanford&gt;Cruise Terminals&gt;Disney or Universal&gt;Sanford</option>
                                              </optgroup>
                                              <optgroup label="Attraction Transfer">
                                              <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                              <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                              <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                              <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                              <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                              <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
                                              </optgroup>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item">
                                            <select class="custom-select">
                                              <option selected>Transportation From</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item">
                                            <select class="custom-select">
                                              <option selected>Transportation To</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        

                                        <div class="retern-date bookinput-item">
                                            <input id="endDate2" placeholder="Transfer Date" />
                                        </div>

                                        <div class="retern-date bookinput-item">
                                            <input type="text" placeholder="Passenger Count" />
                                        </div>

                                        <div class="car-choose bookinput-item">
                                            <select class="custom-select">
                                              <option selected>Car Seat</option>
                                              <option value="1">Booster Seat</option>
                                              
                                            </select>
                                        </div>

                                        <div class="retern-date bookinput-item">
                                            <p>Quote: $120</p>
                                        </div>

                                        

                                        <div class="bookcar-btn bookinput-item">
                                            <button type="submit">Book Car</button>
                                        </div>
                                    </form>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== SlideshowBg Area End ==-->

     

    <!--== About Us Area Start ==-->
    <section id="about-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>About us</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Orlando Airport Transportation to Disney</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <!-- About Content Start -->
                <div class="col-lg-6">
                    <div class="display-table">
                        <div class="display-table-cell">
                            <div class="about-content">
                                <p><b>Thank you for considering Sunstate Transport, Inc. of Central Florida. </b></p>
                                <p>On your next trip to Orlando --for business, vacation, a family experience at Disney World or any of the Disney/Royal Caribbean/Carnival Cruise Lines --we would love for you to let Sunstate Transportation –the premier choice for Orlando Airport (MCO) and Disney World transportation services --handle all your transportation needs. You can be confident that our non-stop service to destinations of your choice is an exclusive service for your family alone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Content End -->

                <!-- About Video Start -->
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="assets/img/home-2-about.png" alt="img">
                    </div>
                </div>
                <!-- About Video End -->
            </div>

            
        </div>
    </section>
    <!--== About Us Area End ==-->

    

    <!--== Services Area Start ==-->
    <section>
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Our Services</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

			<!-- Service Content Start -->
			<div class="row">
				<div class="col-lg-11 m-auto text-center">
					<div class="service-container-wrap">
						<!-- Single Service Start -->
						<div class="service-item">
							<i class="fa fa-taxi"></i>
							<h3>RENTAL CAR</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit admollitia.</p>
						</div>
						<!-- Single Service End -->

						<!-- Single Service Start -->
						<div class="service-item">
							<i class="fa fa-cog"></i>
							<h3>CAR REPAIR</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit admollitia.</p>
						</div>
						<!-- Single Service End -->

						<!-- Single Service Start -->
						<div class="service-item">
							<i class="fa fa-map-marker"></i>
							<h3>TAXI SERVICE</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit admollitia.</p>
						</div>
						<!-- Single Service End -->

						<!-- Single Service Start -->
						<div class="service-item">
							<i class="fa fa-life-ring"></i>
							<h3>life insurance</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit admollitia.</p>
						</div>
						<!-- Single Service End -->

						<!-- Single Service Start -->
						<div class="service-item">
							<i class="fa fa-bath"></i>
							<h3>car wash</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit admollitia.</p>
						</div>
						<!-- Single Service End -->

						<!-- Single Service Start -->
						<div class="service-item">
							<i class="fa fa-phone"></i>
							<h3>call driver</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit admollitia.</p>
						</div>
						<!-- Single Service End -->
					</div>
				</div>
			</div>
			<!-- Service Content End -->
        </div>
    </section>
    <!--== Services Area End ==-->





    <!--== Pricing Area Start ==-->
    <section id="pricing-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Orlando Airport Transportation Reservations</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <!-- Pricing Table Conatent Start -->
            <div class="row">
                <!-- Single Pricing Table -->
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-pricing-table">
                        <h3>Town Car</h3>
                        <h2>$ 55.99</h2>
                        <h5>Daly</h5>

                        <ul class="package-list">
                            <li>4 PASSENGER</li>
                            <li>WITH LUGAGGES</li>
                            <li><button data-toggle="modal" data-target="#myModal2">book Now</button></li>
                        </ul>
                    </div>
                </div>
                <!-- Single Pricing Table -->

                <!-- Single Pricing Table -->
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-pricing-table">
                        <h3>Luxury Van</h3>
                        <h2>$ 155.99</h2>
                        <h5>Daly</h5>

                        <ul class="package-list">
                            <li>10 PASSENGER</li>
                            <li>WITH LUGAGGES</li>
                            <li><button data-toggle="modal" data-target="#myModal1">book Now</button></li>
                        </ul>
                    </div>
                </div>
                <!-- Single Pricing Table -->

                <!-- Single Pricing Table -->
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-pricing-table">
                        <h3>Limousine</h3>
                        <h2>$ 255.99</h2>
                        <h5>Daly</h5>

                        <ul class="package-list">
                            <li>7 PASSENGER</li>
                            <li>WITH LUGAGGES or 10 W/O LUGAGGES</li>
                            <li><button data-toggle="modal" data-target="#myModal">book Now</button></li>
                        </ul>
                    </div>

                      

                          <!-- Modal -->
                          <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  
                                  <h4>Transportation Reservations</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <div class="book-ur-car custom-modal-box">
                                    <form action="">
                                        <div class="pick-location bookinput-item custom-field">
                                            <select class="custom-select">
                                              
                                              <option value="" selected="selected">Trip Type</option>
                                              <optgroup label="Orlando Area">
                                              <option value="1">Orlando Area - One Way</option>
                                              <option value="2">Orlando Area - Round Trip</option>
                                              </optgroup>
                                              <optgroup label="Cruise Transfer">
                                              <option value="76">Disney/Universal&gt;Cruise&gt;MCO - Round trip</option>
                                              <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                              <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                              <option value="7">MCO&gt;Disney or Universal&gt;Cruise terminal&gt;MCO (3 leg)</option>
                                              <option value="8">MCO&gt;Cruise Terminals&gt;Disney or Universal&gt;MCO (3 leg)</option>
                                              <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="10">Sanford&gt;Cruise Terminals&gt;Disney or Universal&gt;Sanford</option>
                                              </optgroup>
                                              <optgroup label="Attraction Transfer">
                                              <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                              <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                              <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                              <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                              <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                              <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
                                              </optgroup>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Transportation From</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Transportation To</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        

                                        <div class="retern-date bookinput-item custom-field">
                                            <input id="endDate2" placeholder="Transfer Date" />
                                        </div>
                                        <div class="retern-date bookinput-item custom-field">
                                            <input type="text" placeholder="Passenger Count" />
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Car Seat</option>
                                              <option value="1">Booster Seat</option>
                                              
                                            </select>
                                        </div>

                                        <div class="retern-date bookinput-item custom-field">
                                            <p>Quote: $120</p>
                                        </div>

                                        

                                        <div class="bookcar-btn bookinput-item custom-field">
                                            <button type="submit">Book Car</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                
                              </div>
                              
                            </div>
                          </div>

                           <!-- Modal -->
                          <div class="modal fade" id="myModal1" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  
                                  <h4>Transportation Reservations</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <div class="book-ur-car custom-modal-box">
                                    <form action="">
                                        <div class="pick-location bookinput-item custom-field">
                                            <select class="custom-select">
                                              
                                              <option value="" selected="selected">Trip Type</option>
                                              <optgroup label="Orlando Area">
                                              <option value="1">Orlando Area - One Way</option>
                                              <option value="2">Orlando Area - Round Trip</option>
                                              </optgroup>
                                              <optgroup label="Cruise Transfer">
                                              <option value="76">Disney/Universal&gt;Cruise&gt;MCO - Round trip</option>
                                              <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                              <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                              <option value="7">MCO&gt;Disney or Universal&gt;Cruise terminal&gt;MCO (3 leg)</option>
                                              <option value="8">MCO&gt;Cruise Terminals&gt;Disney or Universal&gt;MCO (3 leg)</option>
                                              <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="10">Sanford&gt;Cruise Terminals&gt;Disney or Universal&gt;Sanford</option>
                                              </optgroup>
                                              <optgroup label="Attraction Transfer">
                                              <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                              <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                              <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                              <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                              <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                              <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
                                              </optgroup>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Transportation From</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Transportation To</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        

                                        <div class="retern-date bookinput-item custom-field">
                                            <input id="endDate2" placeholder="Transfer Date" />
                                        </div>
                                        <div class="retern-date bookinput-item custom-field">
                                            <input type="text" placeholder="Passenger Count" />
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Car Seat</option>
                                              <option value="1">Booster Seat</option>
                                              
                                            </select>
                                        </div>

                                        <div class="retern-date bookinput-item custom-field">
                                            <p>Quote: $120</p>
                                        </div>

                                        

                                        <div class="bookcar-btn bookinput-item custom-field">
                                            <button type="submit">Book Car</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                
                              </div>
                              
                            </div>
                          </div>

                           <!-- Modal -->
                          <div class="modal fade" id="myModal2" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  
                                  <h4>Transportation Reservations</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <div class="book-ur-car custom-modal-box">
                                    <form action="">
                                        <div class="pick-location bookinput-item custom-field">
                                            <select class="custom-select">
                                              
                                              <option value="" selected="selected">Trip Type</option>
                                              <optgroup label="Orlando Area">
                                              <option value="1">Orlando Area - One Way</option>
                                              <option value="2">Orlando Area - Round Trip</option>
                                              </optgroup>
                                              <optgroup label="Cruise Transfer">
                                              <option value="76">Disney/Universal&gt;Cruise&gt;MCO - Round trip</option>
                                              <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                              <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                              <option value="7">MCO&gt;Disney or Universal&gt;Cruise terminal&gt;MCO (3 leg)</option>
                                              <option value="8">MCO&gt;Cruise Terminals&gt;Disney or Universal&gt;MCO (3 leg)</option>
                                              <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                              <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                              <option value="10">Sanford&gt;Cruise Terminals&gt;Disney or Universal&gt;Sanford</option>
                                              </optgroup>
                                              <optgroup label="Attraction Transfer">
                                              <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                              <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                              <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                              <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                              <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                              <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
                                              </optgroup>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Transportation From</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Transportation To</option>
                                              <option value="1">BMW</option>
                                              <option value="2">Audi</option>
                                              <option value="3">Lexus</option>
                                            </select>
                                        </div>

                                        

                                        <div class="retern-date bookinput-item custom-field">
                                            <input id="endDate2" placeholder="Transfer Date" />
                                        </div>
                                        <div class="retern-date bookinput-item custom-field">
                                            <input type="text" placeholder="Passenger Count" />
                                        </div>

                                        <div class="car-choose bookinput-item custom-field">
                                            <select class="custom-select">
                                              <option selected>Car Seat</option>
                                              <option value="1">Booster Seat</option>
                                              
                                            </select>
                                        </div>

                                        <div class="retern-date bookinput-item custom-field">
                                            <p>Quote: $120</p>
                                        </div>

                                        

                                        <div class="bookcar-btn bookinput-item custom-field">
                                            <button type="submit">Book Car</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                
                              </div>
                              
                            </div>
                          </div>
                </div>
                <!-- Single Pricing Table -->
            </div>
            <!-- Pricing Table Conatent End -->
        </div>
    </section>
    <!--== Pricing Area End ==-->

  



    <!--== Articles Area Start ==-->
    <section id="tips-article-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Tips and articles</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <!-- Articles Content Wrap Start -->
            <div class="row">
                <!-- Single Articles Start -->
                <div class="col-lg-12">
                    <article class="single-article">
                        <div class="row">
                            <!-- Articles Thumbnail Start -->
                            <div class="col-lg-5">
                                <div class="article-thumb">
                                    <img src="assets/img/article/arti-thumb-1.jpg" alt="img">
                                </div>
                            </div>
                            <!-- Articles Thumbnail End -->

                            <!-- Articles Content Start -->
                            <div class="col-lg-7">
                                <div class="display-table">
                                    <div class="display-table-cell">
                                        <div class="article-body">
                                            <h3><a href="#">Wliquam sit amet urna eullam</a></h3>
                                            <div class="article-meta">
                                                <a href="#" class="author">By :: <span>Admin</span></a>
                                                <a href="#" class="commnet">Comments :: <span>10</span></a>
                                            </div>

                                            <div class="article-date">25 <span class="month">jan</span></div>

                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.</p>

                                            <a href="#" class="readmore-btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Articles Content End -->
                        </div>
                    </article>
                </div>
                <!-- Single Articles End -->

                <!-- Single Articles Start -->
                <div class="col-lg-12">
                    <article class="single-article middle">
                        <div class="row">

                            <!-- Articles Thumbnail Start -->
                            <div class="col-lg-5 d-xl-none">
                                <div class="article-thumb">
                                    <img src="assets/img/article/arti-thumb-2.jpg" alt="img">
                                </div>
                            </div>
                            <!-- Articles Thumbnail End -->

                            <!-- Articles Content Start -->
                            <div class="col-lg-7">
                                <div class="display-table">
                                    <div class="display-table-cell">
                                        <div class="article-body">
                                            <h3><a href="#">fringilla oremedad ipsum dolor sit</a></h3>
                                            <div class="article-meta">
                                                <a href="#" class="author">By :: <span>Admin</span></a>
                                                <a href="#" class="commnet">Comments :: <span>10</span></a>
                                            </div>

                                            <div class="article-date">14<span class="month">feb</span></div>

                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.</p>

                                            <a href="#" class="readmore-btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Articles Content End -->

                            <!-- Articles Thumbnail Start -->
                            <div class="col-lg-5 d-none d-xl-block">
                                <div class="article-thumb">
                                    <img src="assets/img/article/arti-thumb-2.jpg" alt="img">
                                </div>
                            </div>
                            <!-- Articles Thumbnail End -->
                        </div>
                    </article>
                </div>
                <!-- Single Articles End -->

                <!-- Single Articles Start -->
                <div class="col-lg-12">
                    <article class="single-article">
                        <div class="row">
                            <!-- Articles Thumbnail Start -->
                            <div class="col-lg-5">
                                <div class="article-thumb">
                                    <img src="assets/img/article/arti-thumb-3.jpg" alt="img">
                                </div>
                            </div>
                            <!-- Articles Thumbnail End -->

                            <!-- Articles Content Start -->
                            <div class="col-lg-7">
                                <div class="display-table">
                                    <div class="display-table-cell">
                                        <div class="article-body">
                                            <h3><a href="#">Tempored incididunt ut labore</a></h3>
                                            <div class="article-meta">
                                                <a href="#" class="author">By :: <span>Admin</span></a>
                                                <a href="#" class="commnet">Comments :: <span>10</span></a>
                                            </div>

                                            <div class="article-date">17 <span class="month">feb</span></div>

                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.</p>

                                            <a href="#" class="readmore-btn">Read More <i class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Articles Content End -->
                        </div>
                    </article>
                </div>
                <!-- Single Articles End -->
            </div>
            <!-- Articles Content Wrap End -->
        </div>
    </section>
    <!--== Articles Area End ==-->

        <!--== Fun Fact Area Start ==-->
    <section id="funfact-area" class="overlay section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-md-12 m-auto">
                    <div class="funfact-content-wrap">
                        <div class="row">
                            <!-- Single FunFact Start -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-smile-o"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter">550</span>+</p>
                                        <h4>HAPPY CLIENTS</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-car"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter">250</span>+</p>
                                        <h4>CARS IN STOCK</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->

                            <!-- Single FunFact Start -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-funfact">
                                    <div class="funfact-icon">
                                        <i class="fa fa-bank"></i>
                                    </div>
                                    <div class="funfact-content">
                                        <p><span class="counter">50</span>+</p>
                                        <h4>office in cities</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FunFact End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Fun Fact Area End ==-->

        <!--== Testimonials Area Start ==-->
    <section id="testimonial-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Testimonials</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Lorem ipsum dolor sit amet elit.</p>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 m-auto">
                    <div class="testimonial-content">
                        <!--== Single Testimoial Start ==-->
                        <div class="single-testimonial">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.</p>
                            <h3>Vongchong Smith</h3>
                            <div class="client-logo">
                                <img src="assets/img/client/client-pic-1.jpg" alt="img">
                            </div>
                        </div>
                        <!--== Single Testimoial End ==-->

                        <!--== Single Testimoial Start ==-->
                        <div class="single-testimonial">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.</p>
                            <h3>Amader Tuni</h3>
                            <div class="client-logo">
                                <img src="assets/img/client/client-pic-3.jpg" alt="img">
                            </div>
                        </div>
                        <!--== Single Testimoial End ==-->

                        <!--== Single Testimoial Start ==-->
                        <div class="single-testimonial">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis totam obcaecati impedit, at autem repellat vel magni architecto veritatis sed.</p>
                            <h3>Atex Tuntuni Smith</h3>
                            <div class="client-logo">
                                <img src="assets/img/client/client-pic-2.jpg" alt="img">
                            </div>
                        </div>
                        <!--== Single Testimoial End ==-->
                    </div>
                </div>
            </div>
        </div>
    </section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div>
                    <div><form id="reserve" style="padding-top:0px;" name="reserve" method="post" action="https://dev.sunstatelimo.com/reserve_step2.php" onsubmit="return validate3(this)">
                      <div width="100%" border="0" cellspacing="0" cellpadding="0">
                      <div valign="middle">
                <div class="ob">
                        <?php 
            $all_vehicles = get_all_vehicles();
            if(count($all_vehicles)>=1){
            ?>
              <div class="BorderBox">
              <div class="edit-account">
                <h4>Select Vehicle:</h4>
                <div class="">
                <?php
        $count =0;
        foreach($all_vehicles as $value){
        ?>
                <div class="third-part-s">
                  
                
                          <div class="ot">
                            <input name="vehicle" value="<?php echo $value['id']; ?>" type="radio" onclick="setcarseat(getCheckedValue(this));" />   
                            <b><?php echo $value['name']; ?></b>
                                                     </div>
                       
                  <div class="ot-img">
            <?php if (!empty($value['vehicle_image'])) { ?><img src="media/images/thumbs/<?php echo $value['vehicle_image']; ?>" alt="<?php echo $value['name']; ?>" width="168" title="<?php echo $value['name']; ?>" /><?php } ?>
                    
                  </div>



                
                          <div class="ot"><?php echo $value['description']; ?></div>
                          </div>
                    
                <?php
        $count++;
        if ($count > 2 ) {
        echo "</div><div>";
        $count =0;
              }
        }
        ?>
                 
              </div>
              </div>
              <?php 
        
        }
        
        ?>                </div>
        </div>



                      <div class="edit-account">





                        
                <div class="ob"><strong>Trip Type: <font color="#ff0000" size="2">*</font></strong></div>
                <div class="ot2"><select name="trip_type" id="trip_type" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="76">Disney/Universal>Cruise>MCO - Round trip</option>
                                      <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
                    </OPTGROUP>
                                      <OPTGROUP LABEL="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
                    </OPTGROUP>
                                    </select></div>
              
              <div>
                <div><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>                </div>
              </div>

              <div>
                              <div class="ot">
                                <strong>Transfer Date: <font color="#ff0000" size="2">*</font></strong>                   </div>
                                <div class="ot">
                                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                        
                        <input name="travel_date" type="text" id="travel_date" class="datepicker" size="10" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('travel_date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                        </div>
                                <div class="ot">&nbsp;                                </div>
                            </div>


                            <div>
                              <div class="ot">
                                <strong>Passenger Count: <font color="#ff0000" size="2">*</font></strong>                   </div>
                                <div class="ot">
                        <input name="passenger_count" type="text" id="passenger_count" size="4" maxlength="4"> &nbsp;&nbsp;&nbsp;
                        <input name="child_carseat" type="checkbox" value="Yes" />
                        <label><strong>Car Seat</strong></label>
                        <input name="child_boosterseat" type="checkbox" id="child_boosterseat" value="Yes" />
                        <label><strong>Booster Seat</strong></label></div>
                                <div class="ot">&nbsp;                                </div>
                            </div>


                             <div valign="middle">
                        <div class="ob"></div>
                        <div class="ot2" background="images/price_box.jpg" style="background-repeat:no-repeat;">&nbsp;&nbsp;<span style="font-size:16px;"><strong>Quote:</strong></span> &nbsp;<span style="color:#000000; font-size:16px;">$<input name="total_amount" id="total_amount" class="bodytxt" size="12" type="text" disabled="disabled" style="font-size:16px; color:#000000; background-color:#ff9600; border:#ff9600 solid 1px; font-weight:bold;"> </span></div>
                                <div class="ot">&nbsp;                                </div>
                      </div>

                      <div class="ob"><span class="ob style1 style1">Note: For round trip  you can enter return date on next step</span></div>

                      <div><input value="Get Quote" type="button" style="border:#648ACE solid 1px; color:#FFFFFF; background-color:#ff9600; padding:3px;" onclick="return validate4(document.reserve);"> <input name="submit3" id="reserve_btn" value="Click here to Reserve Now" style="border:#648ACE solid 1px; color:#FFFFFF; background-color:#49cb1c; padding:3px;" type="submit" onclick="if (validateDate(reserve.travel_date.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {}else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}">                         </div>




                    </div>









</form>
            
                  </div>
                      
                      </div>
                </div>
      </div>
    </div>
  </div>
</section>

    <!--== Footer Area Start ==-->
    <section id="footer-area">
        <!-- Footer Widget Start -->
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>About Us</h2>
                            <div class="widget-body">
                                <img src="assets/img/footer-logo.png" alt="logo">
                                <p>On your next trip to Orlando --for business, vacation, a family experience at Disney World or any of the Disney/Royal Caribbean/Carnival Cruise Lines --we would love for you to let Sunstate Transportation –the premier choice for Orlando Airport (MCO) and Disney World transportation </p>

                                

                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->

                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>Usefull Links</h2>
                            <div class="widget-body">
                                <ul class="recent-post">
                                    <li>
                                        <a href="index.html">
                                           Home
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="rates.html">
                                          Rates
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="fleet.html">
                                           Fleet
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="faq.html">
                                            FAQ
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>

                                    <li>
                                        <a href="testimonial.html">
                                            Testimonials
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            Reserve Online
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>

                                    <li>
                                        <a href="contact.html">
                                            Contact
                                           <i class="fa fa-long-arrow-right"></i>
                                       </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->

                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>get touch</h2>
                            <div class="widget-body">
                                

                                <ul class="get-touch">
                                    <li><i class="fa fa-map-marker"></i> 7021 Grand National Park Suite 104 Orlando, FL 32819</li>
                                    <li><i class="fa fa-mobile"></i> +407-601-7900</li>
                                    <li><i class="fa fa-envelope"></i> reservations@sunstatelimo.com </li>
                                </ul>

                                <div class="header-social-icons">
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>

                                <div class="newsletter-area">
                                    <form action="index.html">
                                        <input type="email" placeholder="Subscribe Our Newsletter">
                                        <button type="submit" class="newsletter-btn"><i class="fa fa-send"></i></button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->
                </div>
            </div>
        </div>
        <!-- Footer Widget End -->

        <!-- Footer Bottom Start -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; All rights reserved by <a href="#" target="_blank">Sunstatelimo</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </section>
    <!--== Footer Area End ==-->
<?php
unset ($_SESSION['notice']);
?>
    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="img">
    </div>
    <!--== Scroll Top Area End ==-->

    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="assets/js/jquery-migrate.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="assets/js/plugins/gijgo.js"></script>
    <!--=== Vegas Min Js ===-->
    <script src="assets/js/plugins/vegas.min.js"></script>
    <!--=== Isotope Min Js ===-->
    <script src="assets/js/plugins/isotope.min.js"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="assets/js/plugins/counterup.min.js"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="assets/js/plugins/mb.YTPlayer.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="assets/js/plugins/slicknav.min.js"></script>

    <!--=== Mian Js ===-->
    <script src="assets/js/main.js"></script>

</body>

</html>
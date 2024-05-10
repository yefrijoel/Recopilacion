<!-- PHP INCLUDES -->


<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
		<meta name="author" content="JAIRI IDRISS">
		<title>Reservación | Mis Vales</title>

		<!-- EXTERNAL CSS LINKS -->

		<link rel="stylesheet" type="text/css" href="Design/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Design/fonts/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="Design/css/main.css">
		<link rel="stylesheet" type="text/css" href="Design/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="Design/css/styrese.css">
        <link rel="stylesheet" type="text/css" href="Design/css/styrese2.css">


		<!-- GOOGLE FONTS -->

		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">

	</head>

	<!-- BODY -->

	<body>
	

    
    <!-- START NAVBAR SECTION -->

    <?php include "menupt.php" ?>
    <!-- START NAVBAR SECTION -->
	<div class="header-height" style="height: 120px;"></div>

    <!-- END NAVBAR SECTION -->    
    

    <!-- START ORDER FOOD SECTION -->

    <section style="
    background: url(Design/images/food_pic.jpg);
    background-position: center bottom;
    background-repeat: no-repeat;
    background-size: cover;">
        <div class="layer">
            <div style="text-align: center;padding: 15px;">
                <h1 style="font-size: 120px; color: white;font-family: 'Roboto'; font-weight: 100;
">Book a Table</h1>
            </div>
        </div>
        
    </section>

	<section class="table_reservation_section">

        <div class="container">
            


            <div class="text_header">
                <span>
                    1. Select Date & Time
                </span>
            </div>
            <form method="POST" action="table-reservation.php">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="reservation_date">Date</label>
                            <input type="date" min="2024-05-07" 
                            value = "2024-05-07"
                            class="form-control" name="reservation_date">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="reservation_time">Time</label>
                            <input type="time" value="18:02" class="form-control" name="reservation_time">
                        </div>
                    </div> 
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="number_of_guests">How many people?</label>
                            <select class="form-control" name="number_of_guests">
                                <option value="1" >
                                    One person
                                </option>
                                <option value="2" >Two people</option>
                                <option value="3" >Three people</option>
                                <option value="4" >Four people</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="check_availability" style="visibility: hidden;">Check Availability</label>
                            <input type="submit" class="form-control check_availability_submit" name="check_availability_submit">
                        </div>
                    </div>
                </div>
            </form>

            <!-- CHECKING AVAILABILITY OF TABLES -->

                    </div>
    </section>


    <section class="restaurant_details" style="background: url(Design/images/food_pic_2.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: 50% 0%;
    background-size: cover;
    color:white !important;
    min-height: 300px;">
        <div class="layer">
            <div class="container">
            <div class="row">
            <div class="col-md-3 details_card">
                <span>30</span>
                <div>
                    Total 
                    <br>
                    Reservations
                </div>
            </div>
            <div class="col-md-3 details_card">
                <span>30</span>
                <div>
                    Total 
                    <br>
                    Menus
                </div>
            </div>
            <div class="col-md-3 details_card">
                <span>30</span>
                <div>
                    Years of 
                    <br>
                    Experience
                </div>
            </div>
            <div class="col-md-3 details_card">
                <span>30</span>
                <div>
                    Profesionnal 
                    <br>
                    Cook
                </div>
            </div>
        </div>
        </div>
         </div>
    </section>

    <!-- FOOTER BOTTOM  -->
    <?php include "copir.php" ?>
	
		<!-- INCLUDE JS SCRIPTS -->

		<script src="Design/js/jquery.min.js"></script>
		<script src="Design/js/bootstrap.min.js"></script>
		<script src="Design/js/bootstrap.bundle.min.js"></script>
		<script src="Design/js/main.js"></script>

	</body>

	<!-- END BODY TAG -->

</html>

<!-- END HTML TAG -->
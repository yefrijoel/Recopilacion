
<!-- PHP INCLUDES -->


<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
		<meta name="author" content="JAIRI IDRISS">
		<title>Restaurant</title>

		<!-- EXTERNAL CSS LINKS -->

		<link rel="stylesheet" type="text/css" href="Design/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Design/fonts/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="Design/css/main.css">
		<link rel="stylesheet" type="text/css" href="Design/css/responsive.css">

		<!-- GOOGLE FONTS -->

		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">

	</head>

	<!-- BODY -->

	<body>
        
    <?php include "menupt.php" ?>
    <!-- START NAVBAR SECTION -->
	<div class="header-height" style="height: 120px;"></div>

    <!-- END NAVBAR SECTION -->
	<!-- HOME SECTION -->

	<section class="home-section" id="home">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				<div class="col-md-6 home-left-section">
					<div style="padding: 100px 0px; color: white;">
						<h1>
							RESTAURANTE MIS VALES.
						</h1>
						<h2>
							MAKING PEOPLE HAPPY
						</h2>
						<hr>
						<p>
						Disfruta y degusta de los mas deliciosos platos típicos de la región en MIS VALES
						</p>
						<div style="display: flex;">							
							<a href="#menus" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
							VER MENÚ
								<i class="fas fa-angle-right"></i>
							</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>

	<!-- OUR QUALITIES SECTION -->

	<section class="our_qualities" style="padding:100px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/quality_food_img.png" >
	                    <div class="caption">
	                        <h3>
							Alimentos de calidad
	                        </h3>
	                        <p>
							Disfruta de la mas alta calidad de nuestros alimento, calidad certificada
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/fast_delivery_img.png" >
	                    <div class="caption">
	                        <h3>
							Servicio de calidad
	                        </h3>
	                        <p>
							Contamos con un eficiente servicio en la entrega de nuestros productos.
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/original_taste_img.png" >
	                    <div class="caption">
	                        <h3>
							Alimentos de calidad
	                        </h3>
	                        <p>
							Visítanos y deleita tu paladar con las mas deliciosas comidas típicas de la región y nuestros platos totalmente exclusivos
	                        </p>
	                    </div>
	                </div>
				</div>

			</div>
		</div>
	</section>

	<!-- OUR MENUS SECTION -->

	<section class="our_menus" id="menus">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">DESCUBRE NUESTROS MENÚS</h2>
			
				
			<div class="menus_tabs">
				<div class="menus_tabs_picker">	
												
				</div>
				<div class="menus_tab">
					<div class="menu_item  tab_category_content" id="burgers" style=display:block>
					<div class="row py-4">
					<?php 
			require ('connect.php');
			$sql="SELECT * FROM designdb.productos WHERE categorias_idcategorias = 10";
			$tabla=mysqli_query($conectar,$sql);
			while($fila=mysqli_fetch_array($tabla)){
				?>				
	                                            <div class="col-lg-3 menu-item">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                    
	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url(<?php echo $fila[4] ?>);"></div>
													        </div>
													    </div>
														                                                    
	                                                    <div class="caption">
	                                                        <h5>
															<?php echo $fila[1] ?>	                                                        
															</h5>
	                                                        <p>
															<?php echo $fila[5] ?>	
															 </p>
	                                                        <span class="menu_price"><?php echo $fila[3] ?></span>
	                                                    </div>												
	                                                </div>
	                                            </div>
												<?php
			}
			?>
	                                        </div>
										</div>                              									
                                        </div>
										</div> 
										
									</div>								
	</section>

	<!-- IMAGE GALLERY -->

	<section class="image-gallery" id="gallery">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">IMAGE GALLERY</h2>
			<div class = 'row'><div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>
	                		<div style = "background-image: url('admin/Uploads/images/58146_Moroccan Chicken Tagine.jpeg') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		</div><div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>
	                		<div style = "background-image: url('Design/images/img_1.jpg') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		</div><div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>
	                		<div style = "background-image: url('Design/images/img_2.jpg') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		</div><div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>
	                		<div style = "background-image: url('Design/images/img_3.jpg') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		</div><div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>
	                		<div style = "background-image: url('admin/Uploads/images/burger.jpeg') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		</div></div>		</div>
	</section>

	<!-- CONTACT US SECTION -->

	<section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
                            Get in touch with us & 
                            <br>send us message today!
                        </h2>
                        <p>
                            Saasbiz is a different kind of architecture practice. Founded by LoganCee in 1991, we’re an employee-owned firm pursuing a democratic design process that values everyone’s input.
                        </p>
                        <h3>
                            1580  Boone Street, Corpus Christi, TX, 78476 - USA                        </h3>
                        <h4>
                            <span>Email:</span> 
                            vincent.pizza@gmail.com                            <br> 
                            <span>Phone:</span> 
                            088866777555                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">
                    <div class="contact-form">
                        <div id="contact_ajax_form" class="contactForm">
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Name">
                                    <div class="invalid-feedback" id="invalid-name" style="display: block">
                                    	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback" id="invalid-email" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="contact_subject" name="subject" oninput="document.getElementById('invalid-subject').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Subject">
                                    <div class="invalid-feedback" id="invalid-subject" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="message" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                                    <div class="invalid-feedback" id="invalid-message" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" class="bttn_style_2">Send Message</button>
                                </div>
                            </div>
                            <div id="sending_load" style="display: none;">Sending...</div>
                            <div id="contact_status_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<!-- OUR QUALITIES SECTION -->
	
	<section class="our_qualities_v2">
		<div class="container">
			<div class="row">
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_1">
						<div class="text_inside_quality">
							<h5>Quality Foods</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_2">
						<div class="text_inside_quality">
							<h5>Fastest Delivery</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_3">
						<div class="text_inside_quality">
							<h5>Original Recipes</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- WIDGET SECTION / FOOTER -->

	<section class="widget_section" style="background-color: #222227;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/images/logomisvales.png" alt="Restaurant Logo" style="width: 180px;margin-bottom: 20px;">
                        <p>
                            Our Restaurnt is one of the bests, provide tasty Menus and Dishes. You can reserve a table or Order food.
                        </p>
                        <ul class="widget_social">
                            <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Headquarters</h3>
                        <p>
                            1580  Boone Street, Corpus Christi, TX, 78476 - USA                        </p>
                        <p>
                            vincent.pizza@gmail.com                            <br>
                            088866777555   
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Opening Hours
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>Subscribe to our contents</h3>
                        <div class="subscribe_form">
                            <form action="#" class="subscribe_form" novalidate="true">
                                <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                                <button type="submit" class="submit">SUBSCRIBE</button>
                                <div class="clearfix"></div>
                            </form>
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
		<script src="Design/js/sjava.js"></script>

	</body>

	<!-- END BODY TAG -->

</html>

<!-- END HTML TAG -->
    

<?php 
		require_once("includes.php"); 
		// NOCH TO COME!
		Menu::createMenu("Auktion"); ?>

        <!-- page content -->
        <div class="right_col" role="main" >

          <div class="" style="margin-bottom:250px;">
            <div class="page-title">
              <div class="title_left">
                <h3>Auktion</h3>
              </div>
            </div>

            <!-- Hey -->
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Immobilie 1</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="product-image">
                        <img src="images/prod-1.jpg" width="250px" height="auto" alt="..." />
                      </div>
					  
					  <h3 class="prod_title">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>

                      <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                      <br />

                      <div class="">
                        <h2>Bieter Spanne</h2>
						<div class="row grid_slider">

						  <div class="col-md-6 col-sm-6 col-xs-12">
							<p>Grid with slider labels are far away outside it's container</p>
							<input type="text" id="range_25" value="" name="range" />
						  </div>				  
						 					  
                    </div>

                      </div>

                      <div class="">
                        <div class="product_price">
                          <h1 class="price">€ 80.00</h1>
                          <span class="price-tax">Tax: Ksh80.00</span>
                          <br>
                        </div>
                      </div>

                      <div class="">
                        <button type="button" class="btn btn-default btn-lg">Bieten</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Immobilie 1</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="product-image">
                        <img src="images/prod-1.jpg" width="250px" height="auto" alt="..." />
                      </div>
					  
					  <h3 class="prod_title">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>

                      <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                      <br />

                      <div class="">
                        <h2>Bieter Spanne</h2>
						<div class="row grid_slider">

						  <div class="col-md-6 col-sm-6 col-xs-12">
							<p>Grid with slider labels are far away outside it's container</p>
							<input type="text" id="range_26" value="" name="range" />
						  </div>				  
						 					  
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                      

                  </div>
                      </div>

                      <div class="">
                        <div class="product_price">
                          <h1 class="price">Ksh80.00</h1>
                          <span class="price-tax">Ex Tax: Ksh80.00</span>
                          <br>
                        </div>
                      </div>

                      <div class="">
                        <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                        <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
          </div>
        </div>
		
		
		
        <!-- /page content -->
		
		
		<!-- Ion.RangeSlider -->
    <script>
      $(document).ready(function() {
        $("#range_25").ionRangeSlider({
          type: "double",
          min: 1000000,
          max: 2000000,
          grid: true
        });
        $("#range_26").ionRangeSlider({
          type: "double",
          min: 0,
          max: 10000,
          step: 500,
          grid: true,
          grid_snap: true
        });
      });
    </script>
	
    <!-- /Ion.RangeSlider -->


		<!-- footer content -->
        <footer style="background-color:#EDEDED">
          <div class="pull-right fixed" >
            Kapital: 10.000.000 €</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

        <?php include 'includes_js.php'; ?>

  </body>
</html>
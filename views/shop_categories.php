<body class="page shop">
  <!--[if lt IE 10]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<div class="main-wrapper">
  <div class="container-fluid">
    <div class="row header">
    	<?php include_once(ROOT_DIR.'/includes/menu.php'); ?>
    </div>
    <div class="view-container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>shop appetite</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" onclick="window.location.href='/directory';">
          <div class="col-xs-12 directory-button-container">
            <div class="directory-button-inner">
              <div class="col-xs-10 text-left">
                <h4>Business Directory</h4>
              </div>
              <div class="col-xs-2 text-right">
                <i class="fa fa-arrow-right "></i>
              </div>
            </div>
          </div>
        </div>    

<?php   

if(count($this->arrCats) > 0) {?>

        <div class="row products-container">

<?php foreach($this->arrCats As $c) { ?>

          <div class="product-wrapper" onclick="window.location.href='/shop/cat/<?php echo $c['id']; ?>/';">
            <div class="background-wrapper">
              <img src="<?php echo $c['icon_img']; ?>" alt="" class="img-responsive" />


            </div>
            <div class="product-top">
              <div class="col-xs-12 points-hex-container">
               
<?php   if ($c['icon_font'] != "") { ?>   
                <div class="points-hex text-center">
                  <p><i class="fa <?php echo $c['icon_font']; ?> fa-2x"></i></p>
                </div>
<?php   } else { ?>   
                  
<?php   } ?>                  
                
              </div>
            </div>
            <div class="product-middle">
            </div>
            <div class="product-bottom">
              <div class="col-xs-12 points-hex-container">
                
                  <p><?php echo $c['cat_title']; ?></p>
                
              </div>
            </div>
          </div>

<?php } ?>

        </div>  <!-- products-container -->

<?php } else { ?>

        <div class="row text-center">
          <br clear="all" />
          <div style="height:150px">
             <p>Sorry, no categories for this sponsor.</p>
          </div>
        </div>

<?php } ?>

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
    </div>  <!-- view-container  -->
  </div>      <!-- container-fluid  -->
</div>        <!-- main-wrapper  -->

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/shop.js"></script>

</body>
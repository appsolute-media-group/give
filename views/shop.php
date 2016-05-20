<body class="page shop">
  <!--[if lt IE 10]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<div class="main-wrapper">
  <div class="container-fluid">
    <div class="row header">
    	<?php include_once(ROOT_DIR.'/includes/menu.php'); ?>
    </div>
    <div class="view initial" data-view="1">
      <div class="view-container">
        <div class="row">
          <div class="col-md-6 item">
            <div class="item-inner">
              <div class="item-header">
                <div class="text-center">
                  <h1>shop appetite</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 input-container text-center">
            <div class="input-inner">
              <input type="text" name="shop_search" id="shop_search" value="<?php echo $this->strSearchTerm;?>" placeholder="Search">
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

if(count($this->arrDeals) > 0) {?>

    <div class="row products-container">

<?php foreach($this->arrDeals As $d) { ?>

          <div class="product-wrapper" onclick="window.location.href='/shop/details/<?php echo $d['id']; ?>/';">
            <div class="background-wrapper">
              <img src="<?php echo $d['deal_image']; ?>" alt="" />
            </div>
            <div class="product-top">
              <div class="col-xs-12 points-hex-container">
                <div class="points-hex text-center">
                  <p><?php echo $d['deal_price']; ?></p>
                </div>
              </div>
            </div>
            <div class="product-middle">
            </div>
            <div class="product-bottom text-center">
              <div class="col-xs-12 points-hex-container">
                <div class="text-center">
                  <p><?php echo $d['deal_title']; ?></p>
                </div>
              </div>
            </div>
          </div>

<?php } ?>

    </div>

<?php } else { ?>

  <div class="row text-center">
    <br clear="all" />
    <div style="height:150px">
        <p>Sorry, no deals to display.</p>
    </div>
  </div>

<?php 
}

?>


        </div>
      </div>
    </div>

<?php include_once(ROOT_DIR.'/includes/banners.php'); ?>
  </div>
</div>

<script src="/scripts/bootstrap.js"></script>
<script src="/scripts/main.js"></script>
<script src="/scripts/shop.js"></script>

</body>
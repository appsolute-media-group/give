<body class="page shop">
  <!--[if lt IE 10]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<div class="main-wrapper">
  <div class="container-fluid">
    <div class="row header">
    	<?php include_once(ROOT_DIR.'/includes/menu.php'); ?>
    </div>


  <div class="view initial" data-view="1" style="margin-bottom:80px;">
    <div class="view-container">
      <div class="row">
        <div class="col-xs-12 directory-header-container text-center">
          <h2>Business Directory</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 directory-input-container text-center">
          <div class="input-inner">
            <input type="text" name="directory_search" id="directory_search" value="<?php echo $this->strSearchTerm;?>" placeholder="Search">
          </div>
        </div>
      </div>
      <div class="directory-list">


<?php   
if(count($this->arrSponsors) > 0) {

  foreach($this->arrSponsors As $s) { ?>

        <div class="row" onclick="window.location.href='/directory/details/<?php echo $s['id']; ?>/';">
          <div class="col-xs-12 directory-item-container">
            <div class="directory-item-inner">
              <div class="col-xs-4">
                <div class="business-logo-container">
                  <div class="business-logo-wrapper text-center">
                    <img src="<?php echo $s['sponsor_img']; ?>" class="center-block img-responsive" alt="" style="height:80px; width:auto;" />
                  </div>
                </div>
              </div>
              <div class="col-xs-8 text-left business-info">
                <h4 class="business-title"><?php echo $s['sponsor_name']; ?></h4>
                <h6 class="business-category"><?php echo $s['sponsor_slogan']; ?></h6>
              </div>
            </div>
          </div>
        </div>

<?php 
  }

} else { ?>

  <div class="row text-center">
    <br clear="all" />
    <div style="height:150px">
        <p>Sorry, no sponsors to display.</p>
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
<script src="/scripts/directory.js"></script>

</body>
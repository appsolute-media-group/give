

  <nav class="navbar navbar-default">
    <div class="container-fluid navbar-default-color">  
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <img src="/images/CA_Logo_simple_white.png" alt="" height="40" />
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse navbar-header" id="bs-example-navbar-collapse-1">
<?php if(isset($_SESSION['userID']) && $_SESSION['userID'] != '') { ?>
        <ul class="nav navbar-nav">
          <li><a href="/main/" >Home</a></li>
          <li><a href="/donate/" >Donate</a></li>
          <li><a href="/profile/" >My Profile</a></li>
          <li><a href="/messages/" >Messages</a></li>
          <li><a href="/foodbank/" >My Food Bank</a></li>
          <li><a href="/faq/" >FAQs</a></li>
          <li><a href="/terms/" >Terms & Policies</a></li>
          <li><a href="/contact/" >Contact</a></li>
          <li><a href="/main/logout/" >Logout</a></li>
        </ul>
<?php } ?>        
       </div><!-- /.navbar-collapse -->
    </div>  <!-- /.container-fluid -->
  </nav>

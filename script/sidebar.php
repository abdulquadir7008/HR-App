
<div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">

      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
          <img src="images/logo.png" style="width:100%;" />
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php if($currentFile=='index'){echo "active";}?>">
            <a class="nav-link" href="index.php">
              
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php if($customerchechlogin_row['account_type']==1){?>
          <li class="nav-item <?php if($currentFile=='uselist'){echo "active";}?>">
            <a class="nav-link" href="uselist.php">
              <i class="material-icons">person</i>
              <p>Employe Details</p>
            </a>
          </li>
          
          <?php }?>
          <li class="nav-item <?php if($currentFile=='manage-project'){echo "active";}?>">
            <a class="nav-link" href="manage-project.php">
              <i class="material-icons">library_books</i>
              <p>Project</p>
            </a>
          </li>
          <li class="nav-item <?php if($currentFile=='tax-manage'){echo "active";}?>">
            <a class="nav-link" href="tax-manage.php">
              <i class="material-icons">Tax</i>
              <p>Tax Details</p>
            </a>
          </li>
          <li class="nav-item <?php if($currentFile=='manage-invoice'){echo "active";}?>">
            <a class="nav-link" href="manage-invoice.php">
              <i class="material-icons">content_paste</i>
              <p>Invoice</p>
            </a>
          </li>
          
          <?php if($customerchechlogin_row['account_type']==1){?>
          <!--li class="nav-item <?php if($currentFile=='tools'){echo "active";}?>">
            <a class="nav-link" href="tools.php">
              <i class="material-icons">bubble_chart</i>
              <p>Tools</p>
              
            </a>
            
          </li-->
          <?php } ?>
          
          
          
        </ul>
        
      </div>
    </div>
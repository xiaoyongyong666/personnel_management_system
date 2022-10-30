<?php
!defined('BOOK') && exit('FORBIDDEN');
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php echo $Companyname." | ".$wzname;?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="system/"><button type="submit" class="btn btn-clr">系统管理</button></a></li>
          </ul>
          
        </div>
      </div>
    </nav> 
<div class="jumbotron" style="background-image: linear-gradient(to bottom right, rgb(60, 255, 158),rgb(19, 255, 216));margin-top: 65px; color:#fff">
        <h1><?php echo $Companyname;?></h1>
        <p class="lead"><?php echo $siteinfo;?></p>
        <a href="system/"><button type="submit" class="btn btn-clr">系统管理</button></a>
      </div>

<!--div id="header"><img src="Style/Images/top.jpg" /></div-->
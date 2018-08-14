<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>CodeIgniter Admin Sample Project</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand"></a>
	      <div class =welmsg>
	      <?php if($this->uri->segment(1) == 'admin'){
	       echo"welcome admin";
	       }?>
	        <?php if($this->uri->segment(1) == 'guard'){
	       echo"welcome guard";
	       }?>
	       </div>
	       
	      <ul class="nav">
	        <li <?php if($this->uri->segment(1) == 'admin'){?>>
	          <a href="<?php echo base_url(); ?>admin/visitors">Visitors</a> <?php }?>
	        </li>
	        <li <?php if($this->uri->segment(1) == 'guard'){?>>
	          <a href="<?php echo base_url(); ?>guard/visitors">Visitors</a><?php }?>
	        </li>
	        
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">MyAccount<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	          <?php  if($this->uri->segment(1) == 'admin'){?>
	           <li>
	              <a href="<?php echo base_url(); ?>admin/visitors/add">Add belongins</a>
	            </li><?php }?>
	            <li>
	              <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
	            </li>
	            
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>	

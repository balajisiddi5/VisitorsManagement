    
    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("guard/visitors"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("guard").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new product created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal',  'id' => '');
      $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['id']] = $row['name'];
      }
      $belonings= array();
      $this->db->select('belongings');
      $this->db->from('belongings');
      
      $query = $this->db->get();
      
      
      $options_belongings = array();
      foreach ($query->result_array() as $blong) {
          foreach ($blong as $key ) {
              $options_belongings[$key] = $key;
          }
          //           print_r($options_belongings);
      }

      //form validation
      echo validation_errors();
      
      echo form_open('guard/visitors/add', $attributes);
      ?>
        <fieldset>
        <form>
          <div class="control-group">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="name" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Age</label>
            <div class="controls">
              <input type="text" id="" name="age" value="<?php echo set_value('stock'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Phone</label>
            <div class="controls">
              <input type="text" id="" name="phone" value="<?php echo set_value('cost_price'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Coming from</label>
            <div class="controls">
              <input type="text" id="geocomplete" name="comingfrom" value="<?php echo set_value('sell_price'); ?>" size="90"/>
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Purpose</label>
            <div class="controls">
              <input type="text" id="geocomplete" name="purpose" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">CheckIn</label>
            <div class="controls">
              <input type="text" id="" name="checkin" value="<?php  echo date('Y-m-d') ?>" readonly >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Address</label>
            <div class="controls">
              <input type="text" id="" name="address" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Adhar</label>
            <div class="controls">
              <input type="text" id="" name="adhar" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Email</label>
            <div class="controls">
              <input type="text" id="" name="email" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
          
            <label for="inputError" class="control-label">Belongings</label>
         <?php  echo form_dropdown('belong_name', $options_belongings, 'class="span2"');?>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Reset</button>
          </div>
          </form>
        </fieldset>

      <?php echo form_close(); ?>
	
    </div>
    
       
     
    
    
    
    
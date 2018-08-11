    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("guard/visitors"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("guard").'/'.$this->uri->segment(2)  ?>/add" class="btn btn-success">Add Visitor</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            $options_manufacture = array(0 => "all");
            foreach ($manufactures as $row)
            {
              $options_manufacture[$row['id']] = $row['name'];
            }
            //save the columns names in a array that we will use as filter         
            $options_products = array();    
            foreach ($products as $array) {
              foreach ($array as $key => $value) {
                $options_products[$key] = $key;
              }
              break;
            }

            echo form_open('guard/visitors', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              echo form_label('Filter by date:', 'manufacture_id');
              echo form_dropdown('manufacture_id', $options_manufacture, $manufacture_selected, 'class="span2"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_products, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">name</th>
                <th class="green header">age</th>
                <th class="red header">phone</th>
                <th class="red header">comingfrom</th>
                <th class="red header">purpose</th>
                <th class="red header">checkin</th>
                <th class="green header">address</th>
                <th class="red header">checkout</th>
                <th class="red header">adhar</th>
                <th class="red header">email</th>
                <th class="red header">Belonging</th>
                <th class="red header">Update</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($products as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$row['age'].'</td>';
                echo '<td>'.$row['phone'].'</td>';
                echo '<td>'.$row['comingfrom'].'</td>';
                echo '<td>'.$row['purpose'].'</td>';
                echo '<td>'.$row['checkin'].'</td>';
                echo '<td>'.$row['address'].'</td>';
                echo '<td>'.$row['checkout'].'</td>';
                echo '<td>'.$row['adhar'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['belongings'].'</td>';
                
                echo '<td class="crud-actions">
                  <a href="'.site_url("guard").'/visitors/update/'.$row['id'].'" class="btn btn-info">CheckOut</a>
                 
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>
<h1><?php echo  $this->uri->segment(1);?></h1>
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>
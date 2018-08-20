<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin/mystyles.css">
	
<div class="container top">

	<ul class="breadcrumb">
		<li><a href="<?php echo site_url("admin/visitors"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> <span class="divider">/</span></li>
		<li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
        <li>
        <?php $attributesex = array(
                'class' => 'form-inline reset-margin',
                'id' => 'myformex'
            );
            echo form_open('admin/visitors/export', $attributesex);?>
            <input type="hidden" name="exportable" id="id"
				value='<?php echo $output ?>'>
				 <input type="submit"
				value="Export  Excel" class="btn btn-info" id="exportbtn">
				<?php echo form_close();?>
        </li>
	</ul>



	<div class="row">
		<div class="span12 columns">
			<div class="well">
           
            <?php
            echo $this->uri->segment(2);
            $attributes = array(
                'class' => 'form-inline reset-margin',
                'id' => 'myform'
            );

            $options_manufacture = array(
                0 => "all"
            );
            foreach ($manufactures as $row) {
                $options_manufacture[$row['id']] = $row['name'];
            }
            // save the columns names in a array that we will use as filter
            $options_products = array();
            foreach ($products as $array) {
                foreach ($array as $key => $value) {
                    $options_products[$key] = $key;
                }
                break;
            }

            echo form_open('admin/visitors', $attributes);

            echo form_label('Search:', 'search_string');
            echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

            echo form_label('From:', 'datefrom');
            ?>
              <input type="date" class="form-control" id="fromdate"
					name="datefrom" value="<?php echo $search_string_selected ?>">
              <?php

            echo form_label('To:', 'dateto');
            ?>
              <input type="date" class="form-control" id="dateto"
					name="dateto" value="<?php echo set_value('dateto'); ?>"><br><br>
              <?php

            echo form_label('Order by:', 'Order');
            echo form_dropdown('order', $options_products, $order, 'class="span2"');

            $data_submit = array(
                'name' => 'mysubmit',
                'class' => 'btn btn-primary',
                'value' => 'Go'
            );

            $options_order_type = array(
                'Asc' => 'Asc',
                'Desc' => 'Desc'
            );
            echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

            echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th class="header">#</th>
						<th class="yellow header headerSortDown">Name</th>
						<th class="green header">Age</th>
						<th class="red header">Phone</th>
						<th class="red header">Comingfrom</th>
						<th class="red header">Purpose</th>
						<th class="red header">Checkin</th>
						<th class="green header">Address</th>
						<th class="red header">Checkout</th>
						<th class="red header">Adhar</th>
						<th class="red header">Email</th>
						<th class="red header">Belonging</th>
						<th class="red header">Update</th>
					</tr>
				</thead>
				<tbody>
              <?php
            foreach ($products as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['comingfrom'] . '</td>';
                echo '<td>' . $row['purpose'] . '</td>';
                echo '<td>' . $row['checkin'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['checkout'] . '</td>';
                echo '<td>' . $row['adhar'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['belongings'] . '</td>';

                echo '<td class="crud-actions">
                                   <a href="' . site_url("admin") . '/visitors/update/' . $row['id'] . '" class="btn btn-info">edit</a>   
                  <a href="' . site_url("admin") . '/visitors/delete/' . $row['id'] . '" class="btn btn-danger" onClick="return confirm(\'Are you sure to Delete?\')">del</a>
 
          
                </td>';
                echo '</tr>';
            }
            ?>      
            </tbody>
			</table>          
		 
          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
          
          <?php
        $output ='<span>g</span>';
        $output .= '<table  border="1">  
                  
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">name</th>
                <th class="green header">age</th>
                <th class="green header">email</th>
                <th class="red header">phone</th>
                <th class="red header">comingfrom</th>
                <th class="red header">purpose</th>
                <th class="red header">checkin</th>
                <th class="green header">address</th>
                <th class="red header">checkout</th>
                <th class="red header">adhar</th>
                <th class="red header">email</th>
                <th class="red header">Belonging</th> 
              </tr>
            
  '.'<span>k</span>';
        foreach ($products as $row) {

            $output .= '
                       <tr>
	                   <td>' . $row["id"] . '</td>
                       <td>' . $row["name"] . '</td>
                       <td>' . $row["age"] . '</td>
                       <td>' . $row["email"] . '</td>
                       <td>' . $row['phone'] . '</td>;
                       <td>' . $row['comingfrom'] . '</td>;
                       <td>' . $row['purpose'] . '</td>;
                       <td>' . $row['checkin'] . '</td>;
                       <td>' . $row['address'] . '</td>;
                       <td>' . $row['checkout'] . '</td>;
                       <td>' . $row['adhar'] . '</td>;
                       <td>' . $row['email'] . '</td>;
                       <td>' . $row['belongings'] . '</td>;
                       </tr>
';
        }
            
        
        $output.='<span>l</span>';
        $output .= '</table>';
 
            
            ?>
              




<!-- <div>									 -->
<?php echo form_open_multipart('exceldatainsert/ExcelDataAdd');?>                      
<!-- <label>Excel File:</label>                         -->
<!-- <input type="file" name="userfile" />				                    -->
<!-- <input type="submit" value="upload" name="upload" /> -->

<!-- </div> -->
               
		</div>
	</div>
	</div>
	
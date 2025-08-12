<style>
        .tooltip-container {
                position: relative;
                display: inline-block;
            }

        .tooltip {
                visibility: hidden;
                position: absolute;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                color: #333;
                padding: 10px;
                z-index: 1;
                min-width: 150px;
                top: 100%;
                left: 0;
                opacity: 0;
                transition: opacity 0.3s;
            }

        .tooltip-link:hover + .tooltip {
                visibility: visible;
                opacity: 1;
            }

</style>


<div id="dataContainer" class="row">
      <div class="col-md-12" >  
                  <?php if($all_expenses){?>
                            
                      <h2><?php echo $title; ?></h2><span><a class="btn btn-info" href="<?php echo site_url('expense/create') ?>"><span class="glyphicon glyphicon-plus" style="text-align:right"></span> Add new expense</a></span>
                      
                      <table class="table table-striped table-bordered  compact hover tbl" id="exp_list"   cellspacing="0">
            
                          <thead>
                              <tr>
                                  <th>Invoice no</th>
                                  <th>Expense category <br><input type="text" class="search-input" placeholder="Filter"></th>
                                  <th>Expense description<br><input type="text" class="search-input" placeholder="Filter"></th>
                                  <th>Date<br><input type="text" class="search-input" placeholder="Filter"></th>
                                  <th>Total amount<br><input type="text" class="search-input" placeholder="Filter"></th>
                                  <th>Paid by<br><input type="text" class="search-input" placeholder="Filter"></th>
                                  <th>Status<br><input type="text" class="search-input" placeholder="Filter"></th>
                                  <th>Action</th>
                              </tr>
                          </thead>

                          
                          <?php $totalExp=0;?>            
                              <?php $sl=1;foreach ($all_expenses as $expenses_item): ?>
                                      <tr>
                                          <td><?php  echo $sl++;?></td>      
                                          <?php
                                              $expense_subarea = $this->expense_model->get_expense_subarea_of_a_expense($expenses_item['id']);
                                                  if(!empty($expense_subarea)){
                                                          $expense_subarea_id = $expense_subarea['expense_subarea_id'];
                                                          $expense_subarea_title_array = $this->expense_subarea_model->read($expense_subarea_id);
                                                          if (is_object($expense_subarea_title_array) && property_exists($expense_subarea_title_array, 'title')) {?>
                                                      <td><?php echo  $title = $expense_subarea_title_array->title; ?></td>  
                                                      <?php  } else {?>
                                                          <td></td>
                                                          
                                                      <?php  }
                                                  }
                                                  if(empty($expense_subarea)){?>
                                                          <td></td>
                                                  <?php }
                                          ?>


                                          <td><?php echo $expenses_item['description'];?></td>                            
                                          <td><?php echo $payment_date = date('d-M-Y', strtotime($expenses_item['payment_date']));?></td> 
                                          <td style="text-align:right"><?php echo $total_amount=$expenses_item['total_amount']; $totalExp = $totalExp+$total_amount; ?></td>

                                      <?php 
                                              foreach ($person as $per):
                                                  if($per['id']=== $expenses_item['paid_by_person_id']){?>
                                                  <td><?php echo $per['fullname'];?></td><?php }
                                              endforeach;
                                      ?>  
                                      <?php  if($expenses_item['status']==='0'){?><td ><span class="glyphicon glyphicon-hourglass" aria-hidden="true">Pending</span> </td><?php  } ?>          
                                      <?php  if($expenses_item['status']==='1'){?><td ><span class="glyphicon glyphicon-check" aria-hidden="true"></span><span>Approved</span></td><?php  } ?>
                                  
                                          
                                          <?php $expenses_id= base64_encode($expenses_item['id']); ?>

                                          <td>
                                              <div class="tooltip-container">
                                                  <a href="#" class="tooltip-link">Memo</a>
                                                  <div class="tooltip">
                                                      <img width='70px' height='60px' style='border: #004ab3 solid thin; padding:3px;' src="<?= base_url()."upload/expense/".$expenses_item['memo_image'] ?>">
                                                      <br>
                                                      <?= $expenses_item['memo_no'] ?>
                                                  </div>
                                              </div>
                                          </br>
                                              <?= anchor('expense/view/' . $expenses_id, 'Details', 'class="view-link"') ?>   
                                              <?php
                                                  if ($expenses_item['status']==='0') {
                                                      echo anchor('expense/edit/' . $expenses_id, 'Edit', 'class="edit-link"');
                                                  }
                                                  ?>
      
                                          </td>

                                      </tr>
                              <?php endforeach; ?>
                              
                              <tfoot>
                                  <tr style="font-weight:bold;background:#FFFFFF;padding:3px;text-align:right">   
                                  <td colspan="4" ></td>                 
                                      <td ><span id="totalExpense"><?php echo $totalExp;?></span></td>                               
                                  </tr>
                              </tfoot>
                      </table>
                  
                      <?php }else{?>
                                  <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin:100px;"> No record found for <?php echo $title;?></p>
                      <?php   }?>
      <div>        
</div>




<script>
$(document).ready(function() {

  var table = $('#exp_list').DataTable({
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'copy',
      footer: true,
      exportOptions: {
        columns: ':visible' // Export only visible columns
      }
    },
    {
      extend: 'csv',
      footer: true,
      exportOptions: {
        columns: ':visible'
      }
    },
    {
      extend: 'excel',
      footer: true,
      exportOptions: {
        columns: ':visible'
      }
    },
    {
      extend: 'pdf',
            
      footer: true,
      exportOptions: {
        columns: ':visible'
      }
    },
    'colvis', // Column visibility button
    'pageLength'
  ],
  lengthMenu: [
    [10, 25, 50, 100, -1],
    [10, 25, 50, 100, 'All']
  ],
  columnDefs: [
    {
      targets: [6,7], // Indices of the columns you want to initially hide
      visible: false
    }
  ],

});




  // Apply the search and recalculate the total on every input change
  table.columns().every(function() {
    var that = this;

    $('input', this.header()).on('keyup change', function() {
      if (that.search() !== this.value) {
        that
          .search(this.value)
          .draw();
        calculateTotal();
      }
    });
  });

  function calculateTotal() {
    var total = table.column(4, {search: 'applied'}).data().reduce(function (a, b) {
      return a + parseFloat(b);
    }, 0);

    $('#totalExpense').text("Total value: "+total.toFixed(2)); // Displaying total with two decimal places
  }
});
</script>
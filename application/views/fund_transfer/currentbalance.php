
<!-- application/views/fund_transfer/read.php -->
<div  id="dataContainer" class="row"  style="font-family: monospace; ">
    <div class="row col-md-1"></div>
        <div class="row col-md-10">
        <table class="table-striped table-bordered" id="payment_all_list" style="width: 100%;font-family: monospace;" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Personal ID</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
         
                <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= $record->id ?></td>
                    <?php 
                                foreach ($management as $per):


                                    if($per['id']=== $record->personal_id){?>
                                    <td><?php echo $per['fullname'];?></td><?php }
                                endforeach;?>  
                        
                    <!-- <td><?= $record->personal_id ?></td> -->
                    <td><?= $record->current_balance ?></td>
                <?php endforeach; ?>
               
            </tbody>   
            </table>  
        </div>
    <div class="row col-md-1"></div>
</div>

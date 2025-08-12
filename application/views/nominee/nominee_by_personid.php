<div id="dataContainer" class="row" style="min-height:400px">

<div class="col-md-1"></div>
<div class="col-md-10">
    
     
    <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:5px;margin-top:10px;"> Nominees of</br>
    <?php 
        echo "<img width='70px' height='60px'  src='". base_url()."upload/".$person_image."'>";
        echo  "</br>".$person_name;    echo  "</br>".$person_id;
    ?>
        </p>
<?php if($nominees){?>        
<table class="table table-striped table-bordered  compact hover" id="nominee_list" style="width: 100%" cellspacing="0">
        <thead>

    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Relation </strong></td>
        <td><strong>Share %</strong></td> 
       
        <td><strong>Action</strong></td>
    </tr> 

        </thead>


<?php foreach ($nominees as $nominee_item): ?>
        <tr>
            <td><?php
            echo $nominee_item['id'];
            ?></td>
            <td>
            <?php 
            echo "<img width='70px' height='60px'  src='". base_url()."upload/nominee/".$nominee_item['image_url']."'>";
            echo "</br>".$nominee_item['fullname'];?>
            <td><?php echo $nominee_item['relation']; ?></td> 
            <td><?php echo $nominee_item['share_percentage']; ?></td> 
           
                    <?php $id= base64_encode($nominee_item['id']);?>
            
            <td>                                
                    <a href="<?php echo site_url('nominee/view/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        <span>View</span>            
                    </a>
                    <a href="<?php echo site_url('nominee/edit/'.$id); ?>" class="btn">
                        <span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span>Edit</span>            
                    </a>
            </td>
        </tr>
<?php endforeach; ?>
</table>
  <?php }else{?>
     <p style="background: #F2F3FF;text-align:center;font-weight:bold; padding:50px;margin-bottom:10px;"> No nominee information added</p>
  <?php   }?>

</div>
<div class="col-md-1"></div>

</div>

 



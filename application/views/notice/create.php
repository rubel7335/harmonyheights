<div  id="dataContainer" class="row"  style="font-family: monospace; ">
<div class="col-md-3"></div>
    <div class="col-md-6" id="bodyholder" style="padding:20px; background:  #F2F3FF;text-align: center;">
        <h1>Create New Notice</h1>
        <form action="<?= site_url('notice/insert'); ?>" method="post">
            <div  class="col-md-6">          
                <div class="form-group">       
                    <div class="rowlabel">Title</div>
                    <input type="text"   placeholder="Enter title" name="title" autocomplete="off"   <?php echo form_input('title', set_value('title')); ?></input>
                </div>
            </div>
            <div  class="col-md-12">          
                <div class="form-group">       
                    <div class="rowlabel">Details</div>
                    <input type="text"   placeholder="Enter details" name="details" autocomplete="off"   <?php echo form_input('details', set_value('details')); ?></input>
                </div>
            </div>

            <div  class="col-md-6">  
                <div class="form-group">
                <div class="rowlabel">Status</div>
                    <select name="status" class="form-group" style="width:100%">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select><br>
                </div>
            </div>

       
            <div class="col-md-12" >
                <div class="form-group"> 
                <div  style="text-align: center">
                    <button type="submit" class="btn btn-lg" name="submit"  >Create </button>       
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>    

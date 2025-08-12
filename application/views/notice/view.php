
<div  id="dataContainer" class="row"  style="font-family: monospace;min-height:450px; ">
        <div class="col-md-12" style="padding:20px;">  
                <h1>Notice Details</h1>
                <p>ID: <?= $notice['id']; ?></p>
                <p>Title: <?= $notice['title']; ?></p>
                <p>Details: <?= $notice['details']; ?></p>
                <p>Status: <?= $notice['status']; ?></p>
                <a href="<?= site_url('notice'); ?>">Back to Notices</a>   
    </div> 
</div>  
<div id="dataContainer" class="row col-md-12">
<div class="row col-md-1"></div>
<div class="row col-md-10">

     <h2><?php echo $title; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>URL Controller</strong></td>
        <td><strong>URl Action</strong></td>
        <td><strong>Remarks</strong></td>
    </tr>
        <tr>
            <td><?php echo $page_item['id']; ?></td>
            <td><?php echo $page_item['name']; ?></td>
            <td><?php echo $page_item['url_controller']; ?></td>
            <td><?php echo $page_item['url_action']; ?></td>
            <td><?php echo $page_item['remarks']; ?></td>
        </tr>

</table>
</div>
<div class="row col-md-1"></div>
</div>

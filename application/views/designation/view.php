<div id="dataContainer" class="row col-md-12">
<div class="row col-md-1"></div>
<div class="row col-md-10">

     <h2><?php echo $designation_item['title']; ?></h2>
<table class="table-striped table-bordered">
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Title</strong></td>
        <td><strong>Alias</strong></td>
        <td><strong>Grade</strong></td>
        <td><strong>Remarks</strong></td>
    </tr>
        <tr>
            <td><?php echo $designation_item['id']; ?></td>
            <td><?php echo $designation_item['title']; ?></td>
            <td><?php echo $designation_item['alias']; ?></td>
            <td><?php echo $designation_item['grade_id']; ?></td>
            <td><?php echo $designation_item['remarks']; ?></td>
        </tr>

</table>
</div>
<div class="row col-md-1"></div>
</div>

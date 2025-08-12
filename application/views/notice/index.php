
<div id="bodyholder" class="row" style="min-height:500px;">
<h1>Notices</h1>
    <p><a href="<?= site_url('notice/create'); ?>" class="btn btn-success" ><span class="glyphicon glyphicon-plus" style="text-align:right"></span>Create New Notice</a></p>
    <div  class="col-md-12">
        <table class="table table-striped table-bordered  compact hover tbl" id="person_list">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($notices as $notice) : ?>
                <tr>
                    <td><?= $notice['id']; ?></td>
                    <td><?= $notice['title']; ?></td>
                    <td><?= $notice['status']; ?></td>
                    <td>
                        <a href="<?= site_url('notice/view/' . $notice['id']); ?>">View</a> |
                        <a href="<?= site_url('notice/edit/' . $notice['id']); ?>">Edit</a> |
                        <a href="<?= site_url('notice/delete/' . $notice['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>    


<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4">Dealers</h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dealer/add_dealer">Add Dealers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dealers</li>
                </ol>
            </nav>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-right">ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th class="text-right">Mobile</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_dealers as $v) {
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $v->pk_client_id ?></td>
                            <td><?php echo $v->first_name.' '.$v->last_name ?></td>
                            <td><?php echo $v->client_address ?></td>
                            <td class="text-right"><?php echo $v->client_mobile ?></td>
                            <td class="text-right">
                                <a href="<?php echo base_url() ?>dealer/add_dealer/<?php echo $v->pk_client_id ?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Edit</a>
                            </td>
                        </tr>  
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4">Products</h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>product/add_product">Add Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-right">ID</th>
                        <th>Name</th>
                        <th class="text-right">Weight</th>
                        <th class="text-right">Box Unit</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_products as $v) {
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $v->pk_product_id ?></td>
                            <td><?php echo $v->product_name ?></td>
                            <td class="text-right"><?php echo $v->product_weight ?></td>
                            <td class="text-right"><?php echo $v->product_unit ?></td>
                            <td class="text-right">
                                <a href="<?php echo base_url() ?>product/add_product/<?php echo $v->pk_product_id ?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Edit</a>
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
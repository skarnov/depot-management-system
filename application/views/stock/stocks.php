<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4">Stocks</h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>stock/add_stock">Add Stocks</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Stocks</li>
                </ol>
            </nav>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Product Info</th>
                        <th class="text-right">Buying Price</th>
                        <th class="text-right">Selling Price</th>
                        <th class="text-right">Stock</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_stocks as $v) {
                        ?>
                        <tr>
                            <td><?php echo $v->first_name . ' ' . $v->last_name ?></td>
                            <td>
                                ID: <?php echo $v->pk_product_id ?><hr/>Name: <?php echo $v->product_name ?>
                            </td>
                            <td class="text-right"><?php echo $v->buying_price ?></td>
                            <td class="text-right"><?php echo $v->selling_price ?></td>
                            <td class="text-right">
                                Box: <?php $unit = ($v->stock_quantity) / ($v->product_unit); echo (int)$unit ?><hr/>
                                Qty: <?php echo ($v->stock_quantity) % ($v->product_unit) ?>
                            </td>
                            <td class="text-right">
                                <a href="<?php echo base_url() ?>stock/edit_stock/<?php echo $v->pk_stock_id ?>" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Edit</a>
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
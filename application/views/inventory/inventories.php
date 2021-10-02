<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4">Inventories</h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Inventories</li>
                </ol>
            </nav>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-right">ID</th>
                        <th>Name</th>
                        <th>Regular</th>
                        <th>Free</th>
                        <th>Damage</th>
                        <th class="text-right">Buy</th>
                        <th class="text-right">Sale</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_inventories as $v) {
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $v->pk_inventory_id ?></td>
                            <td><?php echo $v->product_name ?></td>
                            <td>
                                <?php echo $v->regular_quantity ?>
                                <hr/>
                                <strong>Box:</strong> <?php
                                $unit = ($v->regular_quantity) / ($v->product_unit);
                                echo (int) $unit
                                ?><hr/>
                                <strong>Qty:</strong> <?php echo ($v->regular_quantity) % ($v->product_unit) ?>
                            </td>
                            <td>
                                <?php echo $v->free_quantity ?>
                                <hr/>
                                <strong>Box:</strong> <?php
                                $unit = ($v->free_quantity) / ($v->product_unit);
                                echo (int) $unit
                                ?><hr/>
                                <strong>Qty:</strong> <?php echo ($v->free_quantity) % ($v->product_unit) ?>
                            </td>
                            <td>
                                <?php echo $v->damage_quantity ?>
                                <hr/>
                                <strong>Box:</strong> <?php
                                $unit = ($v->damage_quantity) / ($v->product_unit);
                                echo (int) $unit
                                ?><hr/>
                                <strong>Qty:</strong> <?php echo ($v->damage_quantity) % ($v->product_unit) ?>
                            </td>
                            <td class="text-right"><?php echo $v->buying_price ?></td>
                            <td class="text-right"><?php echo $v->selling_price ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
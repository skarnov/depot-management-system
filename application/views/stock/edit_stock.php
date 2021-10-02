<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4"><?php echo $title ?></h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>stock">Stocks</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                </ol>
            </nav>
            <form id="processOperation">
                <input type="hidden" name="stock_id" value="<?php if (isset($stock_info)) echo $stock_info->pk_stock_id ?>" class="form-control">
                <div class="row">
                    <div class="col-md-12">
                        <div id="result"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="transaction_date" value="<?php if (isset($stock_info)) echo $stock_info->transaction_date ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Select Product</label>
                            <select required name="product_id" class="form-control">
                                <option value="">Select One</option>
                                <?php foreach ($all_products as $v): ?>
                                    <option value="<?php echo $v->pk_product_id ?>" <?php
                                    if (isset($stock_info)) {
                                        if (($v->pk_product_id) == ($stock_info->fk_product_id))
                                            echo 'selected';
                                    }
                                    ?> ><?php echo $v->product_name ?></option>
                                        <?php endforeach ?>
                            </select>
                        </div>
                        <div id="productDetails">
                            <div class="form-group">
                                <label>Product ID</label>
                                <input type="text" value="<?php echo $stock_info->fk_product_id ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Product Unit</label>
                                <input type="text" value="<?php echo $stock_info->product_unit ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Product Weight</label>
                                <input type="text" value="<?php echo $stock_info->product_weight ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Select Branch</label>
                            <select required name="branch_id" class="form-control">
                                <option value="">Select One</option>
                                <?php foreach ($all_branches as $branch): ?>
                                    <option value="<?php echo $branch->pk_client_id ?>" <?php
                                    if (isset($stock_info)) {
                                        if (($branch->pk_client_id) == isset(($stock_info->fk_branch_id)))
                                            echo 'selected';
                                    }
                                    ?>><?php echo $branch->first_name . ' ' . $branch->last_name ?></option>
                                        <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Stock Type</label>
                            <select name="type" class="form-control">
                                <option value="regular" <?php
                                if (isset($stock_info)) {
                                    if ('regular' == ($stock_info->stock_type))
                                        echo 'selected';
                                }
                                ?>>Regular</option>
                                <option value="damage" <?php
                                if (isset($stock_info)) {
                                    if ('damage' == ($stock_info->stock_type))
                                        echo 'selected';
                                }
                                ?>>Damage</option>
                                <option value="free" <?php
                                if (isset($stock_info)) {
                                    if ('free' == ($stock_info->stock_type))
                                        echo 'selected';
                                }
                                ?>>Free</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Buying Price</label>
                            <input type="text" name="buying_price" value="<?php if (isset($stock_info)) echo $stock_info->buying_price ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="text" name="selling_price" value="<?php if (isset($stock_info)) echo $stock_info->selling_price ?>" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Box</label>
                                    <input type="number" name="box" value="<?php
                                    if (isset($stock_info)) {
                                        $unit = ($stock_info->stock_quantity) / ($stock_info->product_unit);
                                        echo (int) $unit;
                                    }
                                    ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="number" name="qty" value="<?php
                                    if (isset($stock_info)) {
                                        echo ($stock_info->stock_quantity) % ($stock_info->product_unit);
                                    }
                                    ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <button type="submit" id="submitProcess" class="btn btn-primary"><?php echo $title ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    jQ.push(function () {
        $('#submitProcess').click(function (e) {
            $("#submitProcess").attr("disabled", true);
            $("#submitProcess").html('Processing..');
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url() ?>stock/update_stock/<?php echo $edit ? $edit : '' ?>",
                data: $('#processOperation').serialize(),
                success: function (data)
                {       
                    
                    console.log(data);
                    
                    if (data === 'success') {
                        $("#submitProcess").html('Execute');
                        $("#submitProcess").attr("disabled", false);
                        $('#processOperation')[0].reset();
                        $('#result').append("<div class='alert alert-success' role='alert'>Success</div>");
                    } else {
                        alert('Invalid');
                    }
                }
            });
        });

        $('[name=product_id]').click(function (e) {
            e.preventDefault();
            $("#productDetails").html('');
            var productId = $(this).val();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url() ?>product/select_product/" + productId,
                success: function (data)
                {
                    $('#productDetails').html(data);
                }
            });
        });
    });
</script>
<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4"><?php echo $title ?></h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>product">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
                </ol>
            </nav>
            <form id="processOperation">
                <div class="row">
                    <div class="col-md-12">
                        <div id="result"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="name" value="<?php if (isset($product_info)) echo $product_info->product_name ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" name="weight" value="<?php if (isset($product_info)) echo $product_info->product_weight ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Box Unit</label>
                            <input type="text" name="unit" value="<?php if (isset($product_info)) echo $product_info->product_unit ?>" class="form-control">
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
                url: "<?php echo base_url() ?>product/save_product/<?php echo $edit ? $edit : '' ?>",
                data: $('#processOperation').serialize(),
                success: function (data)
                {
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
    });
</script>
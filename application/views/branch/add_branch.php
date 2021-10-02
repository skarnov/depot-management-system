<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4"><?php echo $title ?></h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>branch">Branches</a></li>
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
                            <label>Branch Name</label>
                            <input type="text" name="first_name" value="<?php if (isset($branch_info)) echo $branch_info->first_name ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" value="<?php if (isset($branch_info)) echo $branch_info->client_mobile ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php if (isset($branch_info)) echo $branch_info->client_email ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control noresize"><?php if (isset($branch_info)) echo $branch_info->client_address ?></textarea>
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
                url: "<?php echo base_url() ?>branch/save_branch/<?php echo $edit ? $edit : '' ?>",
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
<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4">Dashboard</h2>
    <div class="row mt-3">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <a href="<?php echo base_url() ?>cashbook/cash_in" class="text-light">Cash In</a>
                </div>
                <div class="card-body">
                    <h1 class="card-title"><?php echo number_format((float)$statics['cash_in']->cash_in, 2, '.', ''); ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <a href="<?php echo base_url() ?>cashbook/cash_out" class="text-light">Cash Out</a>
                </div>
                <div class="card-body">
                    <h1 class="card-title"><?php echo $statics['cash_out']->cash_out ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="main" class="col-md-10 mt-5 float-md-right">
    <h2 class="mt-4">Cashbook</h2>
    <div class="row mt-3">
        <div class="col-lg">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>cashbook">Cashbook</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>cashbook/cash_in">IN</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>cashbook/cash_out">OUT</a></li>
                </ol>
            </nav>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-right">Date</th>
                        <th>Description</th>
                        <?php if(isset($args['cashbook'])): if($args['cashbook']) : ?><th class="text-right">IN</th><?php endif; endif ?>
                        <?php if(isset($args['cashbook'])): if($args['cashbook']) : ?><th class="text-right">OUT</th><?php endif; endif ?>
                        <?php if(isset($args['cash_in'])): if($args['cash_in']) : ?><th class="text-right">IN</th><?php endif; endif ?>
                        <?php if(isset($args['cash_out'])): if($args['cash_out']) : ?><th class="text-right">OUT</th><?php endif; endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cashbook as $v) {   
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $v->transaction_date ?></td>
                            <td><?php echo $v->cashbook_description ?></td>
                            <?php if(isset($args['cashbook'])): if($args['cashbook']) : ?><td class="text-right"><?php echo $v->cash_in ?></td><?php endif; endif ?>
                            <?php if(isset($args['cashbook'])): if($args['cashbook']) : ?><td class="text-right"><?php echo $v->cash_out ?></td><?php endif; endif ?>
                            <?php if(isset($args['cash_in'])): if($args['cash_in']) : ?><td class="text-right"><?php echo $v->cash_in ?></td><?php endif; endif ?>
                            <?php if(isset($args['cash_out'])): if($args['cash_out']) : ?><td class="text-right"><?php echo $v->cash_out ?></td><?php endif; endif ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
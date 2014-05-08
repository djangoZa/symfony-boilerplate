<?php $view->extend('RogersDataAnalyticsToolBundle::default.html.php') ?>

<?php $view['slots']->start('body') ?>
<script type="text/javascript">
    $(function () { 
        $("#hierarchy").jstree({
            "core" : {
                "data" : <?php echo $data; ?>,
                "check_callback" : true,
                "animation" : 0,
                "multiple" : false
            },
            "plugins" : ["dnd"]
        });

        $('#add-group').on('click', function () {
            console.log($("#hierarchy").jstree("get_selected").attr('data'));
        });
    });
</script>
<div class="row">
    <div class="col-md-6">
        <button type="button" id="add-group" class="btn btn-success">Add Group</button>
        <button type="button" id="rename-group" class="btn btn-warning">Rename Group</button>
        <button type="button" id="delete-group" class="btn btn-danger">Delete Group</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="hierarchy">
        </div>
    </div>
</div>
<?php $view['slots']->stop() ?>
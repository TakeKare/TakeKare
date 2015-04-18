<?=$this->element('Layout' . DS . 'head')?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title"><?=$this->Html->image('logo.png')?></h3>
                    </div>
                    <div class="panel-body">

                        <?php echo $this->Session->flash(); ?>

                        <?php echo $this->fetch('content'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?=$this->element('Layout' . DS . 'foot')?>

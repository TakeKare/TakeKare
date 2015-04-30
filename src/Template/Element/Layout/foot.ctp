
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<?php
$this->append('script', $this->Html->script([
    'app',
]));
?>
<?= $this->fetch('script') ?>

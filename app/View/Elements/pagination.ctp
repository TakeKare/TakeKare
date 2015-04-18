<?php if (isset($this->Paginator) && $this->Paginator->hasPage(NULL, 2)): ?>
    <ul class="pagination"><?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => false, 'currentClass' => 'active', 'currentTag' => 'a')); ?></ul>
<?php endif; ?>
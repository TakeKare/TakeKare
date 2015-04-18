<?php if (isset($item['children'])): ?>
    <li class="dropdown" >
        <a href="<?=(isset($item['url']) ? Router::url($item['url']) : '#')?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> <?=$item['title']?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
        <?php foreach($item['children'] as $c): ?>
            <?=$this->element('Nav' . DS . 'main_item', array('item' => $c))?>
        <?php endforeach;?>
        </ul>
    </li>
<?php else: ?>
    <li><?=$this->Html->link((isset($item['icon']) ? "<i class=\"fa {$item['icon']}\"></i> " : '') . $item['title'], $item['url'], array('escape' => false))?></li>
<?php endif; ?>

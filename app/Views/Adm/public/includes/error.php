<li><?=$k?></li><ul> <?php foreach($values as $value):?> <?php if(is_object($value) || is_array($value)):?> <?php foreach($value as $k=>$values):?> <?php include $this->getViewsPath()."/includes/error.php"; ?> <?php endforeach; ?> <?php else: ?> <li><?=$value?></li> <?php endif; ?> <?php endforeach; ?> </ul>
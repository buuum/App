<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><meta content="<?=$this->getHeader('description')?>" name="description"><meta content="<?=$this->getHeader('keywords')?>" name="keywords"><meta content="telephone=no" name="format-detection"><meta content="no" name="msapplication-tap-highlight"><meta content="user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1,width=device-width" name="viewport"><title><?=$this->getHeader('title')?></title> <?php if($this->getHeader('index')):?> <?php if($this->getHeader('canonical')):?> <link href="<?=$this->getHeader('canonical')?>" rel="canonical"> <?php endif; ?> <meta content="index, follow" name="robots"> <?php else: ?> <meta content="noindex, follow" name="robots"> <?php endif; ?> <link href="<?=$this->getHeader('favicon')?>" rel="shortcut icon"><link href="<?=$this->getLink('css')?>" rel="stylesheet"></head><body> <?=$page?> <script src="<?=$this->getLink('js')?>"></script><script>$(function(){ App = new App(); App.ini();});</script></body></html>
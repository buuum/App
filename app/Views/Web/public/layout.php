<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><meta content="<?=$header['description']?>" name="description"><meta content="<?=$header['keywords']?>" name="keywords"><title><?=$header['title']?></title> <?php if($header['index']):?> <?php if($header['canonical']):?> <link href="<?=$header['canonical']?>" rel="canonical"> <?php endif; ?> <meta content="index, follow" name="robots"> <?php else: ?> <meta content="noindex, follow" name="robots"> <?php endif; ?> <link href="<?=$header['favicon']?>" rel="shortcut icon"><link href="https://fonts.googleapis.com/css?family=Lato:400,100,300" rel="stylesheet" type="text/css"><link href="<?=$header['pluginscssurl']?>" rel="stylesheet"><script src="<?=$header['pluginsjsurl']?>"></script><script>$(function(){ App = new App(); App.ini();});</script></head><body> <?php include $view;?> </body></html>
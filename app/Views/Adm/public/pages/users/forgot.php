<div class="center"><div class="card"><div class="card-header"> <?=$this->getText("Admin")?> </div> <?=$errors?> <form action="<?=$this->getUrl('user_forgot')?>" class="form-floating" method="post"><div class="card-content"><div class="form-group label-floating"><label class="control-label" for="inputEmail"><?=$this->getText("Email")?></label><input class="form-control" name="email" type="text" value="<?=(isset($email))? $email : ''?>"></div></div><div class="card-action clearfix"><div class="pull-right"><a class="btn btn-primary btn-raised black-text" href="<?=$this->getUrl('login_adm')?>"> <?=$this->getText("Go to login")?> <div class="ripple-wrapper"></div></a><button class="btn btn-primary btn-raised black-text blockload" data-disabledtext="<?=$this->getText("Enviando...")?>" type="submit"><span><?=$this->getText("Enviar")?></span></button></div></div></form></div></div>
<div class="p40"> <?=$errors?> <?=(isset($messages))? $messages : ''?> <div class="card"><div class="p40"><form action="<?=$this->getUrl('countries_edit', array ("id" => $id,))?>" method="post"><div class="row"><div class="col-md-12"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("Name")?></label><input class="form-control" name="name" type="text" value="<?=(isset($name))? $name : ''?>"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("ISO ALPHA 2")?></label><input class="form-control" name="iso_alpha2" type="text" value="<?=(isset($iso_alpha2))? $iso_alpha2 : ''?>"></div></div><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("ISO ALPHA 3")?></label><input class="form-control" name="iso_alpha3" type="text" value="<?=(isset($iso_alpha3))? $iso_alpha3 : ''?>"></div></div></div><div class="bloque"><button class="btn btn-default btn-raised" type="submit"> <?=$this->getText("Editar")?> </button></div></form></div></div></div>
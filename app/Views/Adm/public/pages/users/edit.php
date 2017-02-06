<div class="p40"> <?=$errors?> <?=(isset($messages))? $messages : ''?> <div class="card"><div class="p40"><form action="<?=$this->getUrl('users_edit', array ("id" => $id,))?>" class="form-floating" method="post"><div class="row"><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("Nombre")?></label><input class="form-control" name="name" type="text" value="<?=(isset($name))? $name : ''?>"></div></div><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("Apellidos")?></label><input class="form-control" name="surname" type="text" value="<?=(isset($surname))? $surname : ''?>"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("Email")?></label><input class="form-control" name="email" type="text" value="<?=(isset($email))? $email : ''?>"></div></div><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("Nombre de usuario")?></label><input class="form-control" name="pseudo" type="text" value="<?=(isset($pseudo))? $pseudo : ''?>"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group label-floating"><label class="control-label"><?=$this->getText("Contraseña")?></label><input class="form-control" name="password" type="password" value=""></div></div><div class="col-md-6"><div class="row"><div class="form-group label-floating col-md-6"><div class="radio"><label> <?php $selected = (isset($gender) && 'm' == $gender); ?> <input <?=($selected)? " checked " : ""?> name="gender" type="radio" value="m"> <?=$this->getText("Hombre")?> </label></div></div><div class="form-group label-floating col-md-6"><div class="radio"><label> <?php $selected = (isset($gender) && 'f' == $gender); ?> <input <?=($selected)? " checked " : ""?> name="gender" type="radio" value="f"> <?=$this->getText("Mujer")?> </label></div></div></div></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label><?=$this->getText("Pais")?></label><select class="form-control" name="pais_id"> <?php foreach($paises as $pais_i):?> <?php $selected = !empty($pais_id) && ($pais_i->id == $pais_id); ?> <option <?=($selected)? " selected " : ""?> value="<?=$pais_i->id?>"><?=$pais_i->name?></option> <?php endforeach; ?> </select></div></div><div class="col-md-8"><div class="row"><div class="col-md-12"><label><?=$this->getText("Fecha de Nacimiento")?></label></div><div class="col-md-4"><select class="form-control" name="dia"> <?php foreach($dias as $name):?> <?php $selected = ($name == $dia); ?> <option <?=($selected)? " selected " : ""?> value="<?=$name?>"><?=$name?></option> <?php endforeach; ?> </select></div><div class="col-md-4"><select class="form-control" name="mes"> <?php foreach($meses as $name):?> <?php $selected = ($name == $mes); ?> <option <?=($selected)? " selected " : ""?> value="<?=$name?>"><?=$name?></option> <?php endforeach; ?> </select></div><div class="col-md-4"><select class="form-control" name="ano"> <?php foreach($anos as $name):?> <?php $selected = ($name == $ano); ?> <option <?=($selected)? " selected " : ""?> value="<?=$name?>"><?=$name?></option> <?php endforeach; ?> </select></div></div></div></div><div class="row"><div class="col-lg-12"><div class="form-group"><label><?=$this->getText("Roles")?></label><select class="chosen form-control" multiple="multiple" name="roles_relation[]"> <?php foreach($list_roles as $rol):?> <?php $selected = (!empty($roles_relation) && in_array($rol->id, $roles_relation)); ?> <option <?=($selected)? " selected " : ""?> value="<?=$rol->id?>"><?=$rol->rol?></option> <?php endforeach; ?> </select></div></div></div><div class="row"><div class="col-md-12"><label><?=$this->getText("Estado")?></label></div><div class="form-group label-floating col-md-4"><div class="radio"><label> <?php $selected = (isset($estado) && $estado==0); ?> <input <?=($selected)? " checked " : ""?> name="estado" type="radio" value="0"> <?=$this->getText("Baja")?> </label></div></div><div class="form-group label-floating col-md-4"><div class="radio"><label> <?php $selected = (isset($estado) && $estado==1); ?> <input <?=($selected)? " checked " : ""?> name="estado" type="radio" value="1"> <?=$this->getText("Activo")?> </label></div></div><div class="form-group label-floating col-md-4"><div class="radio"><label> <?php $selected = (isset($estado) && $estado==2); ?> <input <?=($selected)? " checked " : ""?> name="estado" type="radio" value="2"> <?=$this->getText("Pendiente")?> </label></div></div></div><div class="bloque"><button class="btn btn-primary btn-raised" type="submit"> <?=$this->getText("Editar")?> </button></div></form></div></div></div>
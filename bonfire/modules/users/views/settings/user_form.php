<script>
    function show_field() {    
        elem = document.getElementById('role_id');        
        tutor = document.getElementById('ftutor');
        autoridad = document.getElementById('fautoridad');        
        if (elem.value == 7){
             tutor.style.display = 'block';
             autoridad.style.display = 'none';        
        }            
        if (elem.value == 8){
             autoridad.style.display = 'block';        
             tutor.style.display = 'none';            
        }            
    }
</script>
<?php

$errorClass = ' error';
$controlClass = 'span6';
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);

if (isset($user) && $user->banned) :
?>
<div class="alert alert-warning fade in">
	<h4 class="alert-heading"><?php echo lang('us_banned_admin_note'); ?></h4>
</div>
<?php
endif;
if (isset($password_hints) ) :
?>
<div class="alert alert-info fade in">
    <a data-dismiss="alert" class="close">&times;</a>
    <?php echo $password_hints; ?>
</div>
<?php
endif;

echo form_open($this->uri->uri_string(), 'class="form-horizontal" autocomplete="off"');
?>
	<fieldset>
		<legend><?php echo lang('us_account_details') ?></legend>
        <?php Template::block('user_fields', 'user_fields', $fieldData); ?>
	</fieldset>
	<?php
    if (has_permission('Bonfire.Roles.Manage')
        && ( ! isset($user) || (isset($user) && has_permission('Permissions.' . $user->role_name . '.Manage')))
       ) :
    ?>
    <fieldset>
        <legend><?php echo lang('us_role'); ?></legend>
        <div class="control-group">
            <label for="role_id" class="control-label"><?php echo lang('us_role'); ?></label>
            <div class="controls">
                <select name="role_id" id="role_id" class="chzn-select <?php echo $controlClass; ?>" onchange="javascript:show_field()">
                    <?php
                    if (isset($roles) && is_array($roles) && count($roles)) :
                        foreach ($roles as $role) :
                            if (has_permission('Permissions.' . ucfirst($role->role_name) . '.Manage')) :
                                // check if it should be the default
                                $default_role = false;
                                if ((isset($user) && $user->role_id == $role->role_id)
                                    || ( ! isset($user) && $role->default == 1)
                                   ) {
                                    $default_role = true;
                                }
                    ?>
                    <option value="<?php echo $role->role_id; ?>" <?php echo set_select('role_id', $role->role_id, $default_role); ?>>
                        <?php e(ucfirst($role->role_name)); ?>
                    </option>
                    <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group<?php echo iif(form_error('name'), $errorClass); ?>">
            <label class="control-label required" for="name"><?php echo lang('us_name'); ?></label>
            <div class="controls">
                <input class="<?php echo $controlClass; ?>" type="text" id="name" name="name" value="<?php echo set_value('name', isset($user) ? $user->name : ''); ?>" />
                <span class="help-inline"><?php echo form_error('name'); ?></span>
            </div>
        </div>
        <div class="control-group<?php echo iif(form_error('surname'), $errorClass); ?>">
            <label class="control-label required" for="surname"><?php echo lang('us_surname'); ?></label>
            <div class="controls">
                <input class="<?php echo $controlClass; ?>" type="text" id="surname" name="surname" value="<?php echo set_value('surname', isset($user) ? $user->surname : ''); ?>" />
                <span class="help-inline"><?php echo form_error('surname'); ?></span>
            </div>
        </div>
        <fieldset id="ftutor" style="display:block">
            <?php                 
                echo form_dropdown('carrera', $carreras, set_value('carrera', isset($user['carrera']) ? $user['carrera'] : ''), 'Carrera');
                echo form_dropdown('equipo_trabajo', $equipos, set_value('equipo_trabajo', isset($user['equipo_trabajo']) ? $user['equipo_trabajo'] : ''), 'Equipo de Trabajo');
            ?>
        </fieldset>
        <fieldset id="fautoridad" style="display:none">
            <div class="control-group<?php echo iif(form_error('cargo'), $errorClass); ?>">
                <label class="control-label required" for="cargo"><?php echo lang('us_cargo'); ?></label>
                <div class="controls">
                    <input class="<?php echo $controlClass; ?>" type="text" id="cargo" name="cargo" value="<?php echo set_value('cargo', isset($user) ? $user->cargo : ''); ?>" />
                    <span class="help-inline"><?php echo form_error('cargo'); ?></span>
                </div>
            </div>
        </fieldset>
    </fieldset>
    <?php
    endif;

    // Allow modules to render custom fields
    Events::trigger('render_user_form');
    ?>
    <!-- Start of User Meta -->
    <legend>Domicilio</legend>
    <?php $this->load->view('users/user_meta');?>
    <!-- End of User Meta -->
    <?php
    if (isset($user) && has_permission('Permissions.' . ucfirst($user->role_name) . '.Manage')
        && $user->id != $this->auth->user_id() && ($user->banned || $user->deleted)
       ) :
    ?>
    <fieldset>
        <legend><?php echo lang('us_account_status'); ?></legend>
        <?php
        $field = 'activate';
        if ($user->active) {
            $field = 'de' . $field;
        }
        ?>
        <div class="control-group">
            <div class="controls">
                <label for="<?php echo $field; ?>">
                    <input type="checkbox" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="1" />
                    <?php echo lang('us_' . $field . '_note') ?>
                </label>
            </div>
        </div>
        <?php if ($user->deleted) : ?>
        <div class="control-group">
            <div class="controls">
                <label for="restore">
                    <input type="checkbox" name="restore" id="restore" value="1" />
                    <?php echo lang('us_restore_note'); ?>
                </label>
            </div>
        </div>
        <?php elseif ($user->banned) : ?>
        <div class="control-group">
            <div class="controls">
                <label for="unban">
                    <input type="checkbox" name="unban" id="unban" value="1" />
                    <?php echo lang('us_unban_note'); ?>
                </label>
            </div>
        </div>
        <?php endif; ?>
    </fieldset>
    <?php endif; ?>
    <div class="form-actions">
        <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('bf_action_save') . ' ' . lang('bf_user'); ?>" />
        <?php echo lang('bf_or'); ?>
        <?php echo anchor(SITE_AREA . '/settings/users', lang('bf_action_cancel')); ?>
    </div>
<?php echo form_close(); ?>
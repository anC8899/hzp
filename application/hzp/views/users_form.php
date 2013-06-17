<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line"> 
<?php 
    $hidden = array('userid' => $user['userid']); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form' );
    echo form_open_multipart('users/update_user',$attributes,$hidden);
?>
    <fieldset>
      <legend><?=$pagetitle?></legend>
      <div class="control-group">
        <label class="control-label" for="input01">账号</label>
        <div class="controls">
        <?php
            $data = array(
              'name'        => 'username',
              'value'       => $user['username'],
              'class'       => 'input-xlarge',  );

            echo $user['userid'] ? form_label($user['username'],'') : form_input($data);
        ?>
         
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">用户名称</label>
        <div class="controls">
          <input type="text" name="uname" class="input-xlarge" value="<?php echo $user['uname'] ?>" /> 
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textarea">密码</label>
        <div class="controls">
         <input type="password" name="password" class="input-xlarge" value="" />
        </div>
      </div>
      <? if(!empty($group)):?>
      <div class="control-group">
        <label class="control-label" for="input01">用户组</label>
        <div class="controls">
            <select name="group">
                <?php foreach($group AS $c):?>
                <option value="<?php echo $c['groupid']?>"   <? echo $c['groupid'] == $user['group'] ? ' selected':'' ?>><?php echo $c['groupname']?></option>
                <?php endforeach?>
            </select>
          <p class="help-block"></p>
        </div>
      </div>
      <? endif ?>
      <div class="form-actions">
        <button class="btn btn-primary" data-toggle="modal" href="#myModal">保存更改</button>
        <!--<button class="btn" >取消</button>-->
      </div>
    </fieldset>
  </form>
				</div>					
			</div>
		</div>
	</div>
</div>

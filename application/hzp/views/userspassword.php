<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line"> 
<?php   
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form' );
    echo form_open_multipart('users/updatePassoord',$attributes);
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

            echo form_label($user['username'],'');
        ?>
         
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">用户名称</label>
        <div class="controls">
          <?php echo $user['uname'] ?>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textarea">密码</label>
        <div class="controls">
         <input type="password" name="password" class="input-xlarge" value="" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="textarea">确认密码</label>
        <div class="controls">
         <input type="password" name="password2" class="input-xlarge" value="" />
        </div>
      </div>
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

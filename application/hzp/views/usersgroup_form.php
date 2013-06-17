<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line"> 
<?php 
    $hidden = array('groupid' => $id); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form' );
    echo form_open_multipart('users/purview',$attributes,$hidden);
?>
    <fieldset>
      <legend>权限管理</legend>
      <?php foreach($menulist as $value) :?>
      <div class="control-group">
        <label class="control-label" for="input01">
        <?php echo $value['title']; ?>
        </label>
        <div class="controls">
        <?php foreach((array)$value['son'] as $son) : ?>
        <div class="purviewgroup">
          <input type="checkbox" name="<?php echo $value['menu_id']?>[]" class="input-mini" value="<?php echo $son['menu_id']; ?>"  <?php echo $son['check']? 'checked=true':''; ?>  "/> 
          <?php echo $son['title']; ?>
        </div>
        <?php endforeach;?> 
        </div>
      </div>
      <?php endforeach;?>
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

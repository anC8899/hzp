<div class="main-right" id="base-right">
	<div class="entry-box box" id="base-right-box">
		<div id="show-companytask-box">
			<div id="companytask-box-content">						
				<div id="content-line">                            
<?php 
    $hidden = array('goods_id' => $goods['goods_id']); 
    $attributes = array('class' => 'form-horizontal', '_lpchecked' => '1','id' =>'form','name'=>'form');
    echo form_open_multipart('goods/update_goods',$attributes,$hidden);
?>
    <fieldset>
      <legend>添加商品</legend>
      <div class="control-group">
        <label class="control-label" for="select01">品牌</label>
        <div class="controls">
            <select name="brand">
                <?php foreach($brand AS $brd):?>
                <option value="<?php echo $brd['brand_id']?>" <?php if($goods['brand_id'] == $brd['brand_id']): echo  ' selected="selected" '; endif ?> ><?php echo $brd['brand_name_en'].'('.$brd['brand_name'].')'?></option>
                <?php endforeach?>
            </select>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="select01">分类</label>
        <div class="controls">
            <select  name="category">
                <?php foreach($category AS $cay):?>
                <option value="<?php echo $cay['cat_id']?>" <?php if($goods['cat_id'] == $cay['cat_id']): echo ' selected="selected" '; endif ?>  ><?php echo $cay['cat_name']?></option>
                <?php endforeach?>
            </select>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="select01">关键字</label>
        <div class="controls">
            <select  name="keywords">
                <?php foreach($keywords AS $key):?>
                <option value="<?php echo $key['cat_id']?>" <?php if($goods['keywords_id'] == $key['cat_id']): echo  ' selected="selected" '; endif ?> ><?php echo $key['keywords']?></option>
                <?php endforeach?>
            </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">商品编号</label>
        <div class="controls">
          <input type="text" name="itme_code" class="input-xlarge" value="<?php echo $goods['itme_code'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">容量</label>
        <div class="controls">
          <input type="text" name="capacity" class="input-xlarge" value="<?php echo $goods['capacity'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">名称</label>
        <div class="controls">
          <input type="text" name="goods_name" class="input-xlarge" value="<?php echo $goods['goods_name'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">介绍</label>
        <div class="controls">
          <textarea rows="10" name="goods_desc" class="input-xlarge" ><?php echo $goods['goods_desc'] ?></textarea>
          <p class="help-block"></p>
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
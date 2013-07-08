<script type="text/javascript">
<!--
$(document).ready(function(){
        
  /*ajax 提交数据加提示信息 */
	$('select').on('change', function () {
	   var name = $(this).attr('name');
       if('son_cate' == name)
       {
        return false;
       }
       var valu = $(this).attr('value');

        $.post('<?php echo site_url('Category/ajaxCategory')?>', {name:name,value:valu},
            function(Str) {
                if(name == 'base_cate')
                {
                     $("select[name=categor]").html('<option>请选择..</option>'+Str);
                     $("select[name=son_cate]").html('<option>请选择..</option>');        
                }else{
                    
                    $("select[name=son_cate]").html('<option>请选择..</option>'+Str);
                }
                   
        });
    });

});
-->
</script>
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
            <select name="base_cate">
                <option>请选择..</option>
                <?php foreach($base_cate AS $bc):?>
                <option value="<?=$bc['bid']?>" <?php if($goods['bid'] == $bc['bid']): echo  ' selected="selected" '; endif ?>><?=$bc['cate_name']?></option>
                <?php endforeach?>
            </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="select01"></label>
        <div class="controls">
            <select name="categor">
            <option>请选择..</option>
            <?php foreach($categor AS $cate):?>            
            <option value="<?=$cate['bid']?>" <?php if($goods['bcaid'] == $cate['bid']): echo  ' selected="selected" '; endif ?>><?=$cate['cate_name']?></option>
            <?php endforeach?>
            </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="select01"></label>
        <div class="controls">
            <select name="son_cate">
            <option>请选择..</option>
            <?php foreach($son_cate AS $scate):?>            
            <option value="<?=$scate['bid']?>" <?php if($goods['cat_id'] == $scate['bid']): echo  ' selected="selected" '; endif ?>><?=$scate['cate_name']?></option>
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
        <label class="control-label" for="input01">名称</label>
        <div class="controls">
          <input type="text" name="goods_name" class="input-xlarge" value="<?php echo $goods['goods_name'] ?>"/>
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input01">规格/容量</label>
        <div class="controls">
          <input type="text" name="capacity" class="input-xlarge" value="<?php echo $goods['capacity'] ?>"/>
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
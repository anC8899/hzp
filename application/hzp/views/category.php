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
                     $("select[name=category]").html('<option>请选择..</option>'+Str);        
                }else{
                    
                    $("#cate").html(Str);                    
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
                <select name="base_cate">
                <option>请选择..</option>
                <?php foreach($base_cate AS $bc):?>
                <option value="<?=$bc['bid']?>"><?=$bc['cate_name']?></option>
                <?php endforeach?>
                </select>
                <select name="category">
                <option>请选择..</option>
                </select>
				</div>
                <table  class="table">
                <thead>
                <th>#</th>
                <th>内容 / 型号</th>
                <th>&nbsp;</th>
                </thead>
                <tbody id="cate"></tbody>
                </table>										
			</div>
		</div>
	</div>
</div>
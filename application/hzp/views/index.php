<div id="wrapper" style="margin: 0 auto;">
<div id="main" style="margin-top: 0px;">
<div class="main-left" id="base-left">			
<div id="left-menu-each-box">
	<div class="entry-box" id="menu-left-box">
		<ul>        
			<li class="each-menu" id="each-menu-first" style="background-image: url(http://youyur.com/images/right.png); background-color: rgb(243, 243, 243); background-position: 100% 50%; background-repeat: no-repeat no-repeat;">
            <a href="person/managecompanytask" style="color: rgb(0, 92, 255);">功能0</a></li>
        <?php
        
        if($son_menu):
            foreach($son_menu AS $m):
             
        ?>
    			<li class="each-menu" id="each-menu-other"><a href="<?php echo base_url("index.php/{$m['url']}");?>"><?php echo $m['title'] ?></a></li>
       <?php 
       
             endforeach;
         endif;
         
       ?>
		</ul>
	</div>

</div>
<div id="left-menu-each-box">
	<div class="entry-box box" id="menu-left-box">
		<ul>
			<li class="each-menu" id="each-menu-first"><a href="person/showmoney">功能1</a></li>
			<li class="each-menu" id="each-menu-other"><a href="person/getmoney">功能2</a></li>
		</ul>
	</div>
</div>
<input type="hidden" id="navigationid" value="3">
		</div>
		
		<div class="main-right" id="base-right">
			<div class="entry-box box" id="base-right-box">
				<div id="show-companytask-box">
					<div id="companytask-box-content">						
						
						<div id="content-line">
							<div class="contact" id="contact1"></div>
						</div>						
						<div class="page"></div>						
						
					</div>
				</div>
			</div>
		</div>
	</div>
		
	</div>
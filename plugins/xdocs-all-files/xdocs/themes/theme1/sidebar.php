<aside class="main-sidebar">
  <?php xdocs_the_quick_links(); ?>
  <?php xdocs_logo(); ?>

  <!-- sidebar: style can be found in sidebar.less -->
  <div class="sidebar" id="scrollspy">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="nav sidebar-menu">
      <li class="active"><a href="#introduction">概述</a>

                  <?php 
                   if( have_rows('add_sections',$post_id) ):
                         $i = 0;
                          while( have_rows('add_sections',$post_id) ): the_row(); 
                              $section_title  =   get_sub_field('section_title');  
							  
							  //原程序：获取wordpress的文章slug最为锚点
                             // $slug = sanitize_title($section_title);
							 
						   //Websoft9修改：直接赋予数字slug
					       $slug = $slug+1;
                          //Websoft9修改代码结束

                
                            $i++;
                            if($i == 1){
                              $active = 'active';
                            }else{
                              $active = '';
                            }
                   ?>
  <!--修改有step的section标题的after属性，使之具备下拉符。w9-fathermenu-arrow增加下拉符的类属性，w9-childmenu-arrow是去掉下拉符的类属性 -->

                 <?php  if( have_rows('steps',$post_id) ): ?>


                   <li class="treeview w9-fathermenu-arrow" id="scrollspy-components"><a href="#<?php echo $slug; ?>"><?php echo $section_title; ?></a>
                  <?php 


                    echo  '<ul class="nav treeview-menu w9-childmenu-arrow">';
                      // loop through rows (sub repeater)
					  $step_slug = $slug*100;
                      while( have_rows('steps',$post_id) ): the_row();
					  
					  //原程序：获取wordpress的文章slug最为锚点
                     // $step_slug = sanitize_title(get_sub_field('step_title'));
					 
					  //Websoft9修改：直接赋予数字slug
					  $step_slug = $step_slug+1;
					  //Websoft9修改代码结束


                         echo '<li class="treeview w9-childmenu-arrow"><a href="#'.$step_slug.'">'. get_sub_field('step_title') .'</a>';
                       endwhile; 
                      echo '</ul>';
                  ?>
                </li>

              <?php else: ?>
            

               <li class=""><a href="#<?php echo $slug; ?>"><?php echo $section_title; ?></a>

                    <?php endif; ?>

              <?php endwhile; endif;?>

            </ul>
          </div>
    </aside>
<?php  include 'header.php'; ?>
<?php  include 'sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content body">


         <!-- Introduction Section -->
          <section id="introduction">
            <div class='section-content'>
              <div class="content-header">
                <h1><?php xdocs_the_title(); ?></h1>
                <?php xdocs_the_version(); ?>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <?php xdocs_the_fetured_image(); ?>
                 </div>
              </div>
              <div class="row">
                  <div class="col-sm-12">
                     <?php xdocs_the_content(); ?>
                  </div>
              </div>
            </div>
          </section>
          <!-- End Introduction Section -->

<?php    
		//websoft9修改后程序
		$slug =0;
		     
 if( have_rows('add_sections',$post_id) ):
    while( have_rows('add_sections',$post_id) ): the_row(); 
        $section_title    =   get_sub_field('section_title');    
        $section_details  =   get_sub_field('section_details');
        $steps_nav        =    get_sub_field('steps_nav');
		
		//原来程序
       // $slug = sanitize_title($section_title);
		
		//websoft9修改后程序开始
		$slug =$slug+1;
		//websoft9修改后程序结束


        
?>

  <section id="<?php echo $slug ; ?>" class="stickem-container">
  <?php
    $output = '';
    $output .= "<div class='section-content'>";
    $output .= "<h2 class='page-header'>{$section_title}</h2>";
    $output .= $section_details; 

//websoft9修改的代码开始
  $step_slug =  $slug*100;
  $step_slug_kit =  $slug*100;  //数字小标记变量

// websoft9修改的代码结束
  
      //Steps
      if( have_rows('steps',$post_id) ): 
        $step_count = 1;
          $s_output  ='';


          if($steps_nav):

              $s_output .= "<div class='stickem'><ul class='steps'>";
              while( have_rows('steps',$post_id) ): the_row();
			  
			    //原来的代码
                //$step_slug = sanitize_title(get_sub_field('step_title'));
				
				//websoft9修改的代码
				$step_slug_kit = $step_slug_kit+1;
				//websoft9修改代码结束

                $s_output .= "<li><a href='#{$step_slug_kit}'>{$step_count}</a></li>";
                $step_count++;
              endwhile;
              $s_output .= "</ul></div>";
          endif;

          // loop through rows (sub repeater)
          while( have_rows('steps',$post_id) ): the_row();
            //$step_slug = sanitize_title(get_sub_field('step_title'));
			
				//websoft9修改的代码
				$step_slug = $step_slug+1;
				//websoft9修改代码结束
				
             $output .= "<div id='{$step_slug}' class='step-content clearfix'>";
             $output .= "<h3 class='steps-header'><a href='#{$step_slug}'>";
             $output .= get_sub_field('step_title');
             $output .= "</a></h3>";
             $output .= get_sub_field('step_details');
             $output .= "</div>";
           endwhile; 

      endif; 
     
      $output .= "</div>";

      if( have_rows('steps',$post_id) ): 
        $output .= $s_output;
      endif; 
      
      echo $output;
    ?>
  </section>
<?php endwhile; endif; ?>

    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
      
<?php  include 'footer.php'; ?>
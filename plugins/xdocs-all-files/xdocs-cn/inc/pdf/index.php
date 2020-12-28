<?php  include 'header.php'; ?>

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
 if( have_rows('add_sections',$post_id) ):
    while( have_rows('add_sections',$post_id) ): the_row(); 
        $section_title    =   get_sub_field('section_title');    
        $section_details  =   get_sub_field('section_details');
        $steps_nav        =    get_sub_field('steps_nav');
        $slug = sanitize_title($section_title);
        
?>

  <section id="<?php echo $slug ; ?>" class="stickem-container">
  <?php
    $output = '';
    $output .= "<div class='section-content'>";
    $output .= "<h2 class='page-header'>{$section_title}</h2>";
    $output .= $section_details; 

      //Steps
      if( have_rows('steps',$post_id) ): 
        $step_count = 1;
          $s_output  ='';




          // loop through rows (sub repeater)
          while( have_rows('steps',$post_id) ): the_row();
            $step_slug = sanitize_title(get_sub_field('step_title'));
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
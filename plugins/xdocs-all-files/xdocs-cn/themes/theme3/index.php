
<?php  include 'header.php'; ?>

<div class="bs-docs-header">
    <div class="container"> <h1><?php xdocs_the_title(); ?></h1>
        <p> <?php xdocs_the_version(); ?></p>
    </div>
</div>
<div class="container bs-docs-container">
    <div class="row">
        <div class="col-md-9" role="main">
            <div class="bs-docs-section">
                <?php xdocs_the_fetured_image(); ?>
                <h1 id="download" class="page-header"><a href="#download"></a>Introduction</h1>
                <?php xdocs_the_content(); ?>
            </div>


            <?php
            if( have_rows('add_sections',$post_id) ):
                while( have_rows('add_sections',$post_id) ): the_row();
                    $section_title    =   get_sub_field('section_title');
                    $section_details  =   get_sub_field('section_details');
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
                            $s_output .= "<div class='stickem'><ul class='steps'>";
                            while( have_rows('steps',$post_id) ): the_row();
                                $step_slug = sanitize_title(get_sub_field('step_title'));
                                $s_output .= "<li><a href='#{$step_slug}'>{$step_count}</a></li>";
                                $step_count++;
                            endwhile;
                            $s_output .= "</ul></div>";

                            // loop through rows (sub repeater)
                            while( have_rows('steps',$post_id) ): the_row();
                                $step_slug = sanitize_title(get_sub_field('step_title'));
                                $output .= "<div id='{$step_slug}' class'step-content'>";
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
        </div>
        <div class="col-md-3" role="complementary">
            <?php  include 'sidebar.php'; ?>
        </div>
    </div>
</div>

<?php  include 'footer.php'; ?>
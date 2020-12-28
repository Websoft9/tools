
<nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top">
        <ul class="nav bs-docs-sidenav">
            <li class=""><a href="#introduction">Introduction</a></li>

            <?php
            if( have_rows('add_sections',$post_id) ):
            $i = 0;
            while( have_rows('add_sections',$post_id) ): the_row();
            $section_title  =   get_sub_field('section_title');
            $slug = sanitize_title($section_title);

            $i++;
            if($i == 1){
                $active = 'active';
            }else{
                $active = '';
            }
            ?>

            <?php  if( have_rows('steps',$post_id) ): ?>

                <li class="" ><a href="#<?php echo $slug; ?>"><?php echo $section_title; ?></a>
                    <?php


                    echo  '<ul class="nav">';
                    // loop through rows (sub repeater)
                    while( have_rows('steps',$post_id) ): the_row();
                        $step_slug = sanitize_title(get_sub_field('step_title'));
                        echo '<li class=""><a href="#'.$step_slug.'">'. get_sub_field('step_title') .'</a>';
                    endwhile;
                    echo '</ul>';
                    ?>
                </li>

            <?php else: ?>


            <li class=""><a href="#<?php echo $slug; ?>"><?php echo $section_title; ?></a>

                <?php endif; ?>


                <?php endwhile; endif;?>

        </ul>
        <a href="#top" class="back-to-top"> Back to top </a>
    </nav>

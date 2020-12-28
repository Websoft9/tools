<?php  include 'header.php'; ?>

    <div class="aligncenter">
        <?php xdocs_logo(); ?>
    </div>



    <!--=================================
     Blog
     =================================-->


    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="post-detail clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <div class="doc-content">
                                    <h1><?php xdocs_the_title(); ?></h1>
                                    <p><?php xdocs_the_version(); ?></p>
                                    <?php xdocs_the_content(); ?>
                                </div><!--document content-->
                            </div><!--column-->
                            <div class="col-xs-12 col-sm-6">
                                <?php xdocs_the_fetured_image(); ?>
                            </div><!--column-->
                        </div><!--post detail-->
                    </div><!--inner row-->
                </div><!--column-->
            </div><!--row-->
        </div><!--container-->
    </section>
        
    <!--=================================
    Accordian Panel
    =================================-->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">       
                <div class="accordian-wrapper">

                    <?php  if( have_rows('add_sections',$post_id) ):
                                while( have_rows('add_sections',$post_id) ): the_row(); 
                                    $section_title    =   get_sub_field('section_title');    
                                    $section_details  =   get_sub_field('section_details');    
                    ?>
                                    <section class="accordian-panel">
                                        <header>
                                            <h4>
                                                <a class="triggerAcc" href="#"><?php echo $section_title; ?>
                                                    <i class=" fa-2x"></i>
                                                </a>
                                            </h4>
                                        </header><!--header-->                          

                                        <div class="accordian-content">
                                          <?php echo $section_details; ?>
                                        </div><!--accordian-content-->
                                    </section><!--accordian-panel-->          
                    
                    <?php endwhile; endif; ?>

                                                                     
                </div><!--accordian-wrapper-->
                        
            </div><!--conten Coloumn-->
        </div><!--row-->
    </div><!--container-->
<?php  include 'footer.php'; ?>
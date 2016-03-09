<?php 
  $course = $data['course']; 
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" data-original-title="Close" data-placement="top"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  
  <h3 class="modal-title er-modal-title"><?php echo $data['title']; ?> [<?php echo $course['description']; ?>]</h3>

  <div class="clearfix"></div>
</div>
<div class="modal-body">

    <!-- BOX OUTLINE -->
    <div class="er-box-outline er-box-outline-sm">
        <!-- BOX INLINE -->
        <div class="er-box-inline">

          <div class="alert hide"></div>
          
          <!-- CONTENT HERE -->
          <form id="sectionForm" role="form" class="form-horizontal" method="post" action="" data-base="<?php echo base_url( $this->uri->segment(2) .'/'. $this->uri->segment(3) ) ?>" enctype="multipart/form-data">
            <div class="form-body">


              <div class="row">

                <div class="col-sm-10">

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="">Year</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="section[year]">
                            <?php for ($i = 1; $i <= 5; ++$i) : ?>
                              <option <?php echo (isset($enrollment) && $enrollment['year'] == $i) ? 'selected' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="">Code</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="section[section]">
                            <?php for ($i = 65; $i <= 90; ++$i) : ?>
                              <option <?php echo (isset($enrollment) && $enrollment['year'] == $i) ? 'selected' : ''; ?> value="<?php echo chr($i); ?>"><?php echo chr($i); ?></option>
                            <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="">Limit</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="section[limit]" value="<?php echo isset($section) ? $section['limit'] : '30'; ?>"> 
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="">Section</label>
                      <div class="col-sm-10">
                        <input type="hidden" id="course-id" value="<?php echo $course['id']; ?>" />
                        <input type="hidden" id="course-title" value="<?php echo $course['title']; ?>" />
                        <input type="text" id="section-name" disabled class="form-control" />
                      </div>
                    </div>
                  </div>

                </div>

              </div>

            </div>

            <div class="form-actions">
              <div class="pull-right">
                <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn red">Submit</button>
              </div>
              
            </div>
          </form>
          <!-- END CONTENT HERE -->

          <div class="clearfix"></div>

        </div> <!-- END OF BOX INLINE -->
    </div><!-- END OF BOX OUTLINE -->
   
    <div class="clearfix"></div>
</div><!-- END OF MODAL BODY -->
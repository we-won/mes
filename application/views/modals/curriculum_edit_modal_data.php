

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" id="close-signup" data-original-title="Close" data-placement="top"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  
  <h3 class="modal-title er-modal-title">Edit Subjects <b>[ <?php echo $data['year'] . " YR : " . $data['sem'] . " SEM"; ?> ]</b></h3>

  <div class="clearfix"></div>
</div>
<div class="modal-body">

    <!-- BOX OUTLINE -->
    <div class="er-box-outline er-box-outline-sm">
        <!-- BOX INLINE -->
        <div class="er-box-inline">

          <div class="alert hide"></div>
          
          <!-- CONTENT HERE -->
          <form id="curriculumEditForm" action="" method="post">
            <select multiple="multiple" name="duallistbox_curriculumEdit[]">
              <?php foreach ($data['subjects'] as $subject) :  ?>
                   <option <?php echo $subject->selected; ?> value="<?php echo $subject->id; ?>"><?php echo $subject->description; ?></option>
              <?php endforeach; ?>
            </select>
            <br>
            <button type="submit" class="btn btn-default btn-block orange" id="save-curriculum-button">Save</button>
          </form>
          <!-- END CONTENT HERE -->

          <div class="clearfix"></div>

        </div> <!-- END OF BOX INLINE -->
    </div><!-- END OF BOX OUTLINE -->
   
    <div class="clearfix"></div>
</div><!-- END OF MODAL BODY -->
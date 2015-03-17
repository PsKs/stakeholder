<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
    <?php
      foreach ($arr_stklist_name as $key => $value) {
        echo "<th class='text-center'>".$value."</th>";
      }
    ?>
      <th class='col-md-1'></th>
    </tr>
  </thead>
  <tbody id='p_scents'>
    <script>
      var scntDiv = $('#p_scents'),
          i = $('#p_scents tr').size() + 1,
          row = 0,
          arr_stklist = <?php echo json_encode($arr_stklist_type); ?>,
          form = [];
      function gen_form() {
        arr_stklist.forEach(function(element, index){
          if (element == "text") {
            form[index] = '<td><textarea class="form-control" rows="2" id="arr_TextAns['+row+']['+index+']"></textarea></td>';
          } else if (element == "level") {
            form[index] = '<td><select class="form-control" id="arr_LevelAns['+row+']['+index+']">\
                              <option value="1" selected="selected">1</option>\
                              <option value="2">2</option>\
                              <option value="3">3</option>\
                              <option value="4">4</option>\
                              <option value="5">5</option></td>';
          } else if (element == "sum") {
            form[index] = '<td><p id="arr_Result['+row+']['+index+']" class="form-control-static text-center"></p></td>';
          }
        });
        row++;
        return form;
      }
      function get_form() {
        scntDiv.append('<tr>'+gen_form()+ 
                      '<td class="text-center">\
                        <button type="button" class="btn btn-warning btn-sm" disabled="disabled" id="remScnt">\
                          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>\
                        </button>\
                      </td></tr>');
      }            
    </script>
    <?php
      echo  '<script type="text/javascript">',
            'get_form();',
            '</script>';
      /*foreach ($arr_stklist_type as $key => $value) {
        if ($value == "text") {
          echo $form[] = "<td><input type='text' class='form-control' name='arr_TextAns[][$key]'/>";
        } elseif ($value == "level") {
          echo $form[] = "<td><select class='form-control' name='arr_LevelAns[][$key]'>
                          <option value='-'>SELECT</option>
                          <option value='1'>1</option>
                          <option value='2'>2</option>
                          <option value='3'>3</option>
                          <option value='4'>4</option>
                          <option value='5'>5</option>";
        } else {
          echo $form[] = "<td><p id='arr_Result[][$key]' class='form-control-static'></p>";
        }
      }*/
    ?>            
  </tbody>
</table>
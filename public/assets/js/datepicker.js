$(function() {
  'use strict';

  if($('#datePickerExample').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#datePickerExample').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    });
    $('#datePickerExample').datepicker('setDate', today);
  }
});
$(function() {
  'use strict';

  if($('#datePickerExample1').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#datePickerExample1').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    });
    $('#datePickerExample1').datepicker('setDate', today);
  }
});
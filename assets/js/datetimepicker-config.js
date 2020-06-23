$(document).ready(function() {
  $(function(){
   $('#dari_tanggal').datetimepicker({
    scrollMonth : false,
    format:'Y-m-d',
    onShow:function( ct ){
     this.setOptions({
      maxDate:$('#sampai_tanggal').val()?$('#sampai_tanggal').val():false
     })
    },
    timepicker:false
   });
   $('#sampai_tanggal').datetimepicker({
    scrollMonth : false,
    format:'Y-m-d',
    onShow:function( ct ){
     this.setOptions({
      minDate:$('#dari_tanggal').val()?$('#dari_tanggal').val():false
     })
    },
    timepicker:false
   });
  });
});
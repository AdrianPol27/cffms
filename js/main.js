$(document).ready(function () {
  $('.table').DataTable();
});

$('#PLUDelivery').click(function(){
  if($(this).is(":checked")) {
      $('#deliveryCwFormGroup').removeClass("d-none");
      $('#deliverySnFormGroup').removeClass("d-none");
  } else {
    $('#deliveryCwFormGroup').addClass("d-none");
    $('#deliverySnFormGroup').addClass("d-none");
  }
});
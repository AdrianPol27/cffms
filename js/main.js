$(document).ready(function () {
  $('.table').DataTable();
});

$('#PLUDelivery').change(function(){
  if($('#PLUDelivery').is(":checked")) {
    $('#deliveryCwFormGroup').removeClass("d-none");
    $('#deliverySnFormGroup').removeClass("d-none");
  } else {
    $('#deliveryCwFormGroup').addClass("d-none");
    $('#deliverySnFormGroup').addClass("d-none");
  }
});
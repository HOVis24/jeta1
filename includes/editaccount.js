$(document).ready(function() {
  $("#editaccountform").on("submit", function(event){
    event.preventDefault();
    var form = $("#editaccountform");
    var formValues= $(this).serialize();
    if (form[0].checkValidity() === false) {
      event.stopPropagation();
    }
    else
    {
      $.ajax({
        url:"controllers/updateaccount.php",  
        method:"POST",  
        data:formValues,  
        success:function(data)  
        {  
          if (data == "success") {
            Swal.fire({
              type: 'success',
              title: 'Successfully Updated!',
              showConfirmButton: true,
              allowOutsideClick: false,
              onClose: () => {
                location.reload();
              }
            })
          }
          if(data == "error"){
            Swal.fire({
              type: 'error',
              title: "Error!",
              showConfirmButton: true,
              allowOutsideClick: false,
              onClose: () => {
                location.reload();
              }
            })
          }

        }
      });
    }
  });
});
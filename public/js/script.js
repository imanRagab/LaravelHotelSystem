
$(function () {
    $(document).on('click','#delete',function(){
          console.log( $(this).attr('user'));
       });

    $(document).on('click','.banOrunban',function(){
        var userID = $(this).attr("user-id");
        var btn=$(this);
        if(btn.html()==" Ban ") {
            alert("You Will Ban receptionist ");
    }else{
        alert("You Will UnBan receptionist ");
    }
        $.ajax({
            url: '/receptionists/ban',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data: {userId: userID},
            success: function (response) {
                console.log(response.post);
               if(btn.html()==" Ban "){
                btn.html(" UnBan ");
               }else{
                btn.html(" Ban ");  
               }      
            }
        });
         
       });
 
});




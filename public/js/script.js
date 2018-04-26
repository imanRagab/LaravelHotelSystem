
$(function () {
    $(document).on('click','.deleteAjax',function(){
        var userID = $(this).attr("user-id");
        var btn=$(this);
        var resp = confirm("Are you sure you want to delete this receptionist?");
        if (resp == true) {
            console.log(userID);
            $.ajax({
                url: '/receptionists/delete',
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                data: {userId: userID},
                success: function (response) {
                    console.log(response);
                    oTable.ajax.reload();
                     
                }
            });

        }
       
       });

    $(document).on('click','.banOrunban',function(){
        var userID = $(this).attr("user-id");
        var btn=$(this);
        if(btn.html()==" Ban ") {
            var resp = confirm("Are you sure you want to Ban this receptionist?");
           
    }else{
        var resp = confirm("Are you sure you want to UnBan this receptionist?");
    }
    if (resp == true) {
        $.ajax({
            url: '/receptionists/ban',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            data: {userId: userID},
            success: function (response) {
                console.log(response);
               if(btn.html()==" Ban "){
                btn.html(" UnBan ");
               }else{
                btn.html(" Ban ");  
               }      
            }
        });

    }

    
         
       });



 
});




/////////////////////////////////////////////////////////////////
            ////Ajax function for delete/////

            HTMLElement.prototype.del = function(delUrl){
                var resp = confirm("Are you sure you want to delete this post?");
                alert(delUrl)
                if (resp == true) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax(
                    {
                        url: delUrl,
                        type: 'delete',
                        dataType: "JSON",
                        data: "{}",
                        success: function (response)
                        {
                                window.location.href = "/clients/approved";
                            
                            console.log(response); // see the reponse sent
                        },
                        error: function(xhr) {
                        console.log(xhr.responseText); 
                    }
                    
                    });
                }
            }
            //////////////////////////////////////////////
            ////Ajax function for approve/////
    
            HTMLElement.prototype.approve = function(id){
                var resp = confirm("Approve this client?");
                var url = '/clients/' + id + '/approve';
                if (resp == true) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax(
                    {
                        url: url,
                        type: 'post',
                        dataType: "JSON",
                        data: "{}",
                        success: function (response)
                        {
                                window.location.href = "/clients/manage";
                            
                            console.log(response); // see the reponse sent
                        },
                        error: function(xhr) {
                        console.log(xhr.responseText); 
                    }
                    
                    });
                }
            }
    
            //////////////////////////////////////////////////////////
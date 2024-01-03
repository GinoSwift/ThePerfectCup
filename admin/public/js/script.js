$(document).on('click','.deleteBlog',function(event){
    event.preventDefault();
    let status = confirm ("Are you sure to delete?");
    console.log(status);

    if(status)
    {
        let id = $(this).parent().attr('id') 
        $.ajax({
            method:'post',
            url:'deleteBlog.php',
            data:{id:id},
            success:function(response){
                if(response == 'success')
                {
                    alert("Successfully deleted!")
                    location.href = "blog.php"
                }
                else{
                    alert(response)
                }
            },
            error:function(error){
            
            }
        })
    }
})
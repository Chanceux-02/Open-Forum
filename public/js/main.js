
    $(document).ready(function() {

        $('.like-count-1').show();
        $("[class^='like-count2-']").hide();

        $('.like-form').each(function() {
            
            let form = $(this);
        
            $('.prevent').on('click', function(event) {event.preventDefault();
                
                var url = form.attr('action');
                var data = form.serialize();
                var postID = form.find('input[name="id"]').val();
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            let uniquePost = $('#like-count-a' + postID).remove();
                            $("[class^='like-count2-']").show();
                            let likesCountElement = $('.like-count2-' + postID);
                            likesCountElement.text(response.likes_count);
                            let checkingCss = '#helpful2a-'+ postID;
                            let checkingCss2 = $(checkingCss).hasClass('helpful');
                            if(checkingCss2){
                                $(checkingCss).toggleClass('helpful2');
                            }else{
                                $(checkingCss).removeClass('helpful2');
                                $(checkingCss).addClass('helpful');
                            }
                        } else {
                            console.log('not success');
                        }
                    }
                });
            });
        });

    });

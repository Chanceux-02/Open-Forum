
    $(document).ready(function() {

        $('.like-count-1').show();
        $("[class^='like-count2-']").hide();

        $('.prevent').each(function() {
            
            $(this).on('click', function(event) {event.preventDefault();
                
                let form = $(this).closest('form');
                var url = form.attr('action');
                var data = form.serialize();
                var postID = form.find('input[name="id"]').val();
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            $("[class^='like-count2-']").show();
                            let uniquePost = $('#like-count-a' + postID);
                            uniquePost.text(response.likes_count);
                            // let likesCountElement = $('.like-count2-' + postID);
                            // likesCountElement.text(response.likes_count);
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

        //para sa comment vote

        $('.comment-count-1').show();
        $("[class^='comment-count2-']");
        let voteBtn = $('.voteBtn');

        voteBtn.each(function(){
            $(this).on('click', function(event) {event.preventDefault();
                let form =  $(this).closest('form');
                var comID = form.find('input[name="comId"]').val();
                let data = form.serialize();
                let url = form.attr('action');
                let this_ = $(this).find('i');
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            $("[class^='comment-count-']").show();
                            let votecountEl = $('.comment-count-' + comID);
                            votecountEl.text(response.comment_count);
                            console.log(votecountEl);
                            let checkingCss = $(this_).hasClass('helpful');
                            if(checkingCss){
                                $(this_).toggleClass('helpful2');
                            }else{
                                $(this_).removeClass('helpful2');
                                $(this_).addClass('helpful');
                            }
                            console.log('success');
                        } else {
                            console.log('not success');
                        }
                    }
                });
            });
        });
        

    });


<div class="jm-working">
    <div class="flex flex-between">
        <div id="progress-label"></div>
        <div id="progress-number"></div>
    </div>

    <div class="progress">
        <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <div class="sub-progress" style="display: none">
        <div class="flex flex-between mt-2">
            <div id="sub-progress-label"></div>
            <div id="sub-progress-number"></div>
        </div>

        <div class="progress">
            <div class="progress-bar" id="sub-progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

</div>

<div class="jm-complete" style="display: none">

    <P class="message">[ Completion Message ]</P>
            
    <div class="mt-3 pb-3 text-center">
        <button class="btn btn-primary" data-dismiss="modal">OK</button>
    </div>


</div>

<div class="jm-failed" style="display: none">

    <P class="message">[ ERROR MESSAGE ]</P>
            
    <div class="mt-3 pb-3 text-center">
        <button class="btn btn-primary" data-dismiss="modal">OK</button>
    </div>


</div>

<style>
    .notransition {
    -webkit-transition: none !important;
    -moz-transition: none !important;
    -o-transition: none !important;
    -ms-transition: none !important;
    transition: none !important;
    }

</style>

<script>

    var last_sub = 0;

    function poll() {

        $.get('{{ Route('jobmonitor.poll', ['update'=>$monitorid]) }}').done(function(data) {
           
            console.log(data);

            $('#progress-bar').css('width', data.amount_completed + "%");
            $('#progress-label').html(data.message);
            $('#progress-number').html( Math.round(data.amount_completed, 2) + "%");


            if(data.sub_total) {
                $('.sub-progress').show();

                $("#sub-progress-bar").removeClass("notransition");
                
                console.log(last_sub + " vs " + data.sub_percent_complete);
                if(data.sub_percent_complete < last_sub) {
                    console.log('no transition')
                    $("#sub-progress-bar").addClass("notransition");
                } else {
                    console.log('allow transition');
                }

                $('#sub-progress-bar').css('width', data.sub_percent_complete + "%");
                $('#sub-progress-label').html(data.sub_message);
                $('#sub-progress-number').html( Math.round(data.sub_percent_complete, 2) + "%");
                

                last_sub = data.sub_percent_complete;
                
            }
           

            if (data.is_complete == 1) {
                // $('body').trigger('job_complete');
                $('.jm-complete .message').html(data.message);
                $('.jm-complete').show();
                $('.jm-working').hide();

                if(data.payload) {
                    $('.jm-working').trigger('job_complete', $.parseJSON(data.payload));
                } else {
                    $('.jm-working').trigger('job_complete');
                }
                
                return;
            }

            if (data.is_error == 1) {
                // $('body').trigger('job_failed');
                $('.jm-failed .message').html(data.message_html);
                $('.jm-failed').show();
                $('.jm-working').hide();
                return;
            }

            // no completion messages, re-poll in 100ms (or $freq);
            window.setTimeout(poll, {{ $freq ?? 100 }});


        });

    }


    poll();

</script>
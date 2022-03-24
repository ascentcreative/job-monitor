
<div class="jm-working">
    <div class="flex flex-between">
        <div id="progress-label"></div>
        <div id="progress-number"></div>
    </div>

    <div class="progress">
        <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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


<script>

    function poll() {

        $.get('{{ Route('jobmonitor.poll', ['update'=>$monitorid]) }}').done(function(data) {
           
            $('#progress-bar').css('width', data.amount_completed + "%");
            $('#progress-label').html(data.message);
            $('#progress-number').html( Math.round(data.amount_completed, 2) + "%");

            if (data.is_complete == 1) {
                // $('body').trigger('job_complete');
                $('.jm-complete .message').html(data.message);
                $('.jm-complete').show();
                $('.jm-working').hide();
                return;
            }

            if (data.is_error == 1) {
                // $('body').trigger('job_failed');
                $('.jm-failed .message').html(data.message);
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
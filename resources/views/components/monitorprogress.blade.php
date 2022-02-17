
<div class="flex flex-between">
    <div id="progress-label"></div>
    <div id="progress-number"></div>
</div>
<div class="progress">
    <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>


<script>

    function poll() {

        $.get('{{ Route('jobmonitor.poll', ['update'=>$monitorid]) }}').done(function(data) {
           
            $('#progress-bar').css('width', data.amount_completed + "%");
            $('#progress-label').html(data.message);
            $('#progress-number').html( Math.round(data.amount_completed, 2) + "%");

            if (data.is_complete == 1) {
                $('body').trigger('job_complete');
                return;
            }

            if (data.is_error == 1) {
                $('body').trigger('job_failed');
                return;
            }

            // no completion messages, re-poll in 100ms (or $freq);
            window.setTimeout(poll, {{ $freq ?? 100 }});


        });

    }


    poll();

</script>
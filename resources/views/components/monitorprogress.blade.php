
<div class="flex flex-between">
    <div id="progress-label"></div>
    <div id="progress-number"></div>
</div>
<div class="progress">
    <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>


{{-- 
    
    Need to update this script.

    Currently, if the freq is too low, it will fire off requests before the previous ones have completed, causing a cascade of processes on the server.

    Instead, it should poll, wait for a response and then set a short TimeOut (single shot) which polls again.
    
    
    --}}
<script>

    function poll() {

        $.get('{{ Route('jobmonitor.poll', ['update'=>$monitorid]) }}').done(function(data) {
           
            $('#progress-bar').css('width', data.amount_completed + "%");
            $('#progress-label').html(data.message);
            $('#progress-number').html( Math.round(data.amount_completed, 2) + "%");

            if (data.is_complete == 1) {
               // window.clearInterval($handle);
                $('body').trigger('job_complete');
                return;
            }

            if (data.is_error == 1) {
               // window.clearInterval($handle);
                $('body').trigger('job_failed');
                return;
            }

            // no completion messages, re-poll in 100ms;
            window.setTimeout(poll, 100);


        });

    }

    // $handle = window.setInterval(() => {
    // $handle = wind
        // poll();
    //}, {{ $freq ?? 250 }});

    poll();

</script>
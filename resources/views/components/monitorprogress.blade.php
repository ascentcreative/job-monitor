
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
                window.clearInterval($handle);
                $('body').trigger('job_complete');
            }
        });

    }

    $handle = window.setInterval(() => {
        poll();
    }, 250);

    poll();

</script>
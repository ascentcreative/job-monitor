@push('modal-scripts')

<script>

    $('#ajaxModal').on('hide.bs.modal', function (e) {
        window.location.reload();
    });

    // $('body').on('job_complete', function() {
    //     $('#ajaxModal .working').hide();
    //     $('#ajaxModal .complete').show();
    // });

    // $('body').on('job_failed', function() {
    //     $('#ajaxModal .working').hide();
    //     $('#ajaxModal .failed').show();
    // });

</script>

@endpush

<x-cms-modal modalId="ajaxModal" size="sm"
    :backdropclose="false" :closebutton="false" :keyboardclose="false"
    :showHeader="true" :showFooter="false" :fade="false"

    >

    <x-slot name="title">
        {{ $job_title ?? "Progress"}}
    </x-slot>

    <div class="working">    

        <x-jobmonitor-progress monitorid="{{ $monitor_id }}" freq="{{ $freq ?? 500 }}" />
        
    </div>

</x-cms-modal>



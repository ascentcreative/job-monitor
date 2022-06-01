@extends('cms::modal')

@php
    $modalFade = false;
    $modalShowHeader = true;
    //$modalShowFooter = true;
    $modalCenterVertical = false;
    //$modalSize = "modal-lg";
    $modalCloseButton = false;
@endphp

@section('modalTitle')
   {{ $job_title ?? "Progress"}}
@endsection


@section('modalContent')

    <div class="working">    

        <x-jobmonitor-progress monitorid="{{ $monitor_id }}" freq="{{ $freq ?? 500 }}" />
        
    </div>

@endsection




@push('scripts')

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
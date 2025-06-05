{{-- @extends('cms::modal')

@php
    $modalFade = false;
    $modalShowHeader = true;
    //$modalShowFooter = true;
    $modalCenterVertical = false;
    //$modalSize = "modal-lg";
    $modalCloseButton = false;
    $back
@endphp

@section('modalTitle')
   {{ $job_title ?? "Progress"}}
@endsection


@section('modalContent')

    <div class="working">    

        <x-jobmonitor-progress monitorid="{{ $monitor_id }}" freq="{{ $freq ?? 500 }}" />
        
    </div>

@endsection --}}

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
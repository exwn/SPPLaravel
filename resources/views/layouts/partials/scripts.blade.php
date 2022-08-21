<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script>


<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $(".alert").fadeTo(10000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
</script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>


{{ $script ?? ''}}

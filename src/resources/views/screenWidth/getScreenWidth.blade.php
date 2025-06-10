@include('screenWidth::screenWidthLoader')
<form action="{{ route('setscreenWidth') }}" method="post">
    @csrf
    <input type="hidden" name="screenWidth" class="screenWidth" value="">
</form>
<script>
    let screenWidth = window.screen.width;
    document.querySelector('.screenWidth').value = screenWidth;
    document.querySelector('form').submit();
</script>

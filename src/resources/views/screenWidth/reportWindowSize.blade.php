<script>
    let screenWidth_sending_data = false;
    let screenWidth_get_raw = '{{ screenWidth_get() }}';
    let screenWidth_get = parseInt(screenWidth_get_raw, 10);
    if (isNaN(screenWidth_get) || screenWidth_get <= 0) {
        screenWidth_get = 0;
    }
    let screenWidth_auto_reload = {{ config('screenWidth.auto_reload') }} ?
        {{ config('screenWidth.auto_reload') }} : false;
    let screenWidth_width = 0;

    function screenWidth_update_width() {
        screenWidth_width = (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth);
    }
    screenWidth_update_width();
    console.log('screenWidth_get');
    console.log(screenWidth_get);
    console.log('screenWidth_width');
    console.log(screenWidth_width);

    function reportWindowSize() {
        if (screenWidth_sending_data == true) {
            return false;
        }
        screenWidth_sending_data = true;
        fetch('{{ route('reportWindowSize') }}', {
            method: 'POST',
            mode: 'same-origin',
            headers: {
                "Content-Type": "application/json; charset=utf-8",
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                width: screenWidth_width
            })
        }).then((data) => {
            if (screenWidth_auto_reload == true) {
                window.location.reload();
            }
            screenWidth_sending_data = false;
            if (typeof onReportWindowSize === 'function') {
                screenWidth_onReportWindowSize();
            }
        });
    }
    const screenWidth_debounce = (callback, wait) => {
        let screenWidth_timeoutId = null
        return (...args) => {
            window.clearTimeout(screenWidth_timeoutId)
            screenWidth_timeoutId = window.setTimeout(() => {
                callback.apply(null, args)
            }, wait)
        }
    }
    window.addEventListener('resize', screenWidth_debounce(() => {
        screenWidth_update_width();
        if (Math.abs(screenWidth_width - screenWidth_get) > 20) {
            reportWindowSize()
        }
    }, 750))
    //   If screenWidth_get is 0, this is first time — force one-time report and reload
    if (screenWidth_get === 0) {
        console.log('First time width detection — sending and reloading...');
        reportWindowSize(true);
    } else if (Math.abs(screenWidth_width - screenWidth_get) > 20) {
        console.log('Screen width mismatch, reporting...');
        reportWindowSize();
    } else {
        console.log('No significant width change or already in sync.');
    }
</script>

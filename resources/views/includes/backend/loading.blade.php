<script>
    const setLoading = (state) => {
    const loading = document.querySelector("#loading")

    if(state) {
        return loading.style.display = 'flex';
    }
    return loading.remove();
    // return loading.style.display = 'none';
    }
    $(document).ready(function(){
        setLoading(false)
    })

    // window.onbeforeunload = function(){
    //     setLoading(true)
    // }
</script>
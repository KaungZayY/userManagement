@if (session('success'))
    <div id="flash-message" style="background-color: #48bb78; color: #fff; padding: 0.5rem 1rem; ">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div id="flash-message" style="background-color: #e40f0f; color: #fff; padding: 0.5rem 1rem; ">
        {{ session('error') }}
    </div>
@endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(function() {
                flashMessage.style.opacity = '0';
                setTimeout(function() {
                    flashMessage.remove();
                }, 1000);
            }, 2000);
        }
    });
</script>

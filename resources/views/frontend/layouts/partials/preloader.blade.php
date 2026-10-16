<div class="bg-fixed" aria-hidden="true"></div>

{{-- Lean preloader: logo + golden glow (shob page-e) --}}
<div class="preloader pl-lean" id="preloader" aria-label="Loading">
    <div class="pl-mark">
        <img src="{{ asset('frontend') }}/img/logo-full.png" alt="Unicorn Group">
    </div>
</div>

{{-- Lift intro: sudhu jei page @push('preloader') korbe (home) --}}
@stack('preloader')

<script>
    var pls = 0;
    try {
        pls = sessionStorage.getItem("pl")
    } catch (e) {}
    var pi = document.querySelector(".pl-intro"),
        pn = document.querySelector(".pl-lean");
    if (pi && !pls) {
        pn && pn.remove()
    } else {
        pi && pi.remove()
    }
</script>
<div id="scrollBar"></div>
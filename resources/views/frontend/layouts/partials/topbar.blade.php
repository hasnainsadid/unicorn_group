<div class="topbar">
    <div class="container">
        <div class="left">
            @if (setting('phone'))
                <a href="{{ tel_href(setting('phone')) }}">📞 {{ setting('phone') }}</a>
            @endif
            @if (setting('email'))
                <a href="mailto:{{ setting('email') }}">✉ {{ setting('email') }}</a>
            @endif
        </div>
        <div class="right">
            @if (setting('address'))
                <span>📍 {{ setting('address') }}</span>
            @endif
            @if (setting('working_hours'))
                <span>🕘 {{ setting('working_hours') }}</span>
            @endif
        </div>
    </div>
</div>
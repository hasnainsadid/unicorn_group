@if(isset($clients) && $clients->count())
<section id="clients" style="padding:80px 0">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Trusted By</span>
      <h2>Our Clients</h2>
    </div>
  </div>
  <div class="marquee">
    <div class="track" id="track">
      @foreach($clients as $client)
        <div class="client" title="{{ $client->name }}">
          @if($client->logo)
            <img src="{{ imageShow($client->logo) }}" alt="{{ $client->name }}" loading="lazy">
          @else
            {{ $client->name }}
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
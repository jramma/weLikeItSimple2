<section>
  <div class="relative container text-center py-8 lg:py-16 lg:w-3/4">
    <h1 class="text-gray-1 text-center font-gilroy text-2xl font-bold leading-3.625 pb-5">Welcome to Mortensen</h1>
    <p class="mb-12 lg:text-lg lg:px-12 text-gray-1 font-gilroy-regular text-1.25  font-400 leading-1.875">Far far
      away, behind the word mountains, far from the <br>countries Vokalia and Consonantia, there live the blind
      texts</p> @php
        // Array with numbers from 1 to 4
        $numbers = range(1, 4);
      @endphp
    <div class="w-full h-full mySwiper overflow-x-hidden relative pb-0">
      <div class="swiper-wrapper ">
        @foreach ($numbers as $number)
          <div class="swiper-slide">
            <div class="w-full aspect-video ">
              <img class="w-full h-full object-cover rounded-md" src="@asset('images/image' . $number . '.jpeg')" alt="">
            </div>
          </div>
        @endforeach
      </div>
      <div class=" -bottom-22  mySwiper-pagination z-10 color-black"></div>
    </div>
    <div
      class="cursor-pointer absolute -right-16 top-5/8  z-10 mySwiper-button-next hidden lg:flex">
      {!! get_svg('images.icons.chevron', 'h-8 w-auto rotate-180') !!}</div>
    <div
      class="cursor-pointer absolute -left-16 top-5/8  z-10 mySwiper-button-prev hidden lg:flex">
      {!! get_svg('images.icons.chevron', 'h-8 w-auto') !!}</div>
  </div>
</section>

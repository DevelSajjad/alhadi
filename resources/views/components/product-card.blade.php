@foreach ($products as $value)
<div>
  <div style="max-width: 200px; height: 400px; margin: auto;">
    <div class="product-container" >
      <div class="content">
          <p style="float: right;margin-top: -15px;">
              @if($value->quantity > 0)
                  <span class="ps-shoe__price"
                        style="font-size: 10px;background: #8b75b3; padding: 2px; border-radius: 4px; color: #fff"><strong>Available</strong></span>
              @else
                  <span class="ps-shoe__price"
                        style="font-size: 10px;background: red; padding: 2px; border-radius: 4px; color: #fff;"><strong>Out of stock</strong></span>
              @endif
          </p>
        <div class="content-overlay" ></div>
        <img style="height: 200px!important; max-width: 200px!important;" class="content-image"
          src="{{ asset($value->thumbnail_image) }}">
        @if($value->quantity > 0 && $value->price > 0)
        <div class="content-details fadeIn-top" style="margin-top: -50px;">
          <a class="btn btn-success add-to-cart" data-id="{{ $value->id }}">
            <i class="fa fa-shopping-cart"></i> Add To Cart
          </a>
        </div>
        @endif
        <div class="content-details fadeIn-bottom">
          <a class="btn btn-success" href="{{ route('product.details', $value->slug) }}"><i class="fa fa-tasks"></i>
            See Details</a>
        </div>
      </div>
    </div>
    <div style="float: left; padding-bottom: 27px;">
        <hr style="    width: 200px;">
      <p class="product-name" style="margin: 0px; font-size: 13px; ">
        <a style="font-weight: bold; font-size: 14px; color: black;"
          href="{{ route('product.details', $value->slug) }}">{{ $value->name }}</a>
      </p>

      @if($value->price > 0)
      <h6 style="font-weight: bold; text-align: center; color: #005caf;">{{ $value->price }} Tk.</h6>
      @else
      <span style="font-weight: bold; color: #005caf;">Call for price</span>
      @endif

    </div>
  </div>
</div>

@endforeach


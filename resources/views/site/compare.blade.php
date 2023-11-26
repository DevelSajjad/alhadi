@extends('layouts.frontend_layout')

@section('stylesheet')
@endsection
<style>
  .border-d{
    border: black 1px solid;
  }
  tr{
    border-top: 1px solid;
  }
  .border-down{
    border-bottom: 1px solid;
  }
  .th-name{
    border-left: 1px solid;
    padding: 10px;
    font-weight: 700;
  }
  .td-p1, .td-p2{
    border-left: 1px solid;
    padding: 10px;
    font-weight: 400;
    border-right: 1px solid;
  }
  .td-p3{
    border-left: 1px solid;
    padding: 10px;
    font-weight: 400;
    border-right: 1px solid;
  }
</style>

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      @if(isset($com_p1))
        {{--<div class="row">--}}
              {{--<div class="col-md-3  col-lg-3  col-xl-3  border-d">--}}
          <div class="row"><div class="col-12 h4 p-5"><h1>Product Details</h1></div></div>
          <table style="min-width: 100%;">
            <tbody>

              <tr>
                <th width="200" class="th-name">Name</th>
                @if(isset($com_p1))
                  <td class="td-p1">{{ $com_p1->name }}</td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2">{{ $com_p2->name }}</td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3">{{ $com_p3->name }}</td>
                @endif
              </tr>

              <tr>
                <th width="200" class="th-name">Image</th>
                @if(isset($com_p1))
                  <td class="td-p1"><img src="{{ $com_p1->thumbnail_image }}" width="150" height="200" alt="{{ $com_p1->name }}"></td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2"><img src="{{ $com_p2->thumbnail_image }}" width="150" height="200" alt="{{ $com_p2->name }}"></td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3"><img src="{{ $com_p3->thumbnail_image }}" width="150" height="200" alt="{{ $com_p3->name }}"></td>
                @endif
              </tr>
              <tr>
                <th width="200" class="th-name">Price</th>
                @if(isset($com_p1))
                  <td class="td-p1">{{ $com_p1->price }} TK</td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2">{{ $com_p2->price }} TK</td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3">{{ $com_p3->price }} TK</td>
                @endif
              </tr>
              <tr>
                <th width="200" class="th-name">Category</th>
                @if(isset($com_p1))
                  <td class="td-p1">{{ $com_p1->category_name }}</td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2">{{ $com_p2->category_name }}</td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3">{{ $com_p3->category_name }}</td>
                @endif
              </tr>
              <tr>
                <th width="200" class="th-name">Sub-Category</th>
                @if(isset($com_p1))
                  <td class="td-p1">{{ $com_p1->sub_category_name }}</td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2">{{ $com_p2->sub_category_name }}</td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3">{{ $com_p3->sub_category_name }}</td>
                @endif
              </tr>
              <tr>
                <th width="200" class="th-name">Brand</th>
                @if(isset($com_p1))
                  <td class="td-p1">{{ $com_p1->brand_name }}</td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2">{{ $com_p2->brand_name }}</td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3">{{ $com_p3->brand_name }}</td>
                @endif
              </tr>
              <tr class="border-down">
                <th width="200" class="th-name">Availability</th>
                @if(isset($com_p1))
                  <td class="td-p1">{{ ($com_p1->quantity > 0) ? "Available" : "Out Of Stock" }}</td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p2">{{ ($com_p2->quantity > 0) ? "Available" : "Out Of Stock" }}</td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p3">{{ ($com_p3->quantity > 0) ? "Available" : "Out Of Stock" }}</td>
                @endif
              </tr>
              <tr class="border-down">
                <th width="200" class="th-name">Option</th>
                @if(isset($com_p1))
                  <td class="td-p1">
                    <a href="{{ route('compare.remove', $com_p1->id) }}" class="btn btn-danger btn-sm">remove</a>
                  </td>
                @endif
                @if(isset($com_p2))
                  <td class="td-p1">
                    <a href="{{ route('compare.remove', $com_p2->id) }}" class="btn btn-danger btn-sm">remove</a>
                  </td>
                @endif
                @if(isset($com_p3))
                  <td class="td-p1">
                    <a href="{{ route('compare.remove', $com_p3->id) }}" class="btn btn-danger btn-sm">remove</a>
                  </td>
                @endif
              </tr>

            </tbody>
          </table>
              {{--</div>--}}
        {{--</div>--}}
      @else
        <div class="ps-section__content text-center">
          <h2>No product to compare</h2>
        </div>
      @endif
    </div>
  </div>
@endsection

@section('script')

@endsection



@extends('backend.layout.master')

@section('content')

<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">Product Summary</h5>
            </div>
            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Product id</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>category name</th>
                        <th>Subcategory name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsFromDB as $product)

                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="recent-product-img">
                                    <img src="{{asset('backend/assets/images/icons/chair.png')}}" alt="">
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1 font-14">{{$product->name}}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{$product->slug}}</td>
                        <td> {{$product->Category?$product->Category->name:'Not Found'}}</td>
                        <td> {{$product->SubCategory?$product->SubCategory->name:'Not Found'}}</td>
                        <td>{{$product->created_at->format('d M Y')}}</td>
                        <td>
                            <div class="d-flex order-actions">
                                <form method="POST" action="{{route('products.destroy',$product->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete"><i class="bx bx-trash"></i></button>
                                </form>
                                <a href="{{route('products.edit', $product->id)}}" class="ms-4"><i
                                        class="bx bx-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
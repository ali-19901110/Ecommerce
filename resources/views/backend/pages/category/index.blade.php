@extends('backend.layout.master')

@section('content')
<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">Categories Summary</h5>
            </div>
            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            {{$dataTable->table(['class' => 'table table-bordered nowrap w-100'], true)}}
            {{-- <table class="table align-middle mb-0" id="category_table">
                <thead class="table-light">
                    <tr>
                        <th>Category id</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead> --}}
                {{-- <tbody>
                    @foreach ($categoriesFromDB as $category)

                    <tr>
                        <td>{{$category->id}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="recent-product-img">
                                    <img src="{{asset('backend/assets/images/icons/chair.png')}}" alt="">
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1 font-14">{{$category->name}}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->created_at->format('d M Y')}}</td>
                        <td>
                            <div class="d-flex order-actions">
                                <form method="POST" action="{{route('categories.destroy',$category->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete"><i class="bx bx-trash"></i></button>
                                </form>
                                <a href="{{route('categories.edit', $category->id)}}" class="ms-4"><i class="bx bx-cog"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody> --}}
            {{-- </table> --}}
        </div>
    </div>
</div>
@include('backend.pages.category.componants.create')
@include('backend.pages.category.componants.edit')
@endsection
@push('scripts')
{{$dataTable->scripts(attributes: ['type'=> 'module'])}}
<script src="{{asset('backend/pages/category.js')}}"></script>
@endpush
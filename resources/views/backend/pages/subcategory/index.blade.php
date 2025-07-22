@extends('backend.layout.master')

@section('content')

<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">Subcategories Summary</h5>
            </div>
            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            {{ $dataTable->table(['class' => 'table table-bordered nowrap w-100', 'id' => 'subcategory-table'], true) }}
            {{-- <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>SubCategory id</th>
                        <th>SubCategory</th>
                        <th>Slug</th>
                        <th>category name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategoriesFromDB as $subcategory)

                    <tr>
                        <td>{{$subcategory->id}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="recent-product-img">
                                    <img src="{{asset('backend/assets/images/icons/chair.png')}}" alt="">
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1 font-14">{{$subcategory->name}}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{$subcategory->slug}}</td>
                        <td> {{$subcategory->Category?$subcategory->Category->name:'Not Found'}}</td>
                        <td>{{$subcategory->created_at->format('d M Y')}}</td>
                        <td>
                            <div class="d-flex order-actions">
                                <form method="POST" action="{{route('subcategories.destroy',$subcategory->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete"><i class="bx bx-trash"></i></button>
                                </form>
                                <a href="{{route('subcategories.edit', $subcategory->id)}}" class="ms-4"><i
                                        class="bx bx-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>
    </div>
</div>

@include('backend.pages.subcategory.componnants.create')
@include('backend.pages.subcategory.componnants.edit')
@endsection
@push('scripts')
{{$dataTable->scripts(attributes: ['type'=> 'module'])}}
<script src="{{asset('backend/pages/subcategory.js')}}"></script>
@endpush
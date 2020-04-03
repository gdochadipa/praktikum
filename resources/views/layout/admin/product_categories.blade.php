@extends('components.admin.app_dash')
@section('title')
    Product Categories
@endsection
@section('nav-categories')
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                    <i class="material-icons">content_paste</i>
                  <h4 class="card-title ">  Product Categories</h4>
                  <li class="d-none d-lg-block"> <a href="{{route('category.add')}}" class="btn header-btn">Add New Category</a>
                    </li>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table">
                      <thead class=" text-info">
                        <th>
                          ID
                        </th>
                        <th>
                          Category_name
                        </th>
                      </thead>
                      <tbody> 
                            @foreach ($all_category as $category)
                              <tr>
                            <td>
                              {{$loop->iteration}}
                            </td>
                            <td>
                              {{$category->category_name}}
                            </td>
                           <td class="td-actions text-left">
                                <a href="{{route('category.edit',$category->id)}}"  rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">edit</i>
                                </a>
                                <form style="display:inline-block;" action="{{route('category.destroy',['id'=>$category->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">delete</i>
                                  </button>
                                </form>
                            
                              </td>
                          </tr>
                          @endforeach

                    </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
@endsection
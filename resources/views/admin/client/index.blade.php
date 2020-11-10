@extends('layouts.admin')

@section('content')
 <!-- Main content -->

 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
      

          <div class="card">
            <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h3 class="card-title">Post List</h3>
              <a href="{{route('client.create')}}" class="btn btn-primary">Create Client</a>
            </div>
        </div>


         
        
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Tele</th>
                  <th>Date</th>

                  <th>Active</th>
                 
                </tr>
                </thead>
                <tbody>
                    @if($clients->count())
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>
                                <div style="max-width: 70px; max-height:70px;overflow:hidden">
                                    <img src="{{ asset($client->image) }}" class="img-fluid img-rounded" alt="">
                                </div>
                            </td>
                            <td>{{ $client->name }}</td>
                            
                            <td>{{ $client->tele }}</td>
                           
                           
                            <td style="width: 130px">{{ $client->created_at->format('d M, Y') }}</td>
                            <td class="d-flex">
                                <a href="{{ route('client.show', [$client->id]) }}"  class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                <a href="{{ route('client.edit', [$client->id]) }}" class="btn btn-sm btn-primary mr-1"> <i class="fas fa-edit"></i> </a>
                               
                                <form action="{{ route('client.destroy', [$client->id]) }}" class="mr-1" method="POST">
                                    @method('DELETE')
                                    @csrf 
                                    <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else   
                        <tr>
                            <td colspan="6">
                                <h5 class="text-center">No posts found.</h5>
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Tele</th>
                  <th>Date</th>

                  <th>Active</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
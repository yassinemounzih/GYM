@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Post List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Post list</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->

@if($abonnements->count())

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Clients List</h3>
                            <a href="{{ route('abonnement.create') }}" class="btn btn-primary">Create Clients</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>ASRN</th>
                                    <th>Pay</th>
                                    <th>Date Payée</th>
                                    <th>Date fin</th>
                                   

                                  
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($abonnements->count())
                                @foreach ($abonnements as $abonnement)
                                    <tr>
                                        <td>{{ $abonnement->id }}</td>
                                        <td>
                                            <div style="max-width: 70px; max-height:70px;overflow:hidden">
                                                <img src="{{ asset($abonnement->image) }}" class="img-fluid img-rounded" alt="">
                                            </div>
                                        </td>
                                        <td>{{ $abonnement->name }}</td>
                                        <td>{{ $abonnement->asrn }}</td>
                                        <td>{{ $abonnement->payment }}</td>
                                        <td style="color: green"><strong>{{ $abonnement->date_dubet }}</strong></td>
                                      
                                        <td style="color: red"><strong>{{ $abonnement->date_fine }}</strong></td>
                                        
                                       
                                        <td class="d-flex">
                                            <a href="#" class="btn btn-sm btn-success mr-1"> <i class="fas fa-eye"></i> </a>
                                            <a href= "# " class="btn btn-sm btn-primary mr-1 btn btn-info edit"  id="edit" > <i class="fas fa-edit"></i> </a>
                                            <a href="#" target="_blank" class="btn btn-sm btn-dark mr-1"> <i class="fas fa-link"></i> </a>
                                            <form action="#" class="mr-1" method="POST">
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
                                            <h5 class="text-center">No Abonnement found.</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>ASRN</th>
                                    <th>Pay</th>
                                    <th>Date Payée</th>
                                    <th>Date fin</th>
                                    

                                  
                                    <th style="width: 40px">Action</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

      <!-- /.modal -->

      <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Update</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{route('abonnement.update', [$abonnement->id])}}" id="ed_a" method="POST" >
                @csrf 
                @method('PUT')

                
            <div class="modal-body">

                
                <input type="hidden" name="update_h" id="update_id" >

                <div class="form-row">
                    <div class="col-md-3"> </div>
                    <div class="form-group  col-md-6">
                        
                     <input style="text-align: center;" type="text" name="name" class="form-control" id="name"  disabled>
                      </div>
                      </div>
                <div class="form-group">
                    <label for="title"> Date Dube</label>
                    <input type="datetime-local" id="dateD" name="dateD" value=""  class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4"><b>Payment</b></label>
                      <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="radio-inline">
                              <input type="radio" id="Oui"  value="Oui" name="pay" class="form-control" required checked><b>Oui</b>
                            </label>
                          </div>
                        <div class="col-sm-4">
                          <label class="radio-inline">
                            <input type="radio" id="Non" value="Non" name="pay" class="form-control" ><b>Non<b>
                          </label>
                         
                        </div>   
                      </div>
                    </div>
                  </div>
            </div>
   
        </form>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <input type="submit"  class="btn btn-outline-light" value="Update changes">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      @else   
    
              <h1 class="text-center">No Abonnement found.</h1>
       
  @endif

@endsection





@section('style')

@endsection
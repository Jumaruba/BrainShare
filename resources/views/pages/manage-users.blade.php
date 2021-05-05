@extends('layouts.app')

@section('content')

    <!-- Mobile -  Management Navigation Top Bar-->
    @include('partials.management.mobile-side-bar')
  
    <div class="d-flex justify-content-between page-margin management" id="users"> 
        <!-- Management Navigation SideBar -->
        @include('partials.management.side-bar')
  
        <div class="col-md-9 ms-md-auto col-lg-9 px-md-4 side-content">
            <h2 class="mb- mt-5">Users</h2>

            <!-- Search by username -->
            <form class="mt-5 d-flex justify-content-between flex-wrap mb-3">
                <div class="input-group manage-search mb-3">
                    <input type="text" class="form-control" placeholder="Search by username">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <div id="manage-users-alert">    
            </div>
            
            <!-- Table -->
            <div class="table-responsive w-100">
         
                <div class="table-entries">
                    Showing {{$users->perpage() * ($users->currentpage()-1)}} 
                    to {{$users->perpage() * ($users->currentpage()) - 1 }} 
                    of {{$users->total()}} entries
                </div>
                <table class="table table-hover align-middle">
                    <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col"><i class="fas fa-sort"></i>Username</th>
                          <th scope="col"><i class="fas fa-sort big-row"></i>Date</th>
                          <th scope="col"><i class="fas fa-sort"></i>Banned</th>
                          <th scope="col"><i class="fas fa-sort"></i>Role</th>
                          <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr data-user-id="{{$user->id}}">
                                <th>{{$loop->index + $users->perpage() * ($users->currentpage()-1)}}</th>
                                <td>
                                    <!-- TODO: get profile image -->
                                    <a href="profile.php">
                                        <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile icon">
                                        <span>{{$user->username}}</span>
                                    </a>
                                </td>
                                <td> {{ date('d-m-Y', strtotime($user->getAttribute('signup_date'))) }}</td>
                                @include('partials.management.users.user-actions', ['id' => $user->id, 'role'=> $user->user_role, 'ban'=> $user->ban])
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
  
            <!-- Get pagination -->
            {{ $users->links() }}
        </div>
    </div>
  
@endsection
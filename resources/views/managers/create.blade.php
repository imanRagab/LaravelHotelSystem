@extends('layouts.admin.master')

@section('content')
   <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create Manager Page </h3>
        </div>
        <!--/ .box-header -->
        <!-- form start -->
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail">Email-Address</label>
                    <input id="exampleInputEmail" class="form-control" placeholder="Enter email" type="email"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input id="exampleInputName" class="form-control" placeholder="Enter name" type="text"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input id="exampleInputPassword" class="form-control" placeholder="Enter password" type="password"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input id="exampleInputPassword" class="form-control" placeholder="Enter password" type="password"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputNationalId">National id</label>
                    <input id="exampleInputNationalId" pattern="[0-9]*" class="form-control" placeholder="Enter national id" type="text"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <input id="exampleInputFile" type="file"/>
                </div> 
            </div>
            <div class="box-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
   </div>

   

@endsection
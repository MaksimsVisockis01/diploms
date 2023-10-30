@extends('layouts.base')

@section('page.title')
    Register
@endsection

@section('content')
<section class="signup-form">
     <h1>Sign up</h1>
     <form action="{{ route('register.store') }}" method="POST">
         {{ csrf_field() }}
         <div class="txt_field">
             <input name="name" required>
             <span></span>
             <label>Name</label>
         </div>
         <div class="txt_field">
             <input type="email" name="email" required>
             <span></span>
             <label>Email</label>
         </div>
         <div class="txt_field">
             <input name="uid" required>
             <span></span>
             <label>Username</label>
         </div>
         <div class="txt_field">
         <input type="password" name="password" required>
             <span></span>
             <label>Password</label>
         </div>
         <div class="txt_field">
         <input type="password" name="password_repeat" required>
             <span></span>
             <label>Repeat Password</label>
         </div>
         <button type="submit">Sign up</button>
     </form>
</section>
@endsection